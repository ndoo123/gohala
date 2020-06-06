<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends Model
{
    protected $table='shop_category_product_tb';
    public $timestamps =false;

    protected $primaryKey = ['product_id', 'category_id'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('product_id', '=', $this->getAttribute('product_id'))
            ->where('category_id', '=', $this->getAttribute('category_id'));
        return $query;
    }

}