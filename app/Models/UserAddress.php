<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table='user_address_tb';

    public function province(){
        return $this->hasOne('\App\Models\Province','id','province_id');
    }

}