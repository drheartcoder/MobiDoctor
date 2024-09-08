<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSubCategoryDetailsModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "cms_sub_category_details";
    protected $primaryKey = "id";

    protected $fillable   = [	
                                'category_id',
    							'sub_category_id',
                                'is_investigation_details',
                                'tab_name',
                                'tab_slug',
                                'meta_title',
                                'meta_keyword',
                                'meta_desc'
    						];

    public function get_question_answer()
    {
    	 return $this->hasMany('App\Models\CmsQuestionAnswerModel','sub_category_details_id','id');
    }

    public function category_details()
    {
         return $this->BelongsTo('App\Models\CMSCategoryModel','category_id','id');
    }

    public function sub_category_details()
    {
         return $this->BelongsTo('App\Models\CMSSubCategoryModel','sub_category_id','id');
    }
}
