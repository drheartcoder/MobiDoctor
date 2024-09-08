<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageModel extends Model
{
    protected $table      = "language";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'language',
    							'status'
    						];
}
