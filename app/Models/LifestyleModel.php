<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifestyleModel extends Model
{
   	protected $dates = ['created_at','updated_at'];
    protected $table      = "lifestyle";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'smoking',
    							'exercise',
    							'alcohol',
                                'stress_level',
    							'marital_status'
    						];
}
