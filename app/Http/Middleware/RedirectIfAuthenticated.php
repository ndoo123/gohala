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
        // dd(Auth::guard(),$guard,Auth::guard()->check(),Auth::guard($guard)->check());
        if (Auth::guard($guard)->check()) {
            return redirect('/profile');
        }

        return $next($request);
    }
}
