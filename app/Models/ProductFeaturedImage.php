<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeaturedImage extends Model
{
    protected $table = 'product_feature_images';

    protected $fillable = [
        'product_id',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
