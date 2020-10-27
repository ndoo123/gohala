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
var table_order = $('#table_order').DataTable({
    serverSide: true,
    processing: false,
    destroy: true,
    // order: [[ 1, "asc" ]],
    ajax: {
        url: $('#table_order').attr('remote_url'),
        data: order_obj,
    },
    search: {
        "search": $("#order_id").val()
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
    },
    drawCallback: function( settings ) {
        // alert( 'DataTables has redrawn the table' );
    },
    initComplete: function(settingss,json){
        // alert( 'initComplete' );
        var order_id = $("#order_id").val();
        var td = $(this).find('td.order_detail.sorting_1');
        td.each(function(){
            // console.log(this);
            if($(this).attr('order_id') == order_id)
            {
                $(this).click();
            }
        });
    },
});
