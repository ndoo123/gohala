
<div id="new_address_modal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="new_address_modal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="address_info_form" method="post" action="<?php echo url('profile/address/update');?>">
            <?php echo csrf_field();?>
            <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
            <input type="hidden" name="address_id" class="input_address" value="">
            <div class="modal-header">
                <h5 class="modal-title mt-0">ข้อมูลที่อยู่</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo __('view.contact_name');?> <span class="text-danger">*</span></label>
                            <input type="text" name="contact_name" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <label><?php echo __('view.address_name');?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control input_address" value="">
                        </div>
                       
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.contact_phone');?> <span class="text-danger">*</span></label>
                            <input type="text" name="contact_phone" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo __('view.address');?> <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control input_address" value="">
                        </div>
                    </div>
                      
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.province');?> <span class="text-danger">*</span></label>
                            <select name="province" class="form-control select_address">
                                <?php foreach($provinces as $province):?>
                                <option value="<?php echo $province->id;?>"><?php echo $province->name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.zipcode');?> <span class="text-danger">*</span></label>
                            <input type="text" name="zipcode" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="save_address_btn" class="btn btn-primary waves-effect waves-light">บันทึกที่อยู่</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>