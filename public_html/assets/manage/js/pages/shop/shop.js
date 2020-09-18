$(document).ready(function(){
    profit();
    // datatables();
});
$(document).on('click','.goto',function(){
    if($(this).attr('goto') !== undefined)
    {
        location.href = $(this).attr('goto');
    }
});
// var table_order = $('#table_order').DataTable({
//     serverSide: true,
//     processing: false,
//     destroy: true,
//     order: [[ 1, "asc" ]],
//     ajax: {
//         url: $('#table_order').attr('remote_url'),
//         data: {},
//     },
//     columns: [
//         { data: 'id', name: 'id', class: 'text-center order_detail' },
//         { data: 'order_date', name: 'order_date', class: 'text-center order_detail' },
//         { data: 'delivery_name', name: 'delivery_name', class: 'text-center order_detail' },
//         { data: 'qty', name: 'qty', class: 'text-center order_detail' },
//         { data: 'total', name: 'total', class: 'text-center order_detail' },
//         { data: 'status', name: 'status', class: 'text-center order_detail' },
//         { data: 'actions', name: 'actions', class: 'text-center' },
//     ],
//     createdRow: function( row, data, dataIndex ) {
//         var length = $(row).children().length - 1;
//         $.each($('td', row), function (colIndex) {
//             if(colIndex != length)
//             {
//                 $(this).attr('order_id', data.id); 
//             }
//         });
//     },
//     "drawCallback": function( settings ) {
//         profit();
//     },
// });
// function datatables()
// {
//     setInterval(function(){ 
//         // alert("Hello"); 
//         table_order.ajax.reload(null, false);

//     }, 5000);
//     // table_order.ajax.reload();
// }
function profit(){
    var url = $("#url").val()+'/profit';
    // var url = location.origin;
    var obj = new Object();
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
                // $("#profit").html(res.data);
                $("#profit").text(res.data);
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
}