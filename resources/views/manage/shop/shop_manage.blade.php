@extends('manage.master_manage')
@section('title')
สรุปผลรวมของร้าน | <span style="color:blue"><?php echo $shop->name;?></span>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card mini-stat bg-pattern">
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
        <div class="card mini-stat bg-pattern">
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
        <div class="card mini-stat bg-pattern">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                </div>
                <h6 class="text-uppercase mb-3 mt-0"><?php echo __('view.profit');?></h6>
                <h5 class="mb-3"><?php echo $summary->profit;?> <?php echo __('view.currency');?></h5>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title"><?php echo __('view.order_list');?>
        <button class="btn btn-sm btn-primary float-right" style="margin-top:-10px"><?php echo __('view.order_all');?></button>
        </h4>
        <div class="table-responsive">
            <table class="table table-hover mb-0 bg-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo __('view.order_date');?></th>
                        <th><?php echo __('view.order_by');?></th>
                        <th><?php echo __('view.qty');?></th>
                        <th><?php echo __('view.total');?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($orders as $ord)
                    <tr>
                        <td>{{ $ord->id }}</td>
                        <td>{{ $ord->order_date }}</td>
                        <td>{{ $ord->buyer_user_id }}</td>
                        <td>{{ $ord->qty }}</td>
                        <td>{{ $ord->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
    </div>
</div>

@stop
@section('js')
 <script src="<?php echo url('assets/manage/js/pages/shop/shop.js');?>"></script>
@stop