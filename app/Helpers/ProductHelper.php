<?php

namespace App\Helpers;



use App\Models\Product;

class ProductHelper
{

    public function getFeaturedProducts()
    {
        return Product::where('featured_products',1)->get()->take(12);

    }


    public function getProducts($ids)
    {
        return Product::whereIn('id',$ids)->get()->take(12);

    }


}