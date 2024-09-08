<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserModel extends CartalystUser
{
    //use SoftDeletes;
   
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "users";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'first_name',
                                'last_name',
                                'email',
                                'user_type',
                                'phone_code',
                                'mobile_no',
                                'new_phone_code',
                                'new_mobile_no',
                                'mobile_otp',
                                'mobile_otp_expired_time',
                                'password',
                                'address',
                                'state',
                                'city',
                                'country',
                                'latitude',
                                'longitude',
                                'gender',
                                'is_online',
                                'status',
                                'is_email_verified',
                                'is_mobile_verified',
                                'verification_token',
                                'last_login',
                                'login_count',
                                'dump_id',
                                'dump_session',
                                'fax_no',
                                'postal_code',
                                'profile_image',
                                'contact_no',
                                'prefix',
                                'timezone',
                                'date_of_birth',
                                'social_login',
                                'view_type',
                                'is_pause',
                                'referral_code',
                                'refer_user_id'
                            ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin_details()
    {
        return $this->BelongsTo('App\Models\AdminProfileModel','id','user_id');
    }

    public function doctor_data()
    {
        return $this->belongsTo('App\Models\DoctorDetailsModel','id','user_id');
    }

    public function doctor_prefix()
    {
        return $this->belongsTo('App\Models\PrefixModel','prefix','id');
    }

    public function timezone_details()
    {
        return $this->belongsTo('App\Models\TimezoneModel','timezone','id');
    }

    public function verification()
    {
        return $this->belongsTo('App\Models\DoctorDetailsModel','id','user_id')->select('user_id','admin_verified');
    }

    public function family_member()
    {
        return $this->hasMany('App\Models\FamilyMemberModel','user_id','id');
    }

    public function life_style_details()
    {
        return $this->belongsTo('App\Models\LifestyleModel','id','user_id');
    }

    public function medication_details()
    {
        return $this->hasMany('App\Models\MedicationsModel','user_id','id');
    }

    public function doctor_details()
    {
        return $this->hasOne('App\Models\DoctorDetailsModel','id','user_id');       
    }
    
}
