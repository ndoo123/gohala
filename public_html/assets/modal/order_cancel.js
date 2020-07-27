var table_order = $('#table_order').DataTable();
$(document).on('click','.btn_order_cancel',function(){
    var order_id = $(this).attr('order_id');
    $("#modal_order_cancel_label span").html(order_id);
    $("#modal_order_cancel").attr('order_id',order_id);
    $("#modal_order_cancel").modal('show');
});
$(document).on('click','.sm_order_cancel',function(){
    var modal = $(this).closest('.modal');
    var order_id = modal.attr('order_id');
    var input = modal.find('#order_cancel');
    if(input.val() == '')
        return alert('กรุณาระบุเหตุผล');

    var url = $("#url").val()+'/order_cancel';
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.order_id = order_id;
    obj.text = input.val();
    console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            console.log(res);
            if(res.status == 1)
            {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your Order has been Remove!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            else
            {
                // alert(res.msg);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.msg,
                })
            }
            table_order.ajax.reload();
        }
    });
    input.val('');
    // console.log(modal);
    // console.log(order_id);
    modal.modal('hide');
});