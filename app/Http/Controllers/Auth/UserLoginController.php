<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Mail\forgetPassowrdMailer;
use Illuminate\Support\Facades\Mail;
use App\User;
use Hash;

class UserLoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }



    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);


        if(Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            // return Auth::user()->verify ;
            if(Auth::user()->verify == 1){
                return redirect()->route('website.home');
            }
            else{
                Auth::guard('web')->logout();
                return redirect()->back()->with('success'," The email and password are correct, but unfortunately, I must inform you that you are not authorized to proceed.");
            }
        }

        return redirect()->back()->with('error', 'email and password doesnot match');
    }

    public function forgetpassword(Request $request){
        $this->validate($request, [
            'email' => 'required',
        ]);
        $email = $request->email;
        if(!isset($request->again))
        {
            $token = rand(100000,999999);
            session()->put('token',$token);
            session()->put('tempemail',$request->email);
        }
        else{
            $token = session()->get('token');
        }
        $data = compact('token','email');
        Mail::to($request->email)->send(new forgetPassowrdMailer($data));
    	if($data){
    		return redirect()->back()->with('sent_mail',"Please Check your Mail !!!");
    	}
    	//return redirect()->back()->with('error',"token sent successfully");
       
    }

    public function forgetpasswordgmail(Request $request){
        $this->validate($request, [
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($request->token == session()->get('token')){
            $user = User::where('email',session()->get('tempemail'))->first();
            $user->verify = 1;
            $user->url_verify = null;
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            $this->destroysession();
            return redirect()->back()->with('success', 'Password Changed Please Login !');
        }
        else{
    		return redirect()->back()->with('sent_mail',"Token Not Matched !!!");
        }
    }
    public function destroysession(){
        session()->forget('token');
        return response()->json(['success' => true]);
       
    }

    public function signUp(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);



        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout(){
        Cart::destroy();
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
