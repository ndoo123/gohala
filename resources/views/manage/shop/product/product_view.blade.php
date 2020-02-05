@extends('manage.master_manage')
@section('title')
<?php echo $shop->name;?> | <?php echo __('view.product.create_product');?> 

@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
      <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title"><?php echo __('view.product.product_detail');?></h4>
                    <div class="form-group">
                        <label><?php echo __('view.product.product_name');?> <span class="text-danger">*</span></label>
                        <input type="text" maxlength="150" class="form-control maxlength" required="">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('view.product.info_short');?></label>
                        <div>
                            <textarea maxlength="100" class="form-control maxlength" rows="2"></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label><?php echo __('view.product.info');?></label>
                        <div>
                            <textarea maxlength="2000" class="form-control maxlength" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
             <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title"><?php echo __('view.product.product_image');?></h4>
                    <p class="text-muted"><?php echo __('view.product.image_upload_info');?></p>
                    <input type="file" id="file_input" style="display:none" multiple>
                     <div id="image_area">
                     </div>
                    <button type="button" id="file_selector" class="btn btn-rouned btn-primary"><?php echo __('view.add_image');?></button>
                </div>
            </div>
        </div> <!-- end col -->
         <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title"><?php echo __('view.product.product_detail');?></h4>
                    <div class="form-group">
                        <label><?php echo __('view.product.product_category');?></label>
                        <select class="form-control">
                            <?php foreach($product_categories as $cat):?>
                                <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('view.product.price');?></label>
                        <div class="input-group"><input type="money" value=""  class="form-control"><span class="input-group-addon input-group-append"><span class="input-group-text"><?php echo __('view.currency');?></span></span></div>
                    </div>
                     <div class="form-group">
                        <label><?php echo __('view.product.discount');?></label>
                        <div>
                            <input type="checkbox" id="switch4" switch="success"/>
                            <label for="switch4" data-on-label="<?php echo __('view.on');?>" data-off-label="<?php echo __('view.off');?>"></label>
                            <div class="discount_price">
                                <div class="input-group"><input type="money" value=""  class="form-control"><span class="input-group-addon input-group-append">
                                      <select class="form-control">
                                        <option>บาท</option>
                                        <option>%</option>
                                        </select>
                                    </span>
                                </div>
                              
                            </div>
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
<link href="<?php echo url('assets/manage/css/pages/product.css');?>" rel="stylesheet" type="text/css">
@stop
@section('js')


<script src="<?php echo url('assets/js/plugins/dropzone/dist/dropzone.js');?>"></script>
<script src="<?php echo url('assets/manage/js/pages/shop/product/product_view.js');?>"></script>

@stop