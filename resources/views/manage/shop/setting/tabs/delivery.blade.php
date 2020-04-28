<p>เลือกขนส่งที่รองรับ</p>
<form action="<?php echo url($shop->url.'/setting/delivery/save/json');?>" method="post">
<?php echo csrf_field();?>
<button type="submit" class="btn btn-success form-submit-action"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th width="150">ค่าจัดส่ง</th>
                <th width="200">คำนวณค่าส่ง</th>
                <th width="150"></th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($ship_method_tb as $method):
           $shop_method=$shop_shippings->where("shipping_id",$method->id)->first();
           ?>
            <input type="hidden" name="ship_cost[<?php echo $method->id;?>]" value="">
            <input type="hidden" name="ship_cal[<?php echo $method->id;?>]" value="">
           <tr method_id="<?php echo $method->id;?>">
               <td>
                   <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" <?php echo ($shop_method && $shop_method->is_checked==1?'checked':'');?> name="ship_method[<?php echo $method->id;?>]" class="custom-control-input" id="ship_method_<?php echo $method->id;?>">
                        <label class="custom-control-label" for="ship_method_<?php echo $method->id;?>"><?php echo $method->name;?></label>
                    </div>
               </td>
               <?php 
               
               if($shop_method):?>
               <input type="hidden" name="ship_cost[<?php echo $method->id;?>]" value="<?php echo $shop_method->ship_cost;?>">
               <input type="hidden" name="ship_cal[<?php echo $method->id;?>]" value="<?php echo $shop_method->cal_type;?>">
               <td class="ship_cost"><?php echo $shop_method->ship_cost;?></td>
               <td class="cal_type"><?php echo $shop_method->get_calculate();?></td>
               <?php else:?>
               <td class="ship_cost"></td>
               <td class="cal_type"></td>
               <?php endif;?>
               <td><button type="button" ship_method_id="<?php echo $method->id;?>" class="btn btn-sm btn-primary set_ship_method_btn">กำหนดค่าส่ง</button></td>
           </tr>
           <?php endforeach;?>
        </tbody>
    </table>
</div>
</form>


<div id="ship_setting_modal" ship_method_id="" class="modal fade show" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">กำหนดค่าส่ง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ค่าส่ง</span>
                        </div>
                        <input type="text" class="cost form-control text-right">
                            <div class="input-group-appened">
                            <span class="input-group-text">บาท</span>
                        </div>
                    </div>
                     <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">การคำนวณ</span>
                                    </div>
                                    <select class="custom-select cal_type"> 
                                        <option value="1">ค่าใช้จ่ายเหมารวม</option>
                                        <option value="2">ค่าส่ง * จำนวนรายการ</option>
                                    </select>
                                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" id="save_ship_method_info_btn" class="btn btn-primary waves-effect">บันทึก</button>
                </div>
           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/delivery.js');?>"></script>
@stop