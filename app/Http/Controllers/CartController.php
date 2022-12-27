<?php

namespace App\Http\Controllers;



use App\Helpers\FrontendHelper;
use App\Models\GlobalSetting;
use App\Models\Navigation;
use App\Models\Product;

use App\Models\ProductCategory;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $district;
    protected $order;


    public function __construct()
    {


    }

    public function index(FrontendHelper $frontendHelper)
    {
        $data = [];
        $data['frontend_helper'] =$frontendHelper;
        $data['settings'] = GlobalSetting::where('id', 1)->first();
        $data['categories'] =ProductCategory::where('parent_id', null)->where('status',1)->orderBy('position','ASC')->get();;
        $data['menus'] =Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();



        $data['carts'] = Cart::content();
        $data['subTotal'] = Cart::subtotal();
        $data['total'] = Cart::total();
        //$data['tax'] = Cart::tax();


        //return view('site::cart.list', $data);

        return view('website.cart.list',  $data);
    }

    private function getInstance($instance)
    {
        if ($instance == 'user' & auth()->guard('customer')->check()) {
            return auth()->guard('customer')->user()->id;
        }
        return $instance;
    }

    public function add(Request $request)
    {
        $all = $request->only(['qty', 'pid', 'type']);

        $product = Product::find($all['pid']);

        $price = ($product->compare_price)? $product->compare_price:$product->price ;
        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $all['qty'],
            'price' => $price,
            'options' => [
                'image' => $product->thumbnail,
            ]
        ];


        Cart::add($data);


        //alertify()->success('Added to cart Successfully!')->delay(5000);

        if (isset($all['type']) && $all['type'] === 'buy') {
            $route = 'cart.checkout';
        } /*else {
            $route = 'cart.index';
        }*/

        return redirect()->back()->with('success','ITEM ADDED TO YOUR CART');

    }

    public function update(Request $request)
    {
        $rowId = $request->get('id');
        $qty = $request->get('qty');


        $data = [
            'qty' => $qty
        ];

        try {


            Cart::update($rowId, $data);

            $cartCount = Cart::count();

            $code = 200;
            $message = "Successfully updated";
            //alertify()->success('Cart updated Successfully!');

        } catch (\Throwable $t) {
            $code = 500;
            $subTotal = Cart::subtotal();
            $message = "Something went wrong!";
        }

        return response()->json(['error' => false, 'message' => $message,'cartCount'=>$cartCount,'subTotal'=> $subTotal, $data], $code);

    }

    public function destroy()
    {

        Cart::destroy();

        //alertify()->error('Cart cleared successfully!');

        return redirect(route('cart.index'));
    }

    public function delete($id)
    {

        Cart::remove($id);

       // alertify()->error('Deleted from cart Successfully!');
        return redirect()->back();
    }

}
