<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalCertificateReason extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "medical_certificate_reason";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'reason'
                            ];
}
