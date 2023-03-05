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
        Mail::to('info@raptifashiondirect.com')
            ->bcc(['ektavyas.edu@gmail.com','raptifashion@gmail.com','devraj.sah13@gmail.com'])
            ->send(new contactUsMailer($data));
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

    public function authorizemail(Request $request) 
    {      
        $invoice = $request->query('token');
        $id = $request->query('id');
        // $data = compact('invoice');
        // Mail::to($email)->send(new customerOrderConfirmationMailer($data));

        $user = User::find($id);
        $user->verify = 1;
        $user->url_verify = null;
        $user->save();
        // return $invoice;

        return  redirect()->route('website.home')->with(['success' => 'Access granted! The selected user can now log in and start using the website.']);
    }


}
