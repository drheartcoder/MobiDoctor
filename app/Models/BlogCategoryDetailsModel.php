<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryDetailsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "blog_category_details";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'blog_id',
    							'category_id'
    						];

    public function blog_category_details()
    {
         return $this->BelongsTo('App\Models\BlogCategoryModel','category_id','id');
    }
}
