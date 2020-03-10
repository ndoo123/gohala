<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product_tb';

    public function get_photo(){
      
       return env('APP_URL').'/images/product/'.$this->shop_id.'/'.$this->id.'.'.$this->default_photo.'.jpg';
    }

    public function category(){
        return $this->hasOne('\App\Models\ProductCategory','id','category_id');
    }
    public function photos(){
        return $this->hasMany('\App\Models\ProductPhoto','product_id','id');
    }
    public function shop(){
        return $this->hasOne('\App\Models\Shop','id','shop_id');
    }
    public function get_link(){
       
        if($this->slug!="")
        return env('APP_URL').'/product/'.$this->slug.'.'.$this->shop_id;
        else
        return env('APP_URL').'/product/'.$this->id.'.'.$this->shop_id;

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
            $price=$price*($price*$this->discount_value/100);
        }

        if($price<0)
        $price=0;


        if($is_money)
        $price=number_format($price,2);

        return $price;
    }

}