// console.log($('#table_order').attr('remote_url'));
$(document).ready(function(){
    setInterval(function(){ 
        // alert("Hello"); 
        table_order.ajax.reload(null, false);
    }, 5000);
    // }, 100000);
});

var order_obj = {};
if($('#table_order').attr('order_status') !== undefined && $('#table_order').attr('order_status') != "")
{
    // alert();
    order_obj['order_status'] = $('#table_order').attr('order_status');
}
console.log(order_obj);
var table_order = $('#table_order').DataTable({
    serverSide: true,
    processing: false,
    destroy: true,
    // order: [[ 1, "asc" ]],
    ajax: {
        url: $('#table_order').attr('remote_url'),
        data: order_obj,
    },
    columns: [
        { data: 'id', name: 'id', class: 'text-center order_detail' ,"searchable": true},
        { data: 'order_date', name: 'order_date', class: 'text-center order_detail' ,"searchable": true},
        { data: 'delivery_name', name: 'delivery_name', class: 'text-center order_detail' ,"searchable": false},
        { data: 'qty', name: 'qty', class: 'text-center order_detail' ,"searchable": true},
        { data: 'total', name: 'total', class: 'text-center order_detail' ,"searchable": true},
        { data: 'status', name: 'status', class: 'text-center order_detail' ,"searchable": false},
        { data: 'actions', name: 'actions', class: 'text-center' ,"searchable": false},
    ],
    createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class
        var length = $(row).children().length - 1;
        // console.log(data.delivery);
        $.each($('td', row), function (colIndex) {
            // console.log(colIndex);
            
            if(colIndex != length)
            {
                $(this).attr('order_id', data.id); 
                $(this).attr('style', 'cursor: context-menu;'); 
            }
        });
    }
});
// $(document).on('submit',"#new_shop_form",function(e){
//     e.preventDefault();
   
//     var post=new PostForm('div.modal-content');
//     post.success=function(r){
//         if(r.result==0)
//         {
//             alert(r.msg);
//             return;
//         }
//        $("#new_shop_modal").modal('hide');
//        Load('html');
//       location.reload(true);
        
//     }
//     post.send($("#new_shop_form"));
// });