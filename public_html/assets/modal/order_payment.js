// user_payment
Dropzone.autoDiscover = false;
window.onload = function () {

    var dropzoneOptions = {
        url: "/file/post",
        addRemoveLinks: true,
        autoProcessQueue : false,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        maxFiles: 5,
        parallelUploads: 5,
        dictDefaultMessage: 'ไฟล์รูปการชำระเงิน',
        paramName: "file",
        maxFilesize: 10,
        init : function() {
            var submitButton = document.querySelector(".sm_order_payment")
            myDropzone = this;

            $("#modal_user_payment").on('hidden.bs.modal',function(){
                $("#form_user_payment input").val('');
                $("#form_user_payment textarea").val('');
                myDropzone.removeAllFiles();
            });
            submitButton.addEventListener("click", function() {
                if(myDropzone.files.length < 1)
                {
                    alert('กรุณาเพิ่มไฟล์รูปการชำระเงิน');
                    return;
                }
                
                // myDropzone.processQueue();  // Tell Dropzone to process all queued files.
            }); 
            this.on("addedfile", function(file) {
                var _this = this;
                if ($.inArray(file.type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']) == -1) {
                    _this.removeFile(file);
                }
            });
            this.on("complete",function(file){
                $(file._removeLink).fadeOut();
            });
        }
    };
    var uploader = document.querySelector('#modal_user_payment .dropzone');
    var newDropzone = new Dropzone(uploader, dropzoneOptions);

    // console.log("Loaded");
};

$(".dropzone").sortable({
    items:'.dz-preview', // item move by this
    cursor: 'move',
    opacity: 0.5,
    containment: '.dropzone',
    distance: 20,
    tolerance: 'pointer'
});
// $("#modal_user_payment .dropzone").dropzone({ url: "/file/post" });
$(".flatpickr").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true,
    allowInput:true,
    onReady:function(dObj, dStr, fp){
        // console.log(dObj);
        // console.log(dStr);
        // console.log(fp);
        // console.log($(this));
        // fp.altInput.required = fp.element.required;
        // fp.altInput.removeAttribute('readonly');
        // $(".flatpickr").attr('readonly',false);
    }
});
var table_order = $('#table_order').DataTable();
// console.log($("h5 span#profit").length);
$(document).on('click','.btn_order_payment',function(){
    var order_id = $(this).attr('order_id');
    var price = $(this).attr('price');
    var payment = $(this).attr('payment');
    // console.log(payment);
    // console.log(JSON.parse(payment));
    var payment_arr = JSON.parse(JSON.parse(payment));
    // console.log(payment_arr);
    // var bank_body = $(".bank_body");
    var append = '';
    for(index in payment_arr)
    {
        // console.log(payment_arr[index]);
        append += '<div class="mb-3">';
            append += '<label class="custom-control custom-checkbox mb-2">';
                append += '<input type="radio" name="payment_data" class="custom-control-input" id="payment_check_'+index+'" value=\''+JSON.stringify(payment_arr[index])+'\' required>';
                append += '<span class="custom-control-label">';
                    append += payment_arr[index].bank_name;
                append += '</span>';
            append += '</label>';
            append += '<table class="ml-4">';
                append += '<tbody>';
                    append += '<tr>';
                        append += '<td width="50%"> ชื่อบัญชี </td>';
                        append += '<td width="50%">';
                            append += payment_arr[index].account_name;
                        append += '</td>';
                    append += '</tr>';
                    append += '<tr>';
                        append += '<td width="50%"> เลขที่บัญชี </td>';
                        append += '<td width="50%">';
                            append += payment_arr[index].account_no;
                        append += '</td>';
                    append += '</tr>';
                append += '</tbody>';
            append += '</table>';
        append += '</div>';
        // <div class="custom-control custom-checkbox mb-2">
        //     <input type="checkbox" checked="" name="payment_check[2]" class="custom-control-input" id="payment_check2">
        //     <label class="custom-control-label" for="payment_check2">โอนเงิน</label>
        // </div>
    }
    $(".bank_body").html('');
    $(".bank_body").append(append);
    $("#modal_user_payment_label span").html(order_id);
    var modal = $("#modal_user_payment");
    modal.attr('order_id',order_id);

    $('input#order_id',modal).val(order_id);
    $('input#price',modal).val(price);

    modal.modal('show');
    // console.log($("#profit").length());
});
$(document).on('submit','#form_user_payment',function(){
    // var modal = $("#modal_order_send");
    // var modal = $(this).closest('.modal');
    // var order_id = modal.attr('order_id');
    // var val = $('#order_send').val();
    // if(val == "")
    //     return alert('กรุณากรอกรหัส');
    // var url = $("#url").val()+'/update_trace';
    // var obj = new Object();
    // obj._token = $('meta[name=csrf-token]').attr('content');
    // obj.order_id = order_id;
    // obj.trace = modal.find('#order_send').val();
    // // console.log(obj);
    // $.ajax({
    //     url: url,
    //     type: 'post',
    //     dataType: 'json',
    //     data: obj,
    //     success: function(res){
    //         console.log(res);
    //         if(res.status == 1)
    //         {
    //             Swal.fire({
    //                 position: 'top-end',
    //                 icon: 'success',
    //                 title: 'Your Order has been saved',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //         }
    //         else
    //         {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: res.msg,
    //             })
    //         }
    //         table_order.ajax.reload();
    //     }
    // });
    // modal.modal('hide');
});