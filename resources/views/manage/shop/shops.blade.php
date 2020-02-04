@extends('manage.master_manage')
@section('title')
ร้านค้าของฉัน
<div class="float-right d-none d-md-block">
   <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" data-target="#new_shop_modal" type="button" data-toggle="modal">
        <i class="mdi mdi-plus mr-2"></i> เปิดร้านใหม่
    </button>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <?php if(count($shops)==0):?>
        <div class="card">
            <div class="card-body">
                ยังไม่มีร้านค้า
            </div>
        </div>
        <?php endif;?>
        <?php foreach($shops as $shop):?>
         <div shop_id="<?php echo $shop->id;?>" class="card card_shop">
            <div class="card-body">
               <div class="media m-b-10">
                    <img class="d-flex mr-3 rounded-circle" src="<?php echo url('assets/images/shop_icon.png');?>" alt="<?php echo $shop->name;?>" height="64">
                    <div class="media-body">
                        <h5 class="mt-0 font-16"><?php echo $shop->name;?> <span class="badge badge-pill badge-primary"><a class="text-white" href="<?php echo $shop->get_url();?>"><i class="fas fa-share-square"></i> <?php echo $shop->get_url();?></a></span></h5>
                        <div class="button-items">
                            <button type="button" class="btn btn-secondary btn-sm waves-effect">สินค้า 0</button>
                            <button type="button" class="btn btn-secondary btn-sm waves-effect">สั่งซื้อ 0</button>
                           
                        </div>
                        
                    </div>
                    <div class="shop_action float-right m-t-20">
                        <input type="checkbox" <?php echo ($shop->is_open==1?'checked':'');?> data-width="90" data-on="เปิดร้าน" data-off="ปิดร้าน" data-toggle="toggle" data-offstyle="light">
                        <a href="<?php echo url('shop/'.$shop->url);?>" class="btn btn-info">จัดการร้าน</a>
                        
                    </div>
                   
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<div id="new_shop_modal" class="modal fade show" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="new_shop_form" method="post" action="<?php echo url('shops/create');?>">
            <?php echo csrf_field();?>
                <div class="modal-header">
                    <h5 class="modal-title mt-0">ข้อมูลร้านใหม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label>ชื่อร้าน <span style="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">URL ของร้าน <span style="text-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon input-group-prepend"><span class="input-group-text"><?php echo env('APP_URL');?>/</span></span><input type="text" value="" name="shop_url" class="form-control"></div>
                        <span class="text-muted">ต้องเป็นตัวภาษาอังกฤษและไม่มีช่องว่างเท่านั้น</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">เพิ่มรา้นใหม่!</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@stop
@section('js')
 <script src="<?php echo url('assets/manage/js/pages/shop/shop.js');?>"></script>
@stop