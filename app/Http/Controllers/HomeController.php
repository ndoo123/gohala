<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\Shop;
use Illuminate\Http\Request;
use LKS;
class HomeController extends Controller
{
    public function home(){
        $data['categories']=ProductCategory::all();
        $data['show_menu']=1;
        return view('web.home.home',$data);
    }
    public function category(Request $r)
    {
        $cat=\DB::table('category_tb')->where("slug",$r->slug)->first();
        if($cat)
        {
            $data['category']=$cat;
            $data['categories']=ProductCategory::all();
            $data['products']=Product::where("category_id",$cat->id)->get();
         
            return view('web.home.category',$data);
        }

        return redirect('error_404');
    }
    public function product_single(Request $r)
    {
      
        $slug=ProductSlug::where("shop_id",$r->shop_id)->where("slug",$r->slug)->first();
        if(!$slug)
        return redirect('error_404');

        $data['product']=Product::where("shop_id",$slug->shop_id)->where("id",$slug->product_id)->first();
        $data['categories']=ProductCategory::all();
        $data['category']=ProductCategory::where("id",$data['product']->category_id)->first();
        
        return view('web.home.single_product',$data);
    }
    public function shop_category_view(Request $r)
    {
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect('error_404');

        $cat=\DB::table('category_tb')->where("slug",$r->cat_slug)->first();

        $data['shop']=$shop;
        $data['categories']=ProductCategory::all();
        $data['discount_items']=Product::where("shop_id",$shop->id)->where("is_discount",1)->take(6)->get();
        $data['products']=array();
        if($cat)
        $data['products']=Product::where("shop_id",$shop->id)->where('category_id',$cat->id)->get();
         return view('web.home.shop_view',$data);
    }
    public function shop_view(Request $r)
    {
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect('error_404');

        $data['shop']=$shop;
        $data['categories']=ProductCategory::all();
        $data['discount_items']=Product::where("shop_id",$shop->id)->where("is_discount",1)->take(6)->get();
        $data['products']=Product::where("shop_id",$shop->id)->get();

        return view('web.home.shop_view',$data);
    }
    public function product_add_to_cart(Request $r)
    {
        $p=Product::where("id",$r->product_id)->first();
        if(!$p)
        return \LKS::o(0,"ไม่พบสินค้า");

        if(!is_numeric($p->p_price))
            $p->p_price=0;
            
             $basket_item=array(
                'product_id'=>$p->id,
                'name'=>$p->name,
                'qty'=>$r->qty,
                'price'=>$p->get_discount_price(),
                'link'=>$p->get_link(),
                'img'=>$p->get_photo()
                );
            return \LKS::o(1,$basket_item);
    }
    public function checkout(Request $r)
    {
        if(!\Auth::user())
        {
            return redirect('login')->with('redirect',env('APP_URL').'/checkout');
        }
        $data['categories']=ProductCategory::all();
        $data['user_address']=\Auth::user()->address;
      
        return view('web.home.checkout',$data);
    }
}