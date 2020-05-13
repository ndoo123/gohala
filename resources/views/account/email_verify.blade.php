<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gohala - ยืนยันอีเมล์</title>
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="<?php echo url('assets/manage/login/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/style.css');?>" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav" style="background-color:white">
                <div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo container-->
                        <div class="logo">
                            <a href="<?php echo env('APP_URL');?>" class="logo">
                                <img src="<?php echo url('assets/images/logo-dark.png');?>" alt="" height="35">
                            </a>
                          
                        </div>


                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

            </header>
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <h4 class="page-title">ยืนยัน Email</h4>        
                                </div>
                            </div> <!-- end row-->
                        </div>
                        <!-- end page title -->
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>
        </div>
        <!-- end header-bg -->
        
        <!-- page wrapper start -->
        <div class="wrapper">
            <div class="container-fluid">
                <?php LKS::has_alert();?>
                
                <div class="card">
                    <div class="card-body">
                        <?php echo session('email');?>
                    </div>
                </div>  
            
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->


        


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        2019 © Gohala
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="<?php echo url('assets/manage/login/js/jquery.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/login/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/login/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo url('assets/manage/login/js/waves.min.js');?>"></script>
         <script src="<?php echo url('assets/js/plugins/blockUI.js');?>"></script>
        <!-- App js -->
         <script src="<?php echo url('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/login/js/app.js');?>"></script>
        <script src="<?php echo url('assets/js/lks.js');?>"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>
        <script src="<?php echo url('assets/account/js/account.js');?>"></script>
    </body>

</html>