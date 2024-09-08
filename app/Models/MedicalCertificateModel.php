<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalCertificateModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "medical_certificate";
    protected $primaryKey = "id";

    protected $fillable   = [
    						  'user_id',
    						  'patient_id',
    						  'user_type',
    						  'doctor_id',
    						  'file_name'
                            ];
}
