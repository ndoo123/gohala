// user_payment
Dropzone.autoDiscover = false;

var table_order = $('#table_order').DataTable();
window.onload = function () {
    var dropzoneOptions = {
        url: $("#url").val()+'/user_payment',
        addRemoveLinks: true,
        autoProcessQueue : false,
        uploadMultiple:true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        maxFiles: 1,
        parallelUploads: 1,
        dictDefaultMessage: 'ไฟล์รูปการชำระเงิน',
        paramName: "file",

		dictRemoveFile : "Remove", // ชื่อ ปุ่ม remove
        dictCancelUpload : "Cancel", // ชื่อ ปุ่ม ยกเลิก
        
		dictFileTooBig : "ไม่อนุญาตให้อัพโหลดไฟล์เกิน 2 MB", //ข้อความแสดงเมื่อเลือกไฟล์ขนาดเกินที่กำหนด	
        maxFilesize: 10,
        init : function() {
            var submitButton = document.querySelector(".sm_order_payment")
            myDropzone = this;
            $("#modal_user_payment").on('hidden.bs.modal',function(){
                $("#form_user_payment input,textarea").not('input[name="_token"]').val('');
                // $("#form_user_payment textarea").val('');
                $("#form_user_payment").removeClass('was-validated');
                
                myDropzone.removeAllFiles();
            });
            this.on("addedfile", function(file) {
                var _this = this;
                if ($.inArray(file.type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif']) == -1) {
                    _this.removeFile(file);
                }                
            });

            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("complete",function(file){
                $(file._removeLink).fadeOut();
            });
            this.on('sendingmultiple', function(data, xhr, formData) {
                // console.log(data);
                // console.log(xhr);
                // console.log(formData);
                var form = $('#form_user_payment');
                var modal = $('#form_user_payment').closest('.modal');
                var inputs = $("#form_user_payment input,textarea",modal).not("input[type='radio']");
                var radio = form.find('input[type="radio"]:checked',modal);
                // console.log(radio);
                // console.log(inputs);
                // return;
                inputs.each(function(index,input){
                    formData.append($(input).attr('name'),$(input).val());
                });
                if(radio !== undefined)
                    formData.append(radio.attr('name'),radio.val());
            });
            this.on('successmultiple',function(file, response){
                // console.log(file);
                // console.log(response);
                // console.log(JSON.parse(response));
                var res = JSON.parse(response);
                if(res.result != 1)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.msg,
                    })
                }
                else
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table_order.ajax.reload(null,false);
                    $("#modal_user_payment").modal('hide');
                }
            });
        }
    };
    var uploader = document.querySelector('#modal_user_payment .dropzone');
    var newDropzone = new Dropzone(uploader, dropzoneOptions);

    $(document).on('submit','#form_user_payment',function(e){
        e.preventDefault();
        e.stopPropagation();

        // var form = $("#form_user_payment");
        // var el = $("#form_user_payment input[name='payment_data'][required]:checked");
        // console.log(el);
        if(newDropzone.files.length < 1)
        {
            alert('กรุณาเพิ่มไฟล์รูปการชำระเงิน');
            return;
        }
        newDropzone.processQueue();  // Tell Dropzone to process all queued files.
    });
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
$(".flatpickr").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true,
    allowInput:true,
    // static: true,
    // wrap: true,
    onReady:function(dObj, dStr, fp){
    }
});
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
    var modal = $("#modal_user_payment");
    modal.attr('order_id',order_id);
    $(".bank_body",modal).html('');
    $(".bank_body",modal).append(append);
    $('input[name="order_id"]',modal).val(order_id);
    $('input[name="price"]',modal).val(price);
    $("#modal_user_payment_label span").html(order_id);


    modal.modal('show');
    // console.log($("#profit").length());
});