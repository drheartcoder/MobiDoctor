<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SiteSettingsModel;
use Validator;
use Flash;
use Sentinel;
use Session;

class SiteSettingsController extends Controller
{
     public function __construct(SiteSettingsModel $SiteSettings)
    {
        $this->SiteSettingsModel   = $SiteSettings;
        $this->arr_view_data       = [];
        $this->module_url_path     = url(config('app.project.admin_panel_slug')."/siteSettings");
        $this->module_title        = "Site Settings";
        $this->module_view_folder  = "admin.sitesettings";
        $this->admin_panel_slug    = config('app.project.admin_panel_slug');
    }

    public function index()
    {
    	$this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_site_settings = array();

    	$user = Sentinel::check();

    	if($user)
    	{
    		if($user->inRole('admin'))
    		{
    			$arr_site =  $this->SiteSettingsModel->where('site_id','1')->first();
           
                if($arr_site!=FALSE)
                {
                    $arr_site_settings = $arr_site->toArray();
                }
               
                $this->arr_view_data['arr_data']        = $arr_site_settings;
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
         $site_status                 =   $request->input("site_status");
         $arr_data['site_status']     =   $site_status;
         $status                      =   $this->SiteSettingsModel->where('site_id',1)->update($arr_data);
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
