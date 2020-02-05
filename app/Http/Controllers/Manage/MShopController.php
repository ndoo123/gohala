<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use LKS;
class MShopController extends Controller
{
   public function shops()
   {
       
       $data['shops']=Shop::where("user_id",\Auth::user()->id)->get();
       return view('manage.shop.shops',$data);
   }
   public function shop_create(Request $r)
   {
       if($r->name=="" || $r->shop_url=="")
       return LKS::o(0,"กรุณาระบุข้อมูลให้ครบ");

       $shop=Shop::where("url",$r->shop_url)->first();
       if($shop)
       return LKS::o(0,"URL นี้มีผู้ใช้แล้ว");

       $shop=new Shop();
       $shop->user_id=\Auth::user()->id;
       $shop->name=$r->name;
       $shop->url=$r->shop_url;
       $shop->province_id=1;
       $shop->save();

       return LKS::o(1,$shop);

   }



   //SHOP MAnage
   
   public function shop_manage(Request $r)
   {
       $data['shop']=$r->shop;
       return view('manage.shop.shop_manage',$data);
   }
   public function product_list(Request $r)
   {
        $data['shop']=$r->shop;
        $data['products']=Product::where("shop_id",$r->shop->id)->get();
       return view('manage.shop.product.product_list',$data);
   }
   public function product_view(Request $r)
   {
       $data['shop']=$r->shop;
       $data['product']=new Product();
       if(isset($r->product_id)){
       
        $data['product']=Product::where("id",$r->product_id)->first();
        
        if(!$data['product'])
        return redirect()->back()->with('error',__('view.product.product_not_found'));

       }

       $data['product_categories']=ProductCategory::all();

       return view('manage.shop.product.product_view',$data);
   }
}