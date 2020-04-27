<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table='order_item_tb';
    //protected $primaryKey = ['order_id', 'id'];
    public $timestamps =false;
    public $incrementing=false;
    public function product(){
        return $this->hasOne('\App\Models\Product','id','product_id');
    }
}
