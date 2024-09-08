<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\FamilyMemberModel;

use Flash;
use Validator;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->UserModel          = new UserModel();
        $this->FamilyMemberModel  = new FamilyMemberModel();

        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/patient");
        $this->module_title       = "Patient";
        $this->module_view_folder = "admin.patient";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');

        $this->patient_image_public_path = url('/').config('app.img_path.patient_profile_images');
        $this->patient_image_base_path   = base_path().config('app.img_path.patient_profile_images');
        $this->default_img_path          = url('/').config('app.img_path.default_img_path');

    }

    public function index()
    {
    	$arr_patient = [];
    	$obj_patient = $this->UserModel->where('user_type','=','patient')->orderBy('id','desc')->get();
    	if($obj_patient)
    	{
    		$arr_patient = $obj_patient->toArray();
    	}	

    	$this->arr_view_data['arr_patient']     = $arr_patient;
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
		$this->arr_view_data['module_title']    = str_singular($this->module_title);
		$this->arr_view_data['page_title'] 		= str_singular($this->module_title);
    	return view($this->module_view_folder.'/patient',$this->arr_view_data);
    }

    public function view($enc_id)
    {
        $arr_patient_detials = [];
        if($enc_id!='false')
        {
            $id = base64_decode($enc_id);
            $obj_patient_details = $this->UserModel->where('id','=',$id)->first();
            if($obj_patient_details)
            {
                $arr_patient_detials = $obj_patient_details->toArray();
            }


            $this->arr_view_data['arr_patient_detials'] = $arr_patient_detials;
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            $this->arr_view_data['page_title']          = "View Details";
            $this->arr_view_data['module_title']        = str_singular($this->module_title);
            $this->arr_view_data['profile_image_public_path']        = $this->patient_image_public_path;
            $this->arr_view_data['profile_image_base_path']        = $this->patient_image_base_path;
            $this->arr_view_data['default_img_path']        = $this->default_img_path;
        }
        return view($this->module_view_folder.'/view',$this->arr_view_data);   
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
            $id     = base64_decode($enc_id);

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
            $id     = base64_decode($enc_id);

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
            $id     = base64_decode($enc_id);

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
            $id     = base64_decode($enc_id);

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
            $id     = base64_decode($enc_id);

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

    public function view_family($enc_id=FALSE)
    {
        $arr_family_member = [];
        if($enc_id)
        {
            $user_id = base64_decode($enc_id);
            $obj_family_member = $this->FamilyMemberModel->where('user_id','=',$user_id)->orderBy('id','desc')->get();
            if($obj_family_member)
            {
                $arr_family_member = $obj_family_member->toArray();
            }   
        }
        $this->arr_view_data['arr_family_member']     = $arr_family_member;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = 'Family Members';
        return view($this->module_view_folder.'/family_member',$this->arr_view_data);
    }
}
