<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($_SERVER['REQUEST_METHOD'],$_SERVER['HTTP_X_REQUESTED_WITH'],Auth::guard(),Auth::guard($guard)->check(),$return);
        if (Auth::guard($guard)->check() && empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return redirect('/profile');
        }

        return $next($request);
    }
}
