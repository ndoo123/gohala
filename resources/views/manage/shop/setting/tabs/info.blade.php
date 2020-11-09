
<form action="<?php echo url($shop->url.'/setting/info/save/json');?>" method="post">
<?php echo csrf_field();?>
<div class="row justify-content-md-center">
    <button type="submit" class="btn btn-success form-submit-action"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    <div class="col-md-2 text-center mb-3">
        <div class="font-weight-bold" style="text-decoration: underline;color:#00A2E3">รูปโปรไฟล์ร้านค้า </div>
        <div class="mt-3">
            {{-- <img src="{{ $shop->get_photo() }}" id="profile_show" width="200" height="150" class="" style="border-width: thin;border-style: solid;border-radius: 8px"> --}}
            {{-- <img src="{{ $shop->get_photo() }}" id="profile_show" width="200" height="150" class="" style="border: 1px solid #ddd;border-radius: 4px;padding: 5px;"> --}}
            <img src="{{ $shop->get_photo() }}" id="profile_show" width="200" height="150" class="img_logo">
            {{-- class="rounded-circle"> --}}
            <br>
        </div>
        <div class="mt-3">( ใช้ไฟล์รูปภาพประเภท JPG หรือ PNG ขนาดภาพที่เหมาะสม 200 x 150 pixel )</div>
        <div class="mt-3">
            {{-- {{ dd($current_ur  l.'/change_profile') }} --}}
            <button type="button" id="change_profile_image" class="btn btn-sm btn-primary" style="margin-left:10px">
                เปลี่ยนรูป
            </button>
        </div>
    </div>
     <div class="col-md-1"></div>
    <div class="col-md-6">
        <h6>ข้อมูลทั่วไป</h6>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">ชื่อร้าน</span>
                </div>
                <input type="text" name="name" class="form-control" value="<?php echo $shop->name;?>" >
            </div>
            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">เลขผู้เสียภาษี</span>
                </div>
                <input type="text" name="tax_id" class="form-control" value="<?php echo $shop->tax_id;?>" >
            </div>
        <hr>
        <h6>ข้อมูลติดต่อ</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">เบอร์โทร</span>
                        </div>
                        <input type="text" name="phone" class="form-control" value="<?php echo $shop->phone;?>" >
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input type="text" name="email" class="form-control" value="<?php echo $shop->email;?>" >
                    </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Line</span>
                        </div>
                        <input type="text" name="line" class="form-control" value="<?php echo $shop->line;?>" >
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Facebook</span>
                        </div>
                        <input type="text" name="facebook" class="form-control" value="<?php echo $shop->facebook;?>" >
                    </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h6>ที่อยู่</h6>
                <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ที่อยู่</span>
                        </div>
                        <input type="text" name="address" class="form-control" value="<?php echo $shop->address;?>" >
                    </div>
            </div>
                <div class="col-md-3">
                    <h6>จังหวัด</h6>
                    <select name="province" class="form-control">
              
                        <?php foreach($provinces as $p):?>
                            <option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3">
                    <h6>ไปรษณีย์</h6>
                    <input name="zipcode" type="text" class="form-control" value="<?php echo $shop->address;?>" >
                </div>
                
        </div>
    </div>
</div>
</form>

@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/info.js');?>"></script>
@stop