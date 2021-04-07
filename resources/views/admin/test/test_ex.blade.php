@extends('manage.master_manage')
@section('title')

@stop
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
                            <table id="products_table" class="table table-hover" > 
                                <thead class="thead-light">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อร้าน</th>
                                        <th>description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shops as $key => $data)
                                    <tr>
                                        <th width="100">{{$data->id}}</th>
                                        <th width="100">{{$data->name}}</th>
                                        <th width="150">ชื่อร้าน</th>
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

<script src="<?php echo url('assets/manage/js/pages/shop/product/product.js');?>"></script>
@stop
