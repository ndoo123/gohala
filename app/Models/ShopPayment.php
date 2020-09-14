<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class ShopPayment extends Model
{
    protected $table='shop_payment_tb';

    public $timestamps= false;

    protected $primaryKey = ['shop_id', 'method_id'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('shop_id', '=', $this->getAttribute('shop_id'))
            ->where('method_id', '=', $this->getAttribute('method_id'));
        return $query;
    }
    public static function get_payment($shop_id,$check = 0)
    {
        return ShopPayment::where('shop_id',$shop_id)->where('is_checked',$check)->get();
    }
}