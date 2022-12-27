<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(Request $request,ProductCategory $category)
    {

        $this->request = $request;
        $this->model = $category;
    }

    public function index()
    {
        $categories  = $this->model->all();
        return view('admin.cart.categories.index',[
            'categories' => $categories
        ]);
    }

    public function create()
    {
       $current_max_position = ProductCategory::max('position');
        $next_position = $current_max_position + 1;
        return view('admin.cart.categories.create',[
            'next_position' => $next_position
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name'=>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(is_null($request['side_banner']) ){
            $data['side_banner']= 0;
        }
        if(is_null($request['feature']) ){
            $data['feature']= 0;
        }


        if ($request->hasfile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $path = public_path('uploads/category');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = $imageName;
        }
        $data['slug'] = Str::slug($request->name);
        $this->model->create($data);
        return redirect()->route('product-categories.index')->with('message','Record was successfully saved!!');
    }

    public function edit($id)
    {
        $model = $this->model->find($id);
        return view('admin.cart.categories.edit',['model' =>$model]);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();


        $this->validate($request, [
            'name'=>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        if(is_null($request['side_banner']) ){
            $data['side_banner']= 0;
        }
        if(is_null($request['feature']) ){
            $data['feature']= 0;
        }

        if ($request->hasfile('thumbnail'))
        {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $path = public_path('uploads/category');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = $imageName;
        }

        $data['slug'] = Str::slug($request->name);
        $this->model->findOrFail($id)-> update($data);
        return redirect(route("product-categories.index"))->with('message', 'Record was successfully Update!!');
    }

    public function destroy($id)
    {
        $category = $this->model->findOrFail($id);
        $category->delete();
        return redirect(route("product-categories.index"))->with('message', 'Record was successfully Deleted!!');
    }

    /*public function importFileIntoDB()
    {

    }*/
    
     public function update_status(Request $request, $id)
    {
        $data['status'] = $request->status;
        ProductCategory::where('id', $id)->update($data);
    }
}
