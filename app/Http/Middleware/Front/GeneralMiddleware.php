<?php

namespace App\Http\Middleware\Front;

use App\Common\Services\MailchimpService;
use App\Common\Services\VirgilService;

use App\Models\MobileCountryCodeModel;
use App\Models\SocialLinksModel;
use App\Models\UserModel;

use Virgil\Sdk\Api\VirgilApiContext;
use Virgil\Sdk\Api\AppCredentials;
use Virgil\Sdk\Api\VirgilApi;
use Virgil\Sdk\Buffer;

use Carbon\Carbon;
use DateTimeZone;
use Sentinel;
use Closure;
use App;

class GeneralMiddleware
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
        $get_mobcode = MobileCountryCodeModel::orderBy('iso3','ASC')->where('phonecode','!=',0)->where('iso3','!=',null)->get()->toArray();
        view()->share('mobcode_data',$get_mobcode);



        $social_links = SocialLinksModel::first()->toArray();
        view()->share('social_links',$social_links);

        $patient_image_public_path = url('/').config('app.img_path.patient_profile_images');
        view()->share('patient_profile_image_public_path',$patient_image_public_path);
        $patient_image_base_path   = base_path().config('app.img_path.patient_profile_images');
        view()->share('patient_profile_image_base_path',$patient_image_base_path);
        $doctor_image_public_path = url('/').config('app.img_path.doctor_profile_images');
        view()->share('doctor_profile_image_public_path',$doctor_image_public_path);
        $doctor_image_base_path   = base_path().config('app.img_path.doctor_profile_images');
        view()->share('doctor_profile_image_base_path',$doctor_image_base_path);
        $default_img_path          = url('/').config('app.img_path.default_img_path');
        view()->share('default_img_path',$default_img_path);

        $user = Sentinel::check();
        if(isset($user->user_type) && $user->user_type != 'admin')
        {
            $user_firstname = isset($user->first_name) && !empty($user->first_name) ? decrypt_value($user->first_name) : '';
            view()->share('user_firstname',$user_firstname);
            $user_lastname  = isset($user->last_name) && !empty($user->last_name) ? decrypt_value($user->last_name) : '';
            view()->share('user_lastname',$user_lastname);
            $profile_image  = isset($user->profile_image) ? $user->profile_image : '';
            view()->share('profile_image',$profile_image);
        }



        $count_subscribers = 0;
        $mailchimp     = new MailchimpService();
        $obj_mailchimp = $mailchimp->get_users_list();
        if( $obj_mailchimp['status'] == 'SUCCESS' )
        {
            $count_subscribers = $obj_mailchimp['arr_members']['total_items'];
        }

        $user_count['patient']     = UserModel::where('user_type','patient')->count();
        $user_count['doctor']      = UserModel::where('user_type','doctor')->count();
        $user_count['subscribers'] = $count_subscribers;
        view()->share('user_count',$user_count);

        
        return $next($request);
    }
}
