<p>การชำระเงิน</p>
<form action="<?php echo url($shop->url.'/setting/payment/save/json');?>" method="post">
<?php echo csrf_field();?>
<button type="submit" class="btn btn-success form-submit-action"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>ชื่อ</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($payment_methods as $method):
           $shop_payment=$shop_payment_methods->where("method_id",$method->id)->first();
           ?>
           <tr method_id="<?php echo $method->id;?>">
               <td>
                   <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" <?php echo ($shop_payment?'checked':'');?> name="shop_payment[<?php echo $method->id;?>]" class="custom-control-input" id="shop_payment<?php echo $method->id;?>">
                        <label class="custom-control-label" for="shop_payment<?php echo $method->id;?>"><?php echo $method->name;?></label>
                    </div>
               </td>
           </tr>
           <?php endforeach;?>
        </tbody>
    </table>
</div>
</form>


@section('js')
@parent
<script src="<?php echo url('assets/manage/js/pages/settings/payment.js');?>"></script>
@stop