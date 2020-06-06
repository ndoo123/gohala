@extends('web.master_web')
@section('bredcrumb')
<div class="breadcrumbs">
<div class="container">

</div>
</div>
@stop
@section('content')

<div id="product_view" class="main-container col1-layout">
    <div class="container">
          <div class="row">
      <div class="col-main">
        <div class="product-view-area">
          <div class="product-big-image col-md-5">
            <?php if($product->is_discount==1):?>
                <div class="icon-sale-label sale-left"><?php echo __('home.discount');?></div>
            <?php endif;?>
            <div class="large-image" style="background-image:url(<?php echo $product->get_photo();?>"> 
                 
			</div>
            <div class="flexslider flexslider-thumb">
              <ul class="previews-list slides">
                  <?php 
                  foreach($product->photos as $photo):
                  ?>
                  <li style="background-image:url(<?php echo $photo->get_image_url();?>)"></li>
                  <?php endforeach;?>
              </ul>
            </div>
            
            <!-- end: more-images --> 
            
          </div>
          <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
       
              <div class="product-name">
                <h1><?php echo $product->name;?></h1>
              </div>
              <div class="price-box">
                <?php if($product->is_discount==1):?>
                    <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> <?php echo $product->get_discount_price();?><?php echo __('home.baht');?> </span> </p>
                    <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> <?php echo number_format($product->price,2);?> </span> </p>
                <?php else:?>
                <span class="price text-black"> <?php echo number_format($product->price,2);?> </span>
                <?php endif;?>
              </div>
            
              <div style="border-top:0" class="short-description">
                <h2 style="color:black">รายละเอียดสินค้า</h2>
                <p><?php echo ($product->info_short!=""?$product->info_short:'('.__('home.no_product_info').')');?></p>
				<p>
					<?php 
					$info=$product->info_full;

			

					echo $info;
					?>
                    </p>
              </div>
             
              <div class="product-variation">
                <form action="#" method="post">
                  <div class="cart-plus-minus">
                    <label for="qty"><?php echo __('home.qty');?>:</label>
                    <div class="numbers-row">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                      <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                      <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                    </div>
                  </div>
                  <button class="button pro-add-to-cart" product_id="<?php echo $product->id;?>" title="<?php echo __('home.add_to_cart');?>" type="button"><span><i class="fa fa-shopping-cart"></i> <?php echo __('home.add_to_cart');?></span></button>
                </form>
              </div>
                <div class="product-color-size-area">
                  <span>จำหน่ายโดย: <span ><a href="<?php echo $product->shop->get_url();?>" class="text-danger"><?php echo $product->shop->name;?></a></span>
            
                </div>
              <!-- <div class="product-cart-option short-description">
                <ul>
                   <li><a href="#"><i class="fa fa-heart"></i><span>Add to Wishlist</span></a></li>
                  <li><a href="#"><i class="fa fa-retweet"></i><span>Add to Compare</span></a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i><span>Email</span></a></li>
                </ul>
           
            </div> -->
          </div>
        </div>
      </div>
   
    </div>
    </div>
</div>
@stop

@section('js')


<script>
	  $('.flexslider').flexslider({
    animation: "slide",
	itemWidth: 150,
	prevText: "",           
    nextText: "",

  });
  $('.toast').toast(option)
</script>
@stop