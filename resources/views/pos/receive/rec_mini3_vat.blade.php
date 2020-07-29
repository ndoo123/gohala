<!DOCTYPE html>
<html lang="<?php echo  app()->getLocale() ; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo  csrf_token() ; ?>">

    <title></title>

</head>
<body onLoad="window.print();">

<table width="300"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center">
    	<b><?php echo  $shop->name ; ?></b><br>
        <?php echo  $shop->address ; ?> <?php echo  $shop->phone; ?><br>
        TAX INVOICE (ABB.)<br>
        TAX ID : <?php echo  $shop->tax_id ; ?><br>
        ใบเสร็จรับเงิน/ใบกำกับภาษีอย่างย่อ
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left">
    	Date : <?php echo  $receipt->created_at ; ?><br>
        Receipt No : <?php echo  $receipt->id ; ?><br>
        CASHIER : <?php echo  $seller->name ; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><hr></td>
  </tr>
        <? 
        $num = '0'; 
        $sum = '0';
        ?>
        @foreach($ord_item as $item)

        <? 
        // จำนวนรายการ
        $num += $item->qty ; 
        // ราคารวม
        $sum += $item->price * $item->qty;
        ?>

          <tr>
            <td align="left"><?php echo  $item->sku ; ?>  <?php echo  $item->product_name ; ?></td>
          </tr>
          <tr>
            <td align="left">(<?php echo  $item->qty ; ?> x <?php echo  number_format($item->price,2,'.',',') ; ?>)</td>
            <td align="right"><?=number_format(($item->price * $item->qty),2,'.',',');?></td>
          </tr>
                   
        @endforeach


  <tr>
    <td colspan="2" align="center"><hr></td>
  </tr>

  <? $vat = ($sum * 7) / 107; ?>

  <tr>
    <td align="left">Sub Total</td><td align="right"><?php echo  number_format($sum,2,'.',',') ; ?></td>
  </tr>
  <tr>
    <td align="left"><b>TOTAL</b></td><td align="right"><b><?php echo  number_format($sum,2,'.',',') ; ?></b></td>
  </tr>
  <tr>
    <td align="left">Before VAT</td><td align="right"><?php echo  number_format($sum - $vat,2,'.',',') ; ?></td>
  </tr>
  <tr>
    <td align="left">VAT 7%</td><td align="right"><?php echo  number_format($vat,2,'.',',') ; ?></td>
  </tr>
  <tr>
    <td align="left">Total Item</td><td align="right"><?php echo  $num ; ?></td>
  </tr>
  <tr>
    <td align="left">Pay Cash</td><td align="right"><?php echo  number_format($payment->amount,2,'.',',') ; ?></td>
  </tr>
  <tr>
    <td align="left">Change</td><td align="right"><?php echo  number_format($payment->amount - $sum,2,'.',',') ; ?></td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
        <hr>
    	** Have A Nice Day **<br>
        ** Thank You **<br>
    	** VAT Included **
    </td>
  </tr>
</table>

<?php 

if($rec_num > 0){
  echo '<meta http-equiv="refresh" content="0;url='. url('print_slip/'.$receipt->id.'/'.$rec_num) .'">';
}else{
  echo '<meta http-equiv="refresh" content="0;url='. url('shop/'.$shop->id) .'">';
}
?>


</body>
</html>

