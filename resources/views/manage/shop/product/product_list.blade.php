@extends('manage.master_manage')
@section('title')
<?php echo $shop->name;?> | <?php echo __('menu.product_list');?>
<div class="float-right d-none d-md-block">
   <a href="<?php echo url($shop->url.'/products/create');?>" class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light">
        <i class="mdi mdi-plus mr-2"></i> เพิ่มสินค้า
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
                    <div class="table-rep-plugin bg-light">
                        <div class="table-responsive mb-0"  data-pattern="priority-columns">
                            <table id="products_table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="100"></th>
                                    <th width="150">#SKU</th>
                                    <th><?php echo __('view.product.product_name');?></th>
                                    <th ><?php echo __('view.product.price');?></th>
                                    <th ><?php echo __('view.product.qty');?></th>
                                    <th width="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($products)==0):?>
                                <tr><td colspan="6"><p class="text-center"><?php echo __('view.product.no_products');?></p></td></tr>
                                <?php endif;?>
                                
                                </tbody>
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
@stop
@section('js')
<!-- Responsive-table-->
<script src="<?php echo url('assets/js/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js');?>"></script>

<script src="<?php echo url('assets/manage/js/pages/shop/product/product.js');?>"></script>
@stop