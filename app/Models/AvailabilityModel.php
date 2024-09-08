<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "availability";
    protected $primaryKey = "id";
    protected $fillable   = [
    							'doctor_id',
    							'start_datetime',
    							'end_datetime',
    							'start_date',
						        'end_date',
						        'start_time',
						        'end_time',
    						];

    public function consultation_details()
    {
        return $this->hasMany('App\Models\ConsultationModel','doctor_id','doctor_id')->select("id", "consultation_id", "user_id", "who_is_patient", "patient_id", "doctor_id", "date", "time", "is_completed");
    }

    public function doctor_details()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id');
    }

}
