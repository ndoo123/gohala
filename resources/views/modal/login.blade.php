<!-- modal_login -->

<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modal_login_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color : transparent;display:block">
            <div id="sign-in-dialog" class="zoom-anim-dialog">
				<div class="modal_header">
					<h3>Sign In</h3>
				</div>
                <form id="login_form" class="form-horizontal m-t-10" method="post" action="<?php echo LKS::url_subdomain('account','auth');?>">
                {{-- {{ csrf_field() }} --}}
					<div class="sign-in-wrapper">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<a href="#0" class="social_bt facebook">Login with Facebook</a>
						{{-- <a href="#0" class="social_bt google">Login with Google</a> --}}
						<div class="divider"><span>Or</span></div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" id="email" required>
							<i class="ti-email"></i>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" id="password" value="" required>
							<i class="ti-lock"></i>
						</div>
						<div class="clearfix add_bottom_15">
							<div class="checkboxes float-left">
								<label class="container_check">Remember me
								<input type="checkbox">
								<span class="checkmark"></span>
								</label>
							</div>
							<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
						</div>
						<div class="text-center">
							<input type="submit" value="Log In" class="btn_1 full-width">
							Don’t have an account? <a href="account.html">Sign up</a>
						</div>
						<div id="forgot_pw">
							<div class="form-group">
								<label>Please confirm login email below</label>
								<input type="email" class="form-control" name="email_forgot" id="email_forgot">
								<i class="ti-email"></i>
							</div>
							<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
							<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
						</div>
					</div>
				</form>
			<button title="Close (Esc)" type="button" class="mfp-close" data-dismiss="modal"></button></div>
        </div>
    </div>
</div>
<!-- end modal_login -->
<div class="modal fade" id="forgot_pass_modal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">ลืมรหัสผ่าน</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group input_email">
                <label for="register_email">ระบุ Email ที่ได้ทำการลงทะเบียนไว้</label>
                <input type="text" class="form-control register_email" placeholder="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="reset_password_btn" class="btn_1 full-width">Reset รหัสผ่าน</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </div>
    </div>
</div>
<script>
$(document).on('click','.btn_login',function(){
    $("#modal_login").modal('show');
});
$(document).on('submit',"#login_form",function(e){
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    // var obj = form.serialize();
    var obj = new Object();
    obj._token = "{{ csrf_token() }}";
    // obj._token = form.find("input[name=_token]").val();
    obj.email = form.find("input[name=email]").val();
    obj.password = form.find("input[name=password]").val();
    console.log(obj);
    // console.log($('meta[name="csrf-token"]').attr('content'));
    // Load('#modal_login',true);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'jsonp',
        data: obj,
        contentType: false,
        // contentType: 'application/json; charset=utf-8',
        crossDomain: true,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res){
            console.log(res);
            
        }
    });
});
$(document).on('click','#forgot',function(){
    $("#forgot_pass_modal").modal('show');
});
</script>