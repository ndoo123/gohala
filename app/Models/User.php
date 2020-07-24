<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserAddress;
class User extends Authenticatable
{
    use Notifiable;
    protected $table='user_tb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address(){
        return $this->hasMany('\App\Models\UserAddress','user_id','id');
    }
    public function get_photo(){
        return env('APP_URL').'/profile/image/'.$this->id;
    }
    public function address_default()
    {
        return UserAddress::where('user_id',$this->id)->where('is_default',1)->first();
    }

}
