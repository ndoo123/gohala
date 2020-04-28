  <div class="page-title">
    <h5>การชำระเงิน</h5>
    </div>
    <div id="payment_card" class="card card-border">
        <div class="card-body">
                <?php 
                if(count($payment_methods)==0)
                echo '<p>ร้านค้าไม่ได้ระบุวิธีชำระเงิน</p>';
             
                foreach($payment_methods as $index=> $dl):
          
                ?>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" <?php if($index==0)echo 'checked';?> id="payment_method_id_<?php echo $dl->method_id;?>" name="payment" value="<?php echo $dl->method_id;?>" class="custom-control-input">
                        <label class="custom-control-label" for="payment_method_id_<?php echo $dl->method_id;?>"><?php echo $dl->name;?></label>
                    
                    </div>
                <?php endforeach;?>
        </div>
    </div>
