// order_send
var table_order = $('#table_order').DataTable();
$(document).on('click','.btn_order',function(){
    var order_id = $(this).attr('order_id');
    var status = $(this).attr('status');
    if(status == 3)
    {
        $("#modal_order_send_label span").html(order_id);
        $("#modal_order_send").attr('order_id',order_id);
        $("#modal_order_send").modal('show');
    }
    else
    {
        var url = $("#url").val()+'/update_order_status';
        var obj = new Object();
        obj._token = $('meta[name=csrf-token]').attr('content');
        obj.order_id = order_id;
        obj.status = status;
        // console.log(obj);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: obj,
            success: function(res){
                // console.log(res);
                if(res.status == 1)
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your Order has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.msg,
                    })
                }
                table_order.ajax.reload();
            }
        });
    }
});
$(document).on('click','.sm_order_send',function(){
    // var modal = $("#modal_order_send");
    var modal = $(this).closest('.modal');
    var order_id = modal.attr('order_id');
    var val = $('#order_send').val();
    if(val == "")
        return alert('กรุณากรอกรหัส');
    var url = $("#url").val()+'/update_trace';
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.order_id = order_id;
    obj.trace = modal.find('#order_send').val();
    // console.log(obj);
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
                    title: 'Your Order has been saved',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.msg,
                })
            }
            table_order.ajax.reload();
        }
    });
    modal.modal('hide');
});