<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\FrontendHelper;
use App\Helpers\ProductHelper;
use App\Mail\InquiryMailer;
use App\Mail\customerOrderConfirmationMailer;
use App\Mail\ApprovedConformationMailer;
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
use App\rpt_wholeseller;
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
            ->bcc(['ektavyas.edu@gmail.com','raptifashion@gmail.com'])
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
        // return "ok";
        $invoice = $request->query('token');
        $id = $request->query('id');
        $email = $request->query('email');
        
        $user = User::find($id);
        if ($invoice == $user->url_verify) {
            # code...
            $user->verify = 1;
            $user->url_verify = null;
            $user->save();
        }
        else{
            return  redirect()->route('website.home')->with(['success' => 'Perhaps this user has already been granted access by one of the authorized members.']);
        }
        $Cname = $user->name;
        $Cemail = $user->email;

        $data = compact('Cname','Cemail');
        Mail::to($email)->send(new ApprovedConformationMailer($data));

        // return $invoice;

        return  redirect()->route('website.home')->with(['success' => 'Access granted! The selected user can now log in and start using the website.']);
    }

    public function merge_database_users(Request $request) 
    {
        $sellers = rpt_wholeseller::all();
        foreach ($sellers as $key => $value) {

            $users = User::where('email',$value['email'])->first();
            if(isset($users)){
                if($value['eveningTel'] != ""){
                    echo("-------");
                    if($value['telephone'] != $value['eveningTel']){
                        echo("------------------------------------------");
                   

                            $users->phone = $value['telephone'].",".$value['eveningTel'];
                        }
                    }
                    
                else{
                    $users->phone = $value['telephone'];
                }
                $users->save();
            
                // $user = User::create([
                //     'name' => $value['firstname'] ." ". $value['lastname'], #1
                //     'email' => $value['email'], #2
                //     'password' => Hash::make("password@123"), #3

                //     'address' => $value['address1'],  #4
                //     'phone' => $value['email'], #5
                //     'company' => $value['company'], #7
                //     'resellerId' => $value['resellerId'],#8
                //     'address_2' => $value['address2'], #9
                //     'city' => $value['city'], #10
                //     'country' => $value['country'], #11
                //     'state' => $value['state'], #12
                //     'zip' => $value['zip'], #13
                //     'state' => $value['state'], #14
                //     'fax' => $value['fax'],
                //     'verify' => 1,
                //     'remember_token' => 'old_user',
                    
                // ]);
                echo("done");
                echo("<br>");
            }
            else{
                echo("already done");
                echo("<br>");
            }
            
        }
        // return $sellers;
    }



}
