// $('.table-responsive').responsiveTable({addDisplayAllBtn:false,addFocusBtn:false});
// alert($('#products_table').attr('remote_url'));
// datatables();
$(document).ready(function(){
    $(".filter_cate").change();
});
$(document).on('change','.filter_cate',function(){
    // alert($(this).val());
    datatables($(this).val());
});
function datatables(val){
    var products_table = $('#products_table').DataTable({
        serverSide: true,
        processing: true,
        destroy: true,
        // order: [[ 1, "asc" ]],
        ajax: {
            url: $('#products_table').attr('remote_url'),
            data: {
                p_id : val,
            },
        },
        columns: [
            { data: 'id', name: 'id', class: 'text-center' },
            { data: 'img', name: 'img', class: 'text-center' },
            { data: 'sku', name: 'sku', class: 'text-center' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price', class: 'text-center' },
            { data: 'qty', name: 'qty', class: 'text-center' },
            { data: 'edit', name: 'edit', class: 'text-center' },
        ]
    });
    products_table.on( 'order.dt search.dt', function () {
        products_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
        
}