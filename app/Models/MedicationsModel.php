<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "medication";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'name',
    							'medication_file',
    							'date',
    							'frequency',
    							'medication_use'
    						];
}
