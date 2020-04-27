@extends('web.master_web')
@section('content')
<div id="cart_page" class="main-container col1-layout">
    <div class="container">
    <div class="row">
         <div class="shop-inner ">
             <div class="row">
                 <div class="col-md-6 text-center">
                       <h4>สั่งซื้อสำเร็จ เลขที่สั่งซื้อของคุณคือ</h4>
                        <h2 style="color:green"><?php echo $order->id;?></h2>
                        <h5>ร้าน: <?php echo $order->shop->name;?></h5>
                        <h5>วันที่สั่งซื้อ: <?php echo date('d/m/Y H:i:s',strtotime($order->order_date));?></h5>
                        <h5>สถานะ: <?php echo $order->get_status_badge();?></h5>
                        <?php if($order->status==1 && $order->payment_type==2):?>
                        <hr>
                        <h5>กรุณาโอนเงินเข้าบัญชีด้านล่าง</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ธนาคาร</th>
                                    <th>ชื่อบัญชี</th>
                                    <th>เลขที่บัญชี</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $payment_data=\App\Models\ShopPayment::where("shop_id",$order->shop_id)->where('method_id',2)->first();
                                if($payment_data)
                                {
                                    $j=str_replace('\\','',$payment_data->payment_data);
                                    $j=substr($j,1);
                                    $j=substr($j,0,strlen($j)-1);
                                    $j=json_decode($j);
                                    if(count($j)==0)
                                    echo '<tr><td>ไม่ปรากฏบัญชีธนาคาร</td></tr>';
                                    else
                                    {
                                        $row='';
                                        foreach($j as $b)
                                        {
                                            $bank_name=mb_convert_encoding($b->bank_name,'UTF-8','auto');
                                            $account_name=mb_convert_encoding($b->account_name,'UTF-8','auto');
                                            $account_no=mb_convert_encoding($b->account_no,'UTF-8','auto');
                                            $row.='<tr>';
                                                $row.='<td>'.$bank_name.'</td>';
                                                $row.='<td>'.$account_name.'</td>';
                                                $row.='<td>'.$account_no.'</td>';
                                            $row.='</tr>';
                                        }
                                        echo $row;
                                    }
                                }
                               
                                ?>
                            </tbody>
                        </table>
                        <?php endif;?>
                 </div>
                 <div class="col-md-6">
                     <h4>รายการสินค้า</h4>
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
                        $items=$order->items;
                        $total=0;
                        foreach($items as $c){
                            
                            $total+=intval($c->qty)*floatval($c->price);
                            $row='<tr>';
                                $row.='<td><div style="background-image:url('.$c->product->get_photo().')" class="img"></div></td>';
                                $row.='<td >'.$c->product_name.'</td>';
                                $row.='<td class="text-right">'.number_format($c->price,2).'</td>';
                                $row.='<td class="text-center qty" >'.$c->qty.'</td>';
                                $row.='<td class="text-right">'.number_format(intval($c->qty)*floatval($c->price),2).'</td>';
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
                            <td class="text-right total_delivery_cost" amount="<?php echo $total;?>"><?php echo number_format($order->total_delivery,2);?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">รวมสุทธิ:</td>
                            <td class="text-right grand_total"><?php echo number_format($total+$order->total_delivery,2);?></td>
                        </tr>
                        
                    </tfoot>
                </table>
                <div><p style="font-size:18px">การจัดส่ง: <?php echo $order->get_delivery()->name;?></p> </div>
                <div class="text-center">
                    <a href="<?php echo url('');?>" class="btn btn-primary">กลับไปหน้าแรก</a>
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