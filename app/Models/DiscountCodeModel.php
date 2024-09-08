<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCodeModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "discount_code";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'code',
                                'price',
                                'start_date',
                                'end_date',
                                'status'
                            ];
}