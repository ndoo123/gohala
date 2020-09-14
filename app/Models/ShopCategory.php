<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class ShopCategory extends Model
{
    protected $table='shop_category_tb';
    public function get_link($shop_url){
        return url($shop_url).'/cat/'.$this->id;
    }
}