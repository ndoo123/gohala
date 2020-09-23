<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShopPayment;

class Shop extends Model
{
    protected $table='shop_tb';

    public function get_url(){
        return env('APP_URL').'/'.$this->url;
    }
    public function is_allow($user)
    {
         //สำหรับเช็คว่ามีสิทธิ์เข้าถึงมั้ย

        if($this->user_id==$user->id)// เป็นเจ้าของ
        return true;
    }
    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function get_photo(){
        return env('APP_URL').'/shop_profile/image/'.$this->id;
    }
    public function get_logo(){
        if($this->logo=="")
        return url('assets/images/no_image_available.jpeg');
    }
    public function count_product(){
       return Product::where("shop_id",$this->id)->count();
    }
    public function count_order(){
       return Order::where("shop_id",$this->id)->count();
    }
    public function shop_payment_tranfer(){
        return ShopPayment::where('shop_id',$this->id)->where('method_id',2)->first();
    }
    public function get_categories($exclude_not_active=false){
        $builder=ShopCategory::where("shop_id",$this->id)
       ->selectRaw('shop_category_tb.*,(select count(product_id) from shop_category_product_tb where shop_category_product_tb.category_id=shop_category_tb.id and shop_category_product_tb.shop_id="'.$this->id.'" ) as product_count');
        
        if($exclude_not_active)
        $builder->where("shop_category_tb.is_active",1);
        
        return $builder->get();
    }

}