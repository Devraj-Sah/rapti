<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class ProductCategory extends Model
{
    use NodeTrait;

    protected $table = 'product_categories';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'side_banner',
        'feature',
        'thumbnail',
        'description',
        'parent_id',
        'status',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'position'
    ];

    // loads only direct children - 1 level
    public function childs()
    {
        return $this->hasMany('App\Models\ProductCategory','parent_id','id')->orderBy('position','ASC') ;
    }



    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
        // which is equivalent to:
        // return $this->hasMany('Survey', 'parent')->with('childrenRecursive);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id');
    }



    // all ascendants
    public function parentRecursive()
    {
        return $this->parents()->with('parentRecursive');
    }
}