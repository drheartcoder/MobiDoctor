<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "subscription_plan";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'name',
                                'slug',
                                'price',
                                'consultation_price',
                                'monthly_price',
                                'yearly_price',
                                'prescription_fee',
                                'sick_note',
                                'referrals',
                                'is_membership_discount'
                            ];   
}