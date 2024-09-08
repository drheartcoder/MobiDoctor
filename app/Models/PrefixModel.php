<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrefixModel extends Model
{
    protected $table      = "prefix";
    protected $primaryKey = "id";

    protected $fillable   = [	
    							'name'
    						];
}
