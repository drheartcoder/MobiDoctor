<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMemberModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "family_member";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'first_name',
    							'last_name',
    							'email',
    							'gender',
                                'relation',
    							'birth_date',
                                'mobile_no',
                                'phone_code'
    						];
}
