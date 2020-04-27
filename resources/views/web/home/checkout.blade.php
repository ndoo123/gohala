@extends('web.master_web')
@section('content')
<div class="main-container col1-layout">
     <div class="container">
 
        <div class="row">
            <div class="col-md-12">
                        <?php \LKS::has_alert();?>
              <div class="page-content pb-0">
                  <div class="page-title" style="font-size:24px">
                      ร้าน: <?php echo $shop->name;?>
                  </div>
                  </div>
            </div>
        </div>
    <form action="<?php echo url('').'/'.$shop->url.'/checkout/process';?>" method="post">
    <?php echo csrf_field();?>
    <div class="row">
        <div class="col-md-6 col-md-6">
            <div class="page-content checkout-page">
                @include('web.home.components.checkout_address')
                <br>
                @include('web.home.components.delivery')
             
            </div>
        </div>
        <div class="col-md-6 col-md-6">
            <div class="page-content">
                <h6>รายการสั่งซื้อ</h6>
                <hr>
                <table id="checkout_item_table" class="table">
                    <thead>
                        <tr>
                            <th width="1"></th>
                            <th>ชื่อรายการ</th>
                            <th class="text-right">ราคา</th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-right">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total=0;
                        $ship_cost=0;
                        if(count($delivery_methods)>0){
                        $cost=$delivery_methods[0]->ship_cost;
                        $cal_type=$delivery_methods[0]->cal_type;
           
                         if($cal_type==1)
                         $ship_cost=$cost;
                         else if($cal_type==2)
                         {
                            foreach($cart['items'] as $c){
                                $ship_cost+=intval($c['qty'])*floatVal($cost);
                            }
                         }
                        }
                        foreach($cart['items'] as $c){
                            $total+=intval($c['qty'])*floatval($c['price']);
                            $row='<tr>';
                                $row.='<td><div style="background-image:url('.$c['img'].')" class="img"></div></td>';
                                $row.='<td >'.$c['name'].'</td>';
                                $row.='<td class="text-right">'.$c['price'].'</td>';
                                $row.='<td class="text-center qty" >'.$c['qty'].'</td>';
                                $row.='<td class="text-right">'.intval($c['qty'])*floatval($c['price']).'</td>';
                            $row.='</tr>';
                        }
                        echo $row;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right">รวม:</td>
                            <td class="text-right total" amount="<?php echo $total;?>" ><?php echo number_format($total,2);?></td>
                        </tr>
                         <tr>
                            <td colspan="4" class="text-right">ค่าส่ง:</td>
                            <td class="text-right total_delivery_cost" amount="<?php echo $total;?>"><?php echo number_format($ship_cost,2);?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">รวมสุทธิ:</td>
                            <td class="text-right grand_total"><?php echo number_format($total+$ship_cost,2);?></td>
                        </tr>
                        
                    </tfoot>
                </table>
                 @include('web.home.components.payment')
                 <hr>
                 <div class="text-center">
                 <button type="submit" class="btn btn-primary">ยืนยันการสั่งซื้อ</button>
                 </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

@stop
@section('js')

<script src="<?php echo url('');?>/assets/web/js/page/checkout.js"></script>
@stop