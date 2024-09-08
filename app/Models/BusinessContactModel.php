<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessContactModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "contact_for_business";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'company_name',
    							'email',
    							'phone_no',
    							'employee',
    							'cost_due'
    						];
}
