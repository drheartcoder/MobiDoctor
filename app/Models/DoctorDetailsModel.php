<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDetailsModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "doctor_details";
    protected $primaryKey = "id";

    protected $fillable   = [
    							'user_id',
                                'admin_verified',
    							'clinic_name',
    							'clinic_address',
    							'clinic_city',
    							'clinic_country',
    							'clinic_postal_code',
    							'clinic_lat',
    							'clinic_lng',
    							'clinic_email',
    							'clinic_phone_code',
    							'clinic_mobile_no',
                                'clinic_contact_no',
    							'experience',
                                'language',
                                'medical_qualification',
                                'medical_school',
                                'year_obtained',
                                'country_obtained',
                                'other_qualifications',
                                'bank_name',
                                'bank_account_name',
                                'bank_account_no',
                                'driving_licence',
                                'medical_registration',
                                'medicare_provider_no',
                                'prescriber_no',
                                'ahpra_registration_no'
    						];
}
