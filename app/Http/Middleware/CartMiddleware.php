<?php

namespace App\Http\Middleware;

use Cart;
use Closure;

class CartMiddleware
{
    public function handle($request, Closure $next)
    {
        /*if (auth()->guard('customer')->check()) {
            $carts = Cart::instance($this->getInstance('user'))->content();
        } else {*/
            $carts = Cart::content();
       /* }*/

        if (count($carts)>0) {
            return $next($request);
        }

        return redirect(route('website.home'));

    }

   /* private function getInstance($instance)
    {
        if ($instance == 'user' & auth()->guard('customer')->check()) {
            return auth()->guard('customer')->user()->id;
        }
        return $instance;
    }*/
}
