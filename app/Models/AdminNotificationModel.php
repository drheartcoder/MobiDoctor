<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdminNotificationModel extends Model
{
    
	protected $dates      = ['created_at','updated_at'];
    protected $table      = "admin_notification";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'from_user_id',
                                'message',
                                'notification_url',
                                'is_read'
                            ];
 }
