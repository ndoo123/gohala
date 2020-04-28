<p>การชำระเงิน</p>
<form action="<?php echo url($shop->url.'/setting/payment/save/json');?>" method="post">
<?php echo csrf_field();?>
<button type="submit" class="btn btn-success form-submit-action"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($payment_methods as $method):
           $shop_payment=$shop_payment_methods->where("method_id",$method->id)->first();
           ?>
           <tr method_id="<?php echo $method->id;?>">
                <input type="hidden" name="payment_method[]" value="<?php echo $method->id;?>">
               <td>
                   <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" <?php echo ($shop_payment&&$shop_payment->is_checked?'checked':'');?> name="payment_check[<?php echo $method->id;?>]" class="custom-control-input" id="payment_check<?php echo $method->id;?>">
                        <label class="custom-control-label" for="payment_check<?php echo $method->id;?>"><?php echo $method->name;?></label>
                    </div>
               </td>
               <td>
                   <?php if($method->id==2):?>
                   <input type="hidden" name="payment_data[<?php echo $method->id;?>]" value='<?php echo ($shop_payment?json_decode($shop_payment->payment_data):'');?>'>
                   <button type="button" id="edit_payment_bank_transfer_btn" class="btn btn-sm btn-primary">ตั้งค่าบัญชีธนาคาร</button>
                   <?php endif;?>
                </td>
           </tr>
           <?php endforeach;?>
        </tbody>
    </table>
</div>
</form>

<div id="shop_payment_bank_transfer_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title pull-left">กำหนดบัญชีธนาคาร</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
         <table class="table" style="width:100%">
             <thead>
             <tr>
                 <th>ชื่อธนาคาร</th>
                 <th>ชื่อบัญชี</th>
                 <th>เลขบัญชี</th>
             </tr>
             </thead>
             <tbody>
                 <tr class="add_row">
                     <td colspan="3" style="text-align:center"><button id="add_bank_row" class="btn btn-sm btn-info">เพิ่มบัญชี</button></td>
                 </tr>
             </tbody>
         </table>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            <button type="button" id="save_shop_payment_bank_transfer" class="btn btn-primary" >ยืนยันรายการ</button>
        </div>
        
        </div>
    </div>
</div>
@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/payment.js');?>"></script>
@stop