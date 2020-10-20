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
<!-- modal_croppie -->
<div class="modal fade" id="modal_croppie" tabindex="-1" role="dialog" aria-labelledby="modal_croppie_label" aria-hidden="true">
    {{-- <form action="{{ $action }}" method="{{ $method }}" class="needs-validation" novalidate id="form_croppie"> --}}
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_croppie_label">รูปโปรไฟล์ร้านค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_croppie_body">
                    <div class="col-12">
                        <div id="crop_img" class="mx-auto" style="height:600px;width:600px"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sm_modal_croppie">Save</button>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
<!-- end modal_croppie -->
@stop
@section('css')
<link href="{{ url('assets/js/plugins/croppie/croppie.css') }}" rel="stylesheet" type="text/css">
@stop
@section('js')
<script src="{{ url('assets/js/plugins/croppie/croppie.min.js') }}"></script>
<script>
    var croppie = $('#crop_img').croppie({ // ประกาศแบบนี้ไม่ใช่ object แต่เป็น element มันเอง
    viewport: { width: 500, height: 375 },
    boundary: { width: 600, height: 600 },
    showZoomer: true,
    enableZoom: true,
});
$(document).on('click','#change_profile_image',function(){
    $("#profile_image").click();
});
$(document).on('change','#profile_image',function(event){
    // $(this).closest('.form_change_profile').submit();
    $("#modal_croppie").modal();
});

// เมื่อมีการแสดง modal ให้ดึงรูปภาพที่อยู่ใน hidden มาแสดง
$(document).on('shown.bs.modal','#modal_croppie',function(){
    var input = $("input#profile_image")[0]; // and this equal

    var reader = new FileReader();
    reader.onload = function(e){
        // console.log(input);
        croppie.croppie('bind', {
            url : URL.createObjectURL(input.files[0]),
        });
    };
    reader.readAsDataURL(input.files[0]);
});
$(document).on('hide.bs.modal','#modal_croppie',function(){
    $("#profile_image").val('');
    // console.log($("#profile_image").val());
});
$(document).on('click','.sm_modal_croppie',function(){
    console.log(croppie);
    
    croppie.croppie('result','base64').then(function(base64){
        // console.log(base64);
        var url = $("input#profile_image").closest('form').attr('action');
        
        var obj = new Object();
        obj.profile_image = base64;
        obj._token = $('meta[name=csrf-token]').attr('content');
        // console.log(obj);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: obj,
            success: function(res){
                console.log(res);
                $("#modal_croppie").modal('hide');
                alert(res.msg);
                if(res.result == 1)
                {
                    if(res.img != "")
                    {
                        var d = new Date();
                        $("#profile_show").attr('src',res.img+'?'+d.getTime());
                    }
                }
            }
        });
    });
});
</script>
@endsection