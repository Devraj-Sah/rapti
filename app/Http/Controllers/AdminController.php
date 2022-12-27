<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Hash;
use App\Models\Navigation;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $navigations = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        return view('admin.dashboard', compact('navigations'));
    }

    public function change_profile()
    {
        $change_profile = Admin::findOrfail(1);
        return view('admin.change_profile', compact('change_profile'));
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'curr_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);


        $data = $request->all();
        $user = Admin::find(auth()->user()->id);
        if (!Hash::check($data['curr_password'], $user->password)) {
            return back()->with('error', 'The specified password does not match the database password');
        } else {
            $request->user()->fill(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)])->save();
        }

        return redirect()->back()->with('success', 'profile updated');
    }


}
