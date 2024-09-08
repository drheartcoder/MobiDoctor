<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettingsModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "dod_site_status";
    protected $primaryKey = "site_id";

    protected $fillable   = [   
                                'site_status',
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
