<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "faq";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'question',
                                'answer',
                                'user_type',
                                'status'
                            ];
}
