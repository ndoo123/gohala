@extends('web.ecommerce.master')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="all">
            <div class="slider">
                <div class="owl-carousel owl-theme main">
                    <?php $photos=$product->photos;?>
                    <?php foreach($photos as $photo):?>
                    <div style="background-image: url(<?php echo $photo->get_image_url();?>);background-size: contain;background-repeat: no-repeat;" class="item-box"></div>
                    <?php endforeach;?>
                    
                </div>
                <div class="left nonl"><i class="ti-angle-left"></i></div>
                <div class="right"><i class="ti-angle-right"></i></div>
            </div>
            <div class="slider-two">
                <div class="owl-carousel owl-theme thumbs">
                     <?php foreach($photos as $index=>$photo):?>
                    <div style="background-image: url(<?php echo $photo->get_image_url();?>);" class="item <?php $index==0?'active':'';?>"></div>
                    <?php endforeach;?>
                </div>
                <div class="left-t nonl-t"></div>
                <div class="right-t"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="breadcrumbs">
            <ul>
                <li><a href="<?php echo url($shop->url);?>">หน้าแรก</a></li>
                 <?php $cat=$product->get_category(); 
                 if($cat)
                 echo '<li><a href="'.$cat->get_link($shop->url).'">'.$cat->name.'</a></li>';
                 ?>
                <li><?php echo $product->name;?></li>
            </ul>
        </div>
        <!-- /page_header -->
        <div class="prod_info">
            <h1><?php echo $product->name;?></h1>
            
            <p><small>SKU: <?php echo $product->sku;?></small><br><?php echo $product->info_short;?></p>
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="price_main">
                        <span class="new_price"><?php echo $product->get_discount_price(true).'฿';?></span>
                       <?php if($product->is_discount!=0):?>
                        <p class="mt-1"><span class="percentage ml-0">-<?php echo $product->discount_value.($product->is_discount==2?'%':'฿');?></span> <span class="old_price"><?php echo number_format($product->price,2);?></span></p>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="btn_add_to_cart"><a href="javascript:;" 
                    onclick="add_to_cart({{ $link }})" class="btn_1">หยิบลงตระกร้า</a></div>
                    {{-- onclick="add_to_cart({{ $product->id.',1' }})" class="btn_1">หยิบลงตระกร้า</a></div> --}}
                </div>
            </div>
        </div>
        <!-- /prod_info -->
        <div class="product_actions">
        <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>รายละเอียด</h3>
                        <p><?php echo nl2br($product->info_full);?></p>
                    </div>
            
                </div>
            </div>
	    <!-- /tab_content_wrapper -->
        </div>
        <!-- /product_actions -->
    </div>
</div>
   
@stop
@section('css')
<link href="<?php echo url('');?>/assets/web/css/product_page.css" rel="stylesheet">
@stop
@section('js')
<script src="<?php echo url('');?>/assets/web/js/carousel_with_thumbs.js"></script>
@stop