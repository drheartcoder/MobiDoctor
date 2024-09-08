<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SubscriptionTransactionModel;
use App\Models\ConsultationTransactionModel;

use Sentinel;
use Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->SubscriptionTransactionModel  = new SubscriptionTransactionModel();
        $this->ConsultationTransactionModel  = new ConsultationTransactionModel();
    	
        $this->arr_view_data             = [];
        $this->module_title              = "My Transactions";
        $this->parent_url_path           = url('/').'/patient';
        $this->module_url_path           = url('/').'/patient/transactions';
        $this->module_view_folder        = "front.patient.my_transactions";
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

    public function index(Request $request)
    {
        $transaction_type = \Request::segment(3);
        $arr_transactions = [];
        $view_path        = '';
        $arr_paginate     = null;

        if(isset($transaction_type) && $transaction_type=='subscription') {
            
            $obj_transaction = $this->SubscriptionTransactionModel
                                                ->where('user_id',$this->user_id)
                                                ->orderBy('id','Desc')
                                                ->paginate(10);                
            
            $view_path             = '.subscription';
            $breadcrum_level_3     = 'Subscription';
            $breadcrum_level_3_url = '/subscription';
        }
        elseif(isset($transaction_type) && $transaction_type=='consultation') {            
            
            $obj_transaction = $this->ConsultationTransactionModel
                                                ->where('user_id',$this->user_id)
                                                ->orderBy('id','Desc')
                                                ->paginate(10);
            
            $view_path             = '.consultation';
            $breadcrum_level_3     = 'Consultation';                                                
            $breadcrum_level_3_url = '/consultation';
        }

        if(isset($obj_transaction) && $obj_transaction!=null) {
            $arr_paginate     = clone $obj_transaction;
            $arr_transactions = $obj_transaction->toArray();
        }

        $this->arr_view_data['arr_pagination']         = isset($arr_paginate)?$arr_paginate:null;
        $this->arr_view_data['transaction_type']       = $transaction_type;
        $this->arr_view_data['arr_transactions']       = $arr_transactions;
        $this->arr_view_data['breadcrum_level_1']      = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']      = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']      = $breadcrum_level_3;
        $this->arr_view_data['breadcrum_level_1_url']  = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']  = $this->breadcrum_level_2_url.$breadcrum_level_3_url;
        $this->arr_view_data['page_title']             = 'My Transactions';
        $this->arr_view_data['module_url_path']        = $this->module_url_path;
    
    	return view($this->module_view_folder.$view_path, $this->arr_view_data);
    }

    public function view_transaction(Request $request)
    {
        $arr_transactions  = [];
        $transaction_type  = \Request::segment(3);
        $id = base64_decode($request->input('id'));

        if(isset($transaction_type) && $transaction_type=='subscription') {
            
            $obj_transaction = $this->SubscriptionTransactionModel
                                                ->with('discount_details')
                                                ->where('id',$id)
                                                ->first();                
            
            $view_path             = '.view_subscription';
            $breadcrum_level_3     = 'Subscription';
            $breadcrum_level_3_url = '/subscription';
        }
        elseif(isset($transaction_type) && $transaction_type=='consultation') {            
            
            $obj_transaction = $this->ConsultationTransactionModel
                                                ->with('discount_details')
                                                ->where('id',$id)
                                                ->first();
            
            $view_path             = '.view_consultation';
            $breadcrum_level_3     = 'Consultation';                                                
            $breadcrum_level_3_url = '/consultation';
        }

        if(isset($obj_transaction) && $obj_transaction!=null) {
            $arr_transactions = $obj_transaction->toArray();
        }
        
        $this->arr_view_data['transaction_type']       = $transaction_type;
        $this->arr_view_data['arr_transactions']       = $arr_transactions;
        $this->arr_view_data['breadcrum_level_1']      = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']      = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']      = $breadcrum_level_3;
        $this->arr_view_data['breadcrum_level_1_url']  = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']  = $this->breadcrum_level_2_url.$breadcrum_level_3_url;
        $this->arr_view_data['breadcrum_level_4']      = 'View';
        $this->arr_view_data['breadcrum_level_4_url']  = $this->breadcrum_level_2_url.$breadcrum_level_3_url.'/view_transaction?id='.$request->input('id');
        $this->arr_view_data['page_title']             = 'My Transactions';
        $this->arr_view_data['module_url_path']        = $this->module_url_path;    
        
        return view($this->module_view_folder.$view_path, $this->arr_view_data);        
    }
}
