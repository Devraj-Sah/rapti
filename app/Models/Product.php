<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'short_desc',
        'description',
        'price',
        'compare_price',
        'category_id',
        'thumbnail',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_products',
        'popular_product',
        'hot_deal',
        'item',
        'pdf_file'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductFeaturedImage', 'product_id', 'id');
    }

    public function setItemAttribute($value)
    {
        $this->attributes['item'] = json_encode($value);
    }

    public function getItemAttribute($value)
    {
        return $this->attributes['item'] = json_decode($value);
    }
}
