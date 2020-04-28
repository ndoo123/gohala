<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $table='order_delivery_tb';
    //protected $primaryKey = ['order_id', 'id'];
    public $timestamps =false;
    public $incrementing=false;
}
