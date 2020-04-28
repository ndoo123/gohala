  <div class="page-title">
    <h5>จัดส่ง</h5>
    </div>
    <div id="delivery_card" class="card card-border">
        <div class="card-body">
                <?php 
                if(count($delivery_methods)==0)
                echo '<p>ร้านค้ายังไม่ได้ระบุการจัดส่ง</p>';
             
                foreach($delivery_methods as $index=> $dl):?>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" cal_type="<?php echo $dl->cal_type;?>" cost="<?php echo $dl->ship_cost;?>" <?php if($index==0)echo 'checked';?> id="method_id_<?php echo $dl->id;?>" name="delivery_method" value="<?php echo $dl->id;?>" class="custom-control-input">
                        <label class="custom-control-label" for="method_id_<?php echo $dl->id;?>"><?php echo $dl->name;
                        ?></label>
                    </div>
                <?php endforeach;?>
        </div>
    </div>
