
<!-- modal_order_detail -->
<div class="modal fade" id="modal_order_detail" tabindex="-1" role="dialog" aria-labelledby="modal_order_detail_label" aria-hidden="true">
    {{-- <form action="{{ $action }}" method="{{ $method }}" class="needs-validation" novalidate id="form_order_detail"> --}}
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_order_detail_label">Custom Header</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row modal_order_detail_body" id="modal_order_detail_body">
                    <div class="col-8">
                        <table class="table table-hover w-100 bg-light" id="table_order_detail" remote_url="">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อ</th>
                                    <th>ราคา</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span class="btn_primary"></span>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ปิด</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
<!-- end modal_order_detail -->
<script src="<?php echo url('assets/modal/order_detail.js');?>"></script>