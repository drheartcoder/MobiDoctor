<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCommentsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "blog_comments";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'blog_id',
    							'user_id',
    							'comment',
                                'status'
    						];

    public function user_details()
    {
         return $this->BelongsTo('App\Models\UserModel','user_id','id')->select('id','first_name','last_name','profile_image','user_type','social_login');
    }
}
