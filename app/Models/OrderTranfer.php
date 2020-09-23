<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTranfer extends Model
{
    protected $table='order_tranfer_tb';
    protected $primaryKey = 'order_id';
    public $incrementing = false;

    public function get_photo(){
      
		return env('APP_URL').'/images/bank_tranfer/'.$this->shop_id.'/'.$this->payment_file.'.jpg';
	}
}
