<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalGeneralModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "medical_general";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'name',
                                'slug',
                                'status'
                            ];
}
