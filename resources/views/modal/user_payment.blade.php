<!-- modal_user_payment -->
<style>
    .input-button
    {
        text-decoration: none; 
        border: 1px solid #bbb;
        display: block;
        padding: 8.5px 12px;
        border-left: 0;
        cursor: pointer;
        align-self: center;
        justify-content: center;
        line-height: 1; 
    }
</style>
<div class="modal fade" id="modal_user_payment" role="dialog" aria-labelledby="modal_user_payment_label" aria-hidden="true">
    <form action="{{ $url.'/user_payment' }}" method="post" class="needs-validation" novalidate id="form_user_payment" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_user_payment_label">Order # <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_user_payment_body">
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
                            <input type="text" id="payment_date" name="payment_date" class="form-control flatpickr" required data-input>
                            {{-- <a class="input-button" title="toggle" data-toggle>
                                <i class="ti-arrow-circle-down"></i>
                            </a>

                            <a class="input-button" title="clear" data-clear>
                                <i class="ti-arrow-circle-down"></i>
                            </a> --}}
                    </div>
                    {{-- <div class="form-group col-4">
                        <label for="price">ชั่วโมง <span class="text-danger">*</span></label>
                        <select id="payment_hour" name="payment_hour" class="form-control">
                            @for ($i = 0 ; $i < 24; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="price">นาที <span class="text-danger">*</span></label>
                        <select id="payment_minute" name="payment_minute" class="form-control">
                            @for ($i = 0 ; $i < 60; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div> --}}
                    <div class="form-group col-12">
                        <label for="price">หมายเหตุ <span class="text-danger"></span></label>
                        <textarea row=3 id="payment_remark" name="payment_remark" class="form-control"></textarea>
                    </div>
                    {{-- <div class="form-group col-12">
                        <label for="price">ไฟล์หลักฐานการชำระเงิน <span class="text-danger">*</span></label>
                        <input type="file" id="payment_file" name="payment_file" accept="image/*" class="form-control" required>
                    </div> --}}

                    <div class="form-group col-12">
                        <div class="dropzone dropzone-previews w-100" id="my-awesome-dropzone"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary sm_order_payment">Submit</button>
            </div>
        </div>
    </div>
    </form>
</div>
<link rel="stylesheet" href="<?php echo url('assets/js/plugins/flatpickr/flatpickr.min.css');?>">
<link rel="stylesheet" href="<?php echo url('assets/js/plugins/dropzone/dist/dropzone.css');?>">
<script src="<?php echo url('assets/js/plugins/flatpickr/flatpickr.js');?>"></script>
<script src="{{ url('assets/js/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo url('assets/modal/order_payment.js');?>"></script>
{{-- <script></script> --}}
<!-- end modal_user_payment -->