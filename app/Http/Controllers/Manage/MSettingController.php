<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\ShopDelivery;

use LKS;
class MSettingController extends Controller
{
   public function settings(Request $r)
   {
       
       $data['shop']=$r->shop;
       $data['provinces']=Province::all();
       $data['ship_method_tb']=\DB::table('ship_method_tb')->get();
       $data['shop_shippings']=ShopDelivery::where("shop_id",$r->shop->id)->get();
       $data['payment_methods']=\DB::table('payment_method_tb')->get();
       $data['shop_payment_methods']=\DB::table('shop_payment_tb')->leftJoin('payment_method_tb','shop_payment_tb.method_id','payment_method_tb.id')->where('shop_payment_tb.shop_id',$r->shop->id)->get();
       return view('manage.shop.setting.settings',$data);
   }
   public function setting_info_save_json(Request $r){
     
       if(!isset($r->name)||$r->name=="")
       {
           return LKS::o(0,"กรุณาระบุชื่อร้าน");
       }
       $r->shop->phone=$r->phone;
       $r->shop->email=$r->email;
       $r->shop->name=$r->name;
       $r->shop->line=$r->line;
       $r->shop->facebook=$r->facebook;
       $r->shop->address=$r->address;
       $r->shop->province_id=$r->province;
       $r->shop->zipcode=$r->zipcode;
       $r->shop->tax_id=$r->tax_id;

       $r->shop->save();

       return LKS::o(1,"");

   }
   public function setting_delivery_save_json(Request $r)
   {
    //    dd($r->all()); 

       foreach($r->ship_cost as $method_id=>$sc)
       {
           $ship=\DB::table('ship_method_tb')->where('id',$method_id)->first();
           if(!$ship)
           continue;
           
           $shop_ship=ShopDelivery::where("shop_id",$r->shop->id)->where("shipping_id",$ship->id)->first();
           if(!$shop_ship)
           {
               $shop_ship=new ShopDelivery();
               $shop_ship->shipping_id=$ship->id;
               $shop_ship->shop_id=$r->shop->id;
           }

            $shop_ship->is_check=0;
           if(isset($r->ship_method[$ship->id]))
           $shop_ship->is_check=1;

           $shop_ship->ship_cost=0;
           if(isset($r->ship_cost[$ship->id]))
           $shop_ship->ship_cost=$r->ship_cost[$ship->id];

           if(!is_numeric($shop_ship->ship_cost))
           $shop_ship->ship_cost=0;

           $shop_ship->cal_type=1;
           if(isset($r->ship_cal[$ship->id]))
           $shop_ship->cal_type=$r->ship_cal[$ship->id];

           $shop_ship->save();

         


           

       }
         return LKS::o(1,"");
   }

   public function setting_payment_save_json(Request $r){
       \DB::table('shop_payment_tb')->where('shop_id',$r->shop->id)->delete();
       if(isset($r->shop_payment)){
       foreach($r->shop_payment as $method_id=>$value)
       {
            \DB::table('shop_payment_tb')->insert(['shop_id'=>$r->shop->id,'method_id'=>$method_id]);
        //    $shop_p=\DB::table('shop_payment_tb')->where('shop_id',$r->shop->id)->where('method_id',$method_id)->first();
        //    if(!$shop_p)
        //    {
        //        \DB::table('shop_payment_tb')->insert(['shop_id'=>$r->shop->id,'method_id'=>$method_id]);
        //    }
       }
       }

       return LKS::o(1,"");
   }
  
}