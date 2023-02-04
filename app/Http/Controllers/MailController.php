<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\FrontendHelper;
use App\Helpers\ProductHelper;
use App\Mail\InquiryMailer;
use App\Mail\customerOrderConfirmationMailer;
use App\Mail\orderDetailMailer;
use App\Mail\contactUsMailer;
use App\Models\Catalogue;
use App\Models\GlobalSetting;
use App\Models\Navigation;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Cart;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{
    public function storeContactUs(Request $request )
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $name = $request['name'];
        $email = $request['email'];
        $subject = $request['subject'];
        $message = $request['message'];

        $data = compact('name','email','subject','message');
        // echo "<pre>";
        // print_r($data);
        // die();
        Mail::to('devraj.sah310@gmail.com')->send(new contactUsMailer($data));
        return redirect()->back()->with('sent_mail',"Please Check your Mail !!!");
    }

    public function acknowledge(Request $request)
    {      
        //mail sections
        $invoice = $request->query('invoice');
        $email = $request->query('email');
        $data = compact('invoice');
        Mail::to($email)->send(new customerOrderConfirmationMailer($data));

        return  redirect()->route('website.home')->with(['success' => 'Conformation Mail Sent Successfully !!']);
    }


}
