<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:6'  
        ]); 
        
        if(Auth::guard('admin')->attempt(['name'=>$request->name, 'password'=>$request->password])){

            return redirect()->route('admin.dashboard');

        }   

        return redirect()->back()->withInput($request->only('name'));                                                                       
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
