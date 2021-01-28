<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiProductPrice extends Model
{
    protected $table='api_product_price_tb';

    public function get_discount_price($is_money=false){
        $price=$this->price;
        if($this->is_discount==1)//ลดแบบ ราคา
        {
            $price-=$this->discount_value;
          
        }
        else if($this->is_discount==2)//ลดแบบ %
        {
            $price=$price-($price*($this->discount_value/100));
        }

        if($price<0)
        $price=0;


        if($is_money)
        $price=number_format($price,2);

        return $price;
    }
    public static function api_products($product_id) // แสดง row จาก ApiProductName = api_product_name_tb สถานะ 1 เพื่อนำมารวมกับข้อมูลเทเบิ้ลนี้(เพราะหากสินค้ายังไม่มีข้อมูลในเทเบิ้ลนี้จะไม่สามารถนำค่ามาแสดงได้)
    {
        $array_product_name = ApiProductName::where("status",1)->pluck('name')->toArray();
        $return = [];
        foreach($array_product_name as $p_name)
        {
            $array = ['name' => $p_name, 'price' => 0, 'is_discount' => 0, 'discount_value' => 0, 'status' => 0];
            $product = ApiProductPrice::where('name',$p_name)
            ->where('product_id',$product_id)
            ->first();
            if(!empty($product))
            {
                $product->real_price = $product->get_discount_price();
                $array = $product->toArray();
            }
            $return[] = $array;
            // $array['id'] = ;
        }
        return $return;
    }
}
