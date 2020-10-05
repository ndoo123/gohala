@extends('web.home.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div id="confirm">
                <div class="icon icon--order-success svg add_bottom_15">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                        <g fill="none" stroke="#8EC343" stroke-width="2">
                            <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                            <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                        </g>
                    </svg>
                </div>
                <h2>Order completed!</h2>
                <p>รหัสออเดอร์ของคุณคือ {{ $order['id'] }}</p>
                <a href="{{ $url }}">ดูโปรไฟล์</a><br><br>
                <div class="row">
                    <div class="col-6">
                        <p> ร้าน {{ $shop->name }} </p>
                        <p> ราคาที่ต้องชำระ <span class="text-primary">{{ $find_order->get_sold_price(true) }} </span></p>
                    </div>
                    <div class="col-6">
                        @foreach ($payment as $p_key => $p)
                            <h5>{{ $p->bank_name }}</h5>
                            <p>ชื่อบัญชี {{ $p->account_name }}<p>
                            <p>เลขที่บัญชี {{ $p->account_no }}<p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@stop
@section('js')
@stop