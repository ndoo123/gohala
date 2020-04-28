<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order_tb';
    //protected $primaryKey = ['id', 'shop_id'];
    public $timestamps =false;
    public $incrementing=false;
    public function shop(){
        return $this->hasOne('\App\Models\Shop','id','shop_id');
    }
    public function get_status_badge(){
        if($this->status==1)
        {
            if($this->payment_type==2)
            return '<span class="badge badge-info">รอการโอนเงิน</span>';
            
            return '<span class="badge badge-info">รอยืนยันการสั่งซื้อ</span>';
        }
    }
    public function items(){
        return $this->hasMany('\App\Models\OrderItem','order_id','id');
    }
    public function get_delivery(){
        $delivery=ShopDelivery::where("shop_shipping_tb.shipping_id",$this->shipping_id)
        ->leftJoin('ship_method_tb','ship_method_tb.id','shop_shipping_tb.shipping_id')
        ->where("shop_shipping_tb.shop_id",$this->shop_id)
        ->selectRaw('shop_shipping_tb.*,ship_method_tb.name')
        ->first();
        return $delivery;
    }
    public function get_user_status_badge(){
        if($this->status==1)
        {
            if($this->payment_type==2)
            return '<span class="badge badge-secondary">รอการโอนเงิน</span>';
            
            return '<span class="badge badge-info">รอยืนยันการสั่งซื้อ</span>';
        }
    }
}
