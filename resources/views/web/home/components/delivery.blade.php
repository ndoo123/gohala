  <div class="page-title">
    <h5>วิธีการขนส่ง</h5>
    </div>
    <div id="delivery_card" class="card card-border">
        <div class="card-body">
                <?php foreach(\DB::table('payment_method_tb')->get() as $dl):?>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="method_id_<?php echo $dl->id;?>" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="method_id_<?php echo $dl->id;?>"><?php echo $dl->name;?></label>
                    </div>
                <?php endforeach;?>
        </div>
    </div>
@section('js')
@parent
<script src="<?php echo url('');?>/assets/web/js/page/checkout.js"></script>
@stop