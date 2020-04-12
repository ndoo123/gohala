@extends('manage.master_manage')
@section('title')
ตั้งค่าร้าน | <span class="shop_name"><?php echo $shop->name;?></span>
@stop
@section('content')
<div id="setting_card" class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">ข้อมูลร้าน</span>    
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#delivery" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">การจัดส่ง</span>    
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#payment" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">การชำระเงิน</span>    
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pos" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">POS</span>    
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active p-3" id="info" role="tabpanel">
                @include('manage.shop.setting.tabs.info')
            </div>
            <div class="tab-pane p-3" id="delivery" role="tabpanel">
                @include('manage.shop.setting.tabs.delivery')
            </div>
            <div class="tab-pane p-3" id="payment" role="tabpanel">
                @include('manage.shop.setting.tabs.payment')
            </div>
             <div class="tab-pane p-3" id="pos" role="tabpanel">
                @include('manage.shop.setting.tabs.pos')
            </div>
        </div>
    </div>
</div>
@stop
