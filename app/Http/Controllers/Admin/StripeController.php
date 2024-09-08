<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StripeSettingsModel;

use Validator;
use Flash;
use Sentinel;
use Session;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->StripeSettingsModel = new StripeSettingsModel();
        $this->arr_view_data       = [];
        $this->module_url_path     = url(config('app.project.admin_panel_slug')."/stripe");
        $this->module_title        = "Stripe";
        $this->module_view_folder  = "admin.stripe";
        $this->admin_panel_slug    = config('app.project.admin_panel_slug');
    }

    public function setting()
    {
        $this->arr_view_data['page_title'] = 'Settings';
        $arr_stripe_settings = array();

    	$user = Sentinel::check();

    	if($user):
    		if($user->inRole('admin')):
    			
                $arr_stripe = $this->StripeSettingsModel->where('id',1)->first();
                if($arr_stripe):
                    $arr_stripe_settings = $arr_stripe->toArray();
                endif;
               
                $this->arr_view_data['arr_data']        = $arr_stripe_settings;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/setting',$this->arr_view_data);

            else:
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            endif;
        else:
        	Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        endif;
    }

    public function setting_process(request $request)
    {
        $arr_data['oauth'] = $request->input("oauth");
        $status = $this->StripeSettingsModel->where('id',1)->update($arr_data);
        if($status):
            Flash::success(str_singular($this->module_title).' Updated Successfully.'); 
        else:
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
        endif;

        return redirect()->back();
    }
}
