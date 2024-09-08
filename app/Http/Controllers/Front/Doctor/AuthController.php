<?php

namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\AdminNotificationService;
use App\Common\Services\UserNotificationService;
use App\Common\Services\VirgilService;
use App\Common\Services\EmailService;
use App\Common\Services\SMSService;

use App\Models\UserModel;

use Activation;       
use Validator;       
use Response;       
use Sentinel;       
use Session;       
use Flash;       
use Email;       

class AuthController extends Controller
{
    public function __construct(
                                    AdminNotificationService $admin_notification_service,
                                    UserNotificationService $user_notification_service,
                                    VirgilService            $virgil_service,
                                    EmailService             $email_service,
                                    SMSService               $sms_service
                                )
    {
        $this->arr_view_data            = [];
        $this->module_view_folder       = 'front.doctor';

        $this->AdminNotificationService = $admin_notification_service;
        $this->UserNotificationService  = $user_notification_service;
        $this->VirgilService            = $virgil_service;
        $this->EmailService             = $email_service;
        $this->SMSService               = $sms_service;

        $this->UserModel                = new UserModel();
    }


    public function signup()
    {
        $this->arr_view_data['page_title'] = 'Doctor Signup | '.config('app.project.name');
        return view($this->module_view_folder.'.signup')->with($this->arr_view_data);
    }


    /*
    | Function  : Store doctor signup data
    | Author    : Deepak Arvind Salunke
    | Date      : 10/01/2018
    | Output    : Success or Error
    */

    public function signup_store(Request $request)
    {
        $arr_rules                       = [];
        $arr_rules['first_name']         = 'required';
        $arr_rules['last_name']          = 'required';
        $arr_rules['email']              = 'required';
        $arr_rules['phone_code']         = 'required';
        $arr_rules['mobile_no']          = 'required';
        $arr_rules['password']           = 'required';
        $arr_rules['confirm_password']   = 'required';
        $arr_rules['address']            = 'required';
        $arr_rules['gender']             = 'required';
        $arr_rules['virgil_private_key'] = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please check your browser javascript setting to allow our website form access. Currently it is denied.';

            return response()->json($return_arr);
    	}

        /* Virgil security */
        // create Virgil api
        $virgilApi = $this->VirgilService->clientToken();
        $userCards = $virgilApi->Cards->get( Session::get('cardId') );

        $arr_data['user_type']    = 'doctor';
        $arr_data['first_name']   = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']    = encrypt_value(trim($request->input('last_name')));
        $arr_data['email']        = trim($request->input('email'));
        $arr_data['password']     = trim($request->input('password'));
        $arr_data['phone_code']   = trim($request->input('phone_code'));
        $arr_data['mobile_no']    = trim($request->input('mobile_no'));
        $arr_data['gender']       = trim($request->input('gender'));
        $arr_data['address']      = encrypt_value(trim($request->input('address', null)));
        $arr_data['city']         = encrypt_value(trim($request->input('city', null)));
        $arr_data['state']        = encrypt_value(trim($request->input('state', null)));
        $arr_data['country']      = encrypt_value(trim($request->input('country', null)));
        $arr_data['latitude']     = trim($request->input('latitude', null));
        $arr_data['longitude']    = trim($request->input('longitude', null));
        $arr_data['dump_id']      = \Session::get('cardId');
        $arr_data['dump_session'] = trim($request->input('virgil_private_key'));
        $arr_data['referral_code'] = $this->create_referral_code();
        $arr_data['refer_user_id'] = trim($request->input('refer_user_id'));

        $arr_data['mobile_otp']              = generate_otp();
        $arr_data['mobile_otp_expired_time'] = date("c", strtotime('+10 minutes'));

        try
        {
            $user = Sentinel::register($arr_data);
        }
        catch(\Exception $e)
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = $e->getMessage();
            return response()->json($return_arr);
        }

        if($user)
        {
            $user = Sentinel::findById($user->id);
            $role = Sentinel::findRoleBySlug('doctor');
            
            try
            {
                $user->roles()->attach($role);
            }
            catch(\Exception $e)
            {
                $return_arr['status']  = 'error';
                $return_arr['message'] = $e->getMessage();
                return response()->json($return_arr);
            }

            $activation        = Activation::create($user);
            $activation_code   = $activation->code;
            $activation_link   = '<a class="btn_emailer_cls" href="'.url('/doctor/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
            $arr_built_content = [
                                    'FIRST_NAME'      => decrypt_value($arr_data['first_name']).' '.decrypt_value($arr_data['last_name']),
                                    'APP_NAME'        => config('app.project.name'),
                                    'ACTIVATION_LINK' => $activation_link,
                                ];

            $arr_mail_data                      = [];
            $arr_mail_data['email_template_id'] = '1';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $arr_data;
            $email_status = $this->EmailService->send_mail($arr_mail_data);

            // Admin Notification
            $arr_notification['from_user_id']     = $user->id;
            $arr_notification['message']          = decrypt_value($arr_data['first_name']).' '.decrypt_value($arr_data['last_name']).', New Doctor Registered Successfully.';
            $arr_notification['notification_url'] = '/admin/doctor';
            $this->AdminNotificationService->create_admin_notification($arr_notification);

            $arr_sms_data           = [];
            $arr_sms_data['msg']    = config('app.project.name').", An OTP to verify your mobile number is : ".$arr_data['mobile_otp'];
            $arr_sms_data['mobile'] = '+'.$arr_data['phone_code'].$arr_data['mobile_no'];
            $sms_status = $this->SMSService->send_SMS($arr_sms_data);

            $return_arr['user_id'] = base64_encode($user->id);
            $return_arr['status']  = 'success';
            $return_arr['message'] = 'Your registration is successfully completed, Please check your registered email. Wait and verify your registered mobile using the OTP send to you.';

            return response()->json($return_arr);
        }
        else
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Something went wrong while registration, Please try again.';

            return response()->json($return_arr);
        }
    } // end signup_store


    /*
    | Function  : Verify email using link
    | Author    : Deepak Arvind Salunke
    | Date      : 11/01/2019
    | Output    : Success or Error
    */

    public function verify_email($enc_id, $activation_code)
    {
        $user_id         = base64_decode($enc_id);
        $activation_code = base64_decode($activation_code);

        $user       = Sentinel::findById($user_id);
        $activation = Activation::exists($user); // check if activation already done ...
        if($activation) // if activation is done
        {
            if (Activation::complete($user, $activation_code)) // complete an activation process
            {
                $tmp_user = $this->UserModel->where('id',$user_id)->first();
                if($tmp_user)
                {
                    $tmp_user->is_email_verified = 1;
                    $tmp_user->status = 1;
                    $tmp_user->save();
                }

                $this->arr_view_data['status'] = 'Verified';
                $this->arr_view_data['msg']    = 'Your account verified successfully, you are ready to login your account!';
            }
            else
            {
                $this->arr_view_data['status'] = 'Error';
                $this->arr_view_data['msg']    = 'Something went wrong while activating your account, Please try again later!';
            }
        }
        else
        {
            $this->arr_view_data['status'] = 'Error';
            $this->arr_view_data['msg']    = 'Your account is already verified!';
        }

        return view('front.status')->with($this->arr_view_data);
    } // end verify_email

    function create_referral_code()
    {
        $res = '';

        $res .= 'MD';
        $res .= mt_rand(10000,99999);

        $count = $this->UserModel->where('referral_code',$res)->count();

        if($count=='0')
        {
            return $res;
        }
        $this->create_referral_code();
    }

}
