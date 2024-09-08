<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlanModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table      = "dod_pricing_page";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'title_1',
                                'description_1',
                                'title_2',
                                'description_2',   
                                'title_3',
                                'description_3'                     
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
