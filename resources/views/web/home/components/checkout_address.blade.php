  <div class="page-title">
    <h5>ข้อมูลการจัดส่ง</h5>
    </div>
    <div id="address_card" class="card card-border">
        <div class="card-body">
            <?php 
                if(count($user_address)==0):?>
                    <p class="title">ที่อยู่</p>
                    <div class="row contact">
                    </div>
                    <p class="address">ยังไม่ระบุที่อยู่ <a id="add_new_address_to_select" href="javascript:;">เพิ่มที่อยู่</a></p>
                <?php else:
                    $address=$user_address->where("is_default",1)->first();
                    if(!$address)
                    $address=$user_address[0];

                ?>
                <input type="hidden" name="address_id" value="<?php echo $address->id;?>">
                    <p class="title"><?php echo $address->name_address;?></p>
                    <div class="row contact">
                        <div class="col-md-4">
                            <i class="icon fa fa-user "></i> <?php echo $address->name_contact;?>
                        </div>
                        <div class="col-md-4">
                            <i class="icon fa fa-phone"></i> <?php echo $address->phone;?>
                        </div>
                    </div>
                    <p class="address"><?php echo $address->get_address();?></p>
                    
                <?php endif;?>
            <div class="action">
                <a id="change_address"   href="javascript:;">เปลี่ยนที่อยู่</a><br>
                <a id="add_new_address_to_select" href="javascript:;">เพิ่มที่อยู่</a>
            </div>
            
        </div>
    </div>
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
        <table class="table table-bordered">
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
                <td ><span class="address"><?php echo $addr->get_address();?></span>
                <div class="row" style="margin-top:5px">
                    <div class="col-md-4">
                    <i class="icon fa fa-user "></i><span class="contact_name"><?php echo $addr->name_contact;?></span>
                    </div>
                    <div class="col-md-4">
                         <i class="icon fa fa-phone "></i><span class="contact_phone"><?php echo $addr->phone;?></span>
                    </div>
                </div>
                </td>
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

<div id="user_address_add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title pull-left">เพิ่มที่อยู่</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label>ชื่อเรียกที่อยู่</label>
                    <input type="text" placeholder="บ้าน/ที่ทำงาน/ร้าน"  class="address_name form-control input">
                </div>
                     <div class="col-md-4">
                    <label>ชื่อผุ้รับ</label>
                    <input type="text"  class="contact_name form-control input">
                </div>
                <div class="col-md-4">
                    <label>เบอร์โทร</label>
                    <input type="text"  class="contact_phone form-control input">
                </div>
            </div>
           
            <div class="row" style="margin-top:10px">
                <div class="col-md-7">
                    <label>รายละเอียดที่อยู่</label>
                    <input type="text"  class="address form-control input">
                </div>
                 <div class="col-md-3">
                    <label>จังวัด</label>
                    <select name="province" class="province form-control select_address">
                       <?php foreach($provinces as $p):?>
                       <option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
                       <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>รหัสไปรษณีย์</label>
                    <input type="text"  class="zipcode form-control input">
                </div>
            </div>
           
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            <button type="button" id="add_new_address_btn" class="btn btn-primary" >บันทึกที่อยู่ใหม่</button>
        </div>
        
        </div>
    </div>
</div>
