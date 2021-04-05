@extends('manage.master_manage')
@section('title')
<a class="btn btn-sm btn-secondary" href="<?php echo url($shop->url.'/products');?>">กลับไปหน้ารายการสินค้า</a> <?php echo $shop->name;?> | <?php echo ($product->id!=""?'<span id="product_title_name">'.$product->name.'</span>':__('view.product.create_product'));?> 

@stop
@section('content')
<form id="product_view_form" method="post" action="<?php echo url($shop->url.'/products/save');?>">
<?php echo csrf_field();?>
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
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
                                <input type="text" value="<?php echo $product->barcode;?>" name="barcode" maxlength="20"  class="form-control maxlength" required="">
                            
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

            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 text-primary header-title">{{ __('view.product.seo_tag') }}</h4>
                    <p class="text-muted">{{ __('view.product.keywords_text') }}</p>
                    <div class="row">

                         <div class="col-12">
                             <div class="form-group">
                                <label>Title</label>
                                <input type="text" value="{{ $product->metaTitle }}" name="metaTitle"  class="form-control" maxlength="60">
                            </div>
                        </div>

                         <div class="col-12">
                             <div class="form-group">
                                <label>Keywords</label>
                                {{-- <input type="text" value="{{ $product->metaKeywords }}" name="metaKeywords"  class="metaKeywords form-control"> --}}
                                <select name="metaKeywords[]" class="metaKeywords form-control" multiple="multiple">
                                    @if(!empty($product->metaKeywords))
                                        @foreach(json_decode($product->metaKeywords) as $key => $val)
                                        <option value="{{ $val }}" selected>{{ $val }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                         <div class="col-12">
                             <div class="form-group">
                                <label>Descriptions</label>
                                <textarea maxlength="150" name="metaDescription" class="form-control" rows="5">{{ $product->metaDescription }}</textarea>
                            </div>
                        </div>

                    </div>
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
                                <div class="input-group">
                                    <input type="money" name="discount_amount" value="<?php echo number_format($product->discount_value,2);?>"  class="form-control">
                                    <span class="input-group-addon input-group-append">
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
                        <div class="input-group"><span class="input-group-addon input-group-prepend"><span class="input-group-text"><?php echo __('view.product.price');?></span></span><input type="money" disabled value="" id="product_price_total" class="form-control"></div>
                    </div>
                    <button type="button" class="btn btn-warning w-100" id="btn_api_product">{{ __('view.product.api') }}</button>
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

    </div>
</div>
<!-- modal_api_product -->
<div class="modal fade" id="modal_api_product" tabindex="-1" role="dialog" aria-labelledby="modal_api_product_label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_api_product_label">Api Third Party</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_api_product_body">
                    <div class="card col-12">

                            {{-- <h4 class="mt-0 header-title">Accordion example</h4>
                            <p class="text-muted mb-4">Extend the default collapse behavior to create an accordion.</p> --}}

                            @if(!empty($api_products) && sizeof($api_products) > 0)
                            @foreach($api_products as $a)
                            <div id="accordion_{{ $a['name'] }}">
                                <div class="card mb-1" style="border: 1px solid #e9ecef;">
                                    <div class="card-header p-3" id="headingOne_{{ $a['name'] }}">
                                        <h6 class="m-0 font-14">
                                            <a href="#collapseOne_{{ $a['name'] }}" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne_{{ $a['name'] }}">
                                                {{ $a['name'] }}
                                            </a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne_{{ $a['name'] }}" class="collapse" aria-labelledby="headingOne_{{ $a['name'] }}" data-parent="#accordion_{{ $a['name'] }}" style="">
                                        <div class="card-body api_body">
                                                                    
                                            <div class="form-group">
                                                <label><?php echo __('view.product.price');?></label>
                                                <div class="input-group"><input required="" name="api[{{ $a['name'] }}][price]" type="money" value="{{ $a['price'] }}"  class="form-control required api_price"><span class="input-group-addon input-group-append"><span class="input-group-text"><?php echo __('view.currency');?></span></span></div>
                                            </div>
                                            <div class="form-group">
                                                
                                                <div>
                                                    <input type="checkbox" {{ $a['is_discount']>0?'checked':'' }} name="api[{{ $a['name'] }}][is_discount]" class="discount_switch" data-height="20" data-width="120" data-on="{{ __('view.product.discount_on') }}" data-off="{{ __('view.product.discount_off') }}" data-toggle="toggle" data-offstyle="light">
                                                
                                                    <div style="{{ $a['is_discount']==0?'display:none':'display:block' }}" class="m-t-10 discount_price_panel">
                                                        <div class="input-group">
                                                            <input type="money" class="discount_value form-control" name="api[{{ $a['name'] }}][discount_value]" value="{{ number_format($a['discount_value'],2) }}" >
                                                            <span class="input-group-addon input-group-append">
                                                                <select name="api[{{ $a['name'] }}][discount_type]" class="form-control discount_type">
                                                                    <option {{ $a['is_discount']==1?'selected':'' }} value="1">บาท</option>
                                                                    <option {{ $a['is_discount']==2?'selected':'' }} value="2">%</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo __('view.product.real_price');?></label>
                                                <div class="input-group"><span class="input-group-addon input-group-prepend"><span class="input-group-text"><?php echo __('view.product.price');?></span></span><input type="money" disabled value=""  class="form-control product_price_total"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            @endforeach
                            @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal_api_product -->

</form>
@stop
@section('css')
<link href="{{ url('assets/manage/css/pages/product.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('assets/js/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@stop
@section('js')


<script src="{{ url('assets/js/plugins/dropzone/dist/dropzone.js') }}"></script>
<script src="{{ url('assets/js/plugins/select2/js/select2.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ url('assets/manage/js/pages/shop/product/product_view.js') }}"></script>

@stop