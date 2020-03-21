<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $table='order_payment_tb';
    //protected $primaryKey = ['order_id', 'id'];
    public $timestamps =false;
}
