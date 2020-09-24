<!-- modal_view_payment -->
<div class="modal fade" id="modal_view_payment" tabindex="-1" role="dialog" aria-labelledby="modal_view_payment_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_view_payment_label">Order # <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_view_payment_body">
                    <div class="form-group col-6">
                        <label for="order_id">หมายเลขใบสั่งซื้อ <span class="text-danger">*</span></label>
                        <input type="text" id="order_id" name="order_id" value="" class="form-control" readonly>
                    </div>
                    <div class="form-group col-6">
                        <label for="price">จำนวนเงิน <span class="text-danger">*</span></label>
                        <input type="text" id="price" name="price" value="" class="form-control" readonly>
                    </div>
                    <div class="form-group col-12">
                        <label for="bank">ธนาคาร <span class="text-danger">*</span></label>
                        <div class="bank_body col-12">
                            {{-- <input type="radio" name="payment_data" class="custom-control-input" id="payment_check_'+index+'" value=\''+JSON.stringify(payment_arr[index])+'\' required>'; 
                            in ajax
                            --}}
                        </div>
                    </div>
                    <div class="form-group col-12 ">
                            <label for="price">วันที่ <span class="text-danger">*</span></label>
                            <input type="text" id="payment_date" name="payment_date" class="form-control" readonly>
                    </div>
                    <div class="form-group col-12">
                        <label for="price">หมายเหตุ <span class="text-danger"></span></label>
                        <textarea row=3 id="payment_remark" name="payment_remark" class="form-control" readonly></textarea>
                    </div>
                    
                    <div class="form-group col-12 view_payment_img">
                        {{-- <label for="price">หมายเหตุ <span class="text-danger"></span></label> --}}
                        {{-- <textarea row=3 id="payment_remark"view_payment_img name="payment_remark" class="form-control" readonly></textarea> --}}
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="modal_view_payment_footer">

                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- end modal_view_payment -->
{{-- <script src="{{ url('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<link href="{{ url('assets/js/plugins/magnific-popup/magnific-popup.css') }}"> --}}
<script src="<?php echo url('assets/modal/view_payment.js');?>"></script>