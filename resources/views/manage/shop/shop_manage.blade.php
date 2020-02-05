@extends('manage.master_manage')
@section('title')
<?php echo $shop->name;?>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
      
      
    </div>
</div>


@stop
@section('js')
 <script src="<?php echo url('assets/manage/js/pages/shop/shop.js');?>"></script>
@stop