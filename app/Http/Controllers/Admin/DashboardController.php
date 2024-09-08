<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StaticPagesModel;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->arr_view_data = [];

        $this->UserModel        = new UserModel();
        $this->StaticPagesModel = new StaticPagesModel();
	}
    public function index()
    {
        $patient_count = $this->UserModel->where('user_type','=','patient')->count();
        $doctor_count = $this->UserModel->where('user_type','=','doctor')->count();
        $sub_admin_count = $this->UserModel->where('user_type','=','sub-admin')->count();
        $static_page_count = $this->StaticPagesModel->count();

        $this->arr_view_data['patient_count'] = $patient_count;
        $this->arr_view_data['doctor_count'] = $doctor_count;
        $this->arr_view_data['sub_admin_count'] = $sub_admin_count;
        $this->arr_view_data['static_page_count'] = $static_page_count;
    	$this->arr_view_data['page_title'] = 'Dashboard';
    	return view('admin.dashboard.index',$this->arr_view_data);
    }
}
