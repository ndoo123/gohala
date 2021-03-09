<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <title>Gohala - Privacy</title>
        <link rel="shortcut icon" href="<?php echo url('assets/manage/images/favicon.ico');?>">

        <link href="<?php echo url('assets/manage/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/metismenu.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/js/plugins/bootstraptoggle/bootstrap-toggle.css');?>" rel="stylesheet">
        @yield('css')
        <link href="<?php echo url('assets/manage/css/style.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/vertical.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/custom.css');?>" rel="stylesheet" type="text/css">

        <link href="<?php echo url('');?>/assets/web/css/custom.css" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/js/plugins/toastr/toastr.min.css');?>">

        <link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
        <style>
            *{
                font-family: 'Kanit';
            }
            .flatpickr{
                background-color: #e9ecef;
            }
            #sidebar-menu ul li a{
                font-family: 'Kanit';
            }
        </style>
        <?php

        $url = url('');
        $arr_url = explode('.',$url);
        $extend = end($arr_url);
        // dd($url,$arr_url,$extend);
        if($extend == 'com')
        {
            echo '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">';
        }
        ?>
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <nav style="background-color:#ffffff" class="text-center">
                    <a href="{{ env('APP_URL') }}"><img src="<?php echo url('assets/images/logo-dark.png');?>" alt="" height="50"></a>

                </nav>

            </div>
            <!-- Top Bar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page" style="margin: 0px 100px">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                          <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-12">
                                    <h4 class="page-title">@yield('title')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @yield('content')

                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <footer class="footer" style="left:0px">
            © 2019 Gohala.com 
        </footer>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="<?php echo url('assets/manage/js/jquery.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/metisMenu.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/waves.min.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/bootstraptoggle/bootstrap-toggle.min.js');?>"></script>
        <!-- App js -->
        <script src="<?php echo url('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/app.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/blockUI.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/currency.min.js');?>"></script>
        <script src="<?php echo url('assets/js/lks.js');?>"></script>
        <script src="<?php echo url('assets/js/Met.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

        <script>
        var app=new LKS();
        app.url='<?php echo (isset($shop)?url($shop->url):url(''));?>';
        
        </script>

        @yield('js')
        
    </body>

</html>