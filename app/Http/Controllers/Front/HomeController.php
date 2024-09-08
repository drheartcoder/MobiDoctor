<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SubscriptionPlanModel;

class HomeController extends Controller
{
	public function __construct()
	{
        $this->arr_view_data      = [];
        $this->module_title       = "Home";
        $this->module_view_folder = "front";

        $this->SubscriptionPlanModel   = new SubscriptionPlanModel();
	}

    public function index()
    {
        $arr_subscription_plan = [];
        $obj_subscription_plan = $this->SubscriptionPlanModel->get();
        if($obj_subscription_plan)
        {
            $arr_subscription_plan = $obj_subscription_plan->toArray();
        }

        $this->arr_view_data['page_title']  = 'Home | '.config('app.project.name');
        $this->arr_view_data['arr_subscription_plan']  = $arr_subscription_plan;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

}
