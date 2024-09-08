<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Flash;

use App\Models\UserNotificationModel;

class AuthPatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arr_except = array();
        $current_url_route = app()->router->getCurrentRoute()->uri();
        if(!in_array($current_url_route,$arr_except))
        {
            $user = Sentinel::check();
            if($user)
            {   
                $step_clearance = true;
                if($user->user_status == 'Block')
                {
                    $step_clearance = false;
                    Flash::error('Your Account is Blocked Temporarily by Admin');
                }   
                elseif(!$user->inRole('patient'))
                {
                    $step_clearance = false;
                    Flash::error('You don\'t have sufficient previleges to access this panel ');  
                }
                if($step_clearance == true)
                {
                    $user_data                  = [];
                    $user_data['user_type']     = $user->user_type;
                    $user_data['first_name']    = $user->first_name;
                    $user_data['last_name']     = $user->last_name;
                    $user_data['email']         = $user->email;
                    $user_data['phone_code']    = $user->phone_code;
                    $user_data['mobile_no']     = $user->mobile_no;
                    $user_data['gender']        = $user->gender;
                    $user_data['address']       = $user->address;
                    $user_data['timezone']      = $user->timezone;
                    $user_data['profile_image'] = $user->profile_image;
                    $user_data['dump_id']       = $user->dump_id;
                    $user_data['dump_session']  = $user->dump_session;
                    $user_data['social_login']  = $user->social_login;
                    view()->share('user_data', $user_data);

                    $patient_profile_image_public_path = url('/').config('app.img_path.patient_profile_images');
                    $patient_profile_image_base_path   = base_path().config('app.img_path.patient_profile_images');
                    $default_img_path                  = url('/').config('app.img_path.default_img_path');
                    
                    view()->share('patient_profile_image_public_path', $patient_profile_image_public_path);
                    view()->share('patient_profile_image_base_path', $patient_profile_image_base_path);
                    view()->share('default_img_path', $default_img_path);
                    $unread_notification_count = 0;
                    $unread_notification_count = UserNotificationModel::where('to_user_id',$user->id)
                                                                ->where('is_read','=','0')
                                                                ->count();
                
                    view()->share('unread_notification_count', $unread_notification_count);

                    return $next($request);
                }
                else
                {
                    Sentinel::logout();
                    return redirect('/');
                }    
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return $next($request); 
        }
    }
}
