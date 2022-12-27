<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $table = "global_settings";
    protected $fillable = [
    		'site_name',
            'site_nepali_name',
    		'site_email',
    		'phone',
    		'website_full_address',
    		'page_title',
    		'page_keyword',
    		'page_description',
    		'favicon',
    		'site_logo',
    		'site_logo_nepali',
    		'instagram_link',
    		'facebook_link',
    		'twitter_link',
    		'youtube_link',
    		'site_status',
            'extra_one',
            'extra_tow'
    ];
}
