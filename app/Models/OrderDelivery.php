<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $table='order_delivery_tb';
    protected $primaryKey = 'order_id';
    public $timestamps =false;
    public $incrementing=false;


    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     $query
    //         ->where('order_id', '=', $this->getAttribute('order_id'));
    //     return $query;
    // }
}
