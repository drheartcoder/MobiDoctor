<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "prescription";
    protected $primaryKey = "id";
    protected $fillable   = [
    							'user_id',
                                'doctor_id',
                                'consult_id',
    							'name',
    							'repeats',
    							'direction'
    						];

    public function doctor_details()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id')->select('id','first_name','last_name');
    }

    public function consult_details()
    {
        return $this->belongsTo('App\Models\ConsultationModel','consult_id','id')->select('id','consultation_id','user_id','who_is_patient','patient_id');
    }                        
}
