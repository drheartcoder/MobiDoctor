<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   

    protected $dates      = ['created_at','updated_at'];
    protected $table      = "consultation";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'consultation_id',
                                'user_id',
                                'who_is_patient',
                                'patient_id',
                                'doctor_id',
                                'date',
                                'time',
                                'plan',
                                'illness',
                                'description',
                                'image',
                                'notes',
                                'payment',
                                'patient_video',
                                'doctor_video',
                                'doctor_call_duration',
                                'patient_call_duration',
                                'is_completed',
                                'status'
                            ];

    public function subscription_plan()
    {
        return $this->belongsTo('App\Models\SubscriptionPlanModel','plan','id')->select('id', 'name', 'slug', 'price', 'consultation_price');
    }

    public function user_details()
    {
        return $this->belongsTo('App\Models\UserModel','user_id','id');
    }

    public function doctor_details()
    {
        return $this->belongsTo('App\Models\UserModel','doctor_id','id')->select('id','user_type','first_name','last_name','email','phone_code','mobile_no','contact_no','gender','address','prefix','profile_image');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\ConsultationTransactionModel','consultation_id','consultation_id');
    }

    public function prescription_details()
    {
        return $this->hasMany('App\Models\PrescriptionModel','consult_id','consultation_id');
    }

    public function category_name()
    {
        return $this->belongsTo('App\Models\CMSCategoryModel','illness','id');
    }
}