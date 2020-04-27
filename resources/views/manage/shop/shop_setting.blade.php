@extends('manage.master_manage')
@section('title')
ตั้งค่าข้อมูลร้าน | <?php echo $shop->name;?>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <?php LKS::has_alert();?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">ใบเสร็จ</h4>

                    <div class="form-group">
                        <label>รูปแบบใบเสร็จ</label>
                        <div>
                            <input type="text" class="form-control"
                                    data-parsley-minlength="6" value="{{ LKS::txt_receipt($shop->receipt_type) }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>จำนวนใบเสร็จ</label>
                        <div>
                            <input type="text" class="form-control" required
                                    data-parsley-maxlength="6" value="{{ $shop->receipt_number }}"/>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-warning waves-effect waves-light mr-1">
                                แก้ไข
                            </button>
                        </div>
                    </div>

            </div>
        </div>
    </div> <!-- end col -->
    


</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body">
        
        

    </div>
</div>
    </div>
</div>

@stop
@section('js')

@stop