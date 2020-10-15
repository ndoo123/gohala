@foreach($product as $prod)

    <div class="col-xl-2 col-md-4 pos-rl">
        <a id="pid<?php echo  $prod->id ; ?>" get_product="<?php echo $prod->sku ; ?>" onclick="click_product(<?php echo  $prod->id ; ?>)" title="<?php echo  $prod->name . ' | ราคา ' . number_format($prod->price,2,'.',',') ; ?>">
            <div class="card product-box card-b">
                <div class="card-body p-1">
                    <div class="product-img-pos">
                        <figure style="background-image:url(<?php echo  $prod->get_photo() ; ?>)"> 
    
                        </figure>
                        
                    </div>
                    
                    <div class="detail">
                        <div class="box-detail">
                        <h4 class="font-14"><?php echo  mb_substr($prod->name,0,35,'UTF-8') ; ?> </h4>
                        </div>
                        <h5 class="my-0 font-14 float-right">
                            <b>
                                <?php 
                                if($prod->is_discount == '0'){
                                    echo number_format($prod->price,2,'.',',');
                                }elseif($prod->is_discount == '1'){
                                    echo '<font color="red">'.number_format($prod->price - $prod->discount_value,2,'.',',') .'</font>';
                                }elseif($prod->is_discount == '2'){
                                    echo number_format(\LKS::price_discount($prod->discount_value, $prod->price),2,'.',',') ;
                                }
                                ?></b></h5>
                        <span class="badge badge-soft-primary"><?php echo  $prod->sku ; ?></span>
                    </div>
                </div>
            </div>
            <!-- end product-box -->
        </a>
    </div>

@endforeach