<?php

namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ConsultationTransactionModel;

use Sentinel;
use Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->ConsultationTransactionModel  = new ConsultationTransactionModel();
    	
        $this->arr_view_data             = [];
        $this->module_title              = "My Transactions";
        $this->parent_url_path           = url('/').'/doctor';
        $this->module_url_path           = url('/').'/doctor/transactions';
        $this->module_view_folder        = "front.doctor.my_transactions";
        $this->breadcrum_level_1         = 'Dashboard';
        $this->breadcrum_level_2         = $this->module_title;
        $this->breadcrum_level_1_url     = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url     = $this->module_url_path;
        $user                            = Sentinel::check();
        $this->user_id                   = '';
        if($user)
        {
           $this->user_id = $user->id;
        }
    }

    public function transactions(Request $request)
    {
        $arr_transactions = [];
        $arr_paginate     = null;
        
        $obj_transaction = $this->ConsultationTransactionModel
                                            ->where('doctor_id',$this->user_id)
                                            ->orderBy('id','Desc')
                                            ->paginate(10);                
        
        if(isset($obj_transaction) && $obj_transaction!=null) {
            $arr_paginate     = clone $obj_transaction;
            $arr_transactions = $obj_transaction->toArray();
        }

        $this->arr_view_data['arr_pagination']         = isset($arr_paginate)?$arr_paginate:null;
        $this->arr_view_data['arr_transactions']       = $arr_transactions;
        $this->arr_view_data['breadcrum_level_1']      = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']      = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_1_url']  = $this->breadcrum_level_1_url;
        $this->arr_view_data['page_title']             = 'My Transactions';
        $this->arr_view_data['module_url_path']        = $this->module_url_path;
    
    	return view($this->module_view_folder.'.transactions', $this->arr_view_data);
    }

    public function view_transaction(Request $request)
    {
        $arr_transactions  = [];
        $id = base64_decode($request->input('id'));            
            
        $obj_transaction = $this->ConsultationTransactionModel
                                            ->with('discount_details')
                                            ->where('id',$id)
                                            ->orderBy('id','Desc')
                                            ->first();
        
        if(isset($obj_transaction) && $obj_transaction!=null) {
            $arr_transactions = $obj_transaction->toArray();
        }
        
        $this->arr_view_data['arr_transactions']       = $arr_transactions;
        $this->arr_view_data['breadcrum_level_1']      = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']      = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']      = 'View';
        $this->arr_view_data['breadcrum_level_1_url']  = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']  = $this->breadcrum_level_2_url.'/view_transaction?id='.$request->input('id');
        $this->arr_view_data['page_title']             = 'My Transactions';
        $this->arr_view_data['module_url_path']        = $this->module_url_path;    
        
        return view($this->module_view_folder.'.view_transactions',$this->arr_view_data);        
    }
}
