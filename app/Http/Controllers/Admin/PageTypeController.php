<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PageTypeController extends Controller
{

    public function index()
    {
        $page_types  = PageType::all();
        return view('admin.page-type.index',[
           'page_types' => $page_types
        ]);
    }

    public function create()
    {
        return view('admin.page-type.create');
    }

    public function edit($id)
    {
        $page_type = PageType::where('sort',$id)->first();
        return view('admin.page-type.edit',['model'=>$page_type]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        PageType::create($data);
        return redirect()->route('pageType.index')->with('success','Record was successfully saved!!');
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        PageType::where('sort', $id)->update(['page_type_title'=>$data['page_type_title']]);
        return redirect()->route('pageType.index')->with('success','Record was successfully Updated!!');
    }

    public function show()
    {

    }

    public function destroy($id)
    {
        PageType::where('sort',$id)->delete();
        return redirect()->route('pageType.index')->with('success','Record was successfully Deleted!!');
    }
}
