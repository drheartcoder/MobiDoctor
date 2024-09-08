<?php

namespace App\Http\Controllers\Front\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Common\Services\UserNotificationService;
use App\Common\Services\StripeService;

use App\Models\ConsultationSettingModel;
use App\Models\PrescriptionModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;
use App\Models\TimezoneModel;

use Validator;
use Sentinel;
use PDF;

class MyConsultationController extends Controller
{
    public function __construct(
    								UserNotificationService $user_notification_service,
    								StripeService           $stripe_service
    							)
	{
		$this->user_id = $this->user_first_name = $this->user_last_name = $this->user_timezone = $this->user_view_type = '';

		$this->arr_view_data                = [];
		$this->module_title                 = "My Consultation";
		$this->parent_url_path              = url('/').'/doctor';
		$this->module_url_path              = url('/').'/doctor/my_consultation';
		$this->module_view_folder           = "front.doctor.my_consultation";

		$this->breadcrum_level_1            = 'Dashboard';
		$this->breadcrum_level_2            = $this->module_title;

		$this->breadcrum_level_1_url        = $this->parent_url_path.'/dashboard';
		$this->breadcrum_level_2_url        = $this->module_url_path;

		$this->ConsultationSettingModel     = new ConsultationSettingModel();
		$this->PrescriptionModel            = new PrescriptionModel();
		$this->ConsultationModel            = new ConsultationModel();
		$this->FamilyMemberModel            = new FamilyMemberModel();
		$this->TimezoneModel                = new TimezoneModel();

		$this->UserNotificationService      = $user_notification_service;
		$this->StripeService                = $stripe_service;

		$this->patient_image_public_path    = url('/').config('app.img_path.patient_profile_images');
		$this->patient_image_base_path      = base_path().config('app.img_path.patient_profile_images');
		$this->doctor_image_public_path     = url('/').config('app.img_path.doctor_profile_images');
		$this->doctor_image_base_path       = base_path().config('app.img_path.doctor_profile_images');
		$this->default_img_path             = url('/').config('app.img_path.default_img_path');

		$this->illness_img_base_path        = base_path().config('app.img_path.illness_img');
		$this->illness_img_public_path      = url('/').config('app.img_path.illness_img');

		$this->prescription_img_base_path   = base_path().config('app.img_path.prescription_file');
		$this->prescription_img_public_path = url('/').config('app.img_path.prescription_file');

		$this->user_view_type               = 'list';

		$user                               = Sentinel::check();
		
		if($user)
		{
			$this->user_id         = $user->id;
			$this->user_first_name = decrypt_value( $user->first_name );
			$this->user_last_name  = decrypt_value( $user->last_name );
			$this->user_timezone   = $user->timezone;
			$this->user_view_type  = $user->view_type;
		}
	}

	public function upcoming()
	{
		$arr_consultation = $paginate = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'upcoming')
													->orderBy('id','desc')
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name','profile_image');
													}])
													->paginate(12);
		if( $obj_consultation ):
			$paginate         = clone $obj_consultation;
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$this->arr_view_data['paginate']                  = $paginate;
		$this->arr_view_data['arr_consultation']          = $arr_consultation;
		$this->arr_view_data['user_view_type']            = $this->user_view_type;

		$this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
		$this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
		$this->arr_view_data['default_img_path']          = $this->default_img_path;

		$this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']         = 'Upcoming';

		$this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/upcoming';

		$this->arr_view_data['page_title']                = 'Upcoming Consultation';
		$this->arr_view_data['module_url_path']           = $this->module_url_path;

		return view($this->module_view_folder.'.upcoming', $this->arr_view_data);
	} // end upcomings


	public function upcoming_details($enc_id = false)
	{
		$arr_consultation = $arr_prescription = [];

		$obj_consultation = $this->ConsultationModel->where('id', base64_decode($enc_id))
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'upcoming')
													->orderBy('id','desc')
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name','dump_id','dump_session');
													}])
													->with(['category_name' => function($query){
														$query->select('id','name');
													}])
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();

			if( $arr_consultation['who_is_patient'] == 'family' ):
				$obj_family_member = $this->FamilyMemberModel->select('id','first_name','last_name')
															 ->where('id', $arr_consultation['patient_id'])
															 ->where('user_id', $arr_consultation['user_id'])
															 ->first();
				if( $obj_family_member ):
					$arr_family_member = $obj_family_member->toArray();

					$arr_consultation['family']['id']         = $arr_family_member['id'];
					$arr_consultation['family']['first_name'] = $arr_family_member['first_name'];
					$arr_consultation['family']['last_name']  = $arr_family_member['last_name'];
				endif;
			endif;
		endif;
		
		$obj_prescription = $this->PrescriptionModel->where('consult_id', base64_decode($enc_id))->where('doctor_id', $this->user_id)->get();
		if( $obj_prescription ):
			$arr_prescription = $obj_prescription->toArray();
		endif;

		$this->arr_view_data['enc_id']                       = $enc_id;
		$this->arr_view_data['arr_consultation']             = $arr_consultation;
		$this->arr_view_data['arr_prescription']             = $arr_prescription;

		$this->arr_view_data['illness_img_base_path']        = $this->illness_img_base_path;
		$this->arr_view_data['illness_img_public_path']      = $this->illness_img_public_path;

		$this->arr_view_data['prescription_img_base_path']   = $this->prescription_img_base_path;
		$this->arr_view_data['prescription_img_public_path'] = $this->prescription_img_public_path;

		$this->arr_view_data['breadcrum_level_1']            = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']            = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']            = 'Upcoming';
		$this->arr_view_data['breadcrum_level_4']            = 'Details';

		$this->arr_view_data['breadcrum_level_1_url']        = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']        = $this->breadcrum_level_2_url.'/upcoming';

		$this->arr_view_data['page_title']                   = 'Consultation Details';
		$this->arr_view_data['module_url_path']              = $this->module_url_path;
		$this->arr_view_data['current_url_path']             = $this->module_url_path.'/upcoming/'.$enc_id;

		return view($this->module_view_folder.'.upcoming_details', $this->arr_view_data);
	} // end upcoming_details


	public function upcoming_update(Request $request, $enc_id = false)
	{
		$arr_rules['consult_notes'] = "required";

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails()):
            $return_arr['status'] = "error";
            $return_arr['msg']    = "Enter all required fields.";
            return response()->json($return_arr);
        endif;

        $data['notes'] = $request->input('consult_notes');
        $update_consult = $this->ConsultationModel->where('id', base64_decode( $enc_id ) )->update($data);

        if( $update_consult ):
        	$return_arr['status'] = "success";
            $return_arr['msg']    = "Consultation updated successfully.";
        else:
        	$return_arr['status'] = "error";
            $return_arr['msg']    = "Something went wrong while adding notes. Please try again!";
        endif;

        return response()->json($return_arr);
	}


	public function add_prescription(Request $request, $enc_id = false)
	{
		$arr_rules['repeats']   = "required";
		$arr_rules['direction'] = "required";

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails()):
            $return_arr['status'] = "error";
            $return_arr['msg']    = "Enter all required fields.";
            return response()->json($return_arr);
        endif;

        $user_id = '';

        $obj_consult = $this->ConsultationModel->select('id','user_id')->where('id', base64_decode( $enc_id ) )->first();
        if( $obj_consult ):
        	$arr_consult = $obj_consult->toArray();

        	$user_id = $arr_consult['user_id'];
        endif;

        // upload prescription image
        if($request->hasFile('file_prescription_image'))
        {
            $prescription_image = $request->file('file_prescription_image');

            if(isset($prescription_image) && sizeof($prescription_image)>0)
            {
                $extention = strtolower($prescription_image->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    $return_arr['status']  = 'error';
            		$return_arr['message'] = 'Invalid file. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx';
                    return response()->json($return_arr);
                }
                else if($prescription_image->getClientSize() > 5000000)
                {
                    $return_arr['status']  = 'error';
            		$return_arr['message'] = 'File is more than limit size. Please upload image/document with small size. Max size allowed is 5mb';
                    return response()->json($return_arr);
                }
                else
                {
                    $prescription_image_name   = $request->file('file_prescription_image');
                    $prescription_image_ext    = strtolower($request->file('file_prescription_image')->getClientOriginalExtension());
                    $prescription_image_name   = uniqid().'.'.$prescription_image_ext;
                    $prescription_image_result = $request->file('file_prescription_image')->move($this->prescription_img_base_path, $prescription_image_name);
                }

                $data['name'] = isset($prescription_image_name) && !empty($prescription_image_name) ? $prescription_image_name : '';
            }
            else
            {
                $return_arr['status']  = 'error';
            	$return_arr['message'] = 'Invalid file. Please upload valid image/document.';
                return response()->json($return_arr);
            }
        }

        $data['user_id']    = $user_id;
        $data['doctor_id']  = $this->user_id;
        $data['consult_id'] = base64_decode( $enc_id );
        $data['repeats']    = $request->input('repeats');
        $data['direction']  = $request->input('direction');
        $add_prescription   = $this->PrescriptionModel->insert($data);

        if( $add_prescription ):
        	$return_arr['status'] = "success";
            $return_arr['msg']    = "Prescription added successfully.";
        else:
        	$return_arr['status'] = "error";
            $return_arr['msg']    = "Something went wrong while adding prescription. Please try again!";
        endif;

        return response()->json($return_arr);
	} // end add_prescription


	public function completed()
	{
		$arr_consultation = $paginate = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'completed')
													->orderBy('id','desc')
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name','profile_image');
													}])
													->paginate(12);
		if( $obj_consultation ):
			$paginate         = clone $obj_consultation;
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$this->arr_view_data['paginate']                  = $paginate;
		$this->arr_view_data['arr_consultation']          = $arr_consultation;
		$this->arr_view_data['user_view_type']            = $this->user_view_type;

		$this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
		$this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;
		$this->arr_view_data['default_img_path']          = $this->default_img_path;

		$this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']         = 'Completed';

		$this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/completed';

		$this->arr_view_data['page_title']                = 'Completed Consultation';
		$this->arr_view_data['module_url_path']           = $this->module_url_path;

		return view($this->module_view_folder.'.completed', $this->arr_view_data);
	} // end completed


	public function completed_details($enc_id = false)
	{
		$arr_consultation = [];

		$obj_consultation = $this->ConsultationModel->where('id', base64_decode($enc_id))
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'completed')
													->orderBy('id','desc')
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name','dump_id','dump_session');
													}])
													->with(['category_name' => function($query){
														$query->select('id','name');
													}])
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();

			if( $arr_consultation['who_is_patient'] == 'family' ):
				$obj_family_member = $this->FamilyMemberModel->select('id','first_name','last_name')
															 ->where('id', $arr_consultation['patient_id'])
															 ->where('user_id', $arr_consultation['user_id'])
															 ->first();
				if( $obj_family_member ):
					$arr_family_member = $obj_family_member->toArray();

					$arr_consultation['family']['id']         = $arr_family_member['id'];
					$arr_consultation['family']['first_name'] = $arr_family_member['first_name'];
					$arr_consultation['family']['last_name']  = $arr_family_member['last_name'];
				endif;
			endif;
		endif;

		$this->arr_view_data['enc_id']                  = $enc_id;
		$this->arr_view_data['arr_consultation']        = $arr_consultation;

		$this->arr_view_data['illness_img_base_path']   = $this->illness_img_base_path;
		$this->arr_view_data['illness_img_public_path'] = $this->illness_img_public_path;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Completed';
		$this->arr_view_data['breadcrum_level_4']       = 'Details';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']   = $this->breadcrum_level_2_url.'/completed';

		$this->arr_view_data['page_title']              = 'Consultation Details';
		$this->arr_view_data['module_url_path']         = $this->module_url_path;
		$this->arr_view_data['current_url_path']        = $this->module_url_path.'/completed/'.$enc_id;

		return view($this->module_view_folder.'.completed_details', $this->arr_view_data);
	} // end completed_details


	/*----------------------Video Calling Function Starts----------------------*/

	public function video($enc_id = false)
	{
		$arr_consultation = [];
		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status','doctor_call_duration')
													->where('id', base64_decode($enc_id))
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name','profile_image');
													}])
													->with(['doctor_details' => function($query){
														$query->select('id','first_name','last_name','profile_image')->with('doctor_prefix');
													}])
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$this->arr_view_data['arr_consultation']          = $arr_consultation;

		$this->arr_view_data['patient_image_base_path']   = $this->patient_image_base_path;
		$this->arr_view_data['patient_image_public_path'] = $this->patient_image_public_path;

		$this->arr_view_data['doctor_image_base_path']    = $this->doctor_image_base_path;
		$this->arr_view_data['doctor_image_public_path']  = $this->doctor_image_public_path;

		$this->arr_view_data['default_img_path']          = $this->default_img_path;

		$this->arr_view_data['page_title']                = 'Video Consultation';
		$this->arr_view_data['module_url_path']           = $this->module_url_path;

		return view($this->module_view_folder.'.video', $this->arr_view_data);
	}

	public function initiate_doctor_call(Request $request)
	{
		$consult_id = $request->input('consult_id');
		
		$busy_count = $this->ConsultationModel->where('consultation_id','!=',$consult_id)
											  ->where('doctor_id',$this->user_id)
											  ->where('patient_video','1')
											  ->count();
		if($busy_count > 0 ):
			return 'busy';
		endif;

		if( $consult_id != '' || $consult_id != null ):

			$update['doctor_video'] = "1";
			$update_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->update($update);
			
			if($update_consult):
				return 'success';
			else:
				return 'error';
			endif;

		else:
			return 'error';
		endif;
	}

	public function drop_doctor_call(Request $request)
	{
		$new_call_timer = $doctor_call_duration = '00:00:00';

		$consult_id = $request->input('consult_id');
		
		if( $consult_id != '' || $consult_id != null ):
			
			$obj_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->first();
			if($obj_consult):
				$arr_consult = $obj_consult->toArray();

				$doctor_call_duration = $arr_consult['doctor_call_duration'];
			endif;

			$call_timer = $request->input('call_timer','00:00:00');

			if( strtotime($doctor_call_duration) > strtotime($call_timer) ):
				$new_call_timer = $doctor_call_duration;
			else:
				$new_call_timer = $call_timer;
			endif;

			$update['doctor_video']         = "0";
			$update['patient_video']        = "0";
			$update['doctor_call_duration'] = $new_call_timer;
			$update_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->update($update);
			
			if($update_consult):
				return 'success';
			else:
				return 'error';
			endif;
		else:
			return 'error';
		endif;
	}

	public function update_doctor_call_duration(Request $request)
	{
		$arr_data['call_status'] = 'call_end';
		$new_call_timer = $doctor_call_duration = '00:00:00';
		
		$consult_id = $request->input('consult_id');

		$check_call_status = $this->ConsultationModel->where('consultation_id', $consult_id)->first();
		if($check_call_status):
			$check_call_going = $check_call_status->toArray();
			
			if( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '1' ):
				$arr_data['call_status'] = 'ongoing';
			elseif( $check_call_going['doctor_video'] == '0' && $check_call_going['patient_video'] == '0' ):
				$arr_data['call_status'] = 'waiting_for_call_to_connect';
			elseif( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '0' ):
				$arr_data['call_status'] = 'waiting_for_patient';
			elseif( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '2' ):
				$arr_data['call_status'] = 'reject_by_patient';
			endif;

			$doctor_call_duration = $check_call_going['doctor_call_duration'];

		endif;

		$call_timer = $request->input('call_timer','00:00:00');

		if( strtotime($doctor_call_duration) > strtotime($call_timer) ):
			$new_call_timer = $doctor_call_duration;
		else:
			$new_call_timer = $call_timer;
		endif;
		
		$update['doctor_call_duration'] = $new_call_timer;
		$update_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->update($update);
		
		if($update_consult):
			$arr_data['status'] = 'success';
		else:
			$arr_data['status'] = 'error';
		endif;

		return $arr_data;
	}

	/*----------------------Video Calling Function Ends----------------------*/


	public function generate_invoice(Request $request)
	{
		$id = $request->input('id');

		$obj_consultation = $this->ConsultationModel->where('id', $id)
													->where('doctor_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'upcoming')
													->orderBy('id','desc')
													->with(['user_details' => function($query){
														$query->select('id','first_name','last_name');
													}])
													->with('transaction','subscription_plan')
													->first();

		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();

			dd( $arr_consultation );
		endif;
	}

}
