@extends('manage.master_manage')
@section('title')
{{-- ออเดอร์ทั้งหมดของร้าน | <span style="color:blue">{{ $shop->name }}</span> --}}
<?php echo $label ?>
@stop
@section('content')
<input type="hidden" name="url" id="url" value="{{ $url }}">
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title"><?php echo __('view.order_list_all');?>
        </h4>
        <div class="table-responsive">
            <table class="table table-hover mb-0 bg-light" id="table_order" remote_url="{{ $remote_url }}" order_status="{{ $order_status }}">
                <thead>
                    <tr>
                        <th width="15%"><?php echo __('view.order_id');?></th>
                        <th width="15%"><?php echo __('view.order_date');?></th>
                        <th width="15%"><?php echo __('view.order_by');?></th>
                        <th width="10%"><?php echo __('view.qty');?></th>
                        <th width="10%"><?php echo __('view.total');?></th>
                        <th width="15%"><?php echo __('view.status');?></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
    </div>
</div>

@stop
@section('js')
 <script src="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.all.min.js');?>"></script>
 @include('modal.master_admin')
 <script src="<?php echo url('assets/manage/js/pages/shop/shop_all.js');?>"></script>
@stop
@section('css')
<link href="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.min.css');?>" rel="stylesheet" type="text/css">
@stop