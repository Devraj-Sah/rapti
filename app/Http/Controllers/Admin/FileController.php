<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class FileController extends Controller
{

    public function importExportExcelORCSV()
    {
        return view('admin.cart.categories.file_import_export');
    }

    public function importFileIntoDB(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = [
                        'name' => $value->name,
                        'slug' => Str::slug($value->name),
                        'thumbnail' => '',
                        'description' => '',
                        'parent_id' => $value->parent_id?$value->parent_id:0,
                        'status' => 1,
                        'order' => '',
                        'meta_title' => '',
                        'meta_description' => '',
                        'meta_keywords' => '',
                        'created_at' => '',
                        'updated_at' => '',
                        'deleted_at' => '',
                    ];
                }
                if (!empty($arr)) {
                    \DB::table('product_categories')->insert($arr);
                    return redirect()->route('product-categories.index')->with('success','Insert Record successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');
    }

    public function importExportProductExcelORCSV()
    {
        return view('admin.cart.products.file_import_export');
    }

    public function importProductsFileIntoDB(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = [
                        'category_id'=> $value->category_id,
                        'name'=> $value->name,
                        'slug'=> Str::slug($value->name),
                        'description'=> '',
                        'short_desc'=> '',
                        'thumbnail'=> '',
                        'price'=> '',
                        'compare_price'=> '',
                        'quantity' => 0,
                        'status'=> 1,
                        'order'=> 0,
                        'meta_title'=> '',
                        'meta_description'=> '',
                        'meta_keywords'=> '',
                        'featured_products'=> '',
                        'popular_product'=> '',
                        'hot_deal'=> '',
                        'item'=> '',
                        'created_at' => '',
                        'updated_at' => '',
                        'deleted_at' => '',
                    ];
                }
                if (!empty($arr)) {
                    \DB::table('products')->insert($arr);
                    return redirect()->route('products.index')->with('success','Insert Record successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');
    }
}
