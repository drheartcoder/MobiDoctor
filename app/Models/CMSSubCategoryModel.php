<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSSubCategoryModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "cms_sub_category";
    protected $primaryKey = "id";

    protected $fillable   = [	
                                'category_id',
    							'name',
                                'image',
                                'slug',
                                'status'
    						];

    public function category_details()
    {
    	 return $this->BelongsTo('App\Models\CMSCategoryModel','category_id','id');
    }

    public function sub_category_details()
    {
         return $this->BelongsTo('App\Models\CmsSubCategoryDetailsModel','id','sub_category_id');
    }
}
