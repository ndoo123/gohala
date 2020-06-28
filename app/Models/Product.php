<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product_tb';

    public function get_photo(){
      
        if($this->default_photo!="")
        {
           return env('APP_URL').'/images/product/'.$this->shop_id.'/'.$this->id.'.'.$this->default_photo.'.jpg';
        }

        return env('APP_URL').'/assets/images/no_image_available.jpeg';
    }
    public function get_category(){
        return ShopCategory::join('shop_category_product_tb','shop_category_tb.id','shop_category_product_tb.category_id')
        ->where("shop_category_product_tb.product_id",$this->id)
        ->where("shop_category_product_tb.shop_id",$this->shop_id)
        ->selectRaw('shop_category_product_tb.*,shop_category_tb.id,shop_category_tb.name')->first();
    }
    public function get_categories(){
        
        return ProductCategory::join('shop_category_tb','shop_category_tb.id','shop_category_product_tb.category_id')
        ->where("shop_category_product_tb.product_id",$this->id)
        ->where("shop_category_product_tb.shop_id",$this->shop_id)
        ->selectRaw('shop_category_product_tb.*,shop_category_tb.name')->get();
    }
    public function in_category($cat_id,$categories)
    {
        
      
       foreach($categories as $cat)
       {
           if($cat_id==$cat->category_id)
           return true;
       }

        return false;
    }
    public function photos(){
        return $this->hasMany('\App\Models\ProductPhoto','product_id','id');
    }
    public function shop(){
        return $this->hasOne('\App\Models\Shop','id','shop_id');
    }
    public function get_link($shop_url=''){
       if($shop_url!='')
       $shop_url='/'.$shop_url;
        // if($this->slug!="")
        // return env('APP_URL').$shop_url.'/product/'.$this->slug.'.'.$this->shop_id;
        // else
        return env('APP_URL').$shop_url.'/product/'.$this->id;

        return url('');
    }
    public function get_discount_price($is_money=false){
        $price=$this->price;
        if($this->is_discount==1)//ลดแบบ ราคา
        {
            $price-=$this->discount_value;
          
        }
        else if($this->is_discount==2)//ลดแบบ %
        {
            $price=$price-($price*($this->discount_value/100));
        }

        if($price<0)
        $price=0;


        if($is_money)
        $price=number_format($price,2);

        return $price;
    }

}