<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "contact_us";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'user_type',
    							'name',
    							'email',
                                'phone_code',
    							'mobile_no',
                                'message'
    						];
}
