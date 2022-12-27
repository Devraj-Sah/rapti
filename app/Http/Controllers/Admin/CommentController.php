<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments= Comment::where('blog_id', $id)->orderBy('id','DESC')->get();
        //dd($comments);

        return view('admin.comment.comment_list', compact('comments'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email'
        ]);
        $data = $request->all();
        //dd($data);

        Comment::create($data);
        return redirect()->back()->with('success','Thank you!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_del = Comment::find($id);
        $sub_del->delete();
        return redirect()->back()->with('success','Deleted Successfully!!');
    }

    public function updatestatus($id)
    {
        $data = Comment::find($id);
        $status = $data->status;
        //dd($status);
        if($status == '0'){ 
            $data['status'] = '1';     
            $data->status = $data['status']; 
            $data->save(); 
            return redirect()->back()->with('success','Comment Posted  Successfully');
        }
        elseif($status == '1'){
            $data['status'] = '0';     
            $data->status = $data['status']; 
            $data->save();
            return redirect()->back()->with('success','Comment Removed  Successfully');
        }        
                
    }
}

