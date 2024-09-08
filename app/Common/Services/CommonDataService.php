<?php

namespace App\Common\Services;

use App\Models\ConsultationModel;
use App\Models\ConsultationTransactionModel;
use App\Models\SubscriptionTransactionModel;

use DB;

class CommonDataService
{

    /*------------------------------------------------------------------------------
    | Encodes bcrypt value
    --------------------------------------------------------------------------------*/

    function encrypt_value($value = false)
    {
        $encrypted = null;
        
        if( !empty($value) && $value != null ):
            $encrypted = encrypt($value);
        endif;

        return $encrypted;
    }



    /*------------------------------------------------------------------------------
    | Decodes bcrypt value
    --------------------------------------------------------------------------------*/

    function decrypt_value($value = false)
    {
        $decrypted = null;
        
        if( !empty($value) && $value != null ):
            $decrypted = decrypt($value);
        endif;

        return $decrypted;
    }


    

    function get_consultation_id()
    {
        $consultation_id = "C00001";
        $count_consultation = ConsultationModel::count();
        
        if($count_consultation > 0):
            
            //get the last consultation_id
            $get_id = ConsultationModel::latest()->first();
            if($get_id):
                $new_id = substr($get_id->consultation_id, 1);
                $consultation_id = "C".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
            endif;

        endif;

        return $consultation_id;
    }


    function get_stransaction_id()
    {
        $stransaction_id = "ST00001";
        $count_stransaction = SubscriptionTransactionModel::count();
        
        if($count_stransaction > 0):
            
            //get the last consultation transaction id
            $get_id = SubscriptionTransactionModel::latest()->first();
            if($get_id):
                $new_id = substr($get_id->invoice_no, 2);
                $stransaction_id = "ST".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
            endif;

        endif;

        return $stransaction_id;
    }


    function get_ctransaction_id()
    {
        $ctransaction_id = "CT00001";
        $count_ctransaction = ConsultationTransactionModel::count();
        
        if($count_ctransaction > 0):
            
            //get the last consultation transaction id
            $get_id = ConsultationTransactionModel::latest()->first();
            
            if($get_id):
                $new_id = substr($get_id->invoice_no, 2);
                $ctransaction_id = "CT".str_pad($new_id+1, 5, '0', STR_PAD_LEFT);
            endif;

        endif;

        return $ctransaction_id;
    }

}
?>