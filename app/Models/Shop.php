<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table='shop_tb';

    public function get_url(){
        return env('APP_URL').'/'.$this->url;
    }

}