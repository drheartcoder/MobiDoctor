<?php

namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

use App\Common\Services\AdminNotificationService;

use App\Models\StripeSettingsModel;
use App\Models\DoctorDetailsModel;
use App\Models\LanguageModel;
use App\Models\TimezoneModel;
use App\Models\PrefixModel;
use App\Models\UserModel;

use Validator;
use Sentinel;
use Session;

class MyAccountController extends Controller
{

	public function __construct(AdminNotificationService $admin_notification_service)
	{
        $this->UserModel                = new UserModel();
        $this->PrefixModel              = new PrefixModel();
        $this->TimezoneModel            = new TimezoneModel();
        $this->DoctorDetailsModel       = new DoctorDetailsModel();
        $this->LanguageModel            = new LanguageModel();
        $this->StripeSettingsModel      = new StripeSettingsModel();
        $this->AdminNotificationService = $admin_notification_service;

        $this->arr_view_data            = [];
        $this->module_title             = "My Account";
        $this->parent_url_path          = url('/').'/doctor';
        $this->module_url_path          = url('/').'/doctor/my_account';
        $this->module_view_folder       = "front.doctor.my_account";

        $this->breadcrum_level_1        = 'Dashboard';
        $this->breadcrum_level_2        = $this->module_title;

        $this->breadcrum_level_1_url    = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url    = $this->module_url_path;

        $this->doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        $this->doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');
        $this->default_img_path         = url('/').config('app.img_path.default_img_path');

        $this->driving_base_path        = base_path().config('app.img_path.driving_licence');
        $this->driving_public_path      = url('/').config('app.img_path.driving_licence');

        $this->medical_reg_base_path    = base_path().config('app.img_path.medical_registration');
        $this->medical_reg_public_path  = url('/').config('app.img_path.medical_registration');
        
        $user                        = Sentinel::check();

        if($user):
            $this->user_id         = isset($user->id)?$user->id:'0';
            $this->user_first_name = isset($user->first_name)?$user->first_name:'';
            $this->user_last_name  = isset($user->last_name)?$user->last_name:'';
            $this->user_email      = isset($user->email)?$user->email:'';
            $this->user_phone_code = isset($user->phone_code)?$user->phone_code:'';
            $this->user_mobile_no  = isset($user->mobile_no)?$user->mobile_no:'';
            $this->prefix          = isset($user->prefix)?$user->prefix:'0';
        endif;
	}

    /*---------------------Change Password-------------------------------------*/
   	public function change_password()
    {
    	$this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
		$this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
		$this->arr_view_data['breadcrum_level_3']     = 'Change Password';

		$this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
		$this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/change_password';

        $this->arr_view_data['page_title']      = 'Change Password';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;

    	return view($this->module_view_folder.'.change_password', $this->arr_view_data);
    }

    public function update_change_password(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['old_password']     = 'required';
        $arr_rules['new_password']     = 'required';
        $arr_rules['confirm_password'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';
            return response()->json($return_arr);
        }

        $old_password     = trim($request->input('old_password'));
        $new_password     = trim($request->input('new_password'));
        $confirm_password = trim($request->input('confirm_password'));

        $user = Sentinel::check();

        $credentials = [];
        $credentials['password'] = $old_password;

        if (Sentinel::validateCredentials($user,$credentials)) 
        { 
            $new_credentials = [];
            $new_credentials['password'] = $new_password;

            if(Sentinel::update($user,$new_credentials))
            {
                Session::flash('success','Password Change Successfully.');
                Sentinel::logout();
                return response()->json($return_arr);
            }
            else
            {
                Session::flash('error','Problem Occurred, While Changing Password.');
                return response()->json($return_arr);

            }
        } 
        else
        {
            Session::flash('error','Invalid Old Password.');
            return response()->json($return_arr);
        }       
    }
    /*-------------------------------------------------------------------*/

    /*---------------------About Me-------------------------------------*/
    public function about_me()
    {
        $arr_doctor = $arr_prefix = $arr_timezone = [];
        $obj_doctor = $this->UserModel->where('id','=',$this->user_id)->first();
        if($obj_doctor)
        {
            $arr_doctor = $obj_doctor->toArray();
        }

        $obj_prefix = $this->PrefixModel->get();
        if($obj_prefix)
        {
            $arr_prefix = $obj_prefix->toArray();
        }

        $obj_timezone = $this->TimezoneModel->get();
        if($obj_timezone)
        {
            $arr_timezone = $obj_timezone->toArray();
        }

        $this->arr_view_data['arr_doctor']                = $arr_doctor;
        $this->arr_view_data['arr_prefix']                = $arr_prefix;
        $this->arr_view_data['arr_timezone']              = $arr_timezone;
        $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'About Me';
        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/about_me';
        $this->arr_view_data['page_title']                = 'About Me';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
        $this->arr_view_data['profile_image_base_path']   = $this->doctor_image_base_path;
        $this->arr_view_data['profile_image_public_path'] = $this->doctor_image_public_path;
        $this->arr_view_data['default_img_path']          = $this->default_img_path;

        return view($this->module_view_folder.'.about_me', $this->arr_view_data);
    }

    public function update_about_me(Request $request)
    {
        $fileName = '';
        $arr_rules  = $return_arr = [];

        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';
        $arr_rules['address']    = 'required';
        $arr_rules['country']    = 'required';
        $arr_rules['city']       = 'required';
        $arr_rules['prefix']     = 'required';
        $arr_rules['timezone']   = 'required';
        $arr_rules['birth_date'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $arr_data['first_name']    = encrypt_value(trim($request->input('first_name', null)));
        $arr_data['last_name']     = encrypt_value(trim($request->input('last_name', null)));
        $arr_data['address']       = encrypt_value(trim($request->input('address', null)));
        $arr_data['city']          = encrypt_value(trim($request->input('city', null)));
        $arr_data['country']       = encrypt_value(trim($request->input('country', null)));
        $arr_data['state']         = encrypt_value(trim($request->input('state', null)));
        $arr_data['postal_code']   = encrypt_value(trim($request->input('postal_code', null)));
        $arr_data['latitude']      = trim($request->input('lat', null));
        $arr_data['longitude']     = trim($request->input('lng', null));
        $arr_data['prefix']        = trim($request->input('prefix', null));
        $arr_data['timezone']      = trim($request->input('timezone', null));
        $arr_data['date_of_birth'] = trim(date('Y-m-d',strtotime($request->input('birth_date'))));
        $arr_data['contact_no']    = trim($request->input('contact_no', null));

        $obj_doctor = $this->UserModel->where('id','=',$this->user_id)->first();

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
                $upload                    = $profile_image->move($this->doctor_image_base_path,$enc_profile_image);

                $arr_data['profile_image'] = $enc_profile_image;
                if($upload)
                {
                    if(isset($obj_doctor->profile_image) && $obj_doctor->profile_image!=null)
                    {
                        $profile_image = $this->doctor_image_base_path.'/'.$obj_doctor->profile_image;
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

        $status = $this->UserModel->where('id','=',$this->user_id)->update($arr_data);
        if($status)
        {
            Session::flash('success','Details updated succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while update details, Please try again.');
            return response()->json($return_arr);
        }
    }
    /*-----------------------------------------------------------------*/

    /*-------------------Medical Practice-------------------------------*/
    public function medical_practice()
    {
        $arr_language = $arr_doctor_details = [];
        $obj_language = $this->LanguageModel->where('status','=','1')->orderBy('language','asc')->get();
        if($obj_language)
        {
            $arr_language = $obj_language->toArray();
        }

        $obj_doctor_details = $this->DoctorDetailsModel->select('clinic_name','clinic_address','clinic_email','clinic_phone_code','clinic_mobile_no','clinic_contact_no','experience','language')->where('user_id','=',$this->user_id)->first();
        if($obj_doctor_details)
        {
            $arr_doctor_details = $obj_doctor_details->toArray();
        }

        $this->arr_view_data['arr_doctor_details']    = $arr_doctor_details;
        $this->arr_view_data['arr_language']          = $arr_language;
        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Medical Practice';

        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/medical_practice';

        $this->arr_view_data['page_title']      = 'Medical Practice';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;

        return view($this->module_view_folder.'.medical_practice', $this->arr_view_data);
    }

    public function update_medical_practice(Request $request)
    {
        $arr_rules  = $return_arr = [];

        $arr_rules['clinic_name']    = 'required';
        $arr_rules['clinic_address'] = 'required';
        $arr_rules['experience']     = 'required';
        $arr_rules['language']       = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $arr_data['clinic_name']        = trim($request->input('clinic_name'));
        $arr_data['clinic_address']     = trim($request->input('clinic_address'));
        $arr_data['clinic_city']        = trim($request->input('clinic_city',null));
        $arr_data['clinic_country']     = trim($request->input('clinic_country',null));
        $arr_data['clinic_postal_code'] = trim($request->input('clinic_postal_code',null));
        $arr_data['clinic_lat']         = trim($request->input('clinic_lat',null));
        $arr_data['clinic_lng']         = trim($request->input('clinic_lng',null));
        $arr_data['clinic_email']       = trim($request->input('clinic_email',null));
        $arr_data['clinic_phone_code']  = trim($request->input('clinic_phone_code',null));
        $arr_data['clinic_mobile_no']   = trim($request->input('clinic_mobile_no',null));
        $arr_data['clinic_contact_no']  = trim($request->input('clinic_contact_no',null));
        $arr_data['experience']         = trim($request->input('experience',null));
        $arr_data['language']         = json_encode($request->input('language'));

        $is_update = $request->input('is_update');
        if(isset($is_update) && $is_update!='' && $is_update == 1)
        {
            $arr_data['admin_verified'] = '0';
        }

        $is_exist = $this->DoctorDetailsModel->where('user_id','=',$this->user_id);
        if($is_exist->count() > 0)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {
                $arr_notification['from_user_id']     = $this->user_id;
                $arr_notification['message']          = get_prefix_name($this->user_id).' '.decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name).', updated his medical practice details.';
                $arr_notification['notification_url'] = '/admin/doctor/view/'.base64_encode($this->user_id);

                $this->AdminNotificationService->create_admin_notification($arr_notification);
            }
            $status = $is_exist->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $this->user_id;
            $status = $this->DoctorDetailsModel->create($arr_data);
        }

        if($status)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {

                Session::flash('success','Medical Practice details saved succssfully. Some important information is also updated which will required to verification. Till the time admin verification is completed your account will be deactivated.');
            }
            else
            {
                Session::flash('success','Medical Practice details saved succssfully');
            }
        }
        else
        {
            Session::flash('error','Something went wrong while saved details, Please try again.');
        }

        //Session::flash('success','Medical Practice details saved succssfully. Some important information is also updated which will required to verification. Till the time admin verification is completed your account will be deactivated.');

        return response()->json($return_arr);
    }
    /*-----------------------------------------------------------------*/

    /*--------------------Medical Qualification------------------------*/
    public function medical_qualifications()
    {
        $arr_doctor_details = [];
        $obj_doctor_details = $this->DoctorDetailsModel->select('medical_qualification','medical_school','year_obtained','country_obtained','other_qualifications')->where('user_id','=',$this->user_id)->first();
        if($obj_doctor_details)
        {
            $arr_doctor_details = $obj_doctor_details->toArray();
        }

        $this->arr_view_data['arr_doctor_details']    = $arr_doctor_details;

        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Medical Qualifications';

        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/medical_qualifications';

        $this->arr_view_data['page_title']      = 'Medical Qualifications';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;

        return view($this->module_view_folder.'.medical_qualifications', $this->arr_view_data);
    }

    public function update_medical_qualifications(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['medical_qualification'] = 'required';
        $arr_rules['medical_school']        = 'required';
        $arr_rules['year_obtained']         = 'required';
        $arr_rules['country_obtained']      = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $arr_data['medical_qualification'] = trim($request->input('medical_qualification',null));
        $arr_data['medical_school']        = trim($request->input('medical_school',null));
        $arr_data['year_obtained']         = trim($request->input('year_obtained',null));
        $arr_data['country_obtained']      = trim($request->input('country_obtained',null));
        $arr_data['other_qualifications']  = trim($request->input('other_qualifications',null));
        $is_update = $request->input('is_update');
        if(isset($is_update) && $is_update!='' && $is_update == '1')
        {
            $arr_data['admin_verified'] = '0';
        }

        $is_exist = $this->DoctorDetailsModel->where('user_id','=',$this->user_id);
        if($is_exist->count() > 0)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {
                $arr_notification['from_user_id']     = $this->user_id;
                $arr_notification['message']          = get_prefix_name($this->user_id).' '.decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name).', updated his medical qualifications details.';
                $arr_notification['notification_url'] = '/admin/doctor/view/'.base64_encode($this->user_id);

                $this->AdminNotificationService->create_admin_notification($arr_notification);
            }

            $status = $is_exist->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $this->user_id;
            $status = $this->DoctorDetailsModel->create($arr_data);
        }

        if($status)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {
                Session::flash('success','Medical Qualifications details saved succssfully. Some important information is also updated which will required to verification. Till the time admin verification is completed your account will be deactivated.');
            }
            else
            {
                 Session::flash('success','Medical Qualifications details saved succssfully.');
            }
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while saved details, Please try again.');
            return response()->json($return_arr);
        }
    }
    /*-----------------------------------------------------------------*/

    /*--------------------Document & Verification-----------------------*/
    public function document_verification()
    {
        $arr_doctor_details = [];
        $obj_doctor_details = $this->DoctorDetailsModel->select('medicare_provider_no','prescriber_no','ahpra_registration_no','driving_licence','medical_registration')
                                                       ->where('user_id','=',$this->user_id)
                                                       ->first();
        if($obj_doctor_details)
        {
            $arr_doctor_details = $obj_doctor_details->toArray();
        }

        $this->arr_view_data['driving_base_path']         = $this->driving_base_path;
        $this->arr_view_data['driving_public_path']       = $this->driving_public_path;
        $this->arr_view_data['medical_reg_base_path']     = $this->medical_reg_base_path;
        $this->arr_view_data['medical_reg_public_path']   = $this->medical_reg_public_path;

        $this->arr_view_data['arr_doctor_details']      = $arr_doctor_details;

        $this->arr_view_data['breadcrum_level_1']       = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']       = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']       = 'Document & Verification';

        $this->arr_view_data['breadcrum_level_1_url']   = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']   = $this->breadcrum_level_2_url.'/document_verification';

        $this->arr_view_data['page_title']              = 'Document & Verification';
        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        return view($this->module_view_folder.'.document', $this->arr_view_data);
    }

    public function update_document_verification(Request $request)
    {
        $arr_rules = $return_arr = [];
        $driving_licence_name = $medical_reg_name = '';

        $arr_rules['medicare_provider_no']  = 'required';
        $arr_rules['prescriber_no']         = 'required';
        $arr_rules['ahpra_registration_no'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        // upload driving licence
        if($request->hasFile('file_driving_licence'))
        {
            $driving_licence = $request->file('file_driving_licence');

            if(isset($driving_licence) && sizeof($driving_licence)>0)
            {
                $extention = strtolower($driving_licence->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of Driving Licence or Passport. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($driving_licence->getClientSize() > 5000000)
                {
                    Session::flash('error','Driving Licence or Passport file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                    
                    $driving_licence_name   = $request->file('file_driving_licence');
                    $driving_licence_ext    = strtolower($request->file('file_driving_licence')->getClientOriginalExtension());
                    $driving_licence_name   = uniqid().'.'.$driving_licence_ext;
                    $driving_licence_result = $request->file('file_driving_licence')->move($this->driving_base_path, $driving_licence_name);
                    if($driving_licence_result)
                    {
                        @unlink($this->driving_base_path.'/'.$request->input('old_file_driving_licence'));
                    }
                    $arr_data['admin_verified'] = '0';
                }

                $arr_data['driving_licence']       = isset($driving_licence_name) && !empty($driving_licence_name) ? encrypt_value($driving_licence_name) : '';
            }
            else
            {
                Session::flash('error','Invalid file of Driving Licence. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        // upload medical registration certificate
        if($request->hasFile('file_medical_registration'))
        {
            $medical_reg = $request->file('file_medical_registration');

            if(isset($medical_reg) && sizeof($medical_reg)>0)
            {
                $extention = strtolower($medical_reg->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of Medical Registration Certificate. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($medical_reg->getClientSize() > 5000000)
                {
                    Session::flash('error','Medical Registration Certificate file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                   

                    $medical_reg_name   = $request->file('file_medical_registration');
                    $medical_reg_ext    = strtolower($request->file('file_medical_registration')->getClientOriginalExtension());
                    $medical_reg_name   = uniqid().'.'.$medical_reg_ext;
                    $medical_reg_result = $request->file('file_medical_registration')->move($this->medical_reg_base_path, $medical_reg_name);
                    if($medical_reg_result)
                    {
                        @unlink($this->medical_reg_base_path.'/'.$request->input('old_file_medical_registration'));
                    }
                    $arr_data['admin_verified'] = '0';
                }

                $arr_data['medical_registration']  = isset($medical_reg_name) && !empty($medical_reg_name) ? encrypt_value($medical_reg_name) : '';
            }
            else
            {
                Session::flash('error','Invalid file of Medical Registration Certificate. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        $arr_data['medicare_provider_no']  = trim($request->input('medicare_provider_no'));
        $arr_data['prescriber_no']         = trim($request->input('prescriber_no'));
        $arr_data['ahpra_registration_no'] = trim($request->input('ahpra_registration_no'));

        $is_update = $request->input('is_update');
        if(isset($is_update) && $is_update!='' && $is_update == '1')
        {
            $arr_data['admin_verified'] = '0';
        }

        $is_exist = $this->DoctorDetailsModel->where('user_id','=',$this->user_id);
        if($is_exist->count() > 0)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {
                $arr_notification['from_user_id']     = $this->user_id;
                $arr_notification['message']          = get_prefix_name($this->user_id).' '.decrypt_value($this->user_first_name).' '.decrypt_value($this->user_last_name).', updated his Document & Verification details.';
                $arr_notification['notification_url'] = '/admin/doctor/view/'.base64_encode($this->user_id);

                $this->AdminNotificationService->create_admin_notification($arr_notification);
            }

            $status = $is_exist->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $this->user_id;
            $status = $this->DoctorDetailsModel->create($arr_data);
        }

        if($status)
        {
            if(isset($is_update) && $is_update!='' && $is_update == 1)
            {
                Session::flash('success','Document & Verification details saved succssfully. Some important information is also updated which will required to verification. Till the time admin verification is completed your account will be deactivated.');
            }
            else
            {
                Session::flash('success','Document & Verification details saved succssfully.');
            }
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while saved details, Please try again.');
            return response()->json($return_arr);
        } 
    }

    /*-------------------Card Details----------------------------------*/
    public function bank_details()
    {
        $arr_doctor_details = $arr_stripe = [];

        $obj_doctor_details = $this->DoctorDetailsModel->select('bank_name','bank_account_name','bank_account_no')->where('user_id','=',$this->user_id)->first();
        if($obj_doctor_details)
        {
            $arr_doctor_details = $obj_doctor_details->toArray();
        }

        $obj_stripe = $this->StripeSettingsModel->where('id',1)->first();
        if( $obj_stripe ):
            $arr_stripe = $obj_stripe->toArray();
        endif;

        $this->arr_view_data['arr_doctor_details']    = $arr_doctor_details;
        $this->arr_view_data['arr_stripe']            = $arr_stripe;

        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Bank Details';

        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/bank_details';

        $this->arr_view_data['page_title']            = 'Bank Details';
        $this->arr_view_data['module_url_path']       = $this->module_url_path;

        return view($this->module_view_folder.'.bank_details', $this->arr_view_data);
    }

    public function edit_bank_details()
    {
        $arr_doctor_details = [];
        $obj_doctor_details = $this->DoctorDetailsModel->select('bank_name','bank_account_name','bank_account_no')->where('user_id','=',$this->user_id)->first();
        if($obj_doctor_details)
        {
            $arr_doctor_details = $obj_doctor_details->toArray();
        }

        $this->arr_view_data['arr_doctor_details']    = $arr_doctor_details;

        $this->arr_view_data['breadcrum_level_1']     = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']     = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']     = 'Bank Details';
        $this->arr_view_data['breadcrum_level_4']     = 'Bank Account Details';

        $this->arr_view_data['breadcrum_level_1_url'] = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url'] = $this->breadcrum_level_2_url.'/bank_details';
        $this->arr_view_data['breadcrum_level_4_url'] = $this->breadcrum_level_2_url.'/bank_details/edit';

        $this->arr_view_data['page_title']            = 'Bank Account Details';
        $this->arr_view_data['module_url_path']       = $this->module_url_path;

        return view($this->module_view_folder.'.edit_bank_details', $this->arr_view_data);
    }

    public function update_bank_details(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['bank_name']         = 'required';
        $arr_rules['bank_account_name'] = 'required';
        $arr_rules['bank_account_no']   = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $arr_data['bank_name']         = trim($request->input('bank_name'));
        $arr_data['bank_account_name'] = trim($request->input('bank_account_name'));
        $arr_data['bank_account_no']   = trim($request->input('bank_account_no'));

        $is_exist = $this->DoctorDetailsModel->where('user_id','=',$this->user_id);
        if($is_exist->count() > 0)
        {
            $status = $is_exist->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $this->user_id;
            $status = $this->DoctorDetailsModel->create($arr_data);
        }

        if($status)
        {
            Session::flash('success','Bank account details saved succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while saved details, Please try again.');
            return response()->json($return_arr);
        }
    }

    /*------------------------------------------------------------------*/
}
