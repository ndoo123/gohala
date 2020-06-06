@extends('web.master_web_no_title')
@section('content')
<div id="cart_page" class="main-container col1-layout">
    <div class="container">
    <div class="row">
        <?php if(count($cart)==0):?>
         <div class="shop-inner text-center">
             <div class="page-title">
              <h2>ไม่มีสินค้าในตะกร้า</h2>
            </div>
            <a href="<?php echo url('');?>" class="btn btn-info">กลับไปเลือกซื้อสินค้า</a>
            
         </div>
        <?php endif;?>
        <?php foreach($cart as $c):
        $grand_total=0;
        ?>
         <div shop_id="<?php echo $c['shop_id'];?>" class="shop-inner shop_card">
             <div class="page-title">
              <h2><?php echo $c['name'];?> </h2>
              <div class="checkout_btn">
                  <button type="button" class="btn btn-warning remove_all_cart_shop">ลบออกทั้งหมด</button>
                 
                  <a href="<?php echo url('').'/'.$c['url'].'/checkout';?>" class="btn btn-info">ชำระเงิน</a>
           
              </div>
              
            </div>
            <div class="order-detail-content">
              <div class="table-responsive">
                <table class="table table-bordered cart_summary">
                  <thead>
                    <tr>
                      <th width="100" class="cart_product"></th>
                      <th >ชื่อสินค้า</th>
                      <th width="100" style="text-align:right">ราคา</th>
                      <th width="100">จำนวน</th>
                      <th width="100" style="text-align:right">รวม</th>
                      <th width="1" class="action"><i  class="fa fa-trash-o"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php foreach($c['items'] as $item):
                 
                        $total= floatval($item['price'])*intval($item['qty']);
                        $grand_total+=$total;
                     ?>
                     <tr class="cart_item" shop_id="<?php echo $item['shop_id'];?>" product_id="<?php echo $item['product_id'];?>">
                        <td class="cart_product"><a href="<?php echo $item['link'];?>"><div class="photo" style="background-image:url(<?php echo $item['img'];?>)"></div></td>
                        <td class="cart_description">
                            <p class="product-name"><a href="<?php echo $item['link'];?>"><?php echo $item['name'];?> </a></p>
                        <td class="price" price="<?php echo $item['price'];?>" style="text-align:right"><span><?php echo number_format($item['price'],2);?></span></td>
                        <td class="qty"><input class="form-control input-sm" type="number" default="<?php echo $item['qty'];?>" value="<?php echo $item['qty'];?>"></td>
                        <td class="total" total="<?php echo $total;?>" style="text-align:right"><span><?php echo number_format($total,2);?></span></td>
                        <td class="action"><a href="javascript:;" class="remove_cart_item"><i style="font-size:30px;color:red" class="icon-close"></i></a></td>
                        </tr>
                     <?php endforeach;?>
                    
                
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"><strong>รวม</strong></td>
                      <td colspan="1" style="text-align:right"><strong class="shop_total"><?php echo number_format($grand_total,2);?></strong></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              
            </div>
            
         </div>
        <?php endforeach;?>
          <div class="shop-inner">
            <div class="page-title">
                <div class="row" style="font-size:24px">
                    <div class="col-md-6 text-right">
                        <b>รวม</b>
                    </div>
                    <div class="col-md-6 text-right">
                        <span class="grand_total">0.00</span> บาท
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>
</div>

@stop
@section('js')
<script src="<?php echo url('');?>/assets/web/js/page/cart.js"></script>
@stop