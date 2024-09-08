<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\InvitationModel;
use App\Models\UserModel;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->InvitationModel  = new InvitationModel();
    	$this->UserModel 	    = new UserModel();

    	$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/invitation");
        $this->module_title               = "Invitation";
        $this->module_view_folder         = "admin.invitation";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$obj_invite_list = $this->InvitationModel->with(['user_details'=>function($qry){
    												$qry->select('id','first_name','last_name','user_type');
    											},'is_user_register'])
    											->orderBy('id','desc')
    											->get();
    	if($obj_invite_list)
    	{
    		$arr_invite_arr = $obj_invite_list->toArray();
    	}

    	$this->arr_view_data['arr_invite_arr']  = $arr_invite_arr;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= str_singular($this->module_title);
    	return view($this->module_view_folder.'/index',$this->arr_view_data);
    }
}
