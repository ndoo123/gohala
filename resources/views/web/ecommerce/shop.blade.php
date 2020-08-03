@extends('web.ecommerce.master')
@section('content')
<div class="main_title">
	<h2><?php echo $shop->name;?></h2>
</div>
<input type="hidden" name="rest_url" id="rest_url" value="{{ $shop->url }}">
<div id="product_list" class="row small-gutters">
	<?php 
	if(isset($products)):
	foreach($products as $product):?>
	<div class="col-6 col-md-4 col-xl-3">
		<div class="grid_item">
			<?php if($product->is_discount!=0):?>
			<span class="ribbon off">-<?php echo $product->discount_value.' '.($product->is_discount==1?'฿':'%');?></span>
			<?php endif;?>
			<figure>
				<a href="<?php echo $product->get_link($shop->url);?>">
					<img class="img-fluid lazy" src="<?php echo $product->get_photo();?>" data-src="<?php echo $product->get_photo();?>" alt="">
				</a>
			</figure>
			<a href="<?php echo $product->get_link($shop->url);?>">
				<h3><?php echo $product->name;?></h3>
			</a>
			<div class="price_box">
				<span class="new_price"><?php echo $product->get_discount_price(true);?> ฿</span>
				<?php if($product->is_discount!=0):?>
				<span class="old_price"><?php echo number_format($product->price,2);?> ฿</span>
				<?php endif;?>
			</div>
			<ul>
				<li>
					<a href="<?php echo $product->get_link($shop->url);?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="ซื้อสินค้า">
						<i class="ti-shopping-cart"></i>
						<span>ซื้อสินค้า</span>
					</a>
				</li>
			</ul>
		</div>

	</div>
	<?php endforeach;
	endif;
	?>
</div>
<!-- /row -->
@stop
@section('js')
    <script src="<?php echo url('');?>/assets/web/js/plugins/infinited_scroll.js"></script>
 <script src="<?php echo url('');?>/assets/web/js/pages/shop.js"></script>
@stop