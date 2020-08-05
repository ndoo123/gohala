<!DOCTYPE html>
<html lang="th">

   <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gohala - เข้าสู่ระบบ</title>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="<?php echo url('assets/manage/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/account/css/style.css');?>" rel="stylesheet" type="text/css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="pb-0">
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '151912162083124',
                cookie     : true,
                xfbml      : true,
                version    : 'v8.0'
                });
                
                FB.AppEvents.logPageView();   
                
            };
              (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="home-btn d-none d-sm-block">
            <a href="<?php echo env('APP_URL');?>" class="text-white"><i class="fas fa-home h2"></i></a>
        </div>
        
        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>

        <div class="wrapper-page account-page-full">

            <div class="card p-b-0" style="margin-bottom:0px">
                <div class="card-body p-b-0 " style="padding-bottom:0" >

                    <div class="text-center">
                        <a href="<?php echo env('APP_URL');?>" class="logo"><img src="assets/images/logo-dark.png" height="55" alt="logo"></a>
                    </div>

                    <div class="p-3 p-b-0">
                       
                             {{-- <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="">FF</div> --}}
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#login" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block"><?php echo __('view.login');?></span> 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#register" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block"><?php echo __('view.register');?></span> 
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <?php LKS::has_alert();?>
                            <div class="tab-pane active p-3" id="login" role="tabpanel">
                                <form id="login_form" class="form-horizontal m-t-10" method="post" action="<?php echo url('auth');?>">
                                   <?php if(session('redirect')):?>
                                <input type="hidden" name="redirect" value="<?php echo session('redirect');?>">
                                <?php endif;?>
                                <?php echo csrf_field();?>
                                    <div class="form-group">
                                        <label for="username"><?php echo __('view.email');?> </label>
                                        <input type="text" class="form-control" name="email" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword"><?php echo __('view.password');?></label>
                                        <input type="password" class="form-control" name="password" placeholder="">
                                    </div>

                                    <div class="form-group row m-t-20">
                                        <div class="col-sm-6 p-t-10">
                                        <a data-toggle="modal" data-target="#forgot_pass_modal" href="javascript:;"><i class="mdi mdi-lock"></i> <?php echo __('view.forgot_password');?></a>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit"><?php echo __('view.login');?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane p-3 p-b-0" id="register" role="tabpanel">
                                <form id="register_form" class="form-horizontal m-t-10" method="post" action="<?php echo url('register');?>">
                                <?php if(session('redirect')):?>
                                <input type="hidden" name="redirect" value="<?php echo session('redirect');?>">
                                <?php endif;?>
                                <?php echo csrf_field();?>
                                     <div class="form-group">
                                        <label for="username"><?php echo __('view.fullname');?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="username"><?php echo __('view.email');?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" placeholder="">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="userpassword"><?php echo __('view.password');?> <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword"><?php echo __('view.password_confirm');?> <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirm" placeholder="">
                                    </div>

                                    <div class="form-group row m-t-0">
                                        <div class="col-sm-6 p-t-0">
                                       
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">ลงทะเบียน</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                             {{-- <div class="fb-login-button" onlogin="checkLoginState()" data-size="medium" data-button-type="login_with" data-layout="default"  data-width="">BB</div> --}}
                             {{-- <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width="">FF</div> --}}
                             {{-- <button onclick="checkLoginState();">Login with Facebook</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="m-t-0 text-center">
                
                        <p>© 2019 Gohala.com
                    </div>
                </div>
                  

            </div>

          
        </div>
        <!-- end wrapper-page -->

        <div class="modal" id="forgot_pass_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ลืมรหัสผ่าน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_email">
                            <label for="register_email">ระบุ Email ที่ได้ทำการลงทะเบียนไว้</label>
                            <input type="text" class="form-control register_email"  placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="reset_password_btn" class="btn btn-primary">Reset รหัสผ่าน</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
       <!-- jQuery  -->
        <script src="<?php echo url('assets/manage/js/jquery.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/waves.min.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/blockUI.js');?>"></script>
        <!-- App js -->
      <script src="<?php echo url('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
        <script src="<?php echo url('assets/js/lks.js');?>"></script>
       
        <script src="<?php echo url('assets/account/js/account.js');?>"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>
        
    </body>

</html>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v8.0&appId=151912162083124&autoLogAppEvents=1" nonce="0UV7apiD"></script>
<script>


function checkLoginState() {
    console.log(123);
    
  FB.getLoginStatus(function(response) {
      console.log(response);
      if(response.status=="connected")
      {
          var uid=response.authResponse.userID;
          var accessToken=response.authResponse.accessToken;
        
         
        FB.api('/'+uid+"?fields=name,email", function(response) {
          
           
            Load('div.accountbg',true)
            var obj=new Object();
            obj.fb_login=1;
            obj.fb_id=uid;
            obj.name=response.name;
            obj.email=response.email;
            var post=new JPost();
            post.url='<?php echo url('auth/facebook');?>';
            post.success=function(r){
                if(r.result==0)
                {
                    alert(r.msg);
                    return;
                }
                location.reload(); 
            }
            post.send(obj);
            
        });
      }
 
  });
}
</script>