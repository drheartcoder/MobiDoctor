<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSCategoryModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "cms_category";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'name',
    							'slug',
    							'image',
    							'status'
    						];

    public function details()
    {
         return $this->BelongsTo('App\Models\CmsCategoryDetailsModel','id','category_id');
    }
}
