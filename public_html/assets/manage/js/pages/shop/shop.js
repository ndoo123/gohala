// console.log($('#table_order').attr('remote_url'));
$(document).ready(function(){
    // table_order;
});
var table_order = $('#table_order').DataTable({
    serverSide: true,
    processing: true,
    destroy: true,
    // order: [[ 1, "asc" ]],
    ajax: {
        url: $('#table_order').attr('remote_url'),
        data: {},
    },
    columns: [
        { data: 'id', name: 'id', class: 'text-center order_detail' },
        { data: 'order_date', name: 'order_date', class: 'text-center order_detail' },
        { data: 'delivery_name', name: 'delivery_name', class: 'text-center order_detail' },
        { data: 'qty', name: 'qty', class: 'text-center order_detail' },
        { data: 'total', name: 'total', class: 'text-center order_detail' },
        { data: 'status', name: 'status', class: 'text-center order_detail' },
        { data: 'actions', name: 'actions', class: 'text-center' },
    ],
    createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class
        var length = $(row).children().length - 1;
        // console.log(length);
        $.each($('td', row), function (colIndex) {
            // console.log(colIndex);
            
            if(colIndex != length)
            {
                $(this).attr('order_id', data.id); 
                // $(this).attr('data-toggle', 'modal'); 
                // $(this).attr('data-target', '#modal_order_item'); 
                // <td class="order_detail" order_id="{{ $ord->id }}">{{ $ord->id }}</td>
            }
        });
    }
});
$(document).on('submit',"#new_shop_form",function(e){
    // alert(1);
    e.preventDefault();
   
    var post=new PostForm('div.modal-content');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
       $("#new_shop_modal").modal('hide');
       Load('html');
      location.reload(true);
        
    }
    post.send($("#new_shop_form"));
});