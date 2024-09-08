<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationModel extends Model
{
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "user_notification";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'from_user_id',
                                'to_user_id',
                                'message',
                                'notification_url',
                                'is_read'
                            ];

   	public function user_details()
    {
        return $this->belongsTo('App\Models\UserModel','from_user_id','id');
    }
}
