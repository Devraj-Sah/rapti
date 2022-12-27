<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Mail\SendMail;
use App\Mail\EnquiryMail;
use Mail;

class EnquiryController extends Controller
{
    public function send(Request $request)
    {
    	$data = $request->all();
        dd($data);
    	$data = Enquiry::create($data);
    	$email = "tokhanaresh@gmail.com";
    	
    	Mail::to($email)->send(new EnquiryMail($data));
    	if($data){
    		return redirect()->back()->with('success',"Thank You!!");
    	}
    	return redirect()->back()->with('error',"Contact creation failed");
    }

  
}
