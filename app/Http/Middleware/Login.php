<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Log;
use Session;

class Login
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
        Log::info('Have login?');
        if (Session::has('LOGIN_USER')) {
            return $next($request);
        } else {
            return redirect(route('login'));
        }

    }
}
