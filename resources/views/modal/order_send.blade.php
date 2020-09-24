<!-- modal_order_send -->
<div class="modal fade" id="modal_order_send" tabindex="-1" role="dialog" aria-labelledby="modal_order_send_label" aria-hidden="true">
    {{-- <form action="{{ $action }}" method="{{ $method }}" class="needs-validation" novalidate id="form_order_send"> --}}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_order_send_label">Trace Order #<span ></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_order_send_body">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="order_send">ระบุรหัส</label>
                            <input type="text" name="order_send" id="order_send" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sm_order_send">Save</button>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
<!-- end modal_order_send -->
<script src="<?php echo url('assets/modal/order_send.js');?>"></script>