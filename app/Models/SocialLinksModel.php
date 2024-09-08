<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinksModel extends Model
{
    protected $table = "social_links_master";
    protected $primaryKey = "id";
    protected $fillable = [
    						"facebook_link",
    						"twitter_link",
    						"linkedin_link",
    						"instagram_link",
    						"pinterest_link"	
    					];
}
