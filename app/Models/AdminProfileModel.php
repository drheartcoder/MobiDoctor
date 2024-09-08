<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProfileModel extends Model
{
	
	protected $dates = ['created_at','updated_at'];
    protected $table      = "admin_profile";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'name',
    							'contact_email',
    							'contact_no',
    							'fax',
                                'address',
    							'abn',
                                'acn',
    							'profile_pic'
    						];
    public function user_details()
    {
        return $this->BelongsTo('App\Models\UserModel','user_id','id');
    }                        
}
