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
        // dd(1);
        if(!isset($r->shop_url))
        return redirect()->back()->with('error',__('view.shop_id_not_found'));

        $shop=\App\Models\Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect(env('APP_URL').'/error_404')->with('error',__('view.shop_not_found'));
        $data=[];
        $data['shop']=$shop;
        $data['categories']=$shop->get_categories(true);
        $data['user'] = \Auth::user();
        $r->merge(["data"=>$data]);
        // dd($r->all());
        return $next($r);
    }
}
