<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationSettingModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "consultation_setting";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'reschedule',
                                'time_interval',
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
