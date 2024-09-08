<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DoctorDetailsModel;
use App\Models\UserModel;
use App\Models\LanguageModel;

use Flash;
use Validator;

class DoctorController extends Controller
{
    public function __construct(
                                    UserModel $user_model
                                )
    {
        $this->UserModel          = $user_model;
        $this->DoctorDetailsModel = new DoctorDetailsModel();
        $this->LanguageModel      = new LanguageModel();
        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/doctor");
        $this->module_title       = "Doctor";
        $this->module_view_folder = "admin.doctor";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');

        $this->doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        $this->doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');
        $this->default_img_path         = url('/').config('app.img_path.default_img_path');

        $this->driving_base_path        = base_path().config('app.img_path.driving_licence');
        $this->driving_public_path      = url('/').config('app.img_path.driving_licence');

        $this->medical_reg_base_path    = base_path().config('app.img_path.medical_registration');
        $this->medical_reg_public_path  = url('/').config('app.img_path.medical_registration');
    }

    public function index()
    {
    	$arr_doctor = [];
    	$obj_doctor = $this->UserModel->where('user_type','doctor')
                                      ->with('verification')
                                      ->orderBy('id','desc')
                                      ->get();
    	if($obj_doctor)
    	{
    		$arr_doctor = $obj_doctor->toArray();
    	}

    	$this->arr_view_data['arr_doctor']     = $arr_doctor;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
    
    	return view($this->module_view_folder.'/doctor',$this->arr_view_data);
    }

    public function view($enc_id)
    {
        $arr_doctor_detials = [];
        if($enc_id!='false')
        {
            $id = base64_decode($enc_id);
            $obj_doctor_details = $this->UserModel->where('id',$id)
                                                  ->with(['doctor_data','doctor_prefix','timezone_details'=>function($qry){
                                                        $qry->select('id','location_name','utc_offset');
                                                   }])->first();
            if($obj_doctor_details)
            {
                $arr_doctor_detials = $obj_doctor_details->toArray();
            }
            
            $arr_language = [];
            $obj_language = $this->LanguageModel->get();
            if($obj_language)
            {
                $arr_language = $obj_language->toArray();
            }

            $this->arr_view_data['arr_doctor_details']        = $arr_doctor_detials;
            $this->arr_view_data['arr_language']              = $arr_language;
            $this->arr_view_data['module_url_path']           = $this->module_url_path;
            $this->arr_view_data['page_title']                = "View Details";
            $this->arr_view_data['module_title']              = str_singular($this->module_title);
            $this->arr_view_data['profile_image_public_path'] = $this->doctor_image_public_path;
            $this->arr_view_data['profile_image_base_path']   = $this->doctor_image_base_path;
            $this->arr_view_data['default_img_path']          = $this->default_img_path;
            $this->arr_view_data['driving_base_path']         = $this->driving_base_path;
            $this->arr_view_data['driving_public_path']       = $this->driving_public_path;
            $this->arr_view_data['medical_reg_base_path']     = $this->medical_reg_base_path;
            $this->arr_view_data['medical_reg_public_path']   = $this->medical_reg_public_path;
            
            return view($this->module_view_folder.'/view',$this->arr_view_data);
        }
        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->delete();

                if($result_status)
                {
                    Flash::success($this->module_title.' Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting '.$this->module_title.' Status.');
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

    public function activate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'1']);

                if($result_status)
                {
                    Flash::success($this->module_title.' Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating '.$this->module_title.' Status.');
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
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'0']);

                if($result_status)
                {
                    Flash::success($this->module_title.' Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating '.$this->module_title.' Status.');
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

    public function email_unverify($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['is_email_verified'=>'0']);

                if($result_status)
                {
                    Flash::success($this->module_title.' email unverified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While unverifying '.$this->module_title.' email.');
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

    public function email_verify($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['is_email_verified'=>'1']);

                if($result_status)
                {
                    Flash::success($this->module_title.' email verified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While verifying '.$this->module_title.'email.');
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

    public function mobile_unverify($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['is_mobile_verified'=>'0']);

                if($result_status)
                {
                    Flash::success($this->module_title.' mobile no unverified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While unverifying '.$this->module_title.' mobile no.');
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

    public function mobile_verify($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->UserModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['is_mobile_verified'=>'1']);

                if($result_status)
                {
                    Flash::success($this->module_title.' mobile no is verified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While verifying '.$this->module_title.'mobile no.');
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

    public function admin_unverified($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->DoctorDetailsModel->where('user_id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['admin_verified'=>'0']);

                if($result_status)
                {
                    Flash::success($this->module_title.' unverified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While unverifying '.$this->module_title.'.');
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

    public function admin_verified($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->DoctorDetailsModel->where('user_id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['admin_verified'=>'1']);

                if($result_status)
                {
                    Flash::success($this->module_title.' verified Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While verifying '.$this->module_title.'.');
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
        $arr_rules                   = array();
        $arr_rules['multi_action']   = 'required';
        $arr_rules['checked_record'] = 'required';

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
                        Flash::success($this->module_title.' Deactivated Successfully');
                    }
                }
            }
        }

        return redirect()->back();
    }
}
