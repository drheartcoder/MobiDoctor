<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StripeSettingsModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "stripe_settings";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'oauth',
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
