<?php

namespace App\Http\Middleware;

use Closure;

class UserTypeMiddleware
{

    public static $allowedUserTypes = ['super_admin', 'admin', 'vendor'];

    public function handle($request, Closure $next)
    {
        if (auth()->guard('admins')->check()) {


                return $next($request);

        }

        return redirect(route('website.home'));

    }
}
