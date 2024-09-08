<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Services\AdminNotificationService;
use App\Common\Services\VirgilService;
use App\Common\Services\EmailService;
use App\Common\Services\SMSService;

use App\Models\UserModel;

use Validator;
use Sentinel;
use Reminder;
use Activation;
use Flash;
use Session;

class CommonController extends Controller
{
    public function __construct(
                                    AdminNotificationService $admin_notification_service,
                                    VirgilService            $virgil_service,
                                    EmailService             $email_service,
                                    SMSService               $sms_service
                                )
    {
        $this->arr_view_data = [];
        $this->UserModel                = new UserModel();
        
        $this->AdminNotificationService = $admin_notification_service;
        $this->VirgilService            = $virgil_service;
        $this->EmailService             = $email_service;
        $this->SMSService               = $sms_service;

        $user                           = Sentinel::check();
        if($user)
        {
        $this->user_id                  = $user->id;
        }
    }


    /*
    | Function  : Check if email id already exists or not
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function check_duplicate_email(Request $request)
    {
        $arr_response['status'] = 'success';
        $count = $this->UserModel->where('email',$request->email_id)->count();
        if($count > 0)
        {
            $arr_response['status'] = 'error';
        }
        return response()->json($arr_response);
    }

    /*
    | Function  : Check if refferal code is exists or not
    | Author    : Amol Bhamare
    | Date      : 07/03/2019
    | Output    : Success or Error
    */

    public function check_referral_code(Request $request)
    {
        $arr_response['status'] = 'error';
        $arr_response['refer_user_id'] = '';
        $count = $this->UserModel->select('id','referral_code')->where('referral_code',$request->referral_code)->first();
        if($count)
        {
            $arr_response['status'] = 'success';
            $arr_response['refer_user_id'] = isset($count->id)?$count->id:0;
        }
        return response()->json($arr_response);
    }


    /*
    | Function  : Check if mobile no already exists or not
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function check_duplicate_mobile(Request $request)
    {
        $arr_response['status'] = 'success';
        $count = $this->UserModel->where('mobile_no',$request->mobile_no)->count();
        if($count > 0)
        {
            $arr_response['status'] = 'error';
        }

        return response()->json($arr_response);
    }


    /*
    | Function  : Check if mobile no already exists or not
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function login(Request $request)
    {
        $arr_json = $form_data = $arr_credentials = [];

        $arr_rules['usertype'] = "required";
        $arr_rules['email']    = "required|email";
        $arr_rules['password'] = "required|min:6";

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            $arr_json['status'] = "error";
            $arr_json['msg']    = "Please enter a valid email id & password.";  
        }
        
        $form_data = $request->all();

        $arr_credentials = [
            'email'    => $form_data['email'],
            'password' => $form_data['password'],
        ];

        $arr_json['status'] = "error";
        $arr_json['msg']    = 'Account with this credentials does not exist.';

        $user = Sentinel::findByCredentials($arr_credentials);
        if($user)
        {
            $arr_json['status'] = "error";
            $arr_json['msg']    = 'Invalid credentials, Please try again.';

            $remember_me = isset( $form_data['remember_me'] ) && !empty( $form_data['remember_me'] ) ? $form_data['remember_me'] : '';
            if($remember_me == 'on')
            {
                $check_authentication = Sentinel::authenticateAndRemember($arr_credentials);
                setcookie('remember_me_email',    $request->input('email'),    time()+60*60*24*100);
                setcookie('remember_me_password', $request->input('password'), time()+60*60*24*100);
            }
            else
            {
                $check_authentication = Sentinel::authenticate($arr_credentials);
                setcookie('remember_me_email',    '');
                setcookie('remember_me_password', '');
            }

            if($check_authentication)
            {
                $arr_json['status'] = "error";
                $arr_json['msg']    = 'Your account is blocked by admin, please contact to admin.';

                if($user->status == 1)
                {
                    $arr_json['status'] = "error";
                    $arr_json['msg']    = 'Email verification is pending. Verify email id and try again to login.';
                    
                    if($user->is_email_verified == 1)
                    {
                        $arr_json['status'] = "error";
                        $arr_json['msg']    = 'Mobile no. verification is pending. Verify mobile no. and try again to login.';

                        if($user->is_mobile_verified == 1)
                        {
                            $login_status = Sentinel::login($user);
                            if($login_status)
                            {
                                $user->increment('login_count');

                                $arr_json['status']   = "success";
                                $arr_json['usertype'] = $user->user_type;
                                $arr_json['msg']      = 'You have successfully login to your account.';
                            }
                            else
                            {
                                $this->user_logout();
                            }
                        }
                        else
                        {
                            $this->user_logout();
                        }
                    }
                    else
                    {
                        $this->user_logout();
                    }
                }
                else
                {
                    $this->user_logout();
                }
            }
            else
            {
                $this->user_logout();
            }
        }

        return response()->json($arr_json);
    } // end login


    /*
    | Function  : forgot password
    | Author    : Amol Bhamare
    | Date      : 03/01/2019
    | Output    : Success or Error
    */
    public function forget_password(Request $request)
    {
        $arr_json = $form_data = $arr_credentials = [];

        $arr_rules['email'] = "required|email";
        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            $arr_json['status'] = "error";
            $arr_json['msg']    = "Please enter a valid email id";
            return response()->json($arr_json);
        }
        
        $email = $request->input('email');
        $user = Sentinel::findByCredentials(['email' => $email]);
        if($user)
        {
            $check_user    = Sentinel::findById($user->id);
            $activation    = Activation::exists($check_user);
            $reminder_code = Reminder::create($user);
            
            $password_reset_link             = url('/reset_password_link/'.base64_encode($user->id).'/'.base64_encode($reminder_code->code) );

            $arr_built_content = [
                                    'USER_NAME'      => decrypt_value($user->first_name),
                                    'APP_NAME'        => config('app.project.name'),
                                    'PASSWORD_RESET_LINK' => $password_reset_link,
                                  ];

            $arr_mail_data                      = [];
            $user_data['email']                 = $email;
            $user_data['first_name']            = isset($user->first_name)?decrypt_value($user->first_name):'';
            $arr_mail_data['email_template_id'] = '2';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $user_data;
            $email_status = $this->EmailService->send_mail($arr_mail_data);
            if($email_status)
            {
                $arr_json['status']  = "success";
                $arr_json['message'] = "Password reset link is sent to your email id.";
                return response()->json($arr_json);
            }
            else
            {
                $arr_json['status']  = "error";
                $arr_json['message'] = "Problem occured while sending password reset link.";
                return response()->json($arr_json);
            }
        }
        else
        {
            $arr_json['status']  = "error";
            $arr_json['message'] = "User is not exist with this email address.";
            return response()->json($arr_json);
        }
    }

    /*
    | Function  : open view for reset password
    | Author    : Amol Bhamare
    | Date      : 03/01/2019
    | Output    : show reset password page
    */
    public function reset_password_link($enc_id = false, $enc_reminder_code = '')
    {
        $user_id        = base64_decode($enc_id);
        $reminder_code  = base64_decode($enc_reminder_code);
        $this->module_view_folder                 = 'front';

        $user = Sentinel::findById($user_id);
        
        if(!$user)        
        {
            Flash::error('Invalid user request.');
            return redirect()->back();
        }

        if(Reminder::exists($user))
        {
            $this->arr_view_data                      = [];
            $this->arr_view_data['enc_id']            = $enc_id;
            $this->arr_view_data['enc_reminder_code'] = $enc_reminder_code;
            return view($this->module_view_folder.'.reset_password',$this->arr_view_data);
        }
        else
        {
            $this->arr_view_data['status'] = 'error';
            $this->arr_view_data['msg'] = 'Reset password link expired.';
            return view($this->module_view_folder.'.status',$this->arr_view_data);
        }  
    }

     /*
    | Function  : store new password
    | Author    : Amol Bhamare
    | Date      : 03/01/2019
    */
    public function reset_password(Request $request)
    {
        $arr_rules = $return_arr = [];
        $arr_rules['enc_id']            = "required";
        $arr_rules['enc_reminder_code'] = "required";
        $arr_rules['new_password']      = "required|min:6";
        $arr_rules['confirm_password']  = 'required|same:new_password|min:6';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Session::flash('error','Please enter all fields.');
            return redirect()->back()->withErrors($validator);
        }
        
        $enc_id            = $request->input('enc_id');
        $enc_reminder_code = $request->input('enc_reminder_code');
        $password          = $request->input('new_password');
        $confirm_password  = $request->input('confirm_password');

        if ($password  !=  $confirm_password)
        {
            Session::flash('error','New password and confirm password should be same.');            
            return response()->json($return_arr);
        }

        $user_id           = base64_decode($enc_id);
        $reminder_code     = base64_decode($enc_reminder_code);

        $user              = Sentinel::findById($user_id);
        
        if(!$user)       
        {
            $return_arr['status'] = 'error';
            $return_arr['msg']    = 'Invalid user request.';
            return response()->json($return_arr);
        }
        
        if ($reminder = Reminder::complete($user, $reminder_code, $password))
        {            
            $return_arr['status'] = 'success';
            $return_arr['msg']    = 'Password changed successfully, Please login.';
            return response()->json($return_arr);
        }
        else
        {
            $this->arr_view_data['status'] = 'error';
            $this->arr_view_data['msg']    = 'Reset password link expired.';
            return view('front.status',$this->arr_view_data); 
        }     
    }

    /*
    | Function  : Logout user from dashboard
    | Author    : Deepak Arvind Salunke
    | Date      : 03/01/2019
    | Output    : Success or Error
    */

    public function logout(Request $request)
    {
        $this->user_logout();

        return redirect(url('/'));
    }

    public function user_logout()
    {
        $user = Sentinel::check();
        if($user)
        {
            Sentinel::logout($user, true);
        }
        else
        {
            Sentinel::logout();
        }

        return true;
    }

    

    /*
    | Function  : Verify mobile number using OTP
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function verify_mobile(Request $request)
    {
        $arr_json = $arr_rules = $arr_data = $arr_sms_data = [];

        $arr_rules['email'] = "required|email";

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            $arr_json['status'] = "error";
            $arr_json['msg']    = "Please enter a valid email id"; 
            return response()->json($arr_json); 
        }
        
        $email = $request->input('email');
        $user  = Sentinel::findByCredentials(['email' => $email]);
        if($user)
        {
            if( $user->is_mobile_verified == 0 )
            {
                if( !empty( $user->mobile_no ) )
                {
                    $arr_data['mobile_otp']              = generate_otp();
                    $arr_data['mobile_otp_expired_time'] = date("c", strtotime('+10 minutes'));
                    Sentinel::update($user, $arr_data);

                    $arr_sms_data           = [];
                    $arr_sms_data['msg']    = config('app.project.name').", An OTP to verify your mobile number is : ".$arr_data['mobile_otp'];
                    $arr_sms_data['mobile'] = '+'.$user->phone_code.$user->mobile_no;
                    $this->SMSService->send_SMS($arr_sms_data);

                    $arr_json['user_id_otp'] = base64_encode($user->id);

                    $arr_json['status']  = "success";
                    $arr_json['message'] = "OTP is send to the registered mobile number.";
                }
                else
                {
                    $arr_json['status']  = "error";
                    $arr_json['message'] = "There is no mobile no. added for this account. Contact admin for more details.";
                }
            }
            else
            {
                $arr_json['status']  = "error";
                $arr_json['message'] = "Your mobile no. is already verified.";
            }
        }
        else
        {
            $arr_json['status']  = "error";
            $arr_json['message'] = "User is not exist with this email address.";
        }

        return response()->json($arr_json);
    } // end verify_mobile


    /*
    | Function  : Resend OTP for mobile verification
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function resend_otp(Request $request)
    {
        $return_arr['status'] = 'error';

        $user_id = base64_decode($request->input('user_id'));

        if( !empty($user_id) && $user_id != null )
        {
            $user = Sentinel::findById($user_id);
            if($user)
            {
                $arr_data['mobile_otp']              = generate_otp();
                $arr_data['mobile_otp_expired_time'] = date("c", strtotime('+10 minutes'));
                Sentinel::update($user, $arr_data);

                $arr_sms_data           = [];
                $arr_sms_data['msg']    = config('app.project.name').", An OTP to verify your mobile number is : ".$arr_data['mobile_otp'];
                $arr_sms_data['mobile'] = '+'.$user->phone_code.$user->mobile_no;
                $sms_status = $this->SMSService->send_SMS($arr_sms_data);

                $return_arr['status'] = 'success';
            }
        }

        return response()->json($return_arr);
    } // end resend_otp


    /*
    | Function  : Verify mobile number using OTP
    | Author    : Deepak Arvind Salunke
    | Date      : 27/12/2018
    | Output    : Success or Error
    */

    public function verify_otp(Request $request)
    {
        $return_arr['status'] = 'error';

        $user_id = base64_decode($request->input('user_id_otp'));
        $otp     = $request->input('otp');

        $check_otp = $this->UserModel->where('id', $user_id)
                                     ->where('mobile_otp', $otp)
                                     ->where('mobile_otp_expired_time', '>', date("c"))
                                     ->count();

        if($check_otp > 0)
        {
            $this->UserModel->where('id',$user_id)->update(['is_mobile_verified' => 1,'mobile_otp' => null,'mobile_otp_expired_time' => null]);
            
            $user = $this->UserModel->where('id', $user_id)->first();

            if( $user->social_login == 'yes' )
            {
                Sentinel::login($user);
            }

            $return_arr['social_login'] = $user->social_login;
            $return_arr['user_type'] = $user->user_type;
            $return_arr['status'] = 'success';
        }

        return response()->json($return_arr);
    } // end verify_otp


    public function change_view(Request $request)
    {
        if( !empty( $request->input('view') ) && ( null !== $request->input('view') ) ):
            $this->UserModel->where('id', $this->user_id)->update(['view_type' => $request->input('view')]);
        endif;
    }


    public function fblogin(Request $request)
    {
        $arr_rules                 = array();
        $arr_rules['email']        = "required|email";
        $arr_rules['fb_token']     = "required";
        $arr_rules['pprivate_key'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if ($validator->fails()):
            $arr_response           = array();
            $arr_response['status'] = "error";
            $arr_response['msg']    = "Sorry you can't login through facebook, Email id is not provided by facebook.";

            return response()->json($arr_response);
        endif;


        $fb_token   = trim($request->input('fb_token'));
        $fb_user_id = trim($request->input('fb_user_id'));


        /*--------------------------------Virgil security--------------------------------*/

        // create Virgil api
        $virgilApi = $this->VirgilService->clientToken();
        $userCards = $virgilApi->Cards->get( Session::get('cardId') );

        $arr_data['dump_id']           = \Session::get('cardId');
        $arr_data['dump_session']      = trim($request->input('pprivate_key'));

        /*--------------------------------Virgil security--------------------------------*/


        $birthday = ( null !== $request->input('birthday') && !empty( $request->input('birthday') ) ) ? date("c", strtotime($request->input('birthday'))) : null;

        $arr_data['user_type']         = 'patient';
        $arr_data['first_name']        = encrypt_value(trim($request->input('first_name')));
        $arr_data['last_name']         = encrypt_value(trim($request->input('last_name')));
        $arr_data['email']             = trim($request->input('email'));
        $arr_data['password']          = trim($request->input('password'));
        $arr_data['phone_code']        = trim($request->input('phone_code'));
        $arr_data['mobile_no']         = trim($request->input('mobile_no'));
        $arr_data['gender']            = trim($request->input('gender'));
        $arr_data['address']           = encrypt_value(trim($request->input('address', null)));
        $arr_data['city']              = encrypt_value(trim($request->input('city', null)));
        $arr_data['state']             = encrypt_value(trim($request->input('state', null)));
        $arr_data['country']           = encrypt_value(trim($request->input('country', null)));
        $arr_data['latitude']          = trim($request->input('latitude', null));
        $arr_data['longitude']         = trim($request->input('longitude', null));
        $arr_data['profile_image']     = "https://graph.facebook.com/".$fb_user_id."/picture?height=250&width=250";
        $arr_data['social_login']      = 'yes';
        $arr_data['is_online']         = 1;
        $arr_data['date_of_birth']     = $birthday;
        $arr_data['address']           = trim($request->input('address', null));
        $arr_data['gender']            = trim($request->input('gender', null));
        $arr_data['is_email_verified'] = 1;
        $arr_data['status']            = 1;

        // Generate Password
        $string                        = '1234567890';
        $string_shuffled               = str_shuffle($string);
        $password                      = substr($string_shuffled, 1, 4);
        $char_string                   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_shuffled_char          = str_shuffle($char_string);
        $password_char                 = substr($string_shuffled_char, 1, 3);
        $randomPassword                = $password_char.'@'.$password;
        $arr_data['password']          = bcrypt($randomPassword);

        $arr_data['mobile_otp']              = generate_otp();
        $arr_data['mobile_otp_expired_time'] = date("c", strtotime('+10 minutes'));

        if (verify_fb_token($fb_token)):

            $obj_user = $this->UserModel->where('email', $arr_data['email'])->first();

            if ($obj_user != null):

                if($obj_user->status == 0):
                    $arr_response           = array();
                    $arr_response['status'] = "error";
                    $arr_response['msg']    = "Your account is blocked by admin, Please contact to admin.";
                    return response()->json($arr_response);
                endif;

                if(strpos($obj_user->profile_image, 'http') !== false || $obj_user->profile_image == null):
                    $arr_up_data['social_login']  = 'yes';
                    $arr_up_data['profile_image'] = $arr_data['profile_image'];

                    $this->UserModel->where('id', $obj_user->id)->update($arr_up_data);
                endif;

                $arr_response = array();
                if ($obj_user->is_mobile_verified == 0):
                    $arr_response['mobile_required'] = "yes";
                    $arr_response['usertype']        = "patient";
                    $arr_response['status']          = "success";
                    $arr_response['msg']             = 'Your facebook authentication is successfully done, Please verify your mobile number to continue.';
                    $arr_response['enc_user_id']     = isset($obj_user->id) ? base64_encode($obj_user->id) : '';
                
                else:
                    $user = Sentinel::findById($obj_user->id);
                    Sentinel::login($user);
                    $arr_response['mobile_required'] = "no";
                    $arr_response['usertype']        = "patient";
                    $arr_response['status']          = "success";
                    $arr_response['msg']             = 'Your facebook authentication is successfully done.';
                endif;

                return response()->json($arr_response);
            
            else:

                /* Register User */
                $status = Sentinel::registerAndActivate($arr_data);
                if($status):
                    $arr_response                = array();
                    $arr_response['status']      = "success";
                    $arr_response['msg']         = 'Your facebook authentication is successfully done, Please verify your mobile number to continue.';
                    $arr_response['enc_user_id'] =  isset($status->id) ? base64_encode($status->id) : '';

                    $arr_notification['from_user_id']     = $status->id;
                    $arr_notification['message']          = decrypt_value($arr_data['first_name']).' '.decrypt_value($arr_data['last_name']).', New Patient Registered Successfully.';
                    $arr_notification['notification_url'] = '/admin/patient';
                    $this->AdminNotificationService->create_admin_notification($arr_notification);

                    return response()->json($arr_response);
                
                else:
                    $arr_response           = array();
                    $arr_response['status'] = "error";
                    $arr_response['msg']    = 'Something went wrong, Please try again.';

                    return response()->json($arr_response);
                endif;

            endif;
        
        else:
            $arr_response           = array();
            $arr_response['status'] = "error";
            $arr_response['msg']    = 'Invalid facebook token';

            return response()->json($arr_response);   
        
        endif;
    } // end fblogin


    public function enter_mobile(Request $request)
    {
        $arr_json = $arr_rules = $arr_data = $arr_sms_data = [];

        $arr_rules['phone_code'] = "required";
        $arr_rules['mobile']     = "required";

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            $arr_json['status'] = "error";
            $arr_json['msg']    = "Please enter a valid email id"; 
            return response()->json($arr_json); 
        }
        
        $enc_user_id = $request->input('user_id');
        $phone_code  = $request->input('phone_code');
        $mobile      = $request->input('mobile');

        $count = $this->UserModel->where('mobile_no', $mobile)->count();
        if( $count > 0 ):
            $arr_json['status']  = "error";
            $arr_json['message'] = "User with this mobile no. already exists.";
            return response()->json($arr_json);
        endif;

        $user = $this->UserModel->where('id', base64_decode($enc_user_id))->first();
        if($user):
            if( $user->is_mobile_verified == 0 ):
                $arr_data['phone_code']              = $phone_code;
                $arr_data['mobile_no']               = $mobile;
                $arr_data['mobile_otp']              = generate_otp();
                $arr_data['mobile_otp_expired_time'] = date("c", strtotime('+10 minutes'));
                Sentinel::update($user, $arr_data);

                $arr_sms_data           = [];
                $arr_sms_data['msg']    = config('app.project.name').", An OTP to verify your mobile number is : ".$arr_data['mobile_otp'];
                $arr_sms_data['mobile'] = '+'.$user->phone_code.$user->mobile_no;
                $this->SMSService->send_SMS($arr_sms_data);

                $arr_json['user_id_otp'] = $enc_user_id;

                $arr_json['status']  = "success";
                $arr_json['message'] = "OTP is send to the registered mobile number.";
            else:
                $arr_json['status']  = "error";
                $arr_json['message'] = "Your mobile no. is already verified.";
            endif;
        else:
            $arr_json['status']  = "error";
            $arr_json['message'] = "User is not exist with this email address.";
        endif;

        return response()->json($arr_json);
    } // end enter_mobile
    
}
