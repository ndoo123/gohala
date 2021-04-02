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
        // return redirect('http://gohala.local/error_404');
        // dd($r->all(),!empty($r->shop_id) ? $r->shop_id : null,url()->current(),env('APP_URL').'/error_404');
        if(!isset($r->shop_id))
            return redirect()->back()->with('error',__('view.shop_id_not_found'));
        // dd($shop);
        // dd(1);
        $shop=\App\Models\Shop::where("url",$r->shop_id)->first();
        if(empty($shop))
            return redirect()->back()->with('error',__('view.shop_not_found'));
            // return redirect(env('APP_URL').'/error_404')->with('error',__('view.shop_not_found'));
        
        if(!$shop->is_allow(\Auth::user()))
            return redirect()->back()->with('error',__('view.shop_not_allow'));
            
        $r->merge(["shop"=>$shop]);
        return $next($r);
    }
}
