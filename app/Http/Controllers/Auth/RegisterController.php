<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationAuthorizationMailer;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    protected function registerUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'

        ]);
        $name = $request->get('name');
        $email =  $request->get('email'); 
        $token = Str::random(32);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'company' => $request->get('company'),
            'address' => $request->get('address'),
            'address_2' => $request->get('address_2'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
            'country' => $request->get('country'),
            'phone' => $request->get('phone'),
            'url_verify' => $token,
            'password' => Hash::make($request->get('password')),
        ]);
        $user_id = $user->id;
        $company = $request->get('company');
        $address = $request->get('address');
        $address_2 = $request->get('address_2');
        $city = $request->get('city');
        $state = $request->get('state');
        $zip = $request->get('zip');
        $country = $request->get('country');
        $phone = $request->get('phone');
        $recipients = [
            // '',
            'ekta-vyas2002@yahoo.com',
            'raptitradechannels@gmail.com',
            // 'order@raptifashiondirect.com',
        ];
        $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/"; 
        $data = compact('name','email','token','user_id','company','address','address_2','city','state','zip','country','phone','base_url');
        Mail::to($recipients)->bcc('devraj.sah13@gmail.com')->send(new RegistrationAuthorizationMailer($data));
        
        return redirect()->back()->with('success', 'Registered Successfully. Please Login..');
    }
}
