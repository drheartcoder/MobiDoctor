<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "invitation";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'user_id',
    							'name',
    							'email',
    							'is_mail_send'
    						];

    public function user_details()
    {
        return $this->BelongsTo('App\Models\UserModel','user_id','id');
    }  

    public function is_user_register()
    {
        return $this->BelongsTo('App\Models\UserModel','email','email')->select('id','email');
    }  
}
