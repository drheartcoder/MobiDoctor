<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminProfileModel;
use App\Models\AdminNotificationModel;

use Sentinel;
use Flash;
use Session;
use Validator;
use Mail;
use DB;

class AdminNotificationController extends Controller
{
	public function __construct(AdminProfileModel $AdminProfile, AdminNotificationModel $AdminNotificationModel)
	{
        $this->AdminProfileModel   = $AdminProfile;
		$this->AdminNotificationModel = $AdminNotificationModel;

		$this->arr_view_data       = [];
        $this->module_url_path     = url(config('app.project.admin_panel_slug')."/notification");
		$this->module_title        = "Manage Notification";
		$this->module_view_folder  = "admin.notification";
        $this->admin_panel_slug    = config('app.project.admin_panel_slug');

        DB::connection()->enableQueryLog();
    }
    public function index()
    {
		$this->arr_view_data['page_title'] = str_singular($this->module_title);
    	$arr_contact_enquiry 			   = array();
    	$user 							   = Sentinel::check();

    	if($user)
    	{
    		if($user->inRole('admin'))
     		{
    			$arr_contact = $this->AdminNotificationModel->orderBy('created_at','desc')->get();
    			if($arr_contact!=FALSE)
    			{
    				$arr_contact_enquiry 					= $arr_contact->toArray();

                    $update_data['is_read'] = '1';
                    $update_query = $this->AdminNotificationModel->where('is_read', '0')->update($update_data);

    				$this->arr_view_data['arr_data'] 		= $arr_contact_enquiry;
    				$this->arr_view_data['module_url_path'] = $this->module_url_path;
    				$this->arr_view_data['module_title'] 	= $this->module_title;
    				return view($this->module_view_folder.'/index',$this->arr_view_data);

				}
    		}
    		else
    		{
    			Flash::error("You dont have sufficient privileges to access.");
    			redirect($this->admin_panel_slug.'/login');	
    		}

    	} 
    	else
    	{
    		Flash::error("Please login to your account.");
    		redirect($this->admin_panel_slug.'/login');
    	}
    }

    public function delete($enc_id=false)
    {
    	if($enc_id)
    	{
    		$id 				= base64_decode($enc_id);
    		$contact_details	= $this->AdminNotificationModel->where('id',$id)->first();
    		if(isset($contact_details) && $contact_details)
    		{
    			$status 		= $contact_details->delete();
    			if($status)
    			{
    				flash::success("Record deleted successfully.");
    			}
    			else
    			{
    				flash::error("Error while deleting record.");
    			}
    		}
    		else
    		{
    			flash::error("Sorry..!No records found.");
    		}
    	}
    	else
    	{
    		Flash::error("Sorry..!Invalid request.");
    	}
    	return redirect()->back();
    }
    

    public function get_count()
    {
        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                
                $count = $this->AdminNotificationModel->where(['is_read'=>'0'])->count();
                return json_encode($count);
            }
        } 
        else
        {
            return json_encode('');
        }
    }


    public function multi_action(Request $request)
    {
    	$arr_rules 					= array();
    	$arr_rules['multi_action']  = "required";
    	$arr_rules['checked_record']= "required";

    	$validator 					= Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		  Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
              return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}
    	$multi_action 	= $request->input("multi_action");
    	$checked_record = $request->input("checked_record");

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        
        foreach($checked_record as $key=>$record_id)
        {
        	$record_id 	=  base64_decode($record_id);
        	if($multi_action=="delete")
        	{
        		$result  =  $this->AdminNotificationModel->where('id',$record_id)->first();
        		if(isset($result) && count($result)>0)
        		{
        			$record_del = $result->delete();
        			if($record_del)
        			{
        				Flash::success("Record(s) deleted successfully.");
        			}
        			else
        			{
        				Flash::error("Error while deleting record.");
        			}
        		}
        	} 
        }
        return redirect()->back();

    }
}
