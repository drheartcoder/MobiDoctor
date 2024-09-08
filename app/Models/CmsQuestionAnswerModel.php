<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsQuestionAnswerModel extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table      = "cms_question_answer";
    protected $primaryKey = "id";

    protected $fillable   = [	
                                'sub_category_details_id',
    							'question',
                                'answer'
    						];

   /* public function category_details()
    {
    	 return $this->BelongsTo('App\Models\CMSCategoryModel','category_id','id');
    }*/
}
