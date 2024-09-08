<?php

namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ConsultationModel;
use App\Models\UserModel;
use App\Models\TimezoneModel;
use App\Models\FamilyMemberModel;
use App\Models\LifestyleModel;
use App\Models\MedicalGeneralModel;
use App\Models\HealthGeneralModel;
use App\Models\MedicationsModel;
use App\Models\MedicalCertificateReason;
use App\Models\MedicalCertificateModel;

use App\Common\Services\UserNotificationService;

use Sentinel;
use Validator;
use Session;
use File;
use PDF;

class MyPatientController extends Controller
{
	public function __construct(UserNotificationService  $user_notification_service)
	{
		$this->ConsultationModel               = new ConsultationModel();
		$this->UserModel                       = new UserModel();
		$this->TimezoneModel                   = new TimezoneModel();
		$this->FamilyMemberModel               = new FamilyMemberModel();
		$this->LifestyleModel                  = new LifestyleModel();
		$this->MedicalGeneralModel             = new MedicalGeneralModel();
		$this->HealthGeneralModel              = new HealthGeneralModel();
		$this->MedicationsModel                = new MedicationsModel();
		$this->MedicalCertificateReason        = new MedicalCertificateReason();
		$this->MedicalCertificateModel         = new MedicalCertificateModel();

		$this->UserNotificationService         = $user_notification_service;

		$this->arr_view_data                   = [];
		$this->module_title                    = "Patients";
		$this->parent_url_path                 = url('/').'/doctor';
		$this->module_url_path                 = url('/').'/doctor/my_patients';
		$this->module_view_folder              = "front.doctor.my_patients";

		$this->medical_certificate_base_path   = base_path().config('app.img_path.medical_certificate');
		$this->medical_certificate_public_path = url('/').config('app.img_path.medical_certificate');
        
		$this->patient_image_base_path         = base_path().config('app.img_path.patient_profile_images');
		$this->patient_image_public_path       = url('/').config('app.img_path.patient_profile_images');
		$this->default_img_path                = url('/').config('app.img_path.default_img_path');
        
		$this->patient_medication_base_path    = base_path().config('app.img_path.patient_medication');
		$this->patient_medication_public_path  = url('/').config('app.img_path.patient_medication');
        
		$this->medical_certificate_view_folder = "front.doctor.my_patients.medical_certificate";
		$this->patient_history_view_folder     = "front.doctor.my_patients.patient_history";
		$this->medical_history_view_folder     = "front.doctor.my_patients.medical_history";
        
		$this->breadcrum_level_2               = $this->module_title;
		$this->breadcrum_level_1               = 'Dashboard';

		$this->breadcrum_level_2_url           = $this->module_url_path;
		$this->breadcrum_level_1_url           = $this->parent_url_path.'/dashboard';

		$user                                  = Sentinel::check();
		$this->user_id = $this->user_prefix = $this->user_first_name = $this->user_last_name = '';

		if($user)
		{
			$this->user_id         = $user->id;
			$this->user_prefix     = $user->prefix;
			$this->user_first_name = decrypt_value( $user->first_name );
			$this->user_last_name  = decrypt_value( $user->last_name );
		}
	}

	public function index()
	{
		$obj_patients = $this->ConsultationModel->with(['user_details'=>function($qry){
													$qry->select('id','first_name','last_name','date_of_birth','is_online','profile_image');
												}])
												->where('doctor_id','=',$this->user_id)
												->where('is_completed','=','1')
												->groupBy('user_id')
												->get();

		if($obj_patients)
		{
			$arr_patients = $obj_patients->toArray();
		}

		$this->arr_view_data['arr_patients']          = $arr_patients;
		
		$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;

        $this->arr_view_data['page_title']      = 'Patients';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        
        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
        $this->arr_view_data['default_img_path']          = $this->default_img_path;

    	return view($this->module_view_folder.'.index', $this->arr_view_data);
	}

	/*--------------------------------------------------------------------------------
							          Patient History
	----------------------------------------------------------------------------------*/

	public function patient_history($enc_id='')
	{
		if($enc_id!='')
		{
			$arr_patient_details = [];

			$id = base64_decode($enc_id);
			$obj_patient_details = $this->UserModel->with(['family_member'=>function($qry){
														$qry->select('id','user_id','first_name','last_name','birth_date');
													}])
													->select('id','profile_image','first_name','last_name','date_of_birth','gender','contact_no','phone_code','mobile_no','address','is_online','email','dump_id','dump_session')
													->where('id','=',$id)
													->first();
			if($obj_patient_details)
			{
				$arr_patient_details = $obj_patient_details->toArray();
			}

			$this->arr_view_data['arr_patient_details']   = $arr_patient_details;
			$this->arr_view_data['patient_user_id']   	  = $enc_id;
			
			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Patient History";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/patient_history/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Patient History';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->patient_history_view_folder.'.index', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}	
	}

	public function edit_patient_history($enc_id)
	{
		if($enc_id!='')
		{
			$arr_timezone = $arr_patient_details = [];
			$id = base64_decode($enc_id);
			$obj_patient_details = $this->UserModel->select('profile_image','first_name','last_name','email','date_of_birth','phone_code','mobile_no','contact_no','address','city','fax_no','country','timezone')
												->where('id','=',$id)
												->first();
			if($obj_patient_details)
			{
				$arr_patient_details = $obj_patient_details->toArray();
			}

			$obj_timezone = $this->TimezoneModel->get();
	        if($obj_timezone)
	        {
	            $arr_timezone = $obj_timezone->toArray();
	        }

			$this->arr_view_data['arr_patient_details']   = $arr_patient_details;
			$this->arr_view_data['arr_timezone']          = $arr_timezone;
			$this->arr_view_data['enc_id']          	  = $enc_id;


			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Patient History";
			$this->arr_view_data['breadcrum_level_4']     = "Edit";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/patient_history/'.$enc_id;
			$this->arr_view_data['breadcrum_level_4_url'] = $this->breadcrum_level_2_url.'/patient_history/edit/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Edit Patient History';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->patient_history_view_folder.'.edit', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}
	}

	public function update_patient_history(Request $request)
	{
		$fileName = '';
        $arr_rules  = $return_arr = [];

        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['address']    = 'required';
        $arr_rules['country']    = 'required';
        $arr_rules['city']       = 'required';
        $arr_rules['timezone']   = 'required';
        $arr_rules['birth_date']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';

            return response()->json($return_arr);
        }

        $id = base64_decode($request->input('patient_user_id'));

        $arr_data['first_name']  = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']   = encrypt_value(trim($request->input('last_name')));
        $arr_data['address']     = encrypt_value(trim($request->input('address', null)));
        $arr_data['city']        = encrypt_value(trim($request->input('city', null)));
        $arr_data['country']     = encrypt_value(trim($request->input('country', null)));
        $arr_data['state']       = encrypt_value(trim($request->input('state', null)));
        $arr_data['postal_code'] = encrypt_value(trim($request->input('postal_code')));
        $arr_data['fax_no']      = encrypt_value(trim($request->input('fax_no', null)));
        $arr_data['timezone']    = trim($request->input('timezone', null));
        $arr_data['latitude']    = trim($request->input('lat', null));
        $arr_data['longitude']   = trim($request->input('lng', null));
        $arr_data['date_of_birth'] = trim(date('Y-m-d',strtotime($request->input('birth_date'))));
         $arr_data['contact_no']    = trim($request->input('contact_no', null));

        $obj_patient = $this->UserModel->where('id','=',$this->user_id)->first();
        
        if($request->hasFile('profile_image'))
        {
            $fileName = $request->input('profile_image');
            $profile_image = $request->file('profile_image');

            $file_extension = strtolower($profile_image->getClientOriginalExtension());
            $fileName = sha1(uniqid().$profile_image.uniqid()).'.'.$file_extension;

            if($profile_image->isValid() && in_array($file_extension,['png','jpg','jpeg']))
            { 
                $fileExtension             = strtolower($profile_image->getClientOriginalExtension());
                $enc_profile_image         = sha1(uniqid().$profile_image.uniqid()).'.'.$fileExtension;     
                $upload                    = $profile_image->move($this->patient_image_base_path,$enc_profile_image);        

                $arr_data['profile_image'] = $enc_profile_image;
                if($upload)
                {
                    if(isset($obj_patient->profile_image) && $obj_patient->profile_image!=null)
                    {
                        $profile_image         = $this->patient_image_base_path.'/'.$obj_patient->profile_image;
                        if(file_exists($profile_image))
                        {
                            unlink($profile_image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error',$fileName.' Invalid file extension.');
                return response()->json($return_arr);
            }    
        } 

        $status = $this->UserModel->where('id','=',$id)->update($arr_data);
        if($status)
        {
            $arr_notification['to_user_id']       = $id;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has updated your profile.';
            $arr_notification['notification_url'] = '/patient/my_account/about_me';
            $this->UserNotificationService->create_user_notification($arr_notification);

            Session::flash('success','Patient Details updated succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while update patient details, Please try again.');
            return response()->json($return_arr);
        }
	}

	public function add_family_member($enc_id)
	{
		if($enc_id)
		{
			$this->arr_view_data['enc_id']     			  = $enc_id;
			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Patient History";
			$this->arr_view_data['breadcrum_level_4']     = "Add Family Member";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/patient_history/'.$enc_id;
			$this->arr_view_data['breadcrum_level_4_url'] = $this->breadcrum_level_2_url.'/patient_history/family_member/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Add Family Member';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->patient_history_view_folder.'.add_family_member', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}
	}

	public function store_family_member(Request $request)
	{
		$arr_rules = $return_arr = [];

        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['gender']     = 'required';
        $arr_rules['relation']   = 'required';
        $arr_rules['birth_date'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';

            return response()->json($return_arr);
        }

        $arr_data['user_id']    = base64_decode($request->input('enc_id'));
        $arr_data['first_name'] = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']  = encrypt_value(trim($request->input('last_name')));
        $arr_data['gender']     = encrypt_value(trim($request->input('gender')));
        $arr_data['relation']   = encrypt_value(trim($request->input('relation')));
        $arr_data['birth_date'] = date('Y-m-d',strtotime($request->input('birth_date')));
        $arr_data['email']      = trim($request->input('email',null));
        $arr_data['mobile_no']  = trim($request->input('mobile_no',null));
        $arr_data['phone_code'] = trim($request->input('phone_code',null));

        $status = $this->FamilyMemberModel->create($arr_data);
        if($status)
        {
            $arr_notification['to_user_id']       = $arr_data['user_id'];
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has add new family member.';
            $arr_notification['notification_url'] = '/patient/my_account/family_member';
            $this->UserNotificationService->create_user_notification($arr_notification);

            Session::flash('success','Member added succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured while adding member,Please try again.');
            return response()->json($return_arr);
        }
	}

	public function update_family_member(Request $request)
	{
	
		$arr_rules = $return_arr = [];
		$arr_rules['first_name'] = 'required';
		$arr_rules['last_name']  = 'required';
		$arr_rules['gender']     = 'required';
		$arr_rules['relation']   = 'required';
		$arr_rules['birth_date'] = 'required';

		$validator = Validator::make($request->all(),$arr_rules);
		if($validator->fails())
		{
		    $return_arr['status']  = 'error';
		    $return_arr['message'] = 'Please fill all thr required field.';

		    return response()->json($return_arr);
		}

		$id = base64_decode($request->input('family_member_id'));

		$arr_data['first_name'] = encrypt_value(trim($request->input('first_name')));
		$arr_data['last_name']  = encrypt_value(trim($request->input('last_name')));
		$arr_data['gender']     = encrypt_value(trim($request->input('gender')));
		$arr_data['relation']   = encrypt_value(trim($request->input('relation')));
		$arr_data['birth_date'] = date('Y-m-d',strtotime($request->input('birth_date')));
		$arr_data['email']      = trim($request->input('email',null));
		$arr_data['mobile_no']  = trim($request->input('mobile_no',null));
		$arr_data['phone_code'] = trim($request->input('phone_code',null));

		$status = $this->FamilyMemberModel->where('id','=',$id)->update($arr_data);
		if($status)
		{
		    /*$arr_notification['to_user_id']       = $id;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has updated your family member.';
            $arr_notification['notification_url'] = '/patient/my_account/family_member';
            $this->UserNotificationService->create_user_notification($arr_notification);*/

		    Session::flash('success','Member details updated succssfully.');
		    return response()->json($return_arr);
		}
		else
		{
		    Session::flash('error','Problem occured while updating member details,Please try again.');
		    return response()->json($return_arr);
		}
	}

	public function delete_family_member($enc_id)
	{
		if($enc_id)
		{
			$id = base64_decode($enc_id);
			$status = $this->FamilyMemberModel->where('id','=',$id)->delete();
			if($status)
			{
				/*$arr_notification['to_user_id']       = $id;
	            $arr_notification['from_user_id']     = $this->user_id;
	            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has delete a family member.';
	            $arr_notification['notification_url'] = '/patient/my_account/family_member';
	            $this->UserNotificationService->create_user_notification($arr_notification);*/

				Session::flash('success','Family Member deleted successfully.');
				return redirect()->back();
			}
			else
			{
				Session::flash('error','Problem occur,while delation family member.');
				return redirect()->back();
			}

		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}
	}

	public function family_member_deatils($member_id='')
	{
		if($member_id!='')
		{
			$return_arr = $arr_details = [];
			$obj_details = $this->FamilyMemberModel->where('id','=',$member_id)->first();
			if($obj_details)
			{
				$arr_details = $obj_details->toArray();
			}

			$arr_data                = [];
			$first_name              = isset($arr_details['first_name'])?decrypt_value($arr_details['first_name']):'';
			$last_name               = isset($arr_details['last_name'])?decrypt_value($arr_details['last_name']):'';
			$arr_data['member_name'] = $first_name.' '.$last_name;
			$arr_data['first_name']  = $first_name;
			$arr_data['last_name']   = $last_name;
			$arr_data['gender']      = isset($arr_details['gender'])?decrypt_value($arr_details['gender']):'';
			$arr_data['relation']    = isset($arr_details['relation'])?decrypt_value($arr_details['relation']):'';
			$arr_data['email']       = isset($arr_details['email'])?$arr_details['email']:'';
			$phone_code              = isset($arr_details['phone_code'])?$arr_details['phone_code']:'';
			$mobile_no               = isset($arr_details['mobile_no'])?$arr_details['mobile_no']:'';

			$arr_data['mobile_no']  = '+'.$phone_code.' '.$mobile_no;

			$arr_data['phone_code']  = $phone_code;
			$arr_data['mobile_number']  = $mobile_no;
			$arr_data['birth_date'] = isset($arr_details['birth_date'])?date('m/d/Y',strtotime($arr_details['birth_date'])):'';
			$arr_data['member_id'] = base64_encode($member_id);


			if(isset($arr_data) && sizeof($arr_data)>0)
			{
				$return_arr['status'] = 'success';
				$return_arr['data']   = $arr_data;
				return response()->json($return_arr);
			}

		}
		else
		{
			$return_arr['status'] = 'error';
			$return_arr['data']   = [];
			return response()->json($return_arr);
		}
	}

	/*--------------------------------------------------------------------------------
							          Medical History
	----------------------------------------------------------------------------------*/

	public function medical_history($enc_id='')
	{
		if($enc_id!='')
		{
			$arr_patient_details = $arr_lifestyle = $arr_medication = [];

			$id = base64_decode($enc_id);
			$obj_patient_details = $this->UserModel->with(['family_member'=>function($qry){
														$qry->select('id','user_id','first_name','last_name','birth_date');
													}])
													->select('id','profile_image','first_name','last_name','date_of_birth','gender','contact_no','phone_code','mobile_no','address','is_online','email','dump_id','dump_session')
													->where('id','=',$id)
													->first();
			if($obj_patient_details)
			{
				$arr_patient_details = $obj_patient_details->toArray();
			}

			$obj_lifestyle = $this->LifestyleModel->where('user_id','=',$id)->first();
			if($obj_lifestyle)
			{
				$arr_lifestyle = $obj_lifestyle->toArray();
			}

			$arr_general = $arr_selected_general = $selected_general_ids = [];

			$obj_general = $this->MedicalGeneralModel->select('id','name')->where('status','=','1')->get();
	        if($obj_general)
	        {
	            $arr_general = $obj_general->toArray();
	        }

	        $obj_selected_general = $this->HealthGeneralModel->select('id','medical_general_id')
	                                                         ->with(['general_details'=>function($qry){
	                                                                $qry->select('id','name');
	                                                          }])
	                                                         ->where('user_id','=',$id)
	                                                         ->get();
	        if($obj_selected_general)
	        {
	            $arr_selected_general = $obj_selected_general->toArray();
	        }

	        foreach ($arr_selected_general as $value) 
	        {
	           $selected_general_ids[]  = $value['medical_general_id'];
	        }

	        $obj_medication = $this->MedicationsModel->select('id','name')
                                                 ->where('user_id','=',$id)
                                                 ->orderBy('id','desc')
                                                 ->get();
	        if($obj_medication)
	        {
	            $arr_medication = $obj_medication->toArray();
	        }

			$this->arr_view_data['arr_patient_details']   = $arr_patient_details;
			$this->arr_view_data['arr_lifestyle']         = $arr_lifestyle;
			$this->arr_view_data['arr_general']           = $arr_general;
			$this->arr_view_data['arr_selected_general']  = $arr_selected_general;
			$this->arr_view_data['selected_general_ids']  = $selected_general_ids;
			$this->arr_view_data['arr_medication']  	  = $arr_medication;
			$this->arr_view_data['patient_user_id']       = $enc_id;
			
			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Medical History";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/medical_history/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Medical History';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;
	        
	        $this->arr_view_data['patient_medication_base_path']          = $this->patient_medication_base_path;
	        $this->arr_view_data['patient_medication_public_path']          = $this->patient_medication_public_path;

	    	return view($this->medical_history_view_folder.'.index', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}	
	}

	public function store_general(Request $request)
    {
        $arr_rules = $return_arr = $medical_general = [];

        $arr_rules['medical_general']        = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';
            return response()->json($return_arr);
        }

        $user_id = base64_decode($request->input('enc_id'));
        $medical_general =$request->input('medical_general');
        if(isset($medical_general) && sizeof($medical_general)>0)
        {
            $flag = '0';
            foreach ($medical_general as $key => $value) 
            {
                $flag = '0';
                $arr_data['user_id']            = $user_id;
                $arr_data['medical_general_id'] = $value;

                $status = $this->HealthGeneralModel->create($arr_data);
                if($status)
                {
                    $flag = '1';
                }    
            }

            if($flag == '1')
            {
                $arr_notification['to_user_id']       = $user_id;
	            $arr_notification['from_user_id']     = $this->user_id;
	            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has added/update your medical details.';
	            $arr_notification['notification_url'] = '/patient/my_account/family_member';
	            $this->UserNotificationService->create_user_notification($arr_notification);

                Session::flash('success','Medical general added succssfully.');
                return response()->json($return_arr);
            }
            else
            {
                Session::flash('error','Problem occured while adding medical general, Please try again.');
                return response()->json($return_arr);
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return response()->json($return_arr);
        }
    }

    public function delete_general($enc_id=false)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $status = $this->HealthGeneralModel->where('id','=',$id)->delete();
            if($status)
            {
                Session::flash('success','Medical general remove succssfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error','Problem occured,while removing medical general.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
        return redirect()->back();
    }

	public function lifestyle($enc_id)
	{
		if($enc_id!='')
		{
			$arr_lifestyle = [];
			$id = base64_decode($enc_id);
	        $obj_lifestyle = $this->LifestyleModel->where('user_id','=',$id)->first();
	        if($obj_lifestyle)
	        {
	            $arr_lifestyle = $obj_lifestyle->toArray();
	        }
	        
	        $this->arr_view_data['arr_lifestyle']         = $arr_lifestyle;
	        $this->arr_view_data['enc_id']             	  = $enc_id;

			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Medical History";
			$this->arr_view_data['breadcrum_level_4']     = "Edit Lifestyle";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/medical_history/'.$enc_id;
			$this->arr_view_data['breadcrum_level_4_url'] = $this->breadcrum_level_2_url.'/medical_history/lifestyle/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Edit Lifestyle';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->medical_history_view_folder.'.lifestyle', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}
	}

	public function update_lifestyle(Request $request)
	{
		$arr_rules = $return_arr = [];

        $arr_rules['smoking']        = 'required';
        $arr_rules['exercise']       = 'required';
        $arr_rules['alcohol']        = 'required';
        $arr_rules['stress_level']   = 'required';
        $arr_rules['marital_status'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';
            return response()->json($return_arr);
        }

        $user_id = base64_decode($request->input('enc_id'));

        $arr_data['user_id']        = $user_id;
        $arr_data['smoking']        = trim($request->input('smoking'));
        $arr_data['exercise']       = trim($request->input('exercise'));
        $arr_data['alcohol']        = trim($request->input('alcohol'));
        $arr_data['stress_level']   = trim($request->input('stress_level'));
        $arr_data['marital_status'] = trim($request->input('marital_status'));

        $status = $this->LifestyleModel->updateOrCreate(['user_id'=>$user_id],$arr_data);
        if($status)
        {
            $arr_notification['to_user_id']       = $user_id;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has added/update your lifestyle details.';
            $arr_notification['notification_url'] = '/patient/my_health/medical_history';
            $this->UserNotificationService->create_user_notification($arr_notification);

            Session::flash('success','Lifestyle details saved succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while update lifestyle details, Please try again.');
            return response()->json($return_arr);
        }
	}

	public function medication($enc_id)
    {
    	if($enc_id!='')
		{
			$patient = get_dump_id_session(base64_decode($enc_id));
			$patient_dump['dump_id'] = isset($patient['dump_id'])?$patient['dump_id']:'';
			$patient_dump['dump_session'] = isset($patient['dump_session'])?$patient['dump_session']:'';
			$this->arr_view_data['patient_dump']          = $patient_dump;

	        $this->arr_view_data['enc_id']             	  = $enc_id;
			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Medical History";
			$this->arr_view_data['breadcrum_level_4']     = "Add Medication";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/medical_history/'.$enc_id;
			$this->arr_view_data['breadcrum_level_4_url'] = $this->breadcrum_level_2_url.'/medical_history/medication/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Add Medication';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->medical_history_view_folder.'.add_medication', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}
    }

    public function store_medication(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['name']           = 'required';
        $arr_rules['date']           = 'required';
        $arr_rules['frequency']      = 'required';
        $arr_rules['medication_use'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $id = base64_decode($request->input('enc_id'));

        if($request->hasFile('file_medication'))
        {
            $medication = $request->file('file_medication');

            if(isset($medication) && sizeof($medication)>0)
            {
                $extention = strtolower($medication->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of medication. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($medication->getClientSize() > 5000000)
                {
                    Session::flash('error','medication file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                    
                    $medication_name   = $request->file('file_medication');
                    $medication_ext    = strtolower($request->file('file_medication')->getClientOriginalExtension());
                    $medication_name   = uniqid().'.'.$medication_ext;
                    $medication_result = $request->file('file_medication')->move($this->patient_medication_base_path, $medication_name);
                }

                $arr_data['medication_file']       = isset($medication_name) && !empty($medication_name) ? $medication_name : '';
            }
            else
            {
                Session::flash('error','Invalid file of medication. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        $arr_data['user_id'] = $id;
        $arr_data['name'] = trim($request->input('name'));
        $arr_data['date'] = trim(date('Y-m-d',strtotime($request->input('date'))));
        $arr_data['frequency'] = trim($request->input('frequency'));
        $arr_data['medication_use'] = trim($request->input('medication_use'));

        $status = $this->MedicationsModel->create($arr_data);
        if($status)
        {
            $arr_notification['to_user_id']       = $id;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has added/update your medication details.';
            $arr_notification['notification_url'] = '/patient/my_health/medical_history';
            $this->UserNotificationService->create_user_notification($arr_notification);

            Session::flash('success','Medication saved succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured,while adding medication.');
            return response()->json($return_arr);
        }
    }

    public function edit_medication($enc_id)
    {
        if($enc_id!='')
        {
            $arr_medication_details = [];
            $id = base64_decode($enc_id);
            $obj_medication_details = $this->MedicationsModel->where('id','=',$id)
                                                             ->first();
            if($obj_medication_details)
            {
                $arr_medication_details = $obj_medication_details->toArray();
            }

            $patient_user_id = $arr_medication_details['user_id'];
            $patient = get_dump_id_session($arr_medication_details['user_id']);
			$patient_dump['dump_id'] = isset($patient['dump_id'])?$patient['dump_id']:'';
			$patient_dump['dump_session'] = isset($patient['dump_session'])?$patient['dump_session']:'';

			$this->arr_view_data['patient_dump']                   = $patient_dump;
            $this->arr_view_data['arr_medication_details']         = $arr_medication_details;
            $this->arr_view_data['enc_id']                         = $enc_id;
            $this->arr_view_data['breadcrum_level_1']              = $this->breadcrum_level_1;
            $this->arr_view_data['breadcrum_level_2']              = $this->breadcrum_level_2;
            $this->arr_view_data['breadcrum_level_3']              = 'Medical History';
            $this->arr_view_data['breadcrum_level_4']              = 'Edit Medication';
            $this->arr_view_data['breadcrum_level_1_url']          = $this->breadcrum_level_1_url;
            $this->arr_view_data['breadcrum_level_3_url']          = $this->breadcrum_level_2_url.'/medical_history/'.base64_encode($patient_user_id);

            $this->arr_view_data['breadcrum_level_4_url']          = $this->breadcrum_level_2_url.'/medical_history/medication/edit/'.$enc_id;
            $this->arr_view_data['page_title']                     = 'Edit Medication';
            $this->arr_view_data['module_url_path']                = $this->module_url_path;
            $this->arr_view_data['medication_base_path']   = $this->patient_medication_base_path;
            $this->arr_view_data['medication_public_path'] = $this->patient_medication_public_path;
        
            return view($this->medical_history_view_folder.'.edit_medication', $this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }
    }

    public function upadte_medication(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['name']           = 'required';
        $arr_rules['date']           = 'required';
        $arr_rules['frequency']      = 'required';
        $arr_rules['medication_use'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $id = base64_decode($request->input('enc_id'));

        if($request->hasFile('file_medication'))
        {
            $medication = $request->file('file_medication');

            if(isset($medication) && sizeof($medication)>0)
            {
                $extention = strtolower($medication->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of medication. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($medication->getClientSize() > 5000000)
                {
                    Session::flash('error','medication file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                    
                    $medication_name   = $request->file('file_medication');
                    $medication_ext    = strtolower($request->file('file_medication')->getClientOriginalExtension());
                    $medication_name   = uniqid().'.'.$medication_ext;
                    $medication_result = $request->file('file_medication')->move($this->patient_medication_base_path, $medication_name);
                    if($medication_result)
                    {
                         @unlink($this->patient_medication_base_path.'/'.$request->input('old_medication_file'));
                    }
                }

                $arr_data['medication_file']       = isset($medication_name) && !empty($medication_name) ? $medication_name : '';
            }
            else
            {
                Session::flash('error','Invalid file of medication. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        $arr_data['name'] = trim($request->input('name'));
        $arr_data['date'] = trim(date('Y-m-d',strtotime($request->input('date'))));
        $arr_data['frequency'] = trim($request->input('frequency'));
        $arr_data['medication_use'] = trim($request->input('medication_use'));

        $status = $this->MedicationsModel->where('id','=',$id)->update($arr_data);
        if($status)
        {
            /*$arr_notification['to_user_id']       = $id;
            $arr_notification['from_user_id']     = $this->user_id;
            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has added/update your medication details.';
            $arr_notification['notification_url'] = '/patient/my_health/medical_history';
            $this->UserNotificationService->create_user_notification($arr_notification);*/

            Session::flash('success','Medication updated succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured,while update medication.');
            return response()->json($return_arr);
        }
    }

    public function delete_medication($enc_id = false)
    {
    	if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $obj_medication = $this->MedicationsModel->where('id','=',$id)->first();
                                             
            $medication_file = isset($obj_medication->medication_file)?$obj_medication->medication_file:'';

            $status = $obj_medication->delete();

            if($status)
            {
                if(isset($medication_file) && $medication_file!=null)
                {
                    $file         = $this->patient_medication_base_path.'/'.$medication_file;
                    if(file_exists($file))
                    {
                        unlink($file);
                    }
                }

                /*$arr_notification['to_user_id']       = $id;
	            $arr_notification['from_user_id']     = $this->user_id;
	            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has deleted your medication details.';
	            $arr_notification['notification_url'] = '/patient/my_health/medical_history';
	            $this->UserNotificationService->create_user_notification($arr_notification);*/

                Session::flash('success','Medication deleted succssfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error','Problem occured,while delation medication.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function view_medication($enc_id)
    {
    	if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $obj_medication_details = $this->MedicationsModel->where('id','=',$id)
                                                     ->first();
            if($obj_medication_details)
            {
                $arr_medication_details = $obj_medication_details->toArray();
            }

            $patient_user_id = $arr_medication_details['user_id'];
            $patient = get_dump_id_session($patient_user_id);
			$patient_dump['dump_id'] = isset($patient['dump_id'])?$patient['dump_id']:'';
			$patient_dump['dump_session'] = isset($patient['dump_session'])?$patient['dump_session']:'';

            $this->arr_view_data['patient_dump']         		   = $patient_dump;
            $this->arr_view_data['arr_medication_details']         = $arr_medication_details;
            $this->arr_view_data['enc_id']                         = $enc_id;
            $this->arr_view_data['patient_user_id']                = $patient_user_id;


            $this->arr_view_data['breadcrum_level_1']              = $this->breadcrum_level_1;
            $this->arr_view_data['breadcrum_level_2']              = $this->breadcrum_level_2;
            $this->arr_view_data['breadcrum_level_3']              = 'Medical History';
            $this->arr_view_data['breadcrum_level_4']              = 'View Medication';
            $this->arr_view_data['breadcrum_level_1_url']          = $this->breadcrum_level_1_url;

            $this->arr_view_data['breadcrum_level_3_url']          = $this->breadcrum_level_2_url.'/medical_history/'.base64_encode($patient_user_id);

            $this->arr_view_data['breadcrum_level_4_url']          = $this->breadcrum_level_2_url.'/medical_history/medication/edit/'.$enc_id;
            $this->arr_view_data['page_title']                     = 'View Medication';
            $this->arr_view_data['module_url_path']                = $this->module_url_path;
            $this->arr_view_data['medication_base_path']   = $this->patient_medication_base_path;
            $this->arr_view_data['medication_public_path'] = $this->patient_medication_public_path;
        
            return view($this->medical_history_view_folder.'.view_medication', $this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
    }


	/*--------------------------------------------------------------------------------
							          Medical Certificate
	----------------------------------------------------------------------------------*/

	public function medical_certificate($enc_id='')
	{ 
		if($enc_id!='')
		{
			$arr_doctor_details = $arr_patient_details = $arr_reason = $arr_family_member = [];
			$obj_doctor = $this->UserModel->select('id','first_name','last_name','dump_id','dump_session','prefix')
										  ->with(['doctor_data'=>function($qry){
										  		$qry->select('user_id','clinic_address','medicare_provider_no','clinic_phone_code','clinic_mobile_no','clinic_contact_no','clinic_name');
											},'doctor_prefix'])
										  ->where('id','=',$this->user_id)
										  ->first();
			if($obj_doctor)
			{
				$arr_doctor_details = $obj_doctor->toArray();
			}

			$patient_user_id = base64_decode($enc_id);

			$obj_patient = $this->UserModel->select('first_name','last_name')
											->where('id','=',$patient_user_id)
											->first();
			if($obj_patient)
			{
				$arr_patient_details = $obj_patient->toArray();
			}

			$obj_reason = $this->MedicalCertificateReason->orderBy('reason','asc')->get();
			if($obj_reason)
			{
				$arr_reason = $obj_reason->toArray();
			}

			$obj_famili_memeber = $this->FamilyMemberModel->select('id','user_id','first_name','last_name')->where('user_id',$patient_user_id)->get();
			if($obj_famili_memeber)
			{
				$arr_family_member = $obj_famili_memeber->toArray();
			}
			
			$this->arr_view_data['patient_user_id']       = $enc_id;
			$this->arr_view_data['arr_patient_details']   = $arr_patient_details;
			$this->arr_view_data['arr_doctor_details']    = $arr_doctor_details;
			$this->arr_view_data['arr_reason']    		  = $arr_reason;
			$this->arr_view_data['arr_family_member']     = $arr_family_member;

			$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']     = "Patient Details";

			$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_2_url'] = $this->breadcrum_level_2_url;
			$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/patient/details/'.$enc_id;

	        $this->arr_view_data['page_title']      = 'Patient Details';
	        $this->arr_view_data['module_url_path'] = $this->module_url_path;
	        
	        $this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
	        $this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
	        $this->arr_view_data['default_img_path']          = $this->default_img_path;

	    	return view($this->medical_certificate_view_folder.'.index', $this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went wrong,Please try again.');
			return redirect()->back();
		}	
	}

	public function save_and_generate_medical_certificate(Request $request)
	{
		$arr_data = $arr_patient = $arr_rules = [];
		$reason = $patient_name = $user_type = '';

        $arr_rules['family_member'] = 'required';
        $arr_rules['from_date']     = 'required';
        $arr_rules['to_date']       = 'required';
        $arr_rules['reason']        = 'required';
        $arr_rules['for_reason']    = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails()):
            Session::flash('error','Please fill all required field.');
			return redirect()->back();
        endif;

		$todays_date   = date('d-M-Y');
		$patient_id    = $request->input('patient_id');
		$patient_type  = $request->input('patient_type');
		$family_member = $request->input('family_member');
		$reason_id     = $request->input('reason');
		$to_date       = $request->input('to_date');
		$from_date     = $request->input('from_date');
		$for_reason    = $request->input('for_reason');

		if( $patient_type == 'family' ):
			$arr_patient = get_family_member($patient_id,$family_member);

			if( isset($arr_patient) && sizeof($arr_patient) > 0) :
				$first_name   = isset( $arr_patient['first_name'] ) && !empty( $arr_patient['first_name'] ) ? ucwords( decrypt_value($arr_patient['first_name']) ) : '';
				$last_name    = isset( $arr_patient['last_name'] ) && !empty( $arr_patient['last_name'] ) ? ucwords( decrypt_value($arr_patient['last_name']) ) : '';
				$patient_name = $first_name.' '.$last_name;
				$user_type    = 'family';
			else:
				$arr_patient      = get_user_details($family_member);
				if( isset($arr_patient) && sizeof($arr_patient) > 0):
					$first_name   = isset( $arr_patient['first_name'] ) && !empty( $arr_patient['first_name'] ) ? ucwords( decrypt_value($arr_patient['first_name']) ) : '';
					$last_name    = isset( $arr_patient['last_name'] ) && !empty( $arr_patient['last_name'] ) ? ucwords( decrypt_value($arr_patient['last_name']) ) : '';
					$patient_name = $first_name.' '.$last_name;
					$user_type    = 'user';
				endif;		
			endif;
		endif;
		
		

		if( isset($reason_id) && $reason_id!=null ) 
		{
			$obj_reason = $this->MedicalCertificateReason->where('id',$reason_id)->first();
			if( isset($obj_reason) && $obj_reason!=null )
			{
				$reason = isset( $obj_reason->reason ) && !empty( $obj_reason->reason ) ? $obj_reason->reason : '';
			}
		}
		
		$arr_doctor  = get_user_details($this->user_id);
		$doctor_name = '';
		if( isset($arr_doctor) && sizeof($arr_doctor) ) 
		{
			$mobile_no  		= isset( $arr_doctor['mobile_no'] ) && !empty( $arr_doctor['mobile_no'] ) ? $arr_doctor['mobile_no'] : '';
			$address 	 		= isset( $arr_doctor['address'] ) && !empty( $arr_doctor['address'] ) ? decrypt_value( $arr_doctor['address'] ) : '';
			$doctor_first_name 	= isset( $arr_doctor['first_name'] ) && !empty( $arr_doctor['first_name'] ) ? ucwords( decrypt_value($arr_doctor['first_name']) ) : '';
			$doctor_last_name  	= isset( $arr_doctor['last_name'] ) && !empty( $arr_doctor['last_name'] ) ? ucwords( decrypt_value($arr_doctor['last_name']) ) : '';
			$doctor_name        = $doctor_first_name.' '.$doctor_last_name;	
		}

		$this->arr_view_data['reason']       = $reason;
		$this->arr_view_data['address']      = $address;
		$this->arr_view_data['to_date']      = $to_date;
		$this->arr_view_data['from_date']    = $from_date;
		$this->arr_view_data['mobile_no']    = $mobile_no;
		$this->arr_view_data['for_reason']   = $for_reason;
		$this->arr_view_data['todays_date']  = $todays_date;
		$this->arr_view_data['doctor_name']  = $doctor_name;
		$this->arr_view_data['patient_name'] = $patient_name;

		if(!empty($this->arr_view_data))
		{
		    // Custom Header
		    $file_name = uniqid().'.pdf';

 			PDF::setHeaderCallback(function($pdf) 
				 {
			        $pdf->SetY(15);
			        // Set font
			        $pdf->SetFont('helvetica', 'B', 20);
			        // $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
			        $pdf->SetY(40);
				 });
				
			// Custom Footer
			PDF::setFooterCallback(function($pdf) {
		        // Position at 15 mm from bottom
		        $pdf->SetY(-15);
		        // Set font
		        $pdf->SetFont('helvetica', 'I', 8);
		        // Page number
		        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			});

			PDF::SetTitle('Mobi Doctor | Patient Details');
			PDF::SetMargins(10, 30, 10, 10);
			PDF::SetFontSubsetting(false);
			PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
			PDF::AddPage();
			PDF::writeHTML(view($this->medical_certificate_view_folder.'.download_medical_certificate',$this->arr_view_data)->render());
			PDF::Output($this->medical_certificate_base_path.'/'.$file_name,'F');
			PDF::Output($file_name,'D');
			
			$arr_data['user_id']    = $patient_id;
			$arr_data['patient_id'] = $family_member_id;
			$arr_data['doctor_id']  = $this->user_id;
			$arr_data['user_type']  = $user_type;
			$arr_data['file_name']  = $file_name;
			$obj_pdf = $this->MedicalCertificateModel->create($arr_data);
			if($obj_pdf)
			{
			 	$arr_notification['to_user_id']       = $patient_id;
	            $arr_notification['from_user_id']     = $this->user_id;
	            $arr_notification['message']          = 'Doctor '.$this->user_first_name.' '.$this->user_last_name.', has genarated a medical certificate.';
	            $arr_notification['notification_url'] = '/patient/documents/medical_certificate';
	            $this->UserNotificationService->create_user_notification($arr_notification);

			 	Session::flash('success','Patient medical certificate genarated successfully.');
				return redirect()->back();
			}
			else
			{
				Session::flash('error','Something went wrong,Please try again.');
				return redirect()->back();
			} 
		}

		Session::flash('error','Something went wrong,Please try again.');
		return redirect()->back();
	}

	public function old_download_personal_information($enc_id)
	{
		$user_id = base64_decode($enc_id);
		$obj_patient_details = $this->UserModel->select('id','first_name','last_name','email','phone_code','mobile_no','address','city','country','gender','fax_no','postal_code','contact_no','timezone','date_of_birth','dump_id','dump_session')->with(['family_member'=>function($qry){
																$qry->select('user_id','first_name','last_name','email','gender','relation','birth_date','phone_code','mobile_no');
														},'life_style_details'=>function($qry){
																$qry->select('user_id','smoking','exercise','alcohol','stress_level','marital_status');
														},'medication_details'])->where('id','=',$user_id)
														->first();
		if($obj_patient_details)
		{
			$arr_patient_details = $obj_patient_details->toArray();
		}

		$arr_general = $arr_selected_general = $selected_general_ids = [];

		$obj_general = $this->MedicalGeneralModel->select('id','name')->where('status','=','1')->get();
        if($obj_general)
        {
            $arr_general = $obj_general->toArray();
        }

        $obj_selected_general = $this->HealthGeneralModel->select('id','medical_general_id')
                                                         ->with(['general_details'=>function($qry){
                                                                $qry->select('id','name');
                                                          }])
                                                         ->where('user_id','=',$user_id)
                                                         ->get();
        if($obj_selected_general)
        {
            $arr_selected_general = $obj_selected_general->toArray();
        }

        foreach ($arr_selected_general as $value) 
        {
           $selected_general_ids[]  = $value['medical_general_id'];
        }

		$this->arr_view_data['arr_patient_details'] = $arr_patient_details;
		$this->arr_view_data['arr_selected_general'] = $arr_selected_general;
		$this->arr_view_data['selected_general_ids'] = $selected_general_ids;

		return view($this->patient_history_view_folder.'.download_personal_information', $this->arr_view_data);
	}

	public function get_medication_details($enc_id)
	{
		$arr_medication = [];
		$user_id = base64_decode($enc_id);
		$obj_patient_details = $this->MedicationsModel->where('user_id','=',$user_id)->get();
		if($obj_patient_details)
		{
			$arr_medication = $obj_patient_details->toArray();
		}
		return response()->json($arr_medication);
	}

	public function download_personal_information(Request $request,$enc_id)
	{
		$temp_medication_arr = [];
		//$medication_arr = $request->input('arr_data');
		if($request->has('arr_data') && $request->input('arr_data')!='')
		{
			$arr_session_data = $request->input('arr_data');
			Session::put("arr_medication_data",$arr_session_data);
			return response()->json(['status'=>'success']);
		}
		
		$user_id = base64_decode($enc_id);
		$obj_patient_details = $this->UserModel->select('id','first_name','last_name','email','phone_code','mobile_no','address','city','country','gender','fax_no','postal_code','contact_no','timezone','date_of_birth','dump_id','dump_session')->with(['family_member'=>function($qry){
																$qry->select('user_id','first_name','last_name','email','gender','relation','birth_date','phone_code','mobile_no');
														},'life_style_details'=>function($qry){
																$qry->select('user_id','smoking','exercise','alcohol','stress_level','marital_status');
														}])->where('id','=',$user_id)
														->first();
		if($obj_patient_details)
		{
			$arr_patient_details = $obj_patient_details->toArray();
		}

		$first_name = isset($arr_patient_details['first_name']) ? decrypt_value($arr_patient_details['first_name']):'-';
		$last_name  = isset($arr_patient_details['last_name']) ? decrypt_value($arr_patient_details['last_name']):'-';
		$file_name  = $first_name.' '.$last_name;

		$arr_general = $arr_selected_general = $selected_general_ids = [];

		$obj_general = $this->MedicalGeneralModel->select('id','name')->where('status','=','1')->get();
        if($obj_general)
        {
            $arr_general = $obj_general->toArray();
        }

        $obj_selected_general = $this->HealthGeneralModel->select('id','medical_general_id')
                                                         ->with(['general_details'=>function($qry){
                                                                $qry->select('id','name');
                                                          }])
                                                         ->where('user_id','=',$user_id)
                                                         ->get();
        if($obj_selected_general)
        {
            $arr_selected_general = $obj_selected_general->toArray();
        }

        foreach ($arr_selected_general as $value) 
        {
           $selected_general_ids[]  = $value['medical_general_id'];
        }
		$this->arr_view_data['arr_patient_details']  = $arr_patient_details;
		$this->arr_view_data['arr_selected_general'] = $arr_selected_general;
		$this->arr_view_data['selected_general_ids'] = $selected_general_ids;
		$this->arr_view_data['medication_arr'] 		 = Session::get('arr_medication_data');
		
		if(!empty($this->arr_view_data))
		{
		    // Custom Header
			PDF::setHeaderCallback(function($pdf) 
			{

			        $pdf->SetY(15);
			        // Set font
			        $pdf->SetFont('helvetica', 'B', 20);
			        // Title
			        //$pdf->Cell(0, 15, 'Doctoroo', 0, false, 'C', 0, '', 0, false, 'M', 'M');

			        // Image method signature:
			        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

			        $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
			        $pdf->SetY(40);
			});

			// Custom Footer
			PDF::setFooterCallback(function($pdf) {

			        // Position at 15 mm from bottom
			        $pdf->SetY(-15);
			        // Set font
			        $pdf->SetFont('helvetica', 'I', 8);
			        // Page number
			        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			});

			PDF::SetTitle('Mobi Doctor | Patient Details');
			PDF::SetMargins(10, 30, 10, 10);
			PDF::SetFontSubsetting(false);
			PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
			PDF::AddPage();
			PDF::writeHTML(view($this->patient_history_view_folder.'.download_personal_information', $this->arr_view_data)->render());
			PDF::Output($file_name.'.pdf');
		}

		return redirect()->back();
	}

	
}
