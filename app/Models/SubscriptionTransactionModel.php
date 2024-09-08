<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTransactionModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "subscription_transaction";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'user_id',
                                'invoice_no',
                                'transaction_id',
                                'sp_amount',
                                'discount_id',
                                'discount_amount',
                                'paid_amount',
                                'start_date',
                                'end_date',
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
