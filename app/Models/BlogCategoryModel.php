<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "blog_category";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'name',
    							'slug',
    							'status'
    						];
}
