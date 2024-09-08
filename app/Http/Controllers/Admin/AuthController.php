<?php //Seema

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AdminProfileModel;
use App\Models\UserModel;

use App\Common\Services\EmailService;
use Twilio\Rest\Client;

use Activation;
use Validator;
use Exception;
use Sentinel;
use Reminder;
use Session;
use Flash;
use Hash;
use Mail;

class AuthController extends Controller
{
    public $arr_view_data;
    public $admin_panel_slug;

    public function __construct(EmailService $email_service)
    {
        $this->UserModel         = new UserModel();
        $this->AdminProfileModel = new AdminProfileModel();

        $this->EmailService      = $email_service;

        $this->arr_view_data     = [];
        $this->admin_panel_slug  = config('app.project.admin_panel_slug');
    }
    
    public function login()
    {
        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
        $this->arr_view_data['page_title']       = "Login";
        return view('admin.auth.login',$this->arr_view_data);
    }

    public function process_login(Request $request)
    {    
        $admin_path = config('app.project.admin_panel_slug');
    
        $validator = Validator::make($request->all(), [
            'email'    => 'required|max:255',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            redirect(config('app.project.admin_panel_slug').'/login')->withErrors($validator)->withInput($request->all());
        }

        $login_details = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];
      
        $check_auth = Sentinel::authenticate($login_details);
        if($check_auth)
        {
            $user = Sentinel::check();
            if($user->inRole('admin'))
            {
                $email    = $login_details['email'];
                $password = $login_details['password'];
                $user_arr = $this->UserModel->where('email' ,$email)->with('admin_details')->first();

                if($user_arr)
                {
                    $user_details = $user_arr->toArray();
                }

                $arr_ret['password'] = $password;
                $arr_ret['email']    = $email;

                return redirect(config('app.project.admin_panel_slug').'/dashboard');
            }
            else if($user->inRole('sub-admin'))
            {
                $email    = $login_details['email'];
                $password = $login_details['password'];
                $user_arr = $this->UserModel->where('email' ,$email)->with('admin_details')->first();

                if($user_arr)
                {
                    $user_details = $user_arr->toArray();
                }

                $arr_ret['password'] = $password;
                $arr_ret['email']    = $email;

                if($user_details['status'] == '0')
                {
                    Flash::error('Your account blocked by admin.');
                    return redirect()->back();
                }
                else
                {
                    return redirect(config('app.project.admin_panel_slug').'/dashboard');
                }
            }
            else
            {
                Flash::error('Not Sufficient Privileges');
                return redirect()->back();
            }
        }
        else
        {
            Flash::error('Invalid Login Credential');
            return redirect()->back();
        }
    }

    public function change_password()
    {
        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
        $this->arr_view_data['page_title']       = "Change Password";
        return view('admin.auth.change_password',$this->arr_view_data);
    }

    public function update_password(Request $request)
    {  
        $credentials = $form_data = [];
        
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password'     => 'required|confirmed'
        ]);

        if($validator->fails())
        {
            redirect(config('app.project.admin_panel_slug').'/change_password')->withErrors($validator)->withInput($request->all());
        }

        $user = Sentinel::check();
        $form_data = $request->all();

        $credentials['password'] = $request->input('current_password');
        if($form_data['current_password'] == $form_data['new_password'])
        {
            Flash::error('Current password & new password should not be same.');
            return redirect()->back();
        }
        else
        {
            if(Sentinel::validateCredentials($user,$credentials)) 
            { 
                $new_credentials = [];
                $new_credentials['password'] = $request->input('new_password');                                           
                
                if(Sentinel::update($user, $new_credentials))
                {
                    Flash::success('Password Change Successfully');
                }
                else
                {
                    Flash::error('Problem Occured, While Changing Password');
                }
            }
            else
            {
                Flash::error('Invalid Current Password');
            }
        }
        return redirect()->back(); 
    }

    public function forgot_password(Request $request)
    {
        $arr_rules = array();

        $arr_rules['mobile_no'] = 'required|email';
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        endif;

        $email = $request->input('mobile_no');
        //$user  = Sentinel::findByCredentials(['email' => $email]);
        $user  = $this->UserModel->where('id','1')->where('email',$email)->first();

        if($user)
        {
            $check_user    = Sentinel::findById($user->id);
            $activation    = Activation::exists($check_user);
            $reminder_code = Reminder::create($user);
            
            $password_reset_link = url('/admin/reset_password_link/'.base64_encode($user->id).'/'.base64_encode($reminder_code->code));

            $arr_built_content = [
                                    'USER_NAME'           => decrypt_value($user->first_name),
                                    'APP_NAME'            => config('app.project.name'),
                                    'PASSWORD_RESET_LINK' => $password_reset_link,
                                  ];

            $arr_mail_data                      = [];
            $user_data['email']                 = $email;
            $user_data['first_name']            = isset($user->first_name) ? decrypt_value($user->first_name) : '';
            $arr_mail_data['email_template_id'] = '2';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = $user_data;

            $email_status = $this->EmailService->send_mail($arr_mail_data);
            if($email_status)
            {
                /*$arr_json['status']  = "success";
                $arr_json['message'] = "Password reset link is sent to your email id.";
                return response()->json($arr_json);*/

                //Session::set('mobile_no_err','success');
                Flash::success('Password reset link is sent to your email id.');
                return redirect()->back();
            }
            else
            {
                /*$arr_json['status']  = "error";
                $arr_json['message'] = "Problem occured while sending password reset link.";*/

                Session::set('mobile_no_err','not_registered');
                Flash::error('Problem occured while sending password reset link.');
                return redirect()->back();
            }
        }
        else
        {
            Session::set('mobile_no_err','not_registered');
            Flash::error('This email id is not registered');
            return redirect()->back();
        }
    }

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
            //return view($this->module_view_folder.'.reset_password',$this->arr_view_data);
            return view('admin.auth.reset_password',$this->arr_view_data);
        }
        else
        {
            $this->arr_view_data['status'] = 'error';
            $this->arr_view_data['msg'] = 'Reset password link expired.';
            return view($this->module_view_folder.'.status',$this->arr_view_data);
        }  
    }

    public function reset_password(Request $request)
    {
        $arr_rules = $return_arr = [];
        $arr_rules['enc_id']            = "required";
        $arr_rules['enc_reminder_code'] = "required";
        $arr_rules['password']          = "required|min:6";
        $arr_rules['confirm_password']  = 'required|same:password|min:6';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Session::flash('error','Please enter all fields.');
            return redirect()->back()->withErrors($validator);
        }
        
        $enc_id            = $request->input('enc_id');
        $enc_reminder_code = $request->input('enc_reminder_code');
        $password          = $request->input('password');
        $confirm_password  = $request->input('confirm_password');

        if ($password  !=  $confirm_password)
        {
            Flash::error('New password and confirm password should be same.');
            return redirect()->back();

            /*Session::flash('error','New password and confirm password should be same.');
            return response()->json($return_arr);*/
        }

        $user_id           = base64_decode($enc_id);
        $reminder_code     = base64_decode($enc_reminder_code);

        $user              = Sentinel::findById($user_id);
        
        if(!$user)       
        {
            Flash::error('Invalid user request.');
            return redirect()->back();

            /*$return_arr['status'] = 'error';
            $return_arr['msg']    = 'Invalid user request.';
            return response()->json($return_arr);*/
        }
        
        if ($reminder = Reminder::complete($user, $reminder_code, $password))
        {            
            Flash::success('Password changed successfully, Please login.');
            return redirect()->back();

            /*$return_arr['status'] = 'success';
            $return_arr['msg']    = 'Password changed successfully, Please login.';
            return response()->json($return_arr);*/
        }
        else
        {
            Flash::error('Reset password link expired.');
            return redirect()->back();

            /*$this->arr_view_data['status'] = 'error';
            $this->arr_view_data['msg']    = 'Reset password link expired.';
            return view('front.status',$this->arr_view_data); */
        }     
    }

    /*public function reset_password($enc_user_id=null)
    {
        $arr_view_data               = array();
        $arr_view_data['page_title'] = 'Reset Password';

        if($enc_user_id)
        {
            $user_details = $this->UserModel->where('id',base64_decode($enc_user_id))->first();

            if($user_details!=FALSE)
            {
                $arr_view_data['user_details'] = $user_details->toArray();
                return view('admin.auth.reset_password',$arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
            }
        }
        else
        {
            Flash::error('Invalid Request.');
        }
    }

    public function update_reset_password($enc_id=null, Request $request)
    {
        if($enc_id)
        {
            $arr_rules = array();

            $arr_rules['password']         = 'required';
            $arr_rules['confirm_password'] = 'required';

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $user_id   = base64_decode($enc_id);
            $user_data = $this->UserModel->where('id',$user_id)->first(); 

            if(isset($user_data) && sizeof($user_data)>0)
            {
                $credentials = array();
                $new_credentials['password'] = $request->input('password'); 

                $user = Sentinel::findById($user_id);

                if($user)
                {
                    if(Sentinel::update($user,$new_credentials))
                    {
                        Flash::success('Password reset successfully.');
                    }
                    else
                    {
                        Flash::error('Problem occured, while reseting password.'); 
                    }
                }
                else
                {
                    Flash::error('Invalid Request.'); 
                }
            }
            else
            {
                Flash::error('Invalid User.'); 
            }
        }
        else
        {
            Flash::error('Invalid Request.'); 
        }
        return redirect(config('app.project.admin_panel_slug').'/login');
    }*/

    public function logout()
    {
        Sentinel::logout();
        return redirect(url($this->admin_panel_slug));
    }



    /*--------------------------------------------------------------------------
                                    OTP VERIFICATION
    -----------------------------------------------------------------------------*/

    public function verify_otp(Request $request)
    {
        $current_datetime   = date("Y-m-d H:i:s");

        $otp_expired = $this->OtpModel->where('id', $request->otp_id)
                                ->where('expired_on' ,'>', $current_datetime)
                                ->count();

        if($otp_expired > 0)
        {
            $count = $this->OtpModel->where('id', $request->otp_id)
                                    ->where('otp' , $request->otp)
                                    ->count(); 

        
            if($count > 0)
            {
                $arr_credential['email']    = $request->email;
                $arr_credential['password'] = $request->password;
                $check_authentication = Sentinel::authenticate($arr_credential);

                $user = Sentinel::findByCredentials($arr_credential);
                if($check_authentication)
                {            
                   $login_status = Sentinel::login($user);
                   if($login_status)
                   {
                        $arr_json['status'] =  "success";
                        $arr_json['msg']    =  '';

                        $session_id = Session::getId();

                        $upd_arr['session_id'] = $session_id; 
                        $this->UserModel->where('id' ,$user->id)->update($upd_arr);
                    } 
                    else
                    {
                        $arr_json['status'] =  "error";
                        $arr_json['msg']    =  'Invalid credentials, Please try again.';
                        return response()->json($arr_json);
                    }

                    $arr_json['status'] =  "success";
                    $arr_json['msg']    =  '';
                    return response()->json($arr_json);
                }
                else
                {
                    $arr_json['status'] =  "error";
                    $arr_json['msg']    =  'Invalid credentials, Please try again.';
                    return response()->json($arr_json);
                }

                $arr_json['status'] = 'success';
                $arr_json['msg'] = 'Invalid OTP. Please try again';
            } 
            else
            {
                $arr_json['status'] = 'error';
                $arr_json['msg'] = 'Invalid OTP. Please try again';
            }    
        }
        else
        {
            $arr_json['status'] = 'error';
            $arr_json['msg'] = 'Your OTP is expired ! Please Resend otp';
        }
        return response()->json($arr_json);
    }
}
