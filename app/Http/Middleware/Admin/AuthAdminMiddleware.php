<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;
use Flash;

class AuthAdminMiddleware
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

        $path = 'admin';

        $arr_except[] =  $path;
        $arr_except[] =  $path.'login';
        $arr_except[] =  $path.'process_login';
        $arr_except[] =  $path.'change_password';
        $arr_except[] =  $path.'update_password';
        $arr_except[] =  $path.'forgot_password';
        $arr_except[] =  $path.'reset_password';
        $arr_except[] =  $path.'update_reset_password';

        /*-----------------------------------------------------------------
            Code for {enc_id} or {extra_code} in url
        ------------------------------------------------------------------*/
        $request_path = $request->route()->getCompiled()->getStaticPrefix();
        $request_path = substr($request_path,1,strlen($request_path));
        
        /*-----------------------------------------------------------------
                End
        -----------------------------------------------------------------*/        

        if(!in_array($request_path, $arr_except))
        {
            $sub_admin_module = '';
            $arr_route_action = $request->route()->getAction();

            if(isset($arr_route_action['sub_admin_module']) && $arr_route_action['sub_admin_module']!='')
            {
                $sub_admin_module = $arr_route_action['sub_admin_module'];
            }

            $user = Sentinel::check();
            if($user)
            {
                if($user->inRole('admin'))
                {
                    return $next($request);    
                }
                else if($user->inRole('sub-admin'))
                {
                    if($sub_admin_module == 'NO')
                    {
                        Sentinel::logout();
                        Session::flush();   
                        Flash::error('Not Sufficient Privileges');

                        return redirect('/');
                    }
                    return $next($request);    
                }
                else
                {
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
