<!-- modal_order_cancel -->
<div class="modal fade" id="modal_order_cancel" tabindex="-1" role="dialog" aria-labelledby="modal_order_cancel_label" aria-hidden="true">
    {{-- <form action="{{ $action }}" method="{{ $method }}" class="needs-validation" novalidate id="form_order_cancel"> --}}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_order_cancel_label">Cancel Order #<span ></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_order_cancel_body">
                    <div class="col-12">
                        <textarea placeholder="กรุณาระบุเหตุผล" id="order_cancel" name="order_cancel" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger sm_order_cancel">Cancel Order</button>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
<!-- end modal_order_cancel -->
<script src="<?php echo url('assets/modal/order_cancel.js');?>"></script>