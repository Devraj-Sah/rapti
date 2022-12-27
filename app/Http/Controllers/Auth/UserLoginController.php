<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

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

            return redirect()->route('website.home');

        }

        return redirect()->back()->with('error', 'email and password doesnot match');
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
