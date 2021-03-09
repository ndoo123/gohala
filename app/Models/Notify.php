<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notification_tb';
    protected $appends = ['created_show','shop_url','shop_name'];
    public static $event = [
        1 => 'คำสั่งซื้อใหม่',
        // 1 => 'มีออเดอร์ใหม่',
        2 => 'การชำระเงินโอน',
        3 => 'ออเดอร์จัดส่งสำเร็จ',
    ];
    public function getCreatedShowAttribute(){
        return date("d/m/Y H:i:s",strtotime($this->created_at));
    }
    public function shop()
    {
        return $this->belongsTo('\App\Models\Shop');
    }
    public function getShopUrlAttribute()
    {
        return $this->shop->url;
    }
    public function getShopNameAttribute()
    {
        return $this->shop->name;
    }
}
