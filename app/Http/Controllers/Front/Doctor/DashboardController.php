<?php

namespace App\Http\Controllers\Front\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\ConsultationTransactionModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;
use App\Models\UserNotificationModel;
use App\Models\RatingModel;

use Sentinel;

class DashboardController extends Controller
{
    public function __construct()
	{
        $this->ConsultationTransactionModel = new ConsultationTransactionModel();
        $this->ConsultationModel            = new ConsultationModel();
        $this->FamilyMemberModel            = new FamilyMemberModel();
        $this->UserNotificationModel        = new UserNotificationModel();
        $this->RatingModel                  = new RatingModel();

        $this->arr_view_data                = [];
        $this->module_title                 = "Dashboard";
        $this->parent_url_path              = url('/').'/doctor';
        $this->module_url_path              = url('/').'/doctor/dashboard';
        $this->module_view_folder           = "front.doctor.dashboard";

        $this->breadcrum_level_1            = 'Dashboard';
        $this->breadcrum_level_1_url        = $this->module_url_path;

        $this->patient_image_public_path = url('/').config('app.img_path.patient_profile_images');
        $this->patient_image_base_path   = base_path().config('app.img_path.patient_profile_images');
        $this->default_img_path          = url('/').config('app.img_path.default_img_path');


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
                                                ->where('doctor_id', $this->user_id)
                                                ->where('is_completed', '1')
                                                ->where('status', 'upcoming')
                                                ->orderBy('id','desc')
                                                ->with(['user_details' => function($query){
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->take(10)
                                                ->get();
        if( $obj_upcoming ):
            $arr_upcoming = $obj_upcoming->toArray();
        endif;

        $obj_completed = $this->ConsultationModel->select('id','consultation_id','user_id','who_is_patient','patient_id','doctor_id','date','time','is_completed','status')
                                                ->where('doctor_id', $this->user_id)
                                                ->where('is_completed', '1')
                                                ->where('status', 'completed')
                                                ->orderBy('id','desc')
                                                ->with(['user_details' => function($query){
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->take(10)
                                                ->get();
        if( $obj_completed ):
            $arr_completed = $obj_completed->toArray();
        endif;

        $obj_patients = $this->ConsultationModel->select('id','user_id','doctor_id','is_completed')
                                                ->where('doctor_id',$this->user_id)
                                                ->where('is_completed','1')
                                                ->with(['user_details'=>function($qry){
                                                    $qry->select('id','first_name','last_name');
                                                }])
                                                ->groupBy('user_id')
                                                ->take(10)
                                                ->get();
        if( $obj_patients ):
            $arr_patients = $obj_patients->toArray();
        endif;

        $obj_transaction = $this->ConsultationTransactionModel->select('id','doctor_id','consultation_id','invoice_no','transaction_id','amount')
                                                              ->where('doctor_id', $this->user_id)
                                                              ->take(10)
                                                              ->get();
        if( $obj_transaction ):
            $arr_transaction = $obj_transaction->toArray();
        endif;
        //dd( $arr_patients );

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

        $obj_rating = $this->RatingModel
                                    ->select( '*', \DB::raw('AVG(rating) as rating') )
                                    ->where('doctor_id',$this->user_id)
                                    ->where('status','=','1')
                                    ->first();
        $this->arr_view_data['rating']          = isset($obj_rating->rating)?$obj_rating->rating:0;
        $this->arr_view_data['arr_notification']          = $arr_notification;
        $this->arr_view_data['profile_image_public_path'] = $this->patient_image_public_path;
        $this->arr_view_data['profile_image_base_path']   = $this->patient_image_base_path;
        $this->arr_view_data['default_img_path']          = $this->default_img_path;
        
        $this->arr_view_data['arr_upcoming']    = $arr_upcoming;
        $this->arr_view_data['arr_completed']   = $arr_completed;
        $this->arr_view_data['arr_patients']    = $arr_patients;
        $this->arr_view_data['arr_transaction'] = $arr_transaction;

        $this->arr_view_data['page_title']      = 'Dashboard';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['parent_url_path'] = $this->parent_url_path;

    	return view('front.doctor.dashboard.index', $this->arr_view_data);
    }
}
