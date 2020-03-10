@extends('web.master_web')
@section('content')
<div class="main-container col1-layout">
     <div class="container">
    <div class="row">
        <div class="col-main col-sm-9 col-xs-12">
            <div class="page-content checkout-page"><div class="page-title">
          <h2>ข้อมูลการจัดส่ง</h2>
        </div>
        <div class="box-border">
            <?php 
            if(count($user_address)>0){
            $address=$user_address->where("is_default",1);
           
            if(count($address)==0)
                $address=$user_address[0];
                echo '<div class="row">';
                echo '<input type="hidden" name="address_id" value="">';
                    echo '<div class="col-md-2"><p class="name_address">'.$address->name_address.'</p></div>';
                    echo '<div class="col-md-8 address">'.$address->get_address().'</div>';
                    echo '<div class="col-md-2"><button data-toggle="modal" data-target="#user_address_select" type="button" class="btn btn-sm btn-primary">เปลี่ยน</button></div>';
                echo '</div>';
               
            }
            else
            {
                echo '<p>-- ไม่ได้ตั้งค่าข้อมูลที่อยู่  --</p>';
            }
            ?>
            <div id="user_address_select" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title pull-left">ที่อยุ่ที่จัดส่ง</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <table class="table table-bordered cart_summary">
                        <thead>
                            <tr>
                            <th width="100">ชื่อเรียก</th>
                            <th>ที่อยู่</th>
                            <th width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user_address as $addr):?>
                            <tr>
                                <td class="name_address"><?php echo $addr->name_address;?></td>
                                <td class="address"><?php echo $addr->get_address();?></td>
                                <td><button address_id="<?php echo $addr->id;?>" type="button" class="btn btn-sm btn-info select_user_address">เลือก</button></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
             
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                  
                    </div>
                </div>
                </div>
        </div>
        
        </div>
        </div>
    </div>
</div>
</div>
@stop