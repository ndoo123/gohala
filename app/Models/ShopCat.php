<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class ShopCat extends Model
{
    protected $table='shop_category_product_tb';
    // public function get_link($shop_url){
    //     return url($shop_url).'/cat/'.$this->id;
    // }
	public function shop(){
		return $this->belongsTo('App\Models\Shop');
	}
	public function category(){
		return $this->belongsTo('App\Models\ShopCategory');
	}
	public function product(){
		return $this->belongsTo('App\Models\Product');
	}
}