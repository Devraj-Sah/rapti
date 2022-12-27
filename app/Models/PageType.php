<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $table = "page_types";
    protected $fillable = [
        'page_type_title'
    ];
}
