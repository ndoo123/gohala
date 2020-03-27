<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table='order_item_tb';
    //protected $primaryKey = ['order_id', 'id'];
    public $timestamps =false;
}
