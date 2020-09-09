@extends('web.ecommerce.master')
@section('content')
<?php

  $basket=\Cart::get_cart();
// dd($basket);
  ?>
<div style="margin-bottom:20px">
<a href="<?php echo url()->previous();?>">< กลับไปยังร้านก่อนหน้า</a>
<img class="float-right" src="<?php echo url('');?>/assets/images/logo-dark.png" alt=""  height="35">
</div>

<?php
foreach($basket as $b):?>
<div class="card" style="margin-bottom:15px;margin-top:15px">
    <div class="card-body">
     <h3 style="margin-bottom:15px"><?php echo $b['name'];?>
    <div class="float-right">
        <a href='<?php echo url($b['url']);?>/checkout' class="btn_1">ชำระร้านนี้</a>
        <button type="button" shop_id="<?php echo $b['shop_id'];?>" class="btn_2 remove_shop_from_cart">ลบรายการร้านนี้</button>
    </div>
</h3>
<table class="table table-striped cart-list">
    <thead>
        <tr>
            <th>
                สินค้า
            </th>
            <th>
                ราคา
            </th>
            <th>
                จำนวน
            </th>
            <th>
                รวม
            </th>
            <th>
                
            </th>
        </tr>
    </thead>
    <tbody>
        <?php 
    
        $shop_total=0;
        foreach($b['items'] as $item):
            if(!isset($item['price']))
                continue;
        $total=$item['price']*$item['qty'];
        $shop_total+=$total;
        ?>
        <tr product_id="<?php echo $item['product_id'];?>" shop_id="<?php echo $b['shop_id'];?>">
            <td>
                <div class="thumb_cart">
                    <img src="<?php echo $item['img'];?>" data-src="<?php echo $item['img'];?>" class="lazy" alt="<?php echo $item['name'];?>">
                </div>
                <span class="item_cart"><?php echo $item['name'];?></span>
            </td>

            <td>
                <strong price="<?php echo $item['price'];?>"><?php echo number_format($item['price'],2);?></strong>
            </td>

            <td>
                <div class="numbers-row">
                    <input type="text" value="<?php echo $item['qty'];?>" id="quantity_<?php echo $item['product_id'];?>" class="qty2 qty" name="quantity_<?php echo $item['product_id'];?>">
                  
                </div>
            </td>

            <td class='text-right'>
                <strong class="sum_product"><?php echo number_format($total,2);?></strong>
            </td>

            <td class="options">
                <a href="javascript:;"><i class="ti-trash"></i></a>
            </td>
            
        </tr>
        <?php endforeach;?>
        <tr>
            <td colspan="3" class="text-right">รวม:</td>
            <td class='text-right sum_res' ><?php echo number_format($shop_total,2);?></td>
            <td></td>
        </tr>
    </tbody>
</table>
    </div>
</div>
<?php endforeach;?>
@stop
@section('css')
<link href="<?php echo url('');?>/assets/web/css/cart.css" rel="stylesheet">
@stop
@section('js')
<script src="<?php echo url('');?>/assets/web/js/pages/cart.js"></script>
@stop