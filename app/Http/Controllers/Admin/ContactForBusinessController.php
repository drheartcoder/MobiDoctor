<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\BusinessContactModel;

class ContactForBusinessController extends Controller
{
    public function __construct()
    {
    	$this->BusinessContactModel       = new BusinessContactModel();

    	$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/contact_for_business");
        $this->module_title               = "Contact For Business";
        $this->module_view_folder         = "admin.contact_for_business";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$arr_contact_enquiry = [];
    	$obj_contact_enquiry = $this->BusinessContactModel->orderBy('id','desc')->get();
    	if($obj_contact_enquiry)
    	{
    		$arr_contact_enquiry = $obj_contact_enquiry->toArray();
    	}	

    	$this->arr_view_data['arr_contact_enquiry']     = $arr_contact_enquiry;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= str_singular($this->module_title);
    	return view($this->module_view_folder.'/index',$this->arr_view_data);
    }

    public function view($enc_id=false)
    {
    	$arr_enquiry_details = [];
    	if($enc_id)
    	{
    		$id = base64_decode($enc_id);
    		$obj_enquiry = $this->BusinessContactModel->where('id','=',$id)->first();
    		if($obj_enquiry)
    		{
    			$arr_enquiry_details = $obj_enquiry->toArray();
    		}

    		$this->arr_view_data['arr_enquiry_details'] = $arr_enquiry_details;
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['page_title']      = "View Details";
            $this->arr_view_data['module_title']    = str_singular($this->module_title);
     
        	return view($this->module_view_folder.'/details',$this->arr_view_data);   
    	}
    	else
        {
            Flash::error('Sorry, Invalid Request.');
            return redirect()->back();
        }
    }
}
