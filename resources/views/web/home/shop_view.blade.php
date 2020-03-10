@extends('web.master_web')

@section('content')
<div class="main-container col2-left-layout">
    <div class="container">
 <div class="row">
        <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
          
          <div class="shop-inner">
            
            <div class="toolbar">
              <div class="view-mode">
                <ul>
                  <li class="active"> <a href="shop_grid.html"> <i class="fa fa-th-large"></i> </a> </li>
                  <li> <a href="shop_list.html"> <i class="fa fa-th-list"></i> </a> </li>
                </ul>
              </div>
              <div class="sorter">
                <div class="short-by">
                  <label>Sort By:</label>
                  <select>
                    <option selected="selected">Position</option>
                    <option>Name</option>
                    <option>Price</option>
                    <option>Size</option>
                  </select>
                </div>
                <div class="short-by page">
                  <label>Show:</label>
                  <select>
                    <option selected="selected">18</option>
                    <option>20</option>
                    <option>25</option>
                    <option>30</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="product-grid-area">
              <ul class="products-grid">
                 <?php foreach($products as $product):?>
               <li class="item col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <?php if($product->is_discount==1):?>
                        <div class="icon-sale-label sale-left"><?php echo __('home.discount');?></div>
                        <?php endif;?>
                        <div class="pr-img-area"> 
                          <a title="<?php echo $product->name;?>" href="<?php echo $product->get_link();?>">
                            <figure style="background-image:url(<?php echo $product->get_photo();?>)"> 
                              
                            </figure>
                           
                          </a>
                          <button type="button" product_id="<?php echo $product->id;?>" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> <?php echo __('home.add_to_cart');?></span> </button>
                        </div>
                        <div class="pr-info-area">
                          <div class="pr-button">
                            <!-- <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="fa fa-heart"></i> </a> </div> -->
                            <!-- <div class="mt-button quick-view"> <a href="<?php echo url('product/'.$product);?>"> <i class="fa fa-search"></i> </a> </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="<?php echo $product->name;?>" href="single_product.html"><?php echo $product->name;?> </a> </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price"><?php echo number_format($product->price,2);?> <?php echo __('home.baht');?></span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach;
              if(count($products)==0)
              echo '<p style="margin:20px">-- ไม่มีข้อมูลสินค้า --</p>';
              ?>
             
              
              </ul>
            </div>
            <div class="pagination-area ">
              <ul>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <aside class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <div class="block category-sidebar">
            <div class="sidebar-title">
              <h3>Categories</h3>
            </div>
            <ul class="product-categories">
              <li class="cat-item current-cat cat-parent"><a href="shop_grid.html">Women</a>
                <ul class="children" style="display: block;">
                  <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Accessories</a>
                    <ul class="children" style="display: none;">
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Dresses</a></li>
                      <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Handbags</a>
                        <ul style="display: none;" class="children">
                          <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Beaded Handbags</a></li>
                          <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Sling bag</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Handbags</a>
                    <ul class="children" style="display: none;">
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; backpack</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Beaded Handbags</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Fabric Handbags</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Sling bag</a></li>
                    </ul>
                  </li>
                  <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Jewellery</a> </li>
                  <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Swimwear</a> </li>
                </ul>
              </li>
              <li class="cat-item cat-parent"><a href="shop_grid.html">Men</a>
                <ul class="children" style="display: none;">
                  <li class="cat-item cat-parent"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Dresses</a>
                    <ul class="children" style="display: none;">
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Casual</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Designer</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Evening</a></li>
                      <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Hoodies</a></li>
                    </ul>
                  </li>
                  <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Jackets</a> </li>
                  <li class="cat-item"><a href="shop_grid.html"><i class="fa fa-angle-right"></i>&nbsp; Shoes</a> </li>
                </ul>
              </li>
              <li class="cat-item"><a href="shop_grid.html">Electronics</a></li>
              <li class="cat-item"><a href="shop_grid.html">Furniture</a></li>
              <li class="cat-item"><a href="shop_grid.html">KItchen</a></li>
            </ul>
          </div>
          <div class="block shop-by-side">
            <div class="sidebar-bar-title">
              <h3><a href="<?php echo $shop->get_url();?>"><?php echo $shop->name;?></a></h3>
            </div>
            <div class="text-center">
                <img height="100" src="<?php echo url('assets/images/shop_icon.png');?>">
                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
            </div>
            
            <div class="block-content">
              <div class="manufacturer-area">
                <h2 class="saider-bar-title">ข้อมูลร้าน</h2>
                <div class="saide-bar-menu">
                  <ul>
                    <li><a href="#"><i class="fa fa-user"></i> <?php echo $shop->user->name;?></a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i> <?php echo date('d/m/Y',strtotime($shop->created_at));?></a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> สินค้า: 0 </a></li>
                    <li><a href="#"><i class="fa fa-comment"></i> 3 </a></li>
                  </ul>
                </div>
              </div>
              <div class="layered-Category">
                <h2 class="saider-bar-title"><?php echo __('home.product_category');?></h2>
                <div class="layered-content">
                  <ul class="check-box-list">
                    <?php foreach($categories as $cat):?>
                     <li><a href="<?php echo $shop->get_url();?>/cat/<?php echo $cat->slug;?>"><i class="fa fa-angle-right"></i> <?php echo $cat->name;?></a></li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
              
              
              
            </div>
          </div>
          
          
          
          <?php if(count($discount_items)>0):?>
          <div class="block special-product">
            <div class="sidebar-bar-title">
              <h3>สินค้าลดราคา</h3>
            </div>
            <div class="block-content">
              <ul>
              <?php for($i=0;$i<5;$i++):
              if(!isset($discount_items[$i]))
              break;
              ?>
                 <li class="item">
                  <div class="products-block-left"> <a href="<?php echo $discount_items[$i]->get_link();?>" title="<?php echo $discount_items[$i]->name;?>" class="product-image" ><figure style="background-image:url(<?php echo $discount_items[$i]->get_photo();?>)"></figure></a></div>
                  <div class="products-block-right">
                    <p class="product-name"> <a href="<?php echo $discount_items[$i]->get_link();?>"><?php echo $discount_items[$i]->name;?></a> </p>
                    <span class="price"><?php echo $discount_items[$i]->get_discount_price(true);?></span>
                  </div>
                </li>
              <?php endfor;?>
              </ul>
              <a class="link-all" href="<?php echo $shop->get_url();?>?get=special">สินค้าราคาพิเศษ</a> </div>
          </div>
          <?php endif;?>
        </aside>
      </div>
</div>
</div>
@stop
