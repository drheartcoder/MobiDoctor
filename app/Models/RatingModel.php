<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates      = ['created_at','updated_at'];
    protected $table      = "rating";
    protected $primaryKey = "id";

    protected $fillable   = [
                                'user_id',
                                'doctor_id',
                                'consult_id',
                                'rating',
                                'feedback',
                                'status'
                            ];

    public function patient_details()
    {
        return $this->BelongsTo('App\Models\UserModel','user_id','id');
    }  

    public function doctor_details()
    {
        return $this->BelongsTo('App\Models\UserModel','doctor_id','id');
    }  
}
