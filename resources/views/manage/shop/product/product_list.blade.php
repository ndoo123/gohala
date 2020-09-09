@extends('manage.master_manage')
@section('title')
<?php echo $shop->name;?> | <?php echo __('menu.product_list');?>
<div class="float-right d-none d-md-block">
   <a href="<?php echo url($shop->url.'/products/create');?>" class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light">
        <i class="mdi mdi-plus mr-2"></i> เพิ่มสินค้า
    </a>
   <a href="<?php echo url($shop->url.'/products/create');?>" class="btn btn-success dropdown-toggle arrow-none waves-effect waves-light">
        <i class="ti-list mr-2"></i> จัดเรียง
    </a>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <select class="form-control mb-3 filter_cate">
                            <option value="">--- หมวดหมู่ทั้งหมด ---</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <div class="table-rep-plugin bg-light">
                        <div class="table-responsive mb-0"  data-pattern="priority-columns">
                            <table id="products_table" class="table table-hover" 
                            remote_url="<?=url($shop->url.'/products/datatables')?>">
                                <thead class="thead-light">
                                <tr>
                                    <th width="100">ลำดับ</th>
                                    <th width="100">รูปภาพ</th>
                                    <th width="150">#SKU</th>
                                    <th><?php echo __('view.product.product_name');?></th>
                                    <th class="text-right"><?php echo __('view.product.price');?></th>
                                    <th class="text-center"><?php echo __('view.product.qty');?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
      
    </div>
</div>


@stop
@section('css')
<link href="<?php echo url('assets/js/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css');?>" rel="stylesheet" type="text/css" media="screen">
<link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
@stop
@section('js')
<!-- Responsive-table-->
<script src="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.all.min.js');?>"></script>
<script src="<?php echo url('assets/js/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js');?>"></script>
 <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

<script src="<?php echo url('assets/manage/js/pages/shop/product/product.js');?>"></script>
@stop
