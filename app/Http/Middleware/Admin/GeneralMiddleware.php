<?php

namespace App\Http\Middleware\Admin;

use Closure;
//use Illuminate\Support\Facades\Auth;
use App\Models\AdminProfileModel;
use App\Models\AdminNotificationModel;

class GeneralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));

        $admin_profile = AdminProfileModel::where('user_id',1)->first();
        if($admin_profile)
        {
            $admin_data = $admin_profile->toArray();
        }

        /*Get notification count*/
        $obj_notification = AdminNotificationModel::where(['is_read'=>'0'])->get();
        if(isset($obj_notification) && $obj_notification!=null)
        {
            $notification_count = count($obj_notification);
        }
        view()->share('notification_count',$notification_count);
       
        $admin_img_path = url('/').'/uploads/admin/profile/';
        $profile_pic = $admin_img_path.$admin_data['profile_pic'];
        $default_pic = $admin_img_path.'default-profile.png';
        
        if(isset($admin_data['profile_pic']) && file_exists(base_path().'/uploads/admin/profile/'.$admin_data['profile_pic']))
        {
            view()->share('admin_profile_pic',$profile_pic);
        }
        else
        {
            view()->share('admin_profile_pic',$default_pic);
        }

        return $next($request);
    }
}
