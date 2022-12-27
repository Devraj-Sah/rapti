<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = [
    		'name',
    		'email',
    		'blog_id',
    		'subject',
    		'comment',
    		'status'
    ];
}