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
                                <thead class="thead-light">
                                <tr>
                                    <th width="100"></th>
                                    <th width="150">#SKU</th>
                                    <th><?php echo __('view.product.product_name');?></th>
                                    <th class="text-right"><?php echo __('view.product.price');?></th>
                                    <th class="text-center"><?php echo __('view.product.qty');?></th>
                                    <th width="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($products)==0):?>
                                <tr><td colspan="6"><p class="text-center"><?php echo __('view.product.no_products');?></p></td></tr>
                                <?php endif;?>
                                <?php foreach($products as $product):?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $product->get_photo();?>" alt="" class="rounded thumb-lg">
                                    </td>
                                    <td><?php echo $product->sku;?></td>
                                    <td><?php echo $product->name;?><br>
                                        <?php 
                                        $categories=$product->get_categories();
                                        $cats='';
                                        foreach($categories as $c){
                                            $cats.=$c->name.',';
                                        }
                             
                                        if($cats!='')
                                        $cats=mb_substr($cats,0,2);
                                        echo '<span class="text-muted">'.$cats.'</span>';
                                        ?>
                                    </td>
                                    <td class="text-right"><?php echo number_format($product->price,2);?></td>
                                    <td class="text-center"><?php echo $product->qty;?></td>
                                    <td><a class="btn btn-sm btn-primary" href="<?php echo url($shop->url.'/product/'.$product->id);?>"><?php echo __('view.product.edit_product');?></a></td>
                                </tr>
                                <?php endforeach;?>
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