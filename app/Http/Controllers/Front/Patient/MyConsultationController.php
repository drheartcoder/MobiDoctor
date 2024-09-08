<?php

namespace App\Http\Controllers\Front\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\ConsultationSettingModel;
use App\Models\ConsultationModel;
use App\Models\FamilyMemberModel;
use App\Models\CMSCategoryModel;
use App\Models\TimezoneModel;
use App\Models\RatingModel;

use Sentinel;
use Validator;
use Session;

class MyConsultationController extends Controller
{
    public function __construct()
	{
		$this->user_id = $this->user_first_name = $this->user_last_name = $this->user_timezone = '';

		$this->arr_view_data                 = [];
		$this->user_view_type                = 'list';
		$this->module_title                  = "My Consultation";
		$this->parent_url_path               = url('/').'/patient';
		$this->module_url_path               = url('/').'/patient/my_consultation';
		$this->module_view_folder            = "front.patient.my_consultation";
		$this->breadcrum_level_1             = 'Dashboard';
		$this->breadcrum_level_2             = $this->module_title;
		$this->breadcrum_level_1_url         = $this->parent_url_path.'/dashboard';
		$this->breadcrum_level_2_url         = $this->module_url_path;

		$this->ConsultationSettingModel      = new ConsultationSettingModel();
		$this->ConsultationModel             = new ConsultationModel();
		$this->FamilyMemberModel             = new FamilyMemberModel();
		$this->CMSCategoryModel              = new CMSCategoryModel();
		$this->TimezoneModel                 = new TimezoneModel();
		$this->RatingModel                   = new RatingModel();

		$this->prescription_file_base_path   = base_path().config('app.img_path.prescription_file');
		$this->prescription_file_public_path = url('/').config('app.img_path.prescription_file');
		$this->illness_img_base_path         = base_path().config('app.img_path.illness_img');
		$this->illness_img_public_path       = url('/').config('app.img_path.illness_img');
		$this->doctor_image_public_path      = url('/').config('app.img_path.doctor_profile_images');
		$this->doctor_image_base_path        = base_path().config('app.img_path.doctor_profile_images');
		$this->patient_image_public_path 	 = url('/').config('app.img_path.patient_profile_images');
		$this->patient_image_base_path   	 = base_path().config('app.img_path.patient_profile_images');
		$this->default_img_path              = url('/').config('app.img_path.default_img_path');

		$user                                = Sentinel::check();
		if($user)
		{   
			$this->user_id         = $user->id;
			$this->user_first_name = $user->first_name;
			$this->user_last_name  = $user->last_name;
			$this->user_timezone   = $user->timezone;
			$this->user_view_type  = $user->view_type;
		}
	}

	public function upcoming()
	{
		$arr_consultation = $paginate = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')
													->where('user_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'upcoming')
													->orderBy('id','desc')
													->with(['doctor_details' => function($query){
														$query->select('id','prefix','first_name','last_name','profile_image')
															  ->with('doctor_prefix');
													}])
													->paginate(12);
		if( $obj_consultation ):
			$paginate         = clone $obj_consultation;
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$this->arr_view_data['paginate']                 = $paginate;
		$this->arr_view_data['arr_consultation']         = $arr_consultation;
		$this->arr_view_data['user_view_type']           = $this->user_view_type;

		$this->arr_view_data['doctor_image_base_path']   = $this->doctor_image_base_path;
		$this->arr_view_data['doctor_image_public_path'] = $this->doctor_image_public_path;
		$this->arr_view_data['default_img_path']         = $this->default_img_path;

		$this->arr_view_data['breadcrum_level_1']        = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']        = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']        = 'Upcoming';

		$this->arr_view_data['breadcrum_level_1_url']    = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']    = $this->breadcrum_level_2_url.'/upcoming';

		$this->arr_view_data['page_title']               = 'Upcoming Consultation';

		return view($this->module_view_folder.'.upcoming', $this->arr_view_data);
	} // end upcoming

	public function completed()
	{ 
		$arr_consultation = $paginate = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')
													->where('user_id', $this->user_id)
													->where('is_completed', 1)
													->where('status', 'completed')
													->orderBy('id','desc')
													->with(['doctor_details' => function($query){
														$query->select('id','prefix','first_name','last_name','profile_image')
															  ->with('doctor_prefix');
													}])
													->paginate(12);
		if( $obj_consultation ):
			$paginate         = clone $obj_consultation;
			$arr_consultation = $obj_consultation->toArray();
		endif;
		
		$this->arr_view_data['paginate']                 = $paginate;
		$this->arr_view_data['arr_consultation']         = $arr_consultation;
		$this->arr_view_data['user_view_type']           = $this->user_view_type;

		$this->arr_view_data['doctor_image_base_path']   = $this->doctor_image_base_path;
		$this->arr_view_data['doctor_image_public_path'] = $this->doctor_image_public_path;
		$this->arr_view_data['default_img_path']         = $this->default_img_path;

		$this->arr_view_data['breadcrum_level_1']        = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']        = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']        = 'Completed';

		$this->arr_view_data['breadcrum_level_1_url']    = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']    = $this->breadcrum_level_2_url.'/completed';

		$this->arr_view_data['page_title']               = 'Completed Consultation';

		return view($this->module_view_folder.'.completed', $this->arr_view_data);
	}

	public function upcoming_details($enc_id = false)
	{
		if( $enc_id ):
			
			$arr_consultation = [];

			$obj_consultation = $this->ConsultationModel
												->select('id','consultation_id','user_id','doctor_id','who_is_patient','date','time','payment','illness','description','image','notes','is_completed','status')
												->with(['prescription_details' => function($query){
													$query->select('id','consult_id','name','repeats','direction');
												}])
												->where('id', base64_decode($enc_id))
												->where('user_id', $this->user_id)
												->where('is_completed', 1)
												->where('status', 'upcoming')
												->orderBy('id','desc')
												->with(['doctor_details' => function($query){
													$query->select('id','prefix','first_name','last_name');
												}])
												->with(['category_name' => function($query){
													$query->select('id','name');
												}])
												->first();
			if( $obj_consultation ):
				$arr_consultation = $obj_consultation->toArray();

				if( $arr_consultation['who_is_patient'] == 'family' ):
					$patient_id = isset($arr_consultation['patient_id'])?$arr_consultation['patient_id']:0;
					$obj_family = $this->FamilyMemberModel->select('id','user_id','first_name','last_name')
														  ->where('id', $patient_id)
														  ->where('user_id', $this->user_id)
														  ->first();
					if( $obj_family ):
						$arr_family = $obj_family->toArray();
						$arr_consultation['patient_name'] = decrypt_value($arr_family['first_name']).' '.decrypt_value($arr_family['last_name']);
					endif;
				else:
					$arr_consultation['patient_name'] = decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name);
				endif;
			else:
				return redirect( url('/').'/patient/my_consultation/upcoming' );
			endif;

			$this->arr_view_data['arr_consultation']              = $arr_consultation;
			$this->arr_view_data['breadcrum_level_1']             = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']             = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']             = 'Upcoming';
			$this->arr_view_data['breadcrum_level_4']             = 'Details';
			$this->arr_view_data['illness_img_base_path']         = $this->illness_img_base_path;
			$this->arr_view_data['illness_img_public_path']       = $this->illness_img_public_path;
			$this->arr_view_data['prescription_file_base_path']   = $this->prescription_file_base_path;
			$this->arr_view_data['prescription_file_public_path'] = $this->prescription_file_public_path;
			$this->arr_view_data['breadcrum_level_1_url'] 	      = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_3_url'] 	      = $this->breadcrum_level_2_url.'/upcoming';
			$this->arr_view_data['page_title']                    = 'Consultation Details';

			$this->arr_view_data['current_url_path']        = $this->module_url_path.'/upcoming/'.$enc_id;

			
			return view($this->module_view_folder.'.upcoming_details', $this->arr_view_data);

		else:
			return redirect( url('/').'/patient/my_consultation/upcoming' );

		endif;
	}

	public function completed_details($enc_id = false)
	{
		if( $enc_id ):

			$arr_consultation = [];
			$obj_consultation = $this->ConsultationModel
												->select('id','consultation_id','user_id','doctor_id','who_is_patient','date','time','payment','illness','description','image','notes','is_completed','status')
												->with(['prescription_details' => function($query){
													$query->select('id','consult_id','name','repeats','direction');
												}])
												->where('id', base64_decode($enc_id))
												->where('user_id', $this->user_id)
												->where('is_completed', 1)
												->where('status', 'completed')
												->orderBy('id','desc')
												->with(['doctor_details' => function($query){
													$query->select('id','prefix','first_name','last_name');
												}])
												->with(['category_name' => function($query){
													$query->select('id','name');
												}])
												->first();
			if( $obj_consultation ):
				
				$arr_consultation = $obj_consultation->toArray();
				
				if( $arr_consultation['who_is_patient'] == 'family' ):
					
					$patient_id = isset($arr_consultation['patient_id'])?$arr_consultation['patient_id']:0;
					$obj_family = $this->FamilyMemberModel->select('id','user_id','first_name','last_name')
														  ->where('id', $patient_id)
														  ->where('user_id', $this->user_id)
														  ->first();
					if( $obj_family ):
						$arr_family = $obj_family->toArray();
						$arr_consultation['patient_name'] = decrypt_value($arr_family['first_name']).' '.decrypt_value($arr_family['last_name']);
					endif;
				else:
					$arr_consultation['patient_name'] = decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name);
				endif;
			else:
				return redirect( url('/').'/patient/my_consultation/completed' );
			endif;
			
			$this->arr_view_data['arr_consultation']              = $arr_consultation;
			$this->arr_view_data['breadcrum_level_1']             = $this->breadcrum_level_1;
			$this->arr_view_data['breadcrum_level_2']             = $this->breadcrum_level_2;
			$this->arr_view_data['breadcrum_level_3']             = 'Completed';
			$this->arr_view_data['breadcrum_level_4']             = 'Details';
			$this->arr_view_data['illness_img_base_path']         = $this->illness_img_base_path;
			$this->arr_view_data['illness_img_public_path']       = $this->illness_img_public_path;
			$this->arr_view_data['prescription_file_base_path']   = $this->prescription_file_base_path;
			$this->arr_view_data['prescription_file_public_path'] = $this->prescription_file_public_path;
			$this->arr_view_data['breadcrum_level_1_url'] 	      = $this->breadcrum_level_1_url;
			$this->arr_view_data['breadcrum_level_3_url'] 	      = $this->breadcrum_level_2_url.'/completed';
			$this->arr_view_data['page_title']                    = 'Consultation Details';

			$this->arr_view_data['current_url_path']        = $this->module_url_path.'/completed/'.$enc_id;

			return view($this->module_view_folder.'.completed_details', $this->arr_view_data);
		else:
			return redirect( url('/').'/patient/my_consultation/completed' );

		endif;
	}

	public function online_waiting_room($enc_id)
	{
		$arr_consultation = $arr_consultationsetting = $arr_timezone = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status')
													->where('id', base64_decode($enc_id) )
													->where('user_id', $this->user_id)
													->where('is_completed', 1)
													->with(['doctor_details' => function($query) {
														$query->select('id','prefix','first_name','last_name','profile_image')
															  ->with('doctor_prefix');
													}])
													->first();
		if( $obj_consultation ):
			$arr_consultation = $obj_consultation->toArray();
		endif;

		$obj_consultationsetting = $this->ConsultationSettingModel->where('id', 1)->select('reschedule')->first();
		if($obj_consultationsetting):
			$arr_consultationsetting = $obj_consultationsetting->toArray();
		endif;

		$obj_timezone = $this->TimezoneModel->where('id', $this->user_timezone)->first();
		if( $obj_timezone ):
			$arr_timezone = $obj_timezone->toArray();
		endif;

		$this->arr_view_data['arr_timezone']            = $arr_timezone;
		$this->arr_view_data['arr_consultation']        = $arr_consultation;
		$this->arr_view_data['arr_consultationsetting'] = $arr_consultationsetting;

		$this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']       = 'Upcoming';
		$this->arr_view_data['breadcrum_level_4']       = 'Online Waiting Room';

		$this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url']   = $this->breadcrum_level_2_url.'/upcoming';

		$this->arr_view_data['page_title']              = 'Online Waiting Room';

		return view($this->module_view_folder.'.online_waiting_room', $this->arr_view_data);
	} // end online_waiting_room

	public function video(Request $request,$enc_id = false)
	{
		$accept_call = $request->input('type');
		
		$arr_consultation = [];

		$obj_consultation = $this->ConsultationModel->select('id','consultation_id','user_id','doctor_id','date','time','payment','is_completed','status','patient_call_duration')
													->where('id', base64_decode($enc_id))
													->where('user_id', $this->user_id)
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

		if( $accept_call != null || $accept_call != ''):
			$update['patient_video'] = "1";
		    $update_consult = $this->ConsultationModel->where('id', base64_decode($enc_id))->update($update);	
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

	public function is_patient_get_call(Request $request)
	{
		$check_doctor_calling = $this->ConsultationModel->where('user_id', $this->user_id)
														->where('doctor_video','1')
														->where('patient_video','0')
														->first();
		if($check_doctor_calling):
			$is_doctor_calling  = $check_doctor_calling->doctor_video;

			$arr_data['url']        = url('/')."/patient/my_consultation/upcoming/".base64_encode($check_doctor_calling->id)."/video?type=accept_call";
			$arr_data['id']         = $check_doctor_calling->id;
			$arr_data['consult_id'] = $check_doctor_calling->consultation_id;
			$arr_data['status']     = 'success';
		else:
			$arr_data['url']        = "";
			$arr_data['id']         = "";
			$arr_data['consult_id'] = "";
			$arr_data['status']     = 'error';
		endif;

		return $arr_data;
	}

	public function patient_call_reject(Request $request)
	{
		$consult_id = $request->input('consult_id');

		if( $consult_id != '' || $consult_id != null ):
			$update['patient_video'] = "2";
			$update_consult = $this->ConsultationModel->where('consultation_id',$consult_id)->update($update);
		endif;

		return 'success';
	}

	public function initiate_patient_call(Request $request)
	{
		$consult_id = $request->input('consult_id');
		
		$busy_count = $this->ConsultationModel->where('consultation_id','!=',$consult_id)
											  ->where('user_id',$this->user_id)
											  ->where('patient_video','1')
											  ->count();
		if($busy_count > 0 ):
			return 'busy';
		endif;

		if( $consult_id != '' || $consult_id != null ):
			
			$update['patient_video'] = "1";
			$update_consult = $this->ConsultationModel->where('consultation_id',$consult_id)->update($update);
			
			if($update_consult):
				return 'success';
			else:
				return 'error';
			endif;

		else:
			return 'error';
		endif;
	}

	public function drop_patient_call(Request $request)
	{
		$new_call_timer = $patient_call_duration = '00:00:00';

		$consult_id = $request->input('consult_id');

		if($consult_id != '' || $consult_id != null):

			$obj_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->first();
			if($obj_consult):
				$arr_consult = $obj_consult->toArray();

				$patient_call_duration = $arr_consult['patient_call_duration'];
			endif;

			$call_timer = $request->input('call_timer','00:00:00');

			if( strtotime($patient_call_duration) > strtotime($call_timer) ):
				$new_call_timer = $patient_call_duration;
			else:
				$new_call_timer = $call_timer;
			endif;

			$update['patient_video']         = "0";
			$update['doctor_video']          = "0";
			$update['patient_call_duration'] = $new_call_timer;
			$update_consult = $this->ConsultationModel->where('consultation_id',$consult_id)->update($update);

			if($update_consult):
				return 'success';
			else:
				return 'error';
			endif;
		else:
			return 'error';
		endif;
	}

	public function update_patient_call_duration(Request $request)
	{
		$arr_data['call_status'] = 'call_end';
		$new_call_timer = $patient_call_duration = '00:00:00';

		$consult_id = $request->input('consult_id');
		
		$check_call_status = $this->ConsultationModel->where('consultation_id', $consult_id)->first();
		if($check_call_status):
			$check_call_going = $check_call_status->toArray();

			if( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '1' ):
				$arr_data['call_status'] = 'ongoing';
			elseif( $check_call_going['doctor_video'] == '0' && $check_call_going['patient_video'] == '0' ):
				$arr_data['call_status'] = 'waiting_for_call_to_connect';
			elseif( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '0' ):
				$arr_data['call_status'] = 'waiting_for_doctor';
			elseif( $check_call_going['doctor_video'] == '1' && $check_call_going['patient_video'] == '2' ):
				$arr_data['call_status'] = 'reject_by_doctor';
			endif;

			$patient_call_duration = $check_call_going['patient_call_duration'];

		endif;

		$call_timer = $request->input('call_timer','00:00:00');

		if( strtotime($patient_call_duration) > strtotime($call_timer) ):
			$new_call_timer = $patient_call_duration;
		else:
			$new_call_timer = $call_timer;
		endif;

		$update['patient_call_duration'] = $new_call_timer;
		$update_consult = $this->ConsultationModel->where('consultation_id', $consult_id)->update($update);

		if($update_consult):
			$arr_data['status'] = 'success';
		else:
			$arr_data['status'] = 'error';
		endif;

		return $arr_data;
	}

	public function feedback_review($enc_id)
	{
		$arr_rating = [];
		$consult_id = base64_decode($enc_id);
		$obj_rating = $this->RatingModel->where('consult_id',$consult_id)->first();
		if($obj_rating)
		{
			$arr_rating = $obj_rating->toArray();
		}
		
		$this->arr_view_data['arr_rating']   	= $arr_rating;
		$this->arr_view_data['module_url_path']   	= $this->module_url_path;
		$this->arr_view_data['enc_id']   			= $enc_id;

		return view($this->module_view_folder.'.feedback_review', $this->arr_view_data);
	}

	public function store_feedback_review(Request $request)
	{
		$arr_rules = $return_arr = [];
		$arr_rules['feedback']   = 'required';
        $arr_rules['rates']   	= 'required';
        $arr_rules['enc_id']   	= 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';

            return response()->json($return_arr);
        }

        $consult_id = base64_decode($request->input('enc_id'));

        $obj_consultant_data = $this->ConsultationModel->select('id','user_id','doctor_id')->where('id',$consult_id)->first();

        $arr_data['feedback'] = trim($request->input('feedback'));
        $arr_data['rating']   = trim($request->input('rates'));
        $arr_data['user_id']   = isset($obj_consultant_data->user_id)?$obj_consultant_data->user_id:'0';
        $arr_data['doctor_id']   = isset($obj_consultant_data->doctor_id)?$obj_consultant_data->doctor_id:'0';
        $arr_data['status']   = '0';

        $status = $this->RatingModel->updateOrCreate(['consult_id'=>$consult_id],$arr_data);
        if($status)
        {
            Session::flash('success','Feedback saved succssfully');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occur,while giving feedback.');
            return response()->json($return_arr);
        }

	}
}
