<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPagesModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];
    protected $table      = "static_pages";
    protected $primaryKey = "id";

    protected $fillable   = [   
                                'page_name',
                                'page_slug',
                                'page_title',
                                'page_desc',
                                'meta_title',
                                'meta_keyword',
                                'meta_title',
                                'meta_desc',
                                'page_status',

                                                   
                            ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
