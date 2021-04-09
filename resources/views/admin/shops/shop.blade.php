@extends('admin.master_admin')
@section('content')

<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
      <div class="row">
        <div class="col-12">
            
            <div class="card">
                <div class="card-body">
                    <select class="form-control mb-3 filter_cate">
                        <option value="2">--- หมวดหมู่ทั้งหมด ---</option>
                        <option value="1"> Open </option>
                        <option value="0"> Close </option>
                    </select>
                    <div class="table-rep-plugin bg-light">
                        <div class="table-responsive mb-0"  data-pattern="priority-columns">
                            <table id="shop_table" class="table table-hover" >
                                <thead class="thead-light">
                                <tr>
                                    <th width="100">ลำดับ</th>
                                    <th width="100">ชื่อร้าน</th>
                                    <th width="100"></th>
                                </tr>
                                
                                </thead>
                                <tbody>
                                    @foreach ($shops as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <th>{{ $data->name }}</th>
                                        <th>
                                            <a href="" class="btn btn-sm btn-primary">แก้ไขร้านค้า</a>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
      
    </div>
</div>


@stop
@section('css')
<link href="<?php echo url('assets/js/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css');?>" rel="stylesheet" type="text/css" media="screen">
<link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
@stop

@section('js')
<!-- Responsive-table-->
<script src="<?php echo url('assets/js/plugins/sweet-alert2/sweetalert2.all.min.js');?>"></script>
<script src="<?php echo url('assets/js/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js');?>"></script>
<script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

<script>
    // $(document).ready( function () {
    // } );
    // $.ajax({
    //     url: 'http://admin.gohala.local/shop/datatables',
    //     // url: $('http://admin.gohala.local/shop/datatables').attr('remote_url'),
    //     type: 'get',
    //     dataType: 'json',
    //     data: {},
    //     success:function(res){
    //         console.log(res);
    //     }
    // });
    var datatable = 
        $('#shop_table').DataTable({
            // "processing": true,
            // "serverSide": true,
            // "ajax": { 
            //     url: $('#shop_table').attr('remote_url'),
            // },
            // "columns": [
            //     { data: "id", name: "id" },
            //     { data: "name", name: "name" },
            // ]
        });

    // $(function() {
    // $('#users-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     columns: [
    //         { data: 'id', name: 'id' },
    //         { data: 'name', name: 'name' },
    //         { data: 'email', name: 'email' },
    //         { data: 'created_at', name: 'created_at' },
    //         { data: 'updated_at', name: 'updated_at' }
    //     ]
    // });
// });

</script>
@stop
