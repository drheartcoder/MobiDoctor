<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SubscriptionPlanModel;

use Validator;
use Flash;
use Sentinel;
use Session;


/*-------------------------------Prashant Patil(22th aug 2017)---------------------------*/
class SubscriptionController extends Controller
{
     public function __construct()
    {
        $this->SubscriptionPlanModel = new SubscriptionPlanModel();

        $this->arr_view_data          = [];
        $this->module_url_path        = url(config('app.project.admin_panel_slug')."/subscription_plan");
        $this->module_title           = "Subscription Plan";
        $this->module_view_folder     = "admin.subscription_plan";
        $this->admin_panel_slug       = config('app.project.admin_panel_slug');
    }

    public function index()
    {
        $arr_subscription_plan = array();
        $this->arr_view_data['page_title'] = str_singular($this->module_title);

        $user = Sentinel::check();
        if($user)
        {
            if($user->inRole('admin'))
            {
                $obj_subscription_plan =  $this->SubscriptionPlanModel->get();
                if($obj_subscription_plan)
                {
                    $arr_subscription_plan = $obj_subscription_plan->toArray();
                }

                $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
                $this->arr_view_data['module_url_path']       = $this->module_url_path;
                $this->arr_view_data['module_title']          = str_singular($this->module_title);

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

    public function edit($enc_id=FALSE)
    {
        $arr_subscription_plan = [];
        if($enc_id)
        {
            $plan_id = base64_decode($enc_id);
            $obj_subscription_plan = $this->SubscriptionPlanModel->where('id','=',$plan_id)->first();
            if($obj_subscription_plan)
            {
                $arr_subscription_plan = $obj_subscription_plan->toArray();
            }

            $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
            $this->arr_view_data['module_url_path']       = $this->module_url_path;
            $this->arr_view_data['module_title']          = str_singular($this->module_title);
            $this->arr_view_data['page_title']            = 'Edit '.str_singular($this->module_title);
            $this->arr_view_data['enc_id']            = $enc_id;
            return view($this->module_view_folder.'/edit',$this->arr_view_data);

        }
        else
        {
            Flash::error('Something went wrong,Please try again.');
            return redirect()->back();
        }
    }

    public function update(Request $request,$enc_id='')
    {
        //dd($request->all());
        $arr_rules = [];
        if($enc_id)
        {
            $arr_rules['name']             = 'required';
            //$arr_rules['price']            = 'required';
            $arr_rules['monthly_price']    = 'required';
            $arr_rules['total_price']     = 'required';
            $arr_rules['prescription_fee'] = 'required';
            $arr_rules['sick_note']        = 'required';
            $arr_rules['referrals']        = 'required';
            $arr_rules['consultation_price'] = 'required';
            $validator                     = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                 return back()->withErrors($validator)->withInput();
            }

            $monthly_price = trim($request->input('monthly_price','0'));
          

            $arr_data['name']               = trim($request->input('name'));
            $arr_data['price']              = $monthly_price;
            $arr_data['monthly_price']      = $monthly_price;
            $arr_data['yearly_price']       = trim($request->input('total_price','0'));
            $arr_data['prescription_fee']   = trim($request->input('prescription_fee','0'));
            $arr_data['sick_note']          = trim($request->input('sick_note','0'));
            $arr_data['referrals']          = trim($request->input('referrals','0'));
            $arr_data['consultation_price'] = trim($request->input('consultation_price','0'));

            $plan_id = base64_decode($enc_id);
            $status = $this->SubscriptionPlanModel->where('id','=',$plan_id)->update($arr_data);
            if($status)
            {
                Flash::success($this->module_title.' updated successfully.');
                return redirect()->back();
            }
            else
            {
                Flash::error('Problem occur,while update '.$this->module_title);
                return redirect()->back();
            }
        }
        else
        {
            Flash::error('Something went wrong,Please try again.');
            return redirect()->back();
        }
    }
}   
