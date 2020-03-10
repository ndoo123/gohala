<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class ProductPhoto extends Model
{
    protected $table='product_photo_tb';
    protected $primaryKey = ['product_id', 'name'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('product_id', '=', $this->getAttribute('product_id'))
            ->where('name', '=', $this->getAttribute('name'));
        return $query;
    }
    public function get_image_url(){
        return env('APP_URL').'/images/product/'.$this->shop_id.'/'.$this->product_id.'.'.$this->name.'.jpg';
    }
    

}