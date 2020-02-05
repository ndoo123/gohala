<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table='shop_tb';

    public function get_url(){
        return env('APP_URL').'/'.$this->url;
    }
    public function is_allow($user)
    {
         //สำหรับเช็คว่ามีสิทธิ์เข้าถึงมั้ย

        if($this->user_id==$user->id)// เป็นเจ้าของ
        return true;
    }

}