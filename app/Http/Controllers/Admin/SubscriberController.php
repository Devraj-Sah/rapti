<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{

    public function index(){
    	$subscribers = Subscriber::orderBy('id','DESC')->get();
    	return view('admin.subscriber.subscribers_list',compact('subscribers'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email'
        ]);
        $data = $request->all();
        //dd($data);
        Subscriber::create($data);
        return redirect()->back()->with('success','Thank you!!');
    }

    public function destroy($id)
    {
        $sub_del = Subscriber::find($id);
        $sub_del->delete();
        return redirect()->back()->with('success','Deleted Successfully!!');
    }
}