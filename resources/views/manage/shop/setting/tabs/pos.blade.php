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

@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/pos.js');?>"></script>
@stop