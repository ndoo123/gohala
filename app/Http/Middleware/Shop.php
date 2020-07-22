<?php

namespace App\Http\Middleware;

use Closure;

class Shop
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
        if(!isset($r->shop_url))
        return redirect()->back()->with('error',__('view.shop_id_not_found'));

        $shop=\App\Models\Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect(env('APP_URL').'/error_404')->with('error',__('view.shop_not_found'));
        $data=[];
        $data['shop']=$shop;
        $data['categories']=$shop->get_categories(true);
        $r->merge(["data"=>$data]);
        return $next($r);
    }
}
