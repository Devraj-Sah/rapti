<?php

namespace App\Helpers;


use App\Models\Navigation;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class FrontendHelper
{
    public function getPagesBySlug($alias)
    {
        return Navigation::where('alias', $alias)->first();
    }
    public function getPagesById($id)
    {
        return Navigation::where('id', $id)->first();
    }
    public function getProductsByCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        if ($category) {
            return $category->products()->orderBy('id', 'Desc')->get();
        }
        return null;
    }

    public function getNavigationListByParent($parent_id)
    {
        return Navigation::where('parent_page_id',$parent_id)->orderBy('id','asc')->get();
    }
    public function getLatestChild($parent_id)
    {
        return Navigation::where('parent_page_id',$parent_id)->orderBy('id','desc')->first();
    }
    // public function getallCatlog($parent_id) #devraj
    // {
    //     return Navigation::where('parent_page_id',$parent_id)->orderBy('id','desc')->get();
    // }
    public function getAllCategories()
    {
        return ProductCategory::where('parent_id',0)->get();
    }

    public function getnotification()
    {
        return count(Order::where('customer_id',Auth::user()->id )->where('is_notify',1)->get());
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function getFeaturedProducts()
    {
        return Product::where('featured_products',1)->orderBy('id', 'Desc')->get();
    }

    public function getPagesByPageType($alias, $page_type)
    {
        return Navigation::where('alias', $alias)->where('page_type', $page_type)->first();
    }

    public function getSimilarProductByCategory($category_id)
    {
        return Product::where('category_id',$category_id)->orderBy('id','desc')->get();
    }

    public function getProductsBySlug($alias)
    {
        return Product::where('slug', $alias)->first();
    }
    
     public function getProductsByCategoryID($id)
    {
        $category = ProductCategory::where('id', $id)->first();
        if ($category) {
            return $category->products()->orderBy('id', 'Desc')->get();
        }
        return null;
    }
}