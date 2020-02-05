<?php

namespace App\Http\Middleware;

use Closure;

class ShopManageCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($r, Closure $next)
    {
        if(!isset($r->shop_id))
        return redirect()->back()->with('error',__('view.shop_id_not_found'));

        $shop=\App\Models\Shop::where("url",$r->shop_id)->first();
        if(!$shop)
        return redirect()->back()->with('error',__('view.shop_not_found'));

        if(!$shop->is_allow(\Auth::user()))
        return redirect()->back()->with('error',__('view.shop_not_allow'));

        $r->merge(["shop"=>$shop]);

        return $next($r);
    }
}
