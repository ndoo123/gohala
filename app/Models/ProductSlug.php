<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class ProductSlug extends Model
{
    protected $table='product_slug_tb';
    public $timestamps =false;
    protected $primaryKey = ['product_id', 'slug'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('product_id', '=', $this->getAttribute('product_id'))
            ->where('slug', '=', $this->getAttribute('slug'));
        return $query;
    }
}