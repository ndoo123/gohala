@extends('web.master_web')
@section('bredcrumb')
<div class="breadcrumbs">
<div class="container">
    <div class="row">
    <div class="col-xs-12">
        <ul>
        <li class="home"> <a title="<?php echo __('home.home');?>" href="<?php echo url('');?>"><?php echo __('home.home');?></a><span>»</span></li>
        <li class=""> <a title="<?php echo $category->name;?>" href="<?php echo url('category').'/'.$category->slug;?>"><?php echo $category->name;?></a><span>»</span></li>
        <li><strong><?php echo $product->name;?></strong></li>
        </ul>
    </div>
    </div>
</div>
</div>
@stop
@section('content')
<div class="main-container col1-layout">
    <div class="container">
          <div class="row">
      <div class="col-main">
        <div class="product-view-area">
          <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
            <?php if($product->is_discount==1):?>
                <div class="icon-sale-label sale-left"><?php echo __('home.discount');?></div>
            <?php endif;?>
            <div class="large-image"> 
                <a href="<?php echo $product->get_link();?>" class="cloud-zoom" id="zoom_product_<?php echo $product->id;?>" rel="useWrapper: false, adjustY:0, adjustX:20"> <img class="zoom-img" src="<?php echo $product->get_photo();?>" alt="products"> </a> </div>
            <div class="flexslider flexslider-thumb">
              <ul class="previews-list slides">
                  <?php 
                  foreach($product->photos as $photo):
                  ?>
                  <li><a href='<?php echo $photo->get_image_url();?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom_product_<?php echo $product->id;?>', smallImage: '<?php echo $photo->get_image_url();?>' "><img src="<?php echo $photo->get_image_url();?>" alt = "<?php echo $product->name;?>"/></a></li>
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
              <div class="ratings">
                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                <p class="availability in-stock pull-right">Availability: <span>In Stock</span></p>
              </div>
              <div class="short-description">
                <h2>Quick Overview</h2>
                <p><?php echo ($product->info_short!=""?$product->info_short:'('.__('home.no_product_info').')');?></p>
              </div>
              <!-- <div class="product-color-size-area">
                <div class="color-area">
                  <h2 class="saider-bar-title">Color</h2>
                  <div class="color">
                    <ul>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                    </ul>
                  </div>
                </div>
                
              </div> -->
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
                  <button class="button pro-add-to-cart" title="<?php echo __('home.add_to_cart');?>" type="button"><span><i class="fa fa-shopping-cart"></i> <?php echo __('home.add_to_cart');?></span></button>
                </form>
              </div>
                <div class="product-color-size-area">
                  <span>จำหน่ายโดย: <span ><a href="<?php echo $product->shop->get_url();?>" class="text-danger"><?php echo $product->shop->name;?></a></span>
            
                </div>
              <div class="product-cart-option short-description">
                <ul>
                  <!-- <li><a href="#"><i class="fa fa-heart"></i><span>Add to Wishlist</span></a></li>
                  <li><a href="#"><i class="fa fa-retweet"></i><span>Add to Compare</span></a></li> -->
                  <li><a href="#"><i class="fa fa-envelope"></i><span>Email</span></a></li>
                </ul>
           
            </div>
          </div>
        </div>
      </div>
      <div class="product-overview-tab">
        <div class="container">
          <div class="row">
            <div class="col-xs-12"><div class="product-tab-inner"> 
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#description" data-toggle="tab"> <?php echo __('home.product_info');?> </a> </li>
                <li> <a href="#reviews" data-toggle="tab"><?php echo __('home.review');?></a> </li>
               
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <div class="std">
                    <p>
                        <?php 
                        $info=$product->info_full;

                        if($info=="")
                        {
                            $info=$product->info_short;
                        }
                        if($info=="")
                        $info=__('home.no_product_info');

                        echo $info;
                        ?>
                    </p>
                   
                  </div>
                </div>
                
                
                  <div id="reviews" class="tab-pane fade">
							<div class="col-sm-5 col-lg-5 col-md-5">
								<div class="reviews-content-left">
									<h2>Customer Reviews</h2>
									<div class="review-ratting">
									<p><a href="#">Amazing</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Angela Mack<small> (Posted on 16/12/2015)</small>
									</p>
									</div>
                                    
                                    
                                    <div class="review-ratting">
									<p><a href="#">Good!!!!!</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Lifestyle<small> (Posted on 20/12/2015)</small>
									</p>
									</div>
                                    
                                    
                                    <div class="review-ratting">
									<p><a href="#">Excellent</a> Review by Company</p>
									<table>
										<tbody><tr>
											<th>Price</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Value</th>
											<td>
												<div class="rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</td>
										</tr>
										<tr>
											<th>Quality</th>
											<td>
												<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
											</td>
										</tr>
									</tbody></table>
									<p class="author">
										Jone Deo<small> (Posted on 25/12/2015)</small>
									</p>
									</div>
                                    
								</div>
							</div>
							<div class="col-sm-7 col-lg-7 col-md-7">
								<div class="reviews-content-right">
									<h2>Write Your Own Review</h2>
									<form>
										<h3>You're reviewing: <span>Donec Ac Tempus</span></h3>
										<h4>How do you rate this product?<em>*</em></h4>
                                        <div class="table-responsive reviews-table">
										<table>
											<tbody><tr>
												<th></th>
												<th>1 star</th>
												<th>2 stars</th>
												<th>3 stars</th>
												<th>4 stars</th>
												<th>5 stars</th>
											</tr>
											<tr>
												<td>Quality</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
											<tr>
												<td>Price</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
											<tr>
												<td>Value</td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
												<td><input type="radio"></td>
											</tr>
										</tbody></table></div>
										<div class="form-area">
											<div class="form-element">
												<label>Nickname <em>*</em></label>
												<input type="text">
											</div>
											<div class="form-element">
												<label>Summary of Your Review <em>*</em></label>
												<input type="text">
											</div>
											<div class="form-element">
												<label>Review <em>*</em></label>
												<textarea></textarea>
											</div>
											<div class="buttons-set">
												<button class="button submit" title="Submit Review" type="submit"><span><i class="fa fa-thumbs-up"></i> &nbsp;Review</span></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
            
                <div class="tab-pane fade" id="product_tags">
                  <div class="box-collateral box-tags">
                    <div class="tags">
                                
                        
                      <form id="addTagForm" action="#" method="get">
                        <div class="form-add-tags">

                          
                          <div class="input-box"><label for="productTagName">Add Your Tags:</label>
                            <input class="input-text" name="productTagName" id="productTagName" type="text">
                            <button type="button" title="Add Tags" class="button add-tags"><i class="fa fa-plus"></i> &nbsp;<span>Add Tags</span> </button>
                          </div>
                          <!--input-box--> 
                        </div>
                      </form>
                    </div>
                    <!--tags-->
                    <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                  </div>
                </div>
                <div class="tab-pane fade" id="custom_tabs">
                  <div class="product-tabs-content-inner clearfix">
                    <p><strong>Lorem Ipsum</strong><span>&nbsp;is
                      simply dummy text of the printing and typesetting industry. Lorem Ipsum
                      has been the industry's standard dummy text ever since the 1500s, when 
                      an unknown printer took a galley of type and scrambled it to make a type
                      specimen book. It has survived not only five centuries, but also the 
                      leap into electronic typesetting, remaining essentially unchanged. It 
                      was popularised in the 1960s with the release of Letraset sheets 
                      containing Lorem Ipsum passages, and more recently with desktop 
                      publishing software like Aldus PageMaker including versions of Lorem 
                      Ipsum.</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
        </div>
      </div>
    </div>
    </div>
</div>
@stop
@section('js')
<!-- flexslider js --> 
<script src="<?php echo url('assets/web/js/jquery.flexslider.js');?>"></script> 


<!--cloud-zoom js --> 
<script src="<?php echo url('assets/web/js/cloud-zoom.js');?>"></script> 
@stop