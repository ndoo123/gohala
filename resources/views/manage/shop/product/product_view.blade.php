@extends('manage.master_manage')
@section('title')
<a class="btn btn-sm btn-secondary" href="<?php echo url($shop->url.'/products');?>">กลับไปหน้ารายการสินค้า</a> <?php echo $shop->name;?> | <?php echo ($product->id!=""?'<span id="product_title_name">'.$product->name.'</span>':__('view.product.create_product'));?> 

@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    <form id="product_view_form" method="post" action="<?php echo url($shop->url.'/products/save');?>">
    <?php echo csrf_field();?>
    <input type="hidden" name="product_id" value="<?php echo $product->id;?>">
    <input type="hidden" name="set_default" value="">
      <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title"><?php echo __('view.product.product_detail');?></h4>
                    <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                                <label><?php echo __('view.product.product_name');?> <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $product->name;?>" name="name" maxlength="150" class="form-control maxlength" required="">
                                <p <?php if($product->id==""){ echo 'style="display:none"';}?> id="slug"><b>Slug: </b><span><?php echo $product->slug;?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                             <div class="form-group">
                                <label>#SKU <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $product->sku;?>" name="sku" maxlength="20"  class="form-control maxlength" required="">
                            
                            </div>
                            
                        </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                <label>Barcode</label>
                                <input type="text" value="<?php echo $product->sku;?>" name="barcode" maxlength="20"  class="form-control maxlength" required="">
                            
                            </div>
                            
                        </div>
                      
                    </div>
                    
                  
                    <div class="form-group">
                        <label><?php echo __('view.product.info_short');?></label>
                        <div>
                            <textarea maxlength="100" name="info_short" class="form-control maxlength" rows="2"><?php echo $product->info_short;?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label><?php echo __('view.product.info');?></label>
                        <div>
                            <textarea maxlength="2000" name="info" class="form-control maxlength" rows="5"><?php echo $product->info_full;?></textarea>
                        </div>
                    </div>
                </div>
            </div>

             <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title"><?php echo __('view.product.product_image');?></h4>
                    <p class="text-muted"><?php echo __('view.product.image_upload_info');?></p>
                    <input type="file" id="file_input" style="display:none" multiple accept="image/*">
                     <div id="image_area">
                         <?php foreach($product->photos as $photo):?>
                         <div class="img_preview" img_id="<?php echo $photo->name;?>">
                            <input type="hidden" name="position[]" value="{{ $photo->name }}">
                             <img src="<?php echo $photo->get_image_url();?>">
                             <button type="button" class="btn btn-sm btn-danger remove_btn">
                                 <i class="far fa-trash-alt"></i>
                             </button>
                            <div class="set_default <?php echo ($photo->is_default==1?'active_default':'');?>"><i class="fas fa-star"></i></div></div>
                         <?php endforeach;?>
                     </div>
                    <button type="button" id="file_selector" class="btn btn-rouned btn-primary"><?php echo __('view.add_image');?></button>
                    <br><br><span class="text-muted">กดที่รูป <i class="fas fa-star"></i> เพื่อตั้งค่าให้เป็นรูปหลัก</span>
                </div>
            </div>
            
        </div> <!-- end col -->
         <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-block btn-primary mb-3"><?php echo __('view.save');?></button>
                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-8">
                                <label><?php echo __('view.product.qty');?></label>
                                    <div class="input-group"><input required="" name="qty" type="number" value="<?php echo ($product->qty==""?"1":$product->qty);?>"  class="form-control text-right"></div>
                                </div>
                      
                             <div class="col-md-4">
                                  <label>หน่วยนับ</label>
                                    <div class="input-group"><input name="unit" type="text" value="<?php echo $product->unit;?>" placeholder="กล่อง/ชิ้น"  class="form-control text-right"></div>
                                </div>  
                           
                         </div>
                        </div>
                      
                    <div class="form-group">
                        <label><?php echo __('view.product.price');?></label>
                        <div class="input-group"><input required="" name="price" type="money" value="<?php echo $product->price;?>"  class="form-control"><span class="input-group-addon input-group-append"><span class="input-group-text"><?php echo __('view.currency');?></span></span></div>
                    </div>
                     <div class="form-group">
                        
                        <div>
                            <input type="checkbox" <?php echo ($product->is_discount>0?'checked':'');?> name="is_discount" id="discount_switch" data-height="20" data-width="120" data-on="<?php echo __('view.product.discount_on');?>" data-off="<?php echo __('view.product.discount_off');?>" data-toggle="toggle" data-offstyle="light">
                        
                            <div style="<?php echo $product->is_discount==0?'display:none':'display:block';?>" class="m-t-10" id="discount_price_panel">
                                <div class="input-group"><input type="money" name="discount_amount" value="<?php echo number_format($product->discount_value,2);?>"  class="form-control"><span class="input-group-addon input-group-append">
                                      <select name="discount_type" class="form-control">
                                        <option <?php echo ($product->is_discount==1?'selected':'');?> value="1">บาท</option>
                                        <option <?php echo ($product->is_discount==2?'selected':'');?> value="2">%</option>
                                        </select>
                                    </span>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group"><span class="input-group-addon input-group-prepend"><span class="input-group-text"><?php echo __('view.product.price');?></span></span><input type="money" id="product_price_total" disabled value=""  class="form-control"></div>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title">หมวดหมู่</h4>
                    <?php 
                    $product_categories=$product->get_categories();
                    foreach($categories as $cat):?>
                      <div class="custom-control custom-checkbox">
                            <input type="radio" 
                            value="<?php echo $cat->id;?>" 
                            <?php if(isset($product) && $product->in_category($cat->id,$product_categories)) echo 'checked';?> name="category[]" 
                            class="custom-control-input" 
                            id="cat_<?php echo $cat->id;?>">
                            <label class="custom-control-label" for="cat_<?php echo $cat->id;?>"> <?php echo $cat->name;?></label>
                        </div>
                    <?php endforeach;?>
                      
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
      </form>

    </div>
</div>


@stop
@section('css')
<link href="<?php echo url('assets/manage/css/pages/product.css');?>" rel="stylesheet" type="text/css">
@stop
@section('js')


<script src="<?php echo url('assets/js/plugins/dropzone/dist/dropzone.js');?>"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo url('assets/manage/js/pages/shop/product/product_view.js');?>"></script>

@stop