// $('.view_payment_img').magnificPopup({
//     delegate: 'a',
//     type: 'image',
//     modal: true,
//     // other options
//   });
  
$(document).on('click','.btn_order_payment_view',function(){
    var order_id = $(this).attr('order_id');
    var price = $(this).attr('price');
    var payment = $(this).attr('payment');
    // console.log(payment);
    var payment = JSON.parse(payment);
    // console.log(payment);

    var modal = $("#modal_view_payment");
    modal.attr('order_id',order_id);

    var append = '';
    if(payment != "")
    {
        // console.log(payment_arr[index]);
        append += '<div class="mb-3">';
            append += '<label class="custom-control custom-checkbox mb-2">';
                append += '<input type="radio" name="payment_data" class="custom-control-input" checked>';
                append += '<span class="custom-control-label">';
                    append += payment.bank_name;
                append += '</span>';
            append += '</label>';
            append += '<table class="ml-4">';
                append += '<tbody>';
                    append += '<tr>';
                        append += '<td width="50%"> ชื่อบัญชี </td>';
                        append += '<td width="50%">';
                            append += payment.account_name;
                        append += '</td>';
                    append += '</tr>';
                    append += '<tr>';
                        append += '<td width="50%"> เลขที่บัญชี </td>';
                        append += '<td width="50%">';
                            append += payment.account_no;
                        append += '</td>';
                    append += '</tr>';
                append += '</tbody>';
            append += '</table>';
        append += '</div>';
        // <div class="custom-control custom-checkbox mb-2">
        //     <input type="checkbox" checked="" name="payment_check[2]" class="custom-control-input" id="payment_check2">
        //     <label class="custom-control-label" for="payment_check2">โอนเงิน</label>
        // </div>

        $('input#payment_date',modal).val(payment.payment_date);
        $('textarea#payment_remark',modal).val(payment.payment_remark);
        $('.view_payment_img',modal).html('');
        var url = $("#url").val()+'/get_payment_img';
        var obj = new Object();
        obj.order_id = order_id;
        obj._token = $('meta[name=csrf-token]').attr('content');
        // console.log(obj);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: obj,
            success: function(res){
                // console.log(res);
                if(res.result == 1)
                {
                    var append = '<a class="image-popup-no-margins" target="_blank" href="'+res.img+'"><img src="'+res.img+'" height="200" width="200"></a>';
                    $('.view_payment_img',modal).html(append);
                    $(".modal_view_payment_footer").html('');
                    if(res.btn == 1)
                    {
                        var btn = '<button type="button" class="btn btn-primary btn_order btn-sm" order_id="'+res.order_id+'" status="2">ยืนยันการชำระ</button>';
                        $(".modal_view_payment_footer").html(btn);
                    }
                }
            }
        });
    }
    
    $('input#order_id',modal).val(order_id);
    $(".bank_body",modal).html('');
    $(".bank_body",modal).append(append);
    $('input#price',modal).val(price);
    $("#modal_view_payment_label span").html(order_id);
    $("#modal_view_payment").modal('show');
});