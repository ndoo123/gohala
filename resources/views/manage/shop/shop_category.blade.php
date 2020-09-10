@extends('manage.master_manage')
@section('title')
จัดการหมวดหมู่สินค้า | <span style="color:blue"><?php echo $shop->name;?></span>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title">รายการหมวดหมู่
        <button class="btn btn-sm btn-primary float-right" id="add_shop_category_btn" style="margin-top:-10px">เพิ่มหมวดหมู่</button>
        </h4>
        <div class="table-responsive">
            <table id="shop_category_table" class="table table-hover mb-0 bg-light" remote_url="{{ $current_url.'/datatables' }}">
                <thead>
                    <tr>
                       <th>ลำดับ</th>
                       <th>ชื่อ</th>
                       <th>จำนวนสินค้า</th>
                       <th>สถานะ</th>
                       <th></th>
                       <th></th>
                    </tr>
                </thead>
                <tbody>
                 <?php foreach($categories as $cat):?>
                 <tr category_id="<?php echo $cat->id;?>">
                     <td category_id="<?php echo $cat->id;?>"><?php echo $cat->name;?></td>
                     <td><?php echo $cat->product_count;?></td>
                     <td><input type="checkbox" class="category_active" <?php echo ($cat->is_active==1?'checked':'');?> data-width="90" data-on="แสดง" data-off="ไม่แสดง" data-toggle="toggle" data-offstyle="light"></td>
                     <td><button type="button" class="btn btn-sm btn-primary edit_category">แก้ไข</button> <button type="button" class="btn btn-sm btn-danger delete_category">ลบออก</button></td>
                 </tr>
                 <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
</div>
    </div>
</div>

<div id="shop_category_modal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="shop_category_modal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="shop_category_form" method="post" action="<?php echo url($shop->url.'/categories/update/json');?>">
            <?php echo csrf_field();?>
            <input type="hidden" name="category_id" value="">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>ชื่อหมวดหมู่ <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control input_txt" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="save_category_btn" class="btn btn-primary waves-effect waves-light">เพิ่มรายการ</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@stop
@section('js')
 <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>
 <script src="<?php echo url('assets/manage/js/pages/shop/shop_category.js');?>"></script>
@stop
@section('css')
<link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
@stop