<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductFeaturedImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(Request $request,Product $product)
    {

        $this->request = $request;
        $this->model = $product;
    }

    public function index()
    {
        $products  = $this->model->all();


        return view('admin.cart.products.index',[
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.cart.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $count =0;
        $this->validate($request, [
            'category_id' => 'required|not_in:0',
            'name' =>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->featured_products === '1') {
            $data['featured_products'] = 1;
        } else {
            $data['featured_products'] = 0;
        }
        if ($request->popular_product === '1') {
            $data['popular_product'] = 1;
        } else {
            $data['popular_product'] = 0;
        }
        if ($request->hot_deal === '1') {
            $data['hot_deal'] = 1;
        } else {
            $data['hot_deal'] = 0;
        }
        if ($request->hasfile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $path = public_path('uploads/products');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = $imageName;
        }
        if($request->hasFile('pdf_file')){
            $img_file = $request->file('pdf_file');
            $data['pdf_file'] = time().'_'.$img_file->getClientOriginalName();
            $destinationPath = public_path('uploads/products/pdf');
            $img_file->move($destinationPath,$data['pdf_file']);
        }

        $data['slug'] = Str::slug($request->name);
        $model = $this->model->create($data);


        $featuredImages =$request->file('featured_image');
        if ($request->hasfile('featured_image'))
        {
            foreach ($featuredImages as $image)
            {
                $name = time().'_'.$count++ . '.' . $image->extension();
                $path = public_path('uploads/products/featured_image');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $image->move($path, $name);
                $featured_image = $name;


                $product_FeaturedImage = new ProductFeaturedImage();
                $product_FeaturedImage->product_id = $model->id;
                $product_FeaturedImage->image = $featured_image;
                $product_FeaturedImage->save();
            }
        }
        return redirect()->route('products.index')->with('message','Record was successfully saved!!');
    }

    public function edit($id)
    {
        $model = $this->model->find($id);
        return view('admin.cart.products.edit',['model' =>$model]);
    }

    public function update(Request $request, $id)
    {
        $product = $this->model->findOrFail($id);
        $data = $request->all();
        $count =0;
        $this->validate($request, [
            'category_id' => 'required|not_in:0',
            'name' =>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);



        if ($request->featured_products === '1') {
            $data['featured_products'] = 1;
        } else {
            $data['featured_products'] = 0;
        }
        if ($request->popular_product === '1') {
            $data['popular_product'] = 1;
        } else {
            $data['popular_product'] = 0;
        }
        if ($request->hot_deal === '1') {
            $data['hot_deal'] = 1;
        } else {
            $data['hot_deal'] = 0;
        }

        if ($request->hasfile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $path = public_path('uploads/products');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = $imageName;
        }
        if($request->hasFile('pdf_file')){
            if(file_exists(public_path('uploads/products/pdf').'/'.$product->attachment)){
                File::delete('uploads/products/pdf/'.$product->attachment);
            }

            $attachment_file = $request->file('pdf_file');
            $data['pdf_file'] = time().'_'.$attachment_file->getClientOriginalName();
            $destinationPath = public_path('uploads/products/pdf');
            $attachment_file->move($destinationPath,$data['pdf_file']);
        }


        if ($request->hasfile('featured_image')) {
            foreach ($request->file('featured_image') as $image)
            {
                $name = time().'_'.$count++ . '.' . $image->extension();
                $path = public_path('uploads/products/featured_image');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $image->move($path, $name);
                $featured_image = $name;
                $product_FeaturedImage = new ProductFeaturedImage();
                $product_FeaturedImage->product_id = $product->id;
                $product_FeaturedImage->image = $featured_image;
                $product_FeaturedImage->save();
            }
        }
        $data['slug'] = Str::slug($request->name);

        $product->update($data);
        return redirect(route("products.index"))->with('message', 'Record was successfully Update!!');
    }

    public function destroy($id)
    {
        $category = $this->model->findOrFail($id);
        $category->delete();
        return redirect(route("products.index"))->with('message', 'Record was successfully Deleted!!');
    }

    /*public function getAddToCart(Request $request,$id)
    {
        $product = Product::find($id);
        if($request->session()->exists('cart'))
        {
            $oldCart = $request->session()->get('cart');
        }
        else
        {
            $oldCart=false;
        }

        $Cart = new Cart($oldCart);
        $Cart->Add($product, $id);
        $request->session()->push('cart', $Cart);
        return redirect()->back();

    }*/

    public function deleteProductImage($id)
    {
        $model = Product::where('id',$id)->where('thumbnail','like','%_%')->first();
        File::delete(public_path('uploads/products/'.$model->thumbnail));
        $model->update(['thumbnail'=>null]);
        return back();

    }

    public function deleteFeaturedImage($id)
    {
        $model = ProductFeaturedImage::where('id',$id)->where('image','like','%_%')->first();
        File::delete(public_path('uploads/products/featured_image/'.$model->image));
        $model->delete(['id'=>$id]);
        return back();
    }


}
