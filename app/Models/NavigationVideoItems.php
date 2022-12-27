<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationVideoItems extends Model
{
	protected $table = 'navigation_items';
    protected $fillable = [
    	'navigation_id','sort','name','name_nepali','link','content','content_nepali','file','extra_one','extra_two'
    ];
}
