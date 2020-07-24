<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table='user_address_tb';

    public function province(){
        return $this->hasOne('\App\Models\Province','id','province_id');
    }
    public function get_address()
    {
        $address=$this->address.' '.$this->province->name.' '.$this->zipcode;
       
        return $address;
    }
    public function only_address()
    {
        return $this->name_address.' '.$this->address;
    }

}