<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SubscriptionTransactionModel;
use App\Models\ConsultationTransactionModel;
class TransactionController extends Controller
{
    public function __construct()
    {
        $this->SubscriptionTransactionModel             = new SubscriptionTransactionModel();
        $this->ConsultationTransactionModel             = new ConsultationTransactionModel();
        $this->arr_view_data                            = [];
        $this->module_url_path                          = url(config('app.project.admin_panel_slug')."/transactions");
        $this->module_title                             = "Transactions";
        $this->module_view_folder                       = "admin.transactions";
        $this->admin_panel_slug                         = config('app.project.admin_panel_slug');
        $this->patient_transaction_invoice_base_path    = base_path().config('app.img_path.transaction_invoice');
        $this->patient_transaction_invoice_public_path  = url('/').config('app.img_path.transaction_invoice');
    }

    public function subscription_transactions()
    {
        $arr_transaction = [];
        $obj_transaction = $this->SubscriptionTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->orderBy('id','Desc')
                                                ->get();
        
        if(isset($obj_transaction) && $obj_transaction!=null)
        {
            $arr_transaction = $obj_transaction->toArray();
        }
            
        $this->arr_view_data['invoice_transaction_base_pth']   = $this->patient_transaction_invoice_base_path;
        $this->arr_view_data['invoice_transaction_public_pth'] = $this->patient_transaction_invoice_public_path;
        $this->arr_view_data['arr_transaction']                = $arr_transaction;
        $this->arr_view_data['module_url_path']                = $this->module_url_path.'/subscription_transactions';
        $this->arr_view_data['module_title']                   = str_singular($this->module_title);
        $this->arr_view_data['page_title']                     = 'Subscription'.' '.str_singular($this->module_title);
        
        return view($this->module_view_folder.'/subscription_transaction',$this->arr_view_data);
    }

    public function consultation_transactions()
    {
        $arr_transaction = [];
        $obj_transaction = $this->ConsultationTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->orderBy('id','Desc')
                                                ->get();    

        if(isset($obj_transaction) && $obj_transaction!=null)
        {
            $arr_transaction = $obj_transaction->toArray();
        }
        $this->arr_view_data['invoice_transaction_base_pth']   = $this->patient_transaction_invoice_base_path;
        $this->arr_view_data['invoice_transaction_public_pth'] = $this->patient_transaction_invoice_public_path;
        $this->arr_view_data['arr_transaction']                = $arr_transaction;
        $this->arr_view_data['module_url_path']                = $this->module_url_path.'/consultation_transactions';
        $this->arr_view_data['module_title']                   = str_singular($this->module_title);
        $this->arr_view_data['page_title']                     = 'Consultation'.' '.str_singular($this->module_title);
        
        return view($this->module_view_folder.'/consultation_transaction',$this->arr_view_data);
    }
}
