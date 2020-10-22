<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notification_tb';
    protected $appends = ['created_show'];
    public static $event = [
        1 => 'มีออเดอร์ใหม่',
        2 => 'การชำระเงินโอน',
    ];
    public function getCreatedShowAttribute($value){
        return date("d/m/Y H:i:s",strtotime($this->created_at));
    }
}
