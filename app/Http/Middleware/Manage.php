<?php

namespace App\Http\Middleware;

use Closure;

class Manage
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
        // dd(\Auth::check());
        if(!\Auth::check())
        {
            return redirect('');
        }
        return $next($request);
    }
}
