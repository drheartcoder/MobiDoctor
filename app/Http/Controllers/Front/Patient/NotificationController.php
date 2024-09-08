<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Models\UserNotificationModel;

use Sentinel;
use Session;

class NotificationController extends Controller
{
    public function __construct()
	{
		$this->UserNotificationModel = new UserNotificationModel();

		$this->module_title          = "Notification";
		$this->parent_url_path       = url('/').'/patient';
		$this->module_url_path       = url('/').'/patient/notification';
		$this->module_view_folder    = "front.patient";

		$this->breadcrum_level_1     = 'Dashboard';
		$this->breadcrum_level_2     = $this->module_title;

		$this->breadcrum_level_1_url = $this->parent_url_path.'/dashboard';
		$this->breadcrum_level_2_url = $this->module_url_path;

		$this->doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        $this->doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');
        $this->default_img_path         = url('/').config('app.img_path.default_img_path');

        $user                            = Sentinel::check();
        $this->user_id                   = '';

        if($user)
        {
           $this->user_id = $user->id;
        }

	}

    public function index()
    {
    	$arr_notification = [];
    	$obj_notification = $this->UserNotificationModel->with(['user_details'=>function($qry){
    														$qry->select('id','first_name','last_name','profile_image');
    													}])
    													->where('to_user_id','=',$this->user_id)
                                                        ->orderBy('id','desc')
    												    ->paginate(10);

    	if($obj_notification)
    	{
    		$arr_pagination   = clone $obj_notification;
    		$arr_notification = $obj_notification->toArray();
    	}

        $this->UserNotificationModel->where('to_user_id','=',$this->user_id)->update(['is_read'=>'1']);

		$this->arr_view_data['arr_pagination']    = $arr_pagination;
		$this->arr_view_data['arr_notification']  = $arr_notification;
		$this->arr_view_data['breadcrum_level_1'] = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2'] = $this->breadcrum_level_2;

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;

        $this->arr_view_data['page_title']      = 'Notification';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
       
        $this->arr_view_data['profile_image_public_path'] = $this->doctor_image_public_path;
        $this->arr_view_data['profile_image_base_path'] = $this->doctor_image_base_path;
        $this->arr_view_data['default_img_path'] = $this->default_img_path;

    	return view($this->module_view_folder.'.notification', $this->arr_view_data);
    }

    public function delete($enc_id)
    {
    	if($enc_id!='')
    	{
    		$id = base64_decode($enc_id);
    		$status = $this->UserNotificationModel->where('id',$id)->delete();
    		if($status)
    		{
    			Session::flash('success','Notification deleted successfully.');
    			return redirect()->back();
    		}
    		else
    		{
    			Session::flash('error','Something went wrong,Please try again.');
    			return redirect()->back();
    		}
    	}
    	else
    	{
    		Session::flash('error','Something went wrong,Please try again.');
    		return redirect()->back();
    	}
    }
}
