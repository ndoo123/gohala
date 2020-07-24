@extends('web.home.master')
@section('content')
<?php

//   $basket=\Cart::get_cart();

  ?>
{{-- <div style="margin-bottom:20px">
<a href="{{ url()->previous(); }}">< กลับไปยังร้านก่อนหน้า</a>
<img class="float-right" src="{{ url('/assets/images/logo-dark.png') }}" alt=""  height="35">
</div> --}}
<main class="bg_gray">
	
		
	<div class="container margin_30">
        {{ \LKS::has_alert() }}
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Restaurant</a></li>
					<li>Checkout</li>
				</ul>
            </div>
            {{-- <h1>Sign In or Create an Account</h1> --}}
            <h1>Checkout</h1>
        </div>
	<!-- /page_header -->
        <form class="row" action="{{ $url_submit }}" method="post">
        {{ csrf_field() }}
            <div class="col-lg-4 col-md-6">
                <div class="step first">
                    <h3>1. User Info and Billing address</h3>
                    <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Info</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Login</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content checkout">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                            {{-- <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" value="{{ !empty($user->email)?$user->email:'' }}" required>
                            </div> --}}
                            {{-- <hr> --}}
                            <div class="row no-gutters">
                                <div class="col-12 form-group pr-1">
                                    <input type="text" class="form-control" placeholder="Name Contact" name="name_contact" id="name_contact" value="{{ !empty($address_default->name_contact)?$address_default->name_contact:'' }}" required>
                                </div>
                            </div>
                                <!-- /row -->
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name Address" name="name_address" id="name_address" value="{{ !empty($address_default->name_address)?$address_default->name_address:'' }}" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Full Address" name="address" id="address" value="{{ !empty($address_default->address)?$address_default->address:'' }}" required>
                            </div>
                            {{-- <div class="row no-gutters">
                            </div> --}}
                                <!-- /row -->
                            <div class="row no-gutters">

                                <div class="col-6 form-group pr-1">
                                    <input type="text" class="form-control" placeholder="Telephone" id="phone" name="phone" value="{{ !empty($address_default->phone)?$address_default->phone:'' }}" required>
                                </div>
                                <div class="col-6 form-group pl-1">
                                    <input type="text" class="form-control" placeholder="Postal code" id="zipcode" name="zipcode" value="{{ !empty($address_default->zipcode)?$address_default->zipcode:'' }}" required>
                                </div>

                                <div class="col-12 form-group">
                                    {{-- <div class="custom-select-form"> --}}
                                        <select class="select2 wide add_bottom_15 custom-select-form form-control" name="province_id" id="province_id" required>
                                            <option value="" >Country</option>
                                            @if(!empty($provinces))
                                                @foreach($provinces as $p)
                                                <?php
                                                $check = '';
                                                if(!empty($address_default) && $p->id == $address_default->province_id)
                                                    $check = 'selected';
                                                ?>
                                                <option value="{{ $p->id }}" {{ $check  }}>{{ $p->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    {{-- </div> --}}
                                </div>
                            </div>
                                <!-- /row -->
                            <hr>
                            <div class="form-group">
                                <label class="container_check" id="other_addr">Other billing address
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- /other_addr_c -->
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step middle payments">
                    <h3>2. Payment and Shipping</h3>
                    <ul>
                        @if(!empty($payment_methods))
                        @foreach($payment_methods as $pay)
                        <li>
                            <label class="container_radio">{{ $pay->name }}
                                {{-- <a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a> --}}
                                <input type="radio" name="payment" id="payment" value="{{ $pay->method_id }}" required>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="payment_info d-none d-sm-block">
                        <figure>
                            <img src="{{ url('assets/web/img/cards_all.svg') }}" alt="">
                        </figure>	
                        <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
                    </div>
                    <h6 class="pb-2">Shipping Method</h6>
                    <ul>
                        @foreach($shipping as $ship)
                        <li>
                            <label class="container_radio">{{ $ship->ship_method->name }}
                                <a href="#0" class="float-right">
                                    {{ number_format($ship->price,2) }}
                                </a>
                                <input type="radio" name="ship_method_id" value="{{ $ship->ship_method->id }}" price="{{ $ship->price }}" required>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>3. Order Summary</h3>
                    <div class="box_general summary">
                        <ul>
                            <?php
                                $shipping = 0;
                            ?>
                            @foreach($items as $key => $item)
                            <li class="clearfix"><em>{{ $item['qty'].'x '.$item['name']." (".number_format($item['price'],2).")" }}</em>  <span>{{ number_format($item['total'],2) }}</span></li>
                            <input type="hidden" name="item_id[{{ $key }}]['price']" value="{{ $item['product_id'] }}">
                            <input type="hidden" name="item_id[{{ $key }}]['qty']" value="{{ $item['qty'] }}">
                            @endforeach
                            {{-- <li class="clearfix"><em>2x Armor Air Zoom Alpha</em> <span>$115.00</span></li> --}}
                        </ul>
                        <ul>
                            <li class="clearfix"><em><strong>Subtotal</strong></em>  <span id="total_price">{{ number_format($totally,2) }}</span></li>
                            <li class="clearfix"><em><strong>Shipping</strong></em> <span id="total_shipping">{{ number_format($shipping,2) }}</span></li>
                            
                        </ul>
                        <div class="total clearfix">TOTAL <span id="grand_total">{{ number_format(($totally-$shipping),2) }}</span></div>
                    
                        <button type="submit" class="btn_1 full-width">Confirm and Pay</button>
                    </div>
                    <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
            <!-- /row -->
        </form>
    <!-- /container -->
    </div>
</main>
@stop
@section('css')
{{-- <link href="{{ url('/assets/web/css/cart.css') }}" rel="stylesheet"> --}}
<style>
.alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}
.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
</style>
@stop
@section('js')
{{-- <script src="{{ url('/assets/web/js/pages/cart.js') }}"></script> --}}
<script>

$('.select2').select2();
$(document).on('change','input[name="ship_method_id"]',function(){
    var ship = parseInt($(this).attr('price'));
    var price = parseInt($("#total_price").html());
    var grand_total = ship + price;
    // console.log(ship);
    // console.log(price);
    $("#total_shipping").html( ship.toFixed(2) );
    $("#grand_total").html( grand_total.toFixed(2) );
});
console.log($(document).height());
console.log($(window).height());
console.log($('body').height());
</script>
@stop