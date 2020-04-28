@extends('web.master_web')

@section('content')
<div id="home" class="main-container col1-layout">
  <div class="container">
    <div class="row">
        <div class="col-main col-sm-12 col-xs-12 col-md-12">
          <div class="shop-inner">
              <h4>ผลการค้นหา "<?php echo isset($_GET["s"])?$_GET["s"]:'';?>" พบ <?php echo count($products);?> รายการ</h4>
              <hr>
            <div class="product-grid-area">
              <ul class="products-grid">
                  <?php foreach($products as $p):?>
                  <li class="item col-lg-3 col-md-4 col-sm-6 col-xs-6 ">
                    <div class="product-item">
                        <div class="item-inner">
                            <div style="background-image:url(<?php echo $p->get_photo();?>)" class="product-thumbnail">
                                <div class="pr-img-area">
                                    <a title="df" href="<?php echo $p->get_link();?>">
                                        <figure> </figure>
                                    </a>
                                    <button type="button" product_id="<?php echo $p->id;?>" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> ซื้อสินค้า</span> </button>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="info-inner">
                                    <div class="item-title"> <a title="<?php echo $p->name;?>" href="<?php echo $p->get_link();?>"><?php echo $p->name;?></a> </div>
                                    <div class="item-content">
                                        <div class="item-price">
                                            <div class="price-box"> <span class="regular-price"> <span class="price"><?php echo number_format($p->price,2);?></span> </span>
                                            </div>
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
           
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@stop

@section('js')
<!-- Revolution Slider --> 
<script src="<?php echo url('assets');?>/web/js/page/search.js"></script>

@stop