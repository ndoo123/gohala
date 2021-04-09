@extends('admin.master_admin')
@section('content')

<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-rep-plugin bg-light">
                        <div class="table-responsive mb-0"  data-pattern="priority-columns">
                            <table id="user_table" class="table table-hover" >
                                <thead class="thead-light">
                                <tr>
                                    <th width="100">ลำดับ</th>
                                    <th width="100">ชื่อ</th>
                                    <th width="100">อีเมล์</th>
                                    <th  width="100"></th>
                                </tr>
                                
                                </thead>
                                <tbody>
                                    @foreach ($users as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <th>{{ $data->name }}</th>
                                        <th>{{ $data->email }}</th>
                                        <th>
                                            <a href="edit_user" class="btn btn-sm btn-primary">แก้ไขร้านค้า</a>
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

    var datatable = 
        $('#user_table').DataTable({
        });

</script>
@stop
