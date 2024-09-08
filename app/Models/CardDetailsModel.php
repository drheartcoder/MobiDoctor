<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardDetailsModel extends Model
{
    protected $table = 'card_details';

    protected $fillable = [
                            'user_id',
                            'customer_id',
                            'card_id'
    					  ];
}
