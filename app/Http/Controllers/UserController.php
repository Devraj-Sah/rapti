<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\FrontendHelper;
use App\Helpers\ProductHelper;
use App\Models\GlobalSetting;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use App\Models\Navigation;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function myAccount(FrontendHelper $frontendHelper, CategoryHelper $categoryHelper, ProductHelper $productHelper)
    {

        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $carts = Cart::content();

        return view('website.user-page.account', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,

            'settings' => $settings,

            'menus' => $menus,

            'carts' => $carts,
        ]);
    }

    public function removenotifications(Request $request,FrontendHelper $frontendHelper, CategoryHelper $categoryHelper, ProductHelper $productHelper)
    {
        $orderId = $request->orderID;
        $orders = Order::where('id',$orderId)->first();
        $user_id = Auth::user()->id;
        if ($user_id === $orders->customer_id) {
            $orders->is_notify = 0;
            $orders->save();
        }
        return redirect()->back()->with('success', 'Notification Removed');
    }

    public function updateInformation(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back()->with('success', 'profile updated');
    }

    public function changePassword(Request $request, FrontendHelper $frontendHelper, ProductHelper $productHelper)
    {

        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $carts = Cart::content();

        return view('website.user-page.changePassword', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'carts' => $carts,
        ]);
    }

    public function updatePassword(Request $request, FrontendHelper $frontendHelper, ProductHelper $productHelper)
    {

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6|different:old_password',
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
           return redirect()->back()->with('error', 'Old password didnot match');
        }else{
            $user = User::findOrFail(Auth::user()->id);
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect()->back()->with('success', 'Password Changed');
        }

    }

    public function myOrders( FrontendHelper $frontendHelper, ProductHelper $productHelper)
    {
        $orders = Order::where('customer_id',Auth::user()->id )->orderBy('created_at','devraj')->get();
        $Countorders = count(Order::where('customer_id',Auth::user()->id )->where('is_notify',1)->get());
        // return $Countorders;
        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $carts = Cart::content();

        return view('website.user-page.myOrder', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'carts' => $carts,
            'orders'=>$orders,
            'Countorders'=>$Countorders
        ]);


        // return view('website.user-page.myOrder', compact('change_profile'));
    }

    public function orderDetail(Request $request, FrontendHelper $frontendHelper, ProductHelper $productHelper)
    {

        $orderId = $request->orderId;
        $order = Order::findOrFail($orderId);

        $settings = GlobalSetting::where('id', 1)->first();
        $menus = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        $carts = Cart::content();

        return view('website.user-page.orderDetail', [
            'product_Helper' => $productHelper,
            'frontend_helper' => $frontendHelper,
            'settings' => $settings,
            'menus' => $menus,
            'carts' => $carts,
            'order'=>$order
        ]);


        // return view('website.user-page.orderDetail', compact('change_profile'));
    }
    public function cancleOrder(Request $request, FrontendHelper $frontendHelper, ProductHelper $productHelper,$order_id)
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('id',$order_id)->first();
        if ($user_id === $orders->customer_id) {
            $orders->deleted_at = Carbon::now();
            $orders->save();
        }
        return redirect()->route('user.myOrders')->with('success', 'Order Cancled Succesfully !!!');
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
