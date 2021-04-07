<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Gohala - [Admin]ระบบจัดการหลังร้าน</title>
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
                <div class="topbar-left">
                    <a href="{{ LKS::url_subdomain('','') }}" class="logo">
                        <span>
                                <img src="<?php echo url('assets/images/logo.png');?>" alt="" height="50">
                            </span>
                        <i>
                                <img src="<?php echo url('assets/images/logo-sm.png');?>" alt="" height="22">
                            </i>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <ul class="navbar-right list-inline float-right mb-0">
                      
                        <!-- full screen -->
                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                <i class="mdi mdi-fullscreen noti-icon"></i>
                            </a>
                        </li>

                     

                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?php echo Auth::user()?Auth::user()->get_photo():url('assets/images/no_user.png');?>" alt="user" class="rounded-circle">
                                  
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="<?php echo \LKS::url_subdomain('admin','profile');?>"><i class="mdi mdi-account-circle m-r-5"></i> ข้อมูลของฉัน</a>
                                   
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="<?php echo \LKS::url_subdomain('admin','logout');?>"><i class="mdi mdi-power text-danger"></i> ออกจากระบบ</a>
                                </div>
                            </div>
                        </li>

                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->
            @include('admin.sidebar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
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

                <footer class="footer">
                    © 2019 Gohala.com 
                </footer>

            </div>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
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
        <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>

        @yield('js')
        
    </body>

</html>