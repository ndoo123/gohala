@extends('manage.master_manage')
@section('title')
{{-- ออเดอร์ทั้งหมดของร้าน | <span style="color:blue">{{ $shop->name }}</span> --}}
การแจ้งเตือนทั้งหมด
@stop
@section('content')

{{-- <input type="hidden" name="url" id="url" value="{{ $url }}"> --}}
{{-- <input type="hidden" name="order_id" id="order_id" value="{{ !empty($order_id) ? $order_id : '' }}"> --}}
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">
                    {{-- {{ __('view.order_list_all') }} --}}
                </h4>
                <div class="row">
                    <div class="table-responsive col-12">
                        <table class="table table-hover mb-0 bg-light w-100" id="table_notify" remote_url="{{ $remote_url }}">
                            <thead>
                                <tr>
                                    <th width="20%" class="text-center">วันที่</th>
                                    <th width="20%" class="text-center">คำสั่งซื้อเลขที่</th>
                                    <th width="40%">รายละเอียด</th>
                                    <th width="10%" class="text-center">สถานะ</th>
                                    <th width="10%" class="text-center">#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    var main_table = $('#table_notify').DataTable({
        serverSide: true,
        processing: true,
        destroy: true,
        order: [[ 1, "asc" ]],
        ajax: {
            url: $('#table_notify').attr('remote_url'),
            data: {},
        },
        columns: [
            { data: 'created_show', name: 'created_show', class: 'text-center' },
            { data: 'order_id', name: 'order_id', class: 'text-center' },
            { data: 'info', name: 'info', class: 'text-center' },
            { data: 'is_read', name: 'is_read', class: 'text-center' },
            { data: 'go_to', name: 'go_to', class: 'text-center' },
        ],
        // createdRow: function( row, data, dataIndex ) {
            // $.each($('td',row),function(index){
                // if(index == 0)
                // {
                    // $(this).attr('id', 'data');
                // }
            // });
            // console.log(data);
            // $(row).attr('id', 'data');
        // },
    });
    // table_notify.on( 'order.dt search.dt', function () {
        // table_notify.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            // cell.innerHTML = i+1;
        // } );
    // } ).draw();
</script>
@endsection
