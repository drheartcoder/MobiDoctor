<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SocialLinksModel;
use Validator;
use Flash;
use Sentinel;
use Session;

class SocialLinksController extends Controller
{
     public function __construct(SocialLinksModel $social)
    {
        $this->SocialLinksModel        = $social;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/socialsettings");
        $this->module_title            = "Social Settings";
        $this->module_view_folder      = "admin.socialsettings";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

    	$user = Sentinel::check();

    	if($user)
    	{
    		if($user->inRole('admin'))
    		{
    			$arr_social =  $this->SocialLinksModel->where('id','1')->first();
           
                if($arr_social!=FALSE)
                {
                    $arr_social_settings = $arr_social->toArray();
                }
                $this->arr_view_data['arr_data']        = $arr_social_settings;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/index',$this->arr_view_data);
    		}
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
    	}
        else
        {
        	Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }
    public function update(request $request)
    {   
         $arr_rules = $form_data  = array();
         $form_data               = $request->all();
         $arr_rules['facebook']   =  "active_url";
         $arr_rules['twitter']    =  "active_url";
         $arr_rules['linkedin']   =  "active_url";
         $arr_rules['gplus']      =  "active_url";
         $arr_rules['pinterest']  =  "active_url";  
         $arr_rules['instagram']  =  "active_url";

         $validator               =  Validator::make($form_data,$arr_rules);
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
         }
         $arr_data                    =   array();
         $arr_data['facebook_link']   =   $form_data['facebook'];
         $arr_data['twitter_link']    =   $form_data['twitter'];
         $arr_data['linkedin_link']   =   $form_data['linkedin'];
         $arr_data['google_link']     =   $form_data['gplus'];
         $arr_data['pinterest_link']  =   $form_data['pinterest'];
         $arr_data['instagram_link']  =   $form_data['instagram'];

         $status                      =   $this->SocialLinksModel->where('id',1)->update($arr_data);

         if($status) 
         {
            Flash::success(str_singular($this->module_title).' Updated Successfully.'); 
         }
         else
         {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
         }
         return redirect()->back();
    }
}   
