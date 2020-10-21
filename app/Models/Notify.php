<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notification_tb';
    public static $event = [
        1 => 'มีออเดอร์ใหม่',
        2 => 'มีการชำระเงินใหม่',
    ];
    
}
