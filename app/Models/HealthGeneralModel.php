<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthGeneralModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "health_general";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'medical_general_id'
    						];

    public function general_details()
    {
    	return $this->BelongsTo('App\Models\MedicalGeneralModel','medical_general_id','id');
    }
}
