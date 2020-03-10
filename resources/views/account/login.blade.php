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

    </head>

    <body class="pb-0">

        <div class="home-btn d-none d-sm-block">
            <a href="<?php echo env('APP_URL');?>" class="text-white"><i class="fas fa-home h2"></i></a>
        </div>
        
        <!-- Begin page -->
        <div class="accountbg"></div>

        <div class="wrapper-page account-page-full">

            <div class="card p-b-0" style="margin-bottom:0px">
                <div class="card-body p-b-0 " style="padding-bottom:0" >

                    <div class="text-center">
                        <a href="<?php echo env('APP_URL');?>" class="logo"><img src="assets/images/logo-dark.png" height="55" alt="logo"></a>
                    </div>

                    <div class="p-3 p-b-0">
                        <h4 class="font-18 m-b-5 text-center"><?php echo __('view.welcome');?></h4>
                        <p class="text-muted text-center"><?php echo __('view.welcome_sub');?></p>
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
                                        <a href="pages-recoverpw-2.html"><i class="mdi mdi-lock"></i> <?php echo __('view.forgot_password');?></a>
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
                    </div>
                    <div class="m-t-0 text-center">
                
                        <p>© 2019 Gohala.com
                    </div>
                </div>
                  

            </div>

          
        </div>
        <!-- end wrapper-page -->


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