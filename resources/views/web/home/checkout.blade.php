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
                <div class="step first justify-content-between">
                    <h3>1. User Info and Billing address</h3>
                    <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Info</a>
                        </li>
                        @if(!empty($user_address))
                        <li class="nav-item ml-auto">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_1" aria-selected="true">Address</a>
                        </li>
                        @endif
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Login</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content checkout">
                        <div class="tab-pane fade show active input_change" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                            <div class="row no-gutters">
                                <div class="col-12 form-group pr-1">
                                    <label for="name_contact">ชื่อ-สกุล<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="name_contact" id="name_contact" value="{{ !empty($address_default->name_contact)?$address_default->name_contact:'' }}" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="email">อีเมล<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" placeholder="" id="email" name="email" value="{{ !empty($user->email)?$user->email:'' }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_address">ชื่ออาคาร<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="name_address" id="name_address" value="{{ !empty($address_default->name_address)?$address_default->name_address:'' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">ที่อยู่<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="" name="address" id="address" value="{{ !empty($address_default->address)?$address_default->address:'' }}" required>
                            </div>
                            <div class="row no-gutters">

                                <div class="col-6 form-group pr-1">
                                    <label for="phone">โทรศัพท์<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" placeholder="" id="phone" name="phone" value="{{ !empty($address_default->phone)?$address_default->phone:'' }}" required>
                                </div>
                                <div class="col-6 form-group pl-1">
                                    <label for="zipcode">รหัสไปรษณีย์<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" placeholder="" id="zipcode" name="zipcode" value="{{ !empty($address_default->zipcode)?$address_default->zipcode:'' }}" required>
                                </div>

                                <div class="col-12 form-group">
                                    {{-- <div class="custom-select-form"> --}}
                                        <label for="province_id">จังหวัด<span style="color:red">*</span></label>
                                        <select class="select2 wide add_bottom_15 custom-select-form form-control" name="province_id" id="province_id" required>
                                            <option value="" >เลือกจังหวัด</option>
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
                            <hr>
                        </div>
                        <div class="tab-pane fade show" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
                            <div class="row no-gutters">
                            @if(!empty($user_address))
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                ชื่อตึก
                                            </th>
                                            <th>
                                                ที่อยู่
                                            </th>
                                            {{-- <th>
                                                ชื่อ-สกุล
                                            </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_address as $addr)
                                        <?php
                                        $province = 'App\Models\Province'::where('id',$addr->province_id)->first();
                                        // dd($province);
                                        $check = '';
                                        if($addr->is_default == 1)
                                            $check = 'checked';
                                        ?>
                                        <tr>
                                            <td width="5%">
                                                <input type="radio" class="user_address" name="user_address" 
                                                address_id="{{ $addr->id }}"
                                                name_address='{{ $addr->name_address }}' 
                                                address='{{ $addr->address }}'
                                                name_contact='{{ $addr->name_contact }}' 
                                                province_id='{{ $addr->province_id }}' 
                                                zipcode='{{ $addr->zipcode }}' 
                                                phone='{{ $addr->phone }}'
                                                {{ $check }}>
                                            </td>
                                            <td width="25%">
                                                {{ $addr->name_address }}
                                            </td>
                                            <td width="70%">
                                                {{ $addr->address.' '.$province->name.' '.$addr->zipcode }}
                                            </td>
                                            {{-- <td width="40%">
                                                {{ $addr->name_contact }}
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                No Data
                            @endif
                            </div>
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
                            <?php
                            $disabled = '';
                            // if($pay->method_id == 3 && empty($user))
                            //     $disabled = 'disabled';
                            ?>
                            <li>
                                <label class="container_radio">{{ $pay->name }}
                                    {{-- <a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a> --}}
                                    <input type="radio" name="payment" id="payment" value="{{ $pay->method_id }}" required {{ $disabled }}>
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
                            <li class="clearfix"><em><strong>Subtotal</strong></em>  <span id="total_price" price="{{ $totally }}">{{ number_format($totally,2) }}</span></li>
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
<link rel="stylesheet" type="text/css" href="{{ url('assets/js/plugins/waitme/waitMe.min.css') }}">
<script src="{{ url('assets/js/plugins/waitme/waitMe.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>

$('.select2').select2();
$("input[name=phone]").mask('999-999-9999');
$("input[name=zipcode]").mask('99999');
$(document).on('change','input[name="ship_method_id"]',function(){
    var ship = parseFloat($(this).attr('price'));
    var price = parseFloat($("#total_price").attr('price'));
    var grand_total = ship + price;
    // console.log(ship);
    // console.log(price);
    $("#total_shipping").html( ship.toFixed(2) );
    $("#grand_total").html( grand_total.toFixed(2) );
});
$(document).on('submit',"form",function(){
    $('form').waitMe();
});
$(document).on('change',".user_address",function(){
    var obj = new Object();
    obj.name_address = $(this).attr('name_address');
    obj.address = $(this).attr('address');
    obj.name_contact = $(this).attr('name_contact');
    obj.province_id = $(this).attr('province_id');
    obj.zipcode = $(this).attr('zipcode');
    obj.phone = $(this).attr('phone');
    console.log(obj);
    Object.keys(obj).map(function(key, index){
        // console.log(key);
        // console.log(obj[key]);
        $(".input_change #"+key).val(obj[key]);
    });
    $("#province_id").change();
    $("#home-tab").click();
});
console.log($(document).height());
console.log($(window).height());
console.log($('body').height());
</script>
@stop