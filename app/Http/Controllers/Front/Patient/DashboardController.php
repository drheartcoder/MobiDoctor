<?php

namespace App\Http\Controllers\Front\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\ConsultationTransactionModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;
use App\Models\UserNotificationModel;

use Sentinel;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->ConsultationTransactionModel = new ConsultationTransactionModel();
		$this->ConsultationModel            = new ConsultationModel();
		$this->FamilyMemberModel            = new FamilyMemberModel();
		$this->UserNotificationModel        = new UserNotificationModel();

		$this->arr_view_data                = [];
		$this->module_title                 = "Dashboard";
		$this->parent_url_path              = url('/').'/patient';
		$this->module_url_path              = url('/').'/patient/dashboard';
		$this->module_view_folder           = "front.patient.dashboard";

		$this->doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        $this->doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');
        $this->default_img_path         = url('/').config('app.img_path.default_img_path');

		$this->breadcrum_level_1            = 'Dashboard';
		$this->breadcrum_level_1_url        = $this->module_url_path;
		$user                               = Sentinel::check();
		$this->user_id                      = '';

        if($user)
        {
           $this->user_id = $user->id;
        }
	}

    public function dashboard()
    {
    	$arr_upcoming = $arr_completed = $arr_family = $arr_transaction = [];

    	$obj_upcoming = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','doctor_id','date','time','is_completed','status')
    											->where('user_id', $this->user_id)
    											->where('is_completed', '1')
    											->where('status', 'upcoming')
    											->orderBy('id','desc')
    											->with(['doctor_details' => function($query){
													$query->select('id','prefix','first_name','last_name')->with('doctor_prefix');
												}])
												->take(10)
												->get();
		if( $obj_upcoming ):
			$arr_upcoming = $obj_upcoming->toArray();
		endif;

		$obj_completed = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','doctor_id','date','time','is_completed','status')
    											->where('user_id', $this->user_id)
    											->where('is_completed', '1')
    											->where('status', 'completed')
    											->orderBy('id','desc')
    											->with(['doctor_details' => function($query){
													$query->select('id','prefix','first_name','last_name')->with('doctor_prefix');
												}])
												->take(10)
												->get();
		if( $obj_completed ):
			$arr_completed = $obj_completed->toArray();
		endif;

		$obj_family = $this->FamilyMemberModel->select('id','user_id','first_name','last_name')->where('user_id', $this->user_id)->get();
		if( $obj_family ):
			$arr_family = $obj_family->toArray();
		endif;

		$obj_transaction = $this->ConsultationTransactionModel->select('id','user_id','consultation_id','invoice_no','transaction_id','amount')
															  ->where('user_id', $this->user_id)
															  ->take(10)
															  ->get();
		if( $obj_transaction ):
			$arr_transaction = $obj_transaction->toArray();
		endif;

		$arr_notification = [];
    	$obj_notification = $this->UserNotificationModel->with(['user_details'=>function($qry){
    														$qry->select('id','first_name','last_name','profile_image');
    													}])
    													->where('to_user_id','=',$this->user_id)
    													->orderBy('id','desc')
    												    ->take(10)
    												    ->get();

    	if($obj_notification)
    	{
    		$arr_notification = $obj_notification->toArray();
    	}

		$this->arr_view_data['arr_notification']          = $arr_notification;
		$this->arr_view_data['profile_image_public_path'] = $this->doctor_image_public_path;
		$this->arr_view_data['profile_image_base_path']   = $this->doctor_image_base_path;
		$this->arr_view_data['default_img_path']          = $this->default_img_path;


		$this->arr_view_data['arr_upcoming']          = $arr_upcoming;
		$this->arr_view_data['arr_completed']         = $arr_completed;
		$this->arr_view_data['arr_family']            = $arr_family;
		$this->arr_view_data['arr_transaction']       = $arr_transaction;

		$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;

		$this->arr_view_data['page_title']            = 'Dashboard';

    	return view('front.patient.dashboard.index', $this->arr_view_data);
    }
}
