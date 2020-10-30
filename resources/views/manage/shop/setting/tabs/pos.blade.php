<form action="<?php echo url($shop->url.'/setting/pos/save/json');?>" method="post">
    <?php echo csrf_field();?>
    <button type="submit" class="btn btn-success form-submit-action"><i class="fas fa-save"></i> บันทึกข้อมูล</button>

<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">ใบเสร็จ</h4>

                    <div class="form-group">
                        <label>รูปแบบใบเสร็จ</label>

                        <select name="s_receipt" class="form-control">
                                <option value="1" <?php if($shop->receipt_type == '1'){ echo 'selected'; }?>>ขนาด สลิป ไม่มี VAT</option>
                                <option value="2" <?php if($shop->receipt_type == '2'){ echo 'selected'; }?>>ขนาด สลิป แสดง VAT</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label>จำนวนใบเสร็จ</label>
                        <div>
                            <input name="t_recnum" type="text" class="form-control" required
                                    data-parsley-maxlength="6" value="{{ $shop->receipt_number }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ข้อความท้ายใบเสร็จ</label>
                        <div>
                            <textarea class="form-control" id="t_note" name="t_note" rows="3">{{ $shop->receipt_note }}</textarea>
                        </div>
                    </div>


            </div>
        </div>
    </div> <!-- end col -->
    


</div>

</form>

@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/pos.js');?>"></script>
@stop