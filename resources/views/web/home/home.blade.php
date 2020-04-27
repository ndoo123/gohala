@extends('web.master_web')
@section('slider')
 
@stop
@section('content')
<div id="home" class="main-container col1-layout">
  <div class="container">
    <div class="row">
        <div class="col-main col-sm-12 col-xs-12 col-md-12">
          <div class="shop-inner">
            <div class="product-grid-area">
              <ul class="products-grid">
                
               
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
<script src="<?php echo url('assets');?>/web/js/page/home.js"></script>

@stop