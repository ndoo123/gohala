<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Shop;
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
}