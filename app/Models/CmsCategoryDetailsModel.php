<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsCategoryDetailsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "cms_category_details";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'category_id',
                                'meta_title',
                                'meta_keyword',
                                'meta_desc',
    							'common',
    							'symptoms',
    							'causes',
    							'treatment_prevention',
                                'is_investigation_details',
                                'description'
    						];

    public function category_details()
    {
         return $this->BelongsTo('App\Models\CMSCategoryModel','category_id','id');
    }
}
