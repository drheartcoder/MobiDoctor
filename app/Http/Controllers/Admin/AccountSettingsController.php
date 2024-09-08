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

class AccountSettingsController extends Controller
{
    public function __construct(UserModel $user,AdminProfileModel $admin_profile)
    {
        $this->UserModel          = $user;
        $this->BaseModel          = $this->UserModel;
        $this->AdminProfileModel  = $admin_profile;
        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/account_settings");
        $this->module_title       = "Account Information";
        $this->module_view_folder = "admin.account_settings";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');

        $this->profile_image_public_img_path = url('/').'/uploads/admin/profile/';
        $this->profile_image_base_img_path = base_path().'/uploads/admin/profile/';
    }

    public function index()
    {
    	$this->arr_view_data['page_title']  =  str_singular($this->module_title);
    	$arr_account_settings = array();

    	$user = Sentinel::check();
    	if($user)
    	{
    		if($user->inRole('admin'))
    		{
    			$arr_profile =  $this->AdminProfileModel->where('user_id',$user->id)->with(['user_details'])->first();
           
                if($arr_profile!=FALSE)
                {
                    $arr_account_settings = $arr_profile->toArray();
                }
               
                $this->arr_view_data['arr_data']        = $arr_account_settings;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                $this->arr_view_data['profile_image_public_img_path']  = $this->profile_image_public_img_path;
                $this->arr_view_data['profile_image_base_img_path']  = $this->profile_image_base_img_path;
                return view($this->module_view_folder.'/index',$this->arr_view_data);
    		}
            else if($user->inRole('sub-admin'))
            {
                $arr_account_settings = [];
                $arr_profile =  $this->AdminProfileModel->where('user_id',$user->id)->with(['user_details'])->first();
           
                if($arr_profile!=FALSE)
                {
                    $arr_account_settings = $arr_profile->toArray();
                }
               
                $this->arr_view_data['arr_data']        = $arr_account_settings;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                $this->arr_view_data['profile_image_public_img_path']  = $this->profile_image_public_img_path;
                $this->arr_view_data['profile_image_base_img_path']  = $this->profile_image_base_img_path;
                return view($this->module_view_folder.'/index',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
    	}
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function update(Request $request)
    {
        $arr_rules                  = array();
        $arr_rules['first_name']    = 'required';
        $arr_rules['last_name']     = 'required';
        $arr_rules['contact_email'] = 'required|email';
        $arr_rules['contact_no']    = 'required';
        $arr_rules['mobile_no']     = 'required';
        $arr_rules['address']       = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $form_data = array();
        $arr_data  = array();
        $form_data = $request->all();
        
        $arr_data['contact_email'] = $form_data['contact_email'];
        $arr_data['contact_no']    = $form_data['contact_no'];
        $arr_data['mobile_no']     = $form_data['mobile_no'];
        $arr_data['fax']           = $form_data['fax'];
        $arr_data['address']       = $form_data['address'];
        $arr_data['profile_pic']   = $form_data['old_profile_image'];

        if($request->hasFile('image'))
        {
            $img_validator = Validator::make(array('image' => $request->file('image')), array('image' => 'mimes:png,jpeg,gif')); 
            if ($request->file('image')->isValid() && $img_validator->passes())
            {
                list($width, $height) = getimagesize($form_data['image']);
                if ($width<=300 && $height<=300)
                {
                    $company_logo_name = $form_data['image'];
                    $imageExtension    = $request->file('image')->getClientOriginalExtension();
                    $imageName         = sha1(uniqid().$company_logo_name.uniqid()).'.'.$imageExtension;

                    $request->file('image')->move( base_path() . '/uploads/admin/profile/', $imageName );
                    $arr_data['profile_pic'] = $imageName;
                }
                else
                {
                    Flash::error("Please upload image with size less than 300*300.");
                    return back()->withErrors($validator)->withInput($request->all());
                }
            }
            else
            {
                Flash::error("Please upload valid image.");
                return back()->withErrors($validator)->withInput($request->all());
            }
        }

        $user = Sentinel::check();
        if($user)
        {
            $status = $this->AdminProfileModel->where('user_id', $user->id)->update($arr_data);

            $check_email_exist = $this->UserModel->where('email',$form_data['email'])->where('id','!=',$user->id)->count();
            if($check_email_exist)
            {
                Flash::error("This Email Id Already Exist."); 
                return redirect()->back(); 
            }
            else
            {
                $update_arr = array('first_name'=>encrypt_value($form_data['first_name']), 'last_name'=>encrypt_value($form_data['last_name']));
                $update_status = $this->UserModel->where('id',$user->id)->update($update_arr);
            }
        }

        if($status && $update_status) 
        {
            Flash::success(str_singular($this->module_title).' Updated Successfully'); 
        }
        else
        {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
        }

        return redirect()->back();
    }
}
