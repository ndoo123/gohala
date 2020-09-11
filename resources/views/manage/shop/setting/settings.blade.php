@extends('manage.master_manage')
@section('title')
ตั้งค่าร้าน | <span class="shop_name"><?php echo $shop->name;?></span>
@stop
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php LKS::has_alert();?>
<form action="{{ $current_url.'/change_profile' }}" method="post" class="form_change_profile" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="profile_image" id="profile_image" style="display:none"  accept="image/*">
</form>
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
@section('js')
<script>
$(document).on('click','#change_profile_image',function(){
    $("#profile_image").click();
});
$(document).on('change','#profile_image',function(){
    // alert(1);
    // console.log($(this).closest('.form_change_profile'));
    $(this).closest('.form_change_profile').submit();
});
</script>
@endsection