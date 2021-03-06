@extends('manage.master_manage')
@section('title')
รายการประจำวันของร้าน | <span style="color:blue"><?php echo $shop->name;?></span>
@stop
@section('content')
<input type="hidden" name="url" id="url" value="{{ $url }}">
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card mini-stat bg-pattern goto" type="button" goto="{{ $url.'/order/-1' }}">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="dripicons-broadcast bg-soft-primary text-primary float-right h4"></i>
                </div>
                <h6 class="text-uppercase mb-3 mt-0"><?php echo __('view.order');?></h6>
                <h5 class="mb-3"><?php echo $summary->order;?></h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mini-stat bg-pattern goto" type="button" goto="{{ $url.'/products' }}">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="dripicons-box bg-soft-primary text-primary float-right h4"></i>
                </div>
                <h6 class="text-uppercase mb-3 mt-0"><?php echo __('view.product_all');?></h6>
                <h5 class="mb-3"><?php echo $summary->product;?></h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mini-stat bg-pattern" type="button">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                </div>
                <h6 class="text-uppercase mb-3 mt-0"><?php echo __('view.profit');?></h6>
                <h5 class="mb-3"><span id="profit"><?php echo $summary->profit;?></span> <?php echo __('view.currency');?></h5>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
 <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>
 <script src="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.all.min.js');?>"></script>
 <script src="<?php echo url('assets/manage/js/pages/shop/shop.js');?>"></script>
@stop
@section('css')
<link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.min.css');?>" rel="stylesheet" type="text/css">
@stop