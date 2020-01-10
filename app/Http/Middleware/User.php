<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('LOGIN_USER')) {
            $type = Session::get('LOGIN_USER')->type;
            $currentRoute = Route::getRoutes()->match($request)->getName();
            if ($type == 1) {
                return $next($request);
            } else {
                return redirect(route('login'));
            }
        }
    }
}
