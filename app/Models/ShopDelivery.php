<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ShipMethod;
class ShopDelivery extends Model
{
    protected $table='shop_shipping_tb';

    public $timestamps= false;

    protected $primaryKey = ['shop_id', 'shipping_id'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('shop_id', '=', $this->getAttribute('shop_id'))
            ->where('shipping_id', '=', $this->getAttribute('shipping_id'));
        return $query;
    }
    public function get_calculate(){
        if($this->cal_type==1)
        {
            return "ค่าใช้จ่ายเหมารวม";
        }
        else if($this->cal_type==2)
        { 
            return "ค่าส่ง * จำนวนรายการ";
        }
    }
    public function ship_method()
    {
        return $this->belongsTo(new ShipMethod,'shipping_id');
    }
    public static function get_delivery($shop_id)
    {
        $return = self::where('shop_id',$shop_id)->where('is_checked',1)->get();
        // dd($shop_id,$return);
        return $return;
    }
    public function get_price($qty)
    {
        $price = (float)$this->ship_cost;
        if($this->cal_type == 2)
        {
            $price = $price * (int)$qty;
        }
        return $price;
    }
}