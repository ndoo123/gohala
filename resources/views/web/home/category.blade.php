@extends('web.master_web')
@section('bredcrumb')
<div class="breadcrumbs">
<div class="container">
    <div class="row">
    <div class="col-xs-12">
        <ul>
        <li class="home"> <a title="<?php echo __('home.home');?>" href="<?php echo url('');?>"><?php echo __('home.home');?></a><span>»</span></li>
        <li><strong><?php echo $category->name;?></strong></li>
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
        <div class="col-main col-sm-12 col-xs-12">
          <div class="shop-inner">
            <div class="page-title">
              <h2><?php echo $category->name;?></h2>
            </div>
            <div class="toolbar column">
              <div class="sorter">
                <div class="short-by">
                  <label><?php echo __('home.sort_by');?>:</label>
                  <select>
                    <option value="1" selected="selected"><?php echo __('home.price_low_to_high');?></option>
                    <option value="2"><?php echo __('home.price_high_to_low');?></option>
                    <option value="3"><?php echo __('home.name');?></option>
                  </select>
                </div>
                <div class="short-by page">
                  <label><?php echo __('home.show');?>:</label>
                  <select>
                    <option selected="selected">16</option>
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
                          <button type="button" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> <?php echo __('home.add_to_cart');?></span> </button>
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
              <?php endforeach;?>
              
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
      </div>
</div>
</div>
@stop