<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\BusinessContactModel;
use App\Models\SubscriptionPlanModel;

use Validator;
use Session;

class StaticPagesController extends Controller
{
    public function __construct()
    {
    	$this->arr_view_data  = [];
    	$this->module_view_folder       = "front.static_pages";

        $this->BusinessContactModel     = new BusinessContactModel();
        $this->SubscriptionPlanModel   = new SubscriptionPlanModel();
    }

    public function contact_us()
    {
        $this->arr_view_data['page_title']  = 'Contact Us | '.config('app.project.name');
        return view($this->module_view_folder.'.contact_us',$this->arr_view_data);
    }

    public function about_us()
    {
        $this->arr_view_data['page_title']  = 'About Us | '.config('app.project.name');
        return view($this->module_view_folder.'.about_us',$this->arr_view_data);
    }

    public function how_it_work()
    {
        $this->arr_view_data['page_title']  = 'How it Works | '.config('app.project.name');
        return view($this->module_view_folder.'.how_it_work',$this->arr_view_data);
    }

    public function for_business()
    {
        $this->arr_view_data['page_title']  = 'For Business | '.config('app.project.name');
        return view($this->module_view_folder.'.for_business',$this->arr_view_data);
    }

    public function pregnancy()
    {
        $this->arr_view_data['page_title']  = 'Pregnancy | '.config('app.project.name');
        return view($this->module_view_folder.'.pregnancy',$this->arr_view_data);
    }

    public function for_doctor()
    {
        $this->arr_view_data['page_title']  = 'For Doctor | '.config('app.project.name');
        return view($this->module_view_folder.'.for_doctor',$this->arr_view_data);
    }

    public function membership()
    {
         $arr_subscription_plan = [];
        $obj_subscription_plan = $this->SubscriptionPlanModel->get();
        if($obj_subscription_plan)
        {
            $arr_subscription_plan = $obj_subscription_plan->toArray();
        }

        $this->arr_view_data['page_title']             = 'Membership | '.config('app.project.name');
        $this->arr_view_data['arr_subscription_plan']  = $arr_subscription_plan;

        $arr_view_data['page_title']  = 'Membership';
        return view($this->module_view_folder.'.membership',$this->arr_view_data);
    }

    public function store_contact_for_business(Request $request)
    {
        $arr_rules  = $return_arr = [];

        $arr_rules['company_name'] = 'required';
        $arr_rules['email']  = 'required';
        $arr_rules['phone_no']    = 'required';
        $arr_rules['employee']    = 'required';
        $arr_rules['cost_due']       = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';

            return response()->json($return_arr);
        }

        $arr_data['company_name'] = encrypt_value(trim($request->input('company_name')));
        $arr_data['email']        = encrypt_value(trim($request->input('email')));
        $arr_data['phone_no']     = encrypt_value(trim($request->input('phone_no')));
        $arr_data['employee']     = encrypt_value(trim($request->input('employee')));
        $arr_data['cost_due']     = encrypt_value(trim($request->input('cost_due')));

        $status = $this->BusinessContactModel->create($arr_data);
        if($status)
        {
            Session::flash('success','Contact details send succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occur,while sending contact details.');
            return response()->json($return_arr);
        }
    }
}
