<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product_tb';

    public function get_photo(){
      
        if($this->default_photo!="")
        {
            return env('APP_URL').'/images/product/'.$this->shop_id.'/'.$this->default_photo.'.jpg';
        }

        return env('APP_URL').'/assets/images/no_image_available.jpeg';
    }

    public function category(){
        return $this->hasOne('\App\Models\ProductCategory','id','category_id');
    }
    public function photos(){
        return $this->hasMany('\App\Models\ProductPhoto','product_id','id');
    }

}