<?php

namespace App\Helpers;

use App\Models\Catalogue;
use App\Models\ProductCategory;

class CategoryHelper
{

    public function getCategoriesForDropdown()
    {
        $categories = ProductCategory::all();
        return $categories->pluck('name', 'id');
    }

    public function getCatalogueForDropdown()
    {
        $catalogues = Catalogue::all();
        return $catalogues->pluck('name', 'id');
    }

    public function getCategorySideBanner()
    {
        return ProductCategory::where('side_banner', 1)->orderBy('id','desc')->get()->take(2);

    }

    public function getCategoryFeature()
    {
        return ProductCategory::where('feature', 1)->orderBy('id','desc')->get()->take(3);

    }

    public function getCategorylist($total)
    {
        return ProductCategory::orderBy('code','asc')->get()->take($total);

    }
}