@extends('manage.master_manage')
@section('title')
{{-- ออเดอร์ทั้งหมดของร้าน | <span style="color:blue">{{ $shop->name }}</span> --}}
<span>การแจ้งเตือนทั้งหมด <span class="font-12">(ยังไม่อ่าน {{ $notify_unread }} จาก {{ $notify_count }})</span>
<?= !empty($shop) ? ' | <span style="color:#008CBA">'.$shop->name.'</span>' : '' ?></span>

@stop
@section('content')

{{-- <input type="hidden" name="url" id="url" value="{{ $url }}"> --}}
{{-- <input type="hidden" name="order_id" id="order_id" value="{{ !empty($order_id) ? $order_id : '' }}"> --}}
<div class="row">
    <div class="col-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <select name="notify_is_read" id="notify_is_read" class="form-control">
                            <option value="">--- Filter ---</option>
                            <option value="0">ยังไม่อ่าน</option>
                            <option value="1">อ่านเรียบร้อย</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th width="10%" class="text-center">วันที่</th>
                                    <th width="10%" class="text-center">คำสั่งซื้อเลขที่</th>
                                    <th width="10%" class="text-center">หัวข้อ</th>
                                    <th width="50%">รายละเอียด</th>
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
    $(document).ready(function(){
        $("#notify_is_read").change();
        // setInterval(function(){ main_table.ajax.reload( null, false); }, 3000);
    });
    
    $(document).on('change','#notify_is_read',function(){

        var main_table = $('#table_notify').DataTable({
            serverSide: true,
            processing: false,
            destroy: true,
            order: [[ 1, "asc" ]],
            ajax: ({
                url: $('#table_notify').attr('remote_url'),
                data: { is_read : $("#notify_is_read").val() },
            }),
            columns: [
                { data: 'created_show', name: 'created_show', class: 'text-center', "searchable": false  },
                { data: 'order_id', name: 'order_id', class: 'text-center' },
                { data: 'event_name', name: 'event_name', class: 'text-center', "searchable": false },
                // { data: 'shop_name', name: 'shop_name', class: 'text-center', "searchable": false },
                { data: 'info', name: 'info', class: 'text-left' },
                { data: 'is_read', name: 'is_read', class: 'text-center', "searchable": false  },
                { data: 'go_to', name: 'go_to', class: 'text-center', "searchable": false  },
            ],
            initComplete: function( settings, json ) {
                
            }
        });
    });
</script>
@endsection
