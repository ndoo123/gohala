// $('.table-responsive').responsiveTable({addDisplayAllBtn:false,addFocusBtn:false});
// alert($('#products_table').attr('remote_url'));
// datatables();
$(document).ready(function(){
    $(".filter_cate").change();
});
$(document).on('change','.filter_cate',function(){
    // alert($(this).val());
    if($(".filter_cate").val() != '')
    {
        $("#position").val(0);
        $(".btn_sort").fadeOut();
    }
    else
    {
        $(".btn_sort").fadeIn();
    }
    datatables($(this).val());
});
function datatables(val){
    var columns = [
            { data: 'p_sort', name: 'p_sort', class: 'text-center' },
            { data: 'img', name: 'img', class: 'text-center' },
            { data: 'sku', name: 'sku', class: 'text-center' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price', class: 'text-center' },
            { data: 'qty', name: 'qty', class: 'text-center' },
            { data: 'edit', name: 'edit', class: 'text-center' },
            { data: 'p_position', name: 'p_position', class: 'text-center' },
        ];
    // console.log(columns);
    var products_table = $('#products_table').DataTable({
        serverSide: true,
        processing: true,
        destroy: true,
        // order: [[ 1, "asc" ]],
        ajax: {
            url: $('#products_table').attr('remote_url'),
            data: {
                p_id : val,
                position : $("#position").val(),
            },
        },
        columns: columns,
    });
    // products_table.on( 'order.dt search.dt', function () {
    //     products_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();
        
}
$(document).on('click','.btn_sort',function(){
    // alert(1);
    // console.log($(".filter_cate").val());
    if($("#position").val() == 0)
    {
        $("#position").val(1);
    }
    else
    {
        $("#position").val(0);
    }
    if($(".filter_cate").val() != '')
    {
        $("#position").val(0);
    }
    $(".filter_cate").change();
});

$(document).on('change','.p_position',function(){
    
    var url = $("#current_url").val() + '/update_position';
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.current_p = parseInt($(this).attr('current_p'));
    obj.current_v = parseInt($(this).val());
    console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            console.log(res);
            if(res.result == 1)
            {
                $(".filter_cate").change();
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.msg,
                })
            }
        }
    });

});
$(document).on('click','.p_position_up',function(){
    var element = $(this).closest('td').find('.p_position');
    var val = parseInt(element.val()) - 1;
    element.val(val);
    element.change();
});
$(document).on('click','.p_position_down',function(){
    var element = $(this).closest('td').find('.p_position');
    var val = parseInt(element.val()) + 1;
    element.val(val);
    element.change();
});