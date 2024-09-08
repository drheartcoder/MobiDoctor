<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\AdminProfileModel;

use Validator;
use Flash;
use Sentinel;

class SubAdminController extends Controller
{
    public function __construct()
   	{   
        $this->UserModel                  = new UserModel();
        $this->AdminProfileModel          = new AdminProfileModel();
   		$this->arr_view_data              = [];
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/sub_admin");
        $this->module_title               = "Sub Admin";
        $this->module_view_folder         = "admin.sub_admin";
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
   	}

   	public function index()
   	{
        $arr_sub_admin = [];
        $obj_sub_admin = $this->UserModel->where('user_type','=','sub-admin')->orderBy('id','desc')->get();
        if($obj_sub_admin)
        {
            $arr_sub_admin = $obj_sub_admin->toArray();
        }
        $this->arr_view_data['arr_sub_admin']    = $arr_sub_admin;
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= 'Sub Admin';
    	return view($this->module_view_folder.'/index',$this->arr_view_data);
   	}

   	public function create()
   	{
   		$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= 'Add Sub Admin';
    	return view($this->module_view_folder.'/create',$this->arr_view_data);
   	}

    public function store(Request $request)
    {
        $arr_rules               = array();
        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['email']      = 'required|email';
        $arr_rules['password']   = 'required';
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }


        $email = trim($request->input('email'));

        $is_exist = $this->UserModel->where('email','=',$email)->get();
        if(count($is_exist)>0)
        {
            Flash::error($this->module_title.' already exist.');
            return redirect()->back();
        }

        $arr_data['first_name'] = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name'] = encrypt_value(trim($request->input('last_name')));
        $arr_data['email'] = $email;
        $arr_data['password'] = trim($request->input('password'));
        $arr_data['user_type'] = 'sub-admin';
        $arr_data['is_email_verified'] = '1';

        $user = Sentinel::registerAndActivate($arr_data);


        if($user)
        {
            $user = Sentinel::findById($user->id);
            $role = Sentinel::findRoleBySlug('sub-admin');
            $user->roles()->attach($role);

            $arr_admin_details['user_id'] = $user->id;
            $this->AdminProfileModel->create($arr_admin_details);

            Flash::success($this->module_title.' Added successfully');
            return redirect()->back();
        }
        else
        {
            Flash::error('Problem occured,while adding '.$this->module_title);
            return redirect()->back();
        }
    }

    public function edit($enc_id)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $obj_sub_admin = $this->UserModel->where('id','=',$id)->first();
            if($obj_sub_admin)
            {
                $arr_sub_admin = $obj_sub_admin->toArray();
            }

            $this->arr_view_data['arr_sub_admin']   = $arr_sub_admin;
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);
            $this->arr_view_data['page_title']      = 'Edit Sub Admin';
            $this->arr_view_data['enc_id']          = $enc_id;
            return view($this->module_view_folder.'/edit',$this->arr_view_data);

        }
        else
        {
            Flash::error('Something went wrong,please try again.');
            return redirect()->back();
        }
    }

    public function update(Request $request,$enc_id)
    {
        if($enc_id!='')
        {
            $arr_rules               = array();
            $arr_rules['first_name'] = 'required';
            $arr_rules['last_name']  = 'required';
            $arr_rules['email']      = 'required|email';
            $arr_rules['password']   = 'required';
            
            $id = base64_decode($enc_id);
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $email = trim($request->input('email'));

            $is_exist = $this->UserModel->where('email','=',$email)->where('id','<>',$id)->get();
            if(count($is_exist)>0)
            {
                Flash::error($this->module_title.' already exist.');
                return redirect()->back();
            }

            $arr_data['first_name'] = trim($request->input('first_name'));
            $arr_data['last_name'] = trim($request->input('last_name'));
            $arr_data['email'] = $email;
            $arr_data['password'] = trim($request->input('password'));

            $status = $this->UserModel->where('id','=',$id)->update($arr_data);
            if($status)
            {
                Flash::success($this->module_title.' Details updated successfully');
                return redirect()->back();
            }
            else
            {
                Flash::error('Problem occured,while update '.$this->module_title);
                return redirect()->back();
            }
        }
        else
        {
            Flash::error('Something went wrong,please try again.');
            return redirect()->back();
        }
    }

    public function activate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result  = $this->UserModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'1']);

                if($result_status)
                {
                    Flash::success($this->module_title.' Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating '.$this->module_title);
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $page_id = base64_decode($enc_id);

            $result  = $this->UserModel->where('id',$page_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'0']);

                if($result_status)
                {
                    Flash::success($this->module_title.' Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating '.$this->module_title);
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function multi_action(Request $request)
    {
       
        $arr_rules                     = array();
        $arr_rules['multi_action']     = 'required';
        $arr_rules['checked_record']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');


        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {
               $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success($this->module_title.' Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {

                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'1']);

                    if($result_status)
                    { 
                        Flash::success($this->module_title.' Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                $result = $this->UserModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'0']);

                    if($result_status)
                    {  
                        Flash::success($this->module_title.' Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }
}
