<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationTransactionModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "consultation_transaction";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'user_id',
                                'doctor_id',
                                'call_duration',
                                'consultation_id',
                                'invoice_no',
                                'transaction_id',
                                'amount',
                                'discount_id',
                                'discount_amount',
                                'paid_amount',
                                'status'
                            ];

    public function discount_details()
    {
        return $this->BelongsTo('App\Models\DiscountCodeModel','discount_id','id');
    }

    public function user_details()
    {
        return $this->BelongsTo('App\Models\UserModel','user_id','id');
    }                        
}