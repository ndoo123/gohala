<?php

namespace App\Models;

use App\Models\OrderDelivery;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order_tb';
    //protected $primaryKey = ['id', 'shop_id'];
    public $timestamps =false;
    public $incrementing=false;

    public static $label_status = [
        -1 => 'รายการรอดำเนินการ',
        0 => 'ยกเลิก',
        1 => 'สั่งซื้อ',
        2 => 'ยืนยันคำสั่งซื้อ',
        3 => 'ดำเนินการจัดส่ง',
        4 => 'จัดส่งเรียบร้อย',
        5 => 'รอการโอนเงิน',
        6 => 'รอตรวจสอบการโอนเงิน',
    ];
    protected static $color_status = [
        0 => 'danger',
        1 => 'info',
        2 => 'primary',
        3 => 'warning',
        4 => 'success',
        5 => 'secondary',
        6 => 'primary',
    ];
    public function shop(){
        return $this->hasOne('\App\Models\Shop','id','shop_id');
    }
    public function delivery(){
        return $this->hasOne('\App\Models\OrderDelivery','order_id');
    }
    public function items(){
        return $this->hasMany('\App\Models\OrderItem','order_id');
    }
    public function buyer(){
        return $this->belongsTo('\App\Models\User','buyer_user_id');
    }
    public function payment(){
        return $this->belongsTo('\App\Models\Payment','payment_type');
    }
    public function shop_payment(){
        return $this->belongsTo('\App\Models\OrderTranfer','id','order_id');
    }
    public function shop_payment_transfer(){
        return $this->hasOne('\App\Models\ShopPayment','shop_id','shop_id')->where('method_id',2);
    }
    public function get_status_badge(){
        if($this->status==1)
        {
            if($this->payment_type==2)
            return '<span class="badge badge-info">รอการโอนเงิน</span>';
            
            return '<span class="badge badge-info">รอยืนยันการสั่งซื้อ</span>';
        }
        // return $label_status[$this->status];
    }
    // public function items(){
    //     return $this->hasMany('\App\Models\OrderItem','order_id','id');
    // }
    public function get_delivery(){
        $delivery=ShopDelivery::where("shop_shipping_tb.shipping_id",$this->shipping_id)
        ->leftJoin('ship_method_tb','ship_method_tb.id','shop_shipping_tb.shipping_id')
        ->where("shop_shipping_tb.shop_id",$this->shop_id)
        ->selectRaw('shop_shipping_tb.*,ship_method_tb.name')
        ->first();
        return $delivery;
    }
    public function get_payment_method_name(){
        return $this->payment->name;
    }
    public function get_user_status_badge(){
        
        return self::$label_status[$this->status];
    }
    public function get_status_show()
    {
        // dd($r->all());
        return '<span class="badge badge-'.self::$color_status[$this->status].'">'.self::$label_status[$this->status].'</span>';
    }
    public function delivery_update()
    {
        // dd($this->delivery,$this);
        $field = '';
        $today = date("Y-m-d H:i:s");
        if($this->status == 2)
        {
            $field = 'confirm_date';
        }
        else if($this->status == 3)
        {
            $field = 'delivery_date';
        }
        else if($this->status == 4)
        {
            $field = 'received_date';
        }
        $delivery = OrderDelivery::where('order_id',$this->id)->first();
        $delivery->$field = $today;
        $delivery->save();
    }
    public function get_sold_price($bool = false)
    {
        if($bool == true)
        {
            return number_format($this->total + $this->total_delivery,2);
        }
        return $this->total + $this->total_delivery;
    }
    protected function next_stats(){
        return $this->status < 4 ? $this->status + 1 : '';
    }
    public function btn_cancel()
    {
        $button = '';
        if(in_array($this->status,[1,5,6]))
            $button = '&nbsp;<button type="button" class="btn btn-sm btn-danger btn_order_cancel" order_id="'.$this->id.'">'.__('view.order_cancel').'</button>';
        return $button;
    }
    public function btn_confirm()
    {
        $status = self::next_stats();
        return '<button type="button" class="btn btn-sm btn-primary btn_order" order_id="'.$this->id.'" status="'.$status.'">'.__('view.confirm').'</button>';
    }
    public function btn_send()
    {
        $status = self::next_stats();
        return '<button type="button" class="btn btn-sm btn-warning btn_order" order_id="'.$this->id.'" status="'.$status.'">'.__('view.order_send').'</button>';
    }
    public function btn_success()
    {
        $status = self::next_stats();
        return '<button type="button" class="btn btn-sm btn-success btn_order" order_id="'.$this->id.'" status="'.$status.'">'.__('view.order_success').'</button>';
    }
    public function btn_view_payment()
    {
        if(in_array($this->status,[0,5]) || $this->payment_type != 2)
            return '';
            
        $shop_payment = $this->shop_payment;
        $price = $this->get_sold_price(true);
        $attr = ' 
        order_id="'.$this->id.'" 
        price="'.$price.'"
        payment=\''.$shop_payment.'\' 
        ';
        // payment=\''.$shop_payment->payment_data.'\' 
        return '&nbsp;<button type="button" class="btn btn-sm btn-info btn_order_payment_view"'.$attr.'>ดูการชำระเงิน</button>';
    }
    public function btn_payment()
    {
        $shop_payment = $this->shop_payment_transfer;
        // dd($shop_payment);
        $price = $this->get_sold_price(true);
        $attr = ' 
        order_id="'.$this->id.'" 
        price="'.$price.'"
        payment=\''.$shop_payment->payment_data.'\' 
        ';
        return '<button type="button" class="btn btn-sm btn-primary btn_order_payment"'.$attr.'>แจ้งโอนเงิน</button>';
    }
}
