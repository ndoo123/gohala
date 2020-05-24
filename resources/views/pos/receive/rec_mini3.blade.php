<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

</head>
<body onLoad="window.print();">

<table width="300"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center">
    	<b>{{ $shop->name }}</b><br>
        {{ $shop->address }} {{ $shop->phone}}<br>
        ใบเสร็จรับเงิน/ใบกำกับภาษีอย่างย่อ
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left">
    	Date : {{ $receipt->created_at }}<br>
        Receipt No : {{ $receipt->id }}<br>
        CASHIER : {{ $seller->name }}
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
            <td align="left">{{ $item->sku }}  {{ $item->product_name }}</td>
          </tr>
          <tr>
            <td align="left">({{ $item->qty }} x {{ number_format($item->price,2,'.',',') }})</td>
            <td align="right"><?=number_format(($item->price * $item->qty),2,'.',',');?></td>
          </tr>
          
        @endforeach


  <tr>
    <td colspan="2" align="center"><hr></td>
  </tr>

  <? $vat = ($sum * 7) / 107; ?>

  <tr>
    <td align="left">Sub Total</td><td align="right">{{ number_format($sum,2,'.',',') }}</td>
  </tr>
  <tr>
    <td align="left"><b>TOTAL</b></td><td align="right"><b>{{ number_format($sum,2,'.',',') }}</b></td>
  </tr>
  <tr>
    <td align="left">Total Item</td><td align="right">{{ $num }}</td>
  </tr>
  <tr>
    <td align="left">Pay Cash</td><td align="right">{{ number_format($payment->amount,2,'.',',') }}</td>
  </tr>
  <tr>
    <td align="left">Change</td><td align="right">{{ number_format($payment->amount - $sum,2,'.',',') }}</td>
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

