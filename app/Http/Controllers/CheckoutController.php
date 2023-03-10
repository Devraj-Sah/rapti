<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Helpers\FrontendHelper;
use App\Models\GlobalSetting;
use App\Models\Navigation;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\ProductCategory;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Mail\orderDetailMailer;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use App\Mail\customerOrderConfirmationMailer;


class CheckoutController extends Controller
{
    protected $district;
    protected $orderStatus;
    protected $order;

    public function __construct()
    {

    }

    public function checkout(FrontendHelper $frontendHelper)
    {
        $data = [];
        $data['frontend_helper'] = $frontendHelper;
        $data['settings'] = GlobalSetting::where('id', 1)->first();
        $data['categories'] = ProductCategory::where('parent_id', null)->where('status', 1)->orderBy('position', 'ASC')->get();;
        $data['menus'] = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();

        $data['carts'] = Cart::content();
        $data['subTotal'] = Cart::subtotal();
        $data['total'] = Cart::total();
        $data['tax'] = Cart::tax();
        $data['user_data'] = Auth::user();
        

        return view('website.checkout.checkout', $data);
    }


    public function checkoutStore(Request $request, FrontendHelper $frontendHelper)
    {
        $data['frontend_helper'] = $frontendHelper;
        $data['settings'] = GlobalSetting::where('id', 1)->first();
        $data['categories'] = ProductCategory::where('parent_id', null)->where('status', 1)->orderBy('position', 'ASC')->get();;
        $data['menus'] = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();



        $all = $request->all();


        try {
            $all['customer_type'] = 'user';
            if(Auth::check()){
                $all['customer_id'] = Auth::user()->id;
                $all['customer_type'] = 'user';
            }

            $orderStatus = OrderStatus::where('title', 'initial')->first();

            $all['status_id'] = $orderStatus->id;
            // $all['status_id'] = 0;


            $all['sub_total'] = Cart::subtotal();
            $all['total'] = Cart::subtotal();
            $all['tax'] =  0 /*Cart::tax()*/;

            // Random Order Token generation
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $all['invoice_id'] = $randomString;
            $order = Order::create($all);

            $data['orderAddress'] = $order;
            $all['order_id'] = $order->id;

            $all['type'] = 'billing';
            
            
            $data['orderAddress'] = OrderAddress::create($all);

            if (!isset($all['shiping_address'])){
                $all['type'] = 'shipping';
                $all['company_name'] = $all['ship_company_name'];
                $all['name'] = $all['ship_name'];
                $all['address_line_1'] = $all['ship_address_line_1'];
                $all['address_line_2'] = $all['ship_address_line_2'];
                $all['email'] = $all['ship_email'];
                $all['phone'] = $all['ship_phone'];
                $all['country'] = $all['ship_country'];
                $all['state'] = $all['ship_state'];
                $all['city'] = $all['ship_city'];
                $all['zip_code'] = $all['ship_zip_code'];
                $data['orderAddress'] = OrderAddress::create($all);
            }


            $orderProducts = $this->getCartProducts();

            // if ($all['payment_type'] == 'cash_on_delivery') {
                $order->orderProduct()->saveMany($orderProducts);

                // Send mail to admin
                $Mailorders = Order::where('customer_id',Auth::user()->id )->orderBy('created_at','devraj')->get();
                $MailCountorders = count(Order::where('customer_id',Auth::user()->id )->where('is_notify',1)->get());
                $maildata = compact('Mailorders');
                $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/";   
                $mailall = compact('all','base_url');
                $base_url = compact('base_url');
                $recipients = [
                    // '',
                    // '',
                    // 'raptitradechannels@gmail.com',
                    'order@raptifashiondirect.com',
                 ];
                Mail::to($recipients)
                    ->bcc(['ektavyas.edu@gmail.com','raptifashion@gmail.com'])
                    ->send(new orderDetailMailer($maildata,$mailall,$base_url));

                // $invoice = $all['invoice_id'];
                $email = $all['email'];
                // $data1 = compact('invoice');
                Mail::to($email)->send(new customerOrderConfirmationMailer($maildata,$mailall,$base_url));
                
                // Clear Cart
                $this->clearCart();
                //sending notification to admin
                $superAdmin = Admin::findOrFail(1);
                $superAdmin->notify(new NewOrder($order));

                $random_token = $randomString;                
                $email =  $all['email'];
                $address1 =  $all['address_line_1'];
                $address2=  $all['address_line_2'];
                $name =  $all['name'];
                $phone =  $all['phone'];
                $city =  $all['city'];

                $data = compact('random_token','email','address1','address2','name','phone','city','frontendHelper','all');
                $data['frontend_helper'] = $frontendHelper;
                $data['settings'] = GlobalSetting::where('id', 1)->first();
                $data['categories'] = ProductCategory::where('parent_id', null)->where('status', 1)->orderBy('position', 'ASC')->get();;
                $data['menus'] = Navigation::where('nav_category', 'Main')->where('parent_page_id', 0)->get();
        
                $data['carts'] = Cart::content();
                $data['subTotal'] = Cart::subtotal();
                $data['total'] = Cart::total();
                $data['tax'] = Cart::tax();
                return view('website.checkout.thankYou')->with($data);
            // }else{

            // }

        } catch (\Throwable $t) {
            return redirect()->back()->with('error',$t->getMessage() );
        }

    }

    public function payment()
    {

        $orderId = session('cartOrderId');
        $data['order'] = $this->order->find($orderId);

        $data['orderAddress'] = $data['order']->orderAddress;

        if (auth()->guard('customer')->check()) {

            $data['carts'] = Cart::instance($this->getInstance('user'))->content();
            $data['subTotal'] = Cart::subtotal($this->getInstance('user'));
            $data['total'] = Cart::total($this->getInstance('user'));
            $data['tax'] = Cart::tax($this->getInstance('user'));

        } else {

            $data['carts'] = Cart::content();
            $data['subTotal'] = Cart::subtotal();
            $data['total'] = Cart::total();
            $data['tax'] = Cart::tax();

        }

        return view('site::checkout.payment', $data);
    }

    public function paymentStore(PaymentTypeFormRequest $request)
    {
        $paymentType = $request->get('payment_type');

        $orderId = session('cartOrderId');
        $order = $this->order->find($orderId);

        try {

            $orderProducts = $this->getCartProducts();

            $order->orderProduct()->saveMany($orderProducts);

            //Update Order Status to Pending
            $orderStatus = $this->orderStatus->findByTitle('pending');
            $orderData = [
                'payment_type' => $paymentType,
                'status_id' => $orderStatus->id,
                'sub_total' => Cart::subtotal(),
                'total' => Cart::total(),
                //'shipping_rate' => null,
            ];
            $this->order->update($orderId, $orderData);

            //Clear Cart
            $this->clearCart();

            //Clear OrderId from session
            session()->forget('cartOrderId');
            alertify()->success('Checkout Successfully!')->delay(5000);
            return redirect(route('cart.checkout.payment.success', ['oid' => $orderId]));

        } catch (\Throwable $t) {
            Flash::error($t->getMessage());
            flash("Something went wrong")->error();
        }

    }

    public function success($orderId)
    {
        $data['order'] = $this->order->find($orderId);

        return view('site::checkout.payment-success', $data);
    }

    private function getCartProducts()
    {
        $orderProducts = [];

        /*if (auth()->guard('customer')->check()) {
            $cartsData = Cart::instance($this->getInstance('user'))->content();
        } else {*/
        $cartsData = Cart::content();
        /*}*/


        foreach ($cartsData as $cart) {
            $orderProducts[] = new OrderProduct([
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                /*'color' => $cart->options->color,
                'size' => $cart->options->size*/
            ]);
        }

        return $orderProducts;
    }

    private function clearCart()
    {
       /* if (auth()->guard('customer')->check()) {
            Cart::instance($this->getInstance('user'))->destroy();
        } else {*/
            Cart::destroy();
      /*  }*/
        return true;
    }

    private function getInstance($instance)
    {
        if ($instance == 'user' & auth()->guard('customer')->check()) {
            return auth()->guard('customer')->user()->id;
        }
        return $instance;
    }

}
