<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "blog";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'title',
    							'slug',
    							'short_description',
    							'description',
    							'image',
    							'posted_by',
    							'date',
    							'status',
    							'meta_title',
    							'meta_keyword',
    							'meta_desc',
                                'view_count'
    						];

    public function category_details()
    {
         return $this->hasMany('App\Models\BlogCategoryDetailsModel','blog_id','id');
    }

    public function blog_comment()
    {
         return $this->hasMany('App\Models\BlogCommentsModel','blog_id','id');
    }


}
