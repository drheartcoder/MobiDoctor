<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimezoneModel extends Model
{
    protected $table      = "timezone";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'country_code',
    							'coordinates',
    							'location',
    							'location_name',
                                'utc_offset',
    							'utc_dst_offset'
    						];
}
