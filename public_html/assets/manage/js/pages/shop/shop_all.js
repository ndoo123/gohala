// console.log($('#table_order').attr('remote_url'));
$(document).ready(function(){
    setInterval(function(){ 
        // alert("Hello"); 
        table_order.ajax.reload(null, false);
    }, 5000);
    // }, 100000);
});
// console.log(location);
var order_obj = {};
if($('#table_order').attr('order_status') !== undefined && $('#table_order').attr('order_status') != "")
{
    order_obj['order_status'] = $('#table_order').attr('order_status');
}
var table_order = $('#table_order').DataTable({
    serverSide: true,
    processing: false,
    destroy: true,
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
            
            $(this).attr('order_id', data.id); 
            if(colIndex != length)
            {
                $(this).attr('style', 'cursor: context-menu;'); 
            }
            else if(colIndex == length)
            {
                $(this).addClass('td_edition');
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
            if($(this).attr('order_id') == order_id)
            {
                console.log(this);
                if($("#notify_type").val() == 'order')
                {
                    $(this).click();
                }
                else if($("#notify_type").val() == 'payment')
                {
                    $(this).closest('tr').find('.btn_order_payment_view').click();
                }
            }
        });
    },
});
