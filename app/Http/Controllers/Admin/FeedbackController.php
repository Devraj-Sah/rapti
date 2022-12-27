<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class FeedbackController extends Controller
{

    public function index(){
    	$feedbacks = Comment::orderBy('id','DESC')->get();
    	return view('admin.feedback.feedbacks_list',compact('feedbacks'));
    }

    public function view($id)
    {
        $feedback = Comment::find($id);
        return view('admin.feedback.feedbacks_view',compact('feedback'));
    }

   public function destroy($id)
    {
        $sub_del = Comment::find($id);
        $sub_del->delete();
        return redirect('/admin/feedbacks-list')->with('success','Deleted Successfully!!');
    }

    public function update_status(Request $request, $id){

       $data['page_status'] = $request->page_status;
       Comment::where('id', $id)->update($data);
     }
}
