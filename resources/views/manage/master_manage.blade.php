<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Gohala - ระบบจัดการหลังร้าน</title>
        <link rel="shortcut icon" href="<?php echo url('assets/manage/images/favicon.ico');?>">

        <link href="<?php echo url('assets/manage/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/metismenu.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/js/plugins/bootstraptoggle/bootstrap-toggle.css');?>" rel="stylesheet">
        @yield('css')
        <link href="<?php echo url('assets/manage/css/style.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/vertical.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/css/custom.css');?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/js/plugins/toastr/toastr.min.css');?>">

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
            <?php if(isset($shop)):?>
            <input type="hidden" id="shop_url" value="<?php echo $shop->url;?>">
            <?php endif;?>
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
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

                        <!-- notification -->
                        <li class="dropdown notification-list list-inline-item">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                <span class="badge badge-pill badge-danger noti-icon-badge">
                                    3
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text">
                                    Notifications (258)
                                </h6>
                                <div class="slimscroll notification-item-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                </div>
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                        View all <i class="fi-arrow-right"></i>
                                    </a>
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ Auth::user()->get_photo() }}" alt="user" class="rounded-circle">
                                    {{-- <img src="{{ !empty($shop)?$shop->get_photo():(\Auth::user()->get_photo()?\Auth::user()->get_photo():null) }}" alt="user" class="rounded-circle"> --}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="<?php echo \LKS::url_subdomain('account','profile');?>"><i class="mdi mdi-account-circle m-r-5"></i> ข้อมูลของฉัน</a>
                                    <a class="dropdown-item" href="<?php echo \LKS::url_subdomain('manage','shops');?>"><i class="mdi mdi-wallet m-r-5"></i> ร้านค้าของฉัน</a>
                                
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="<?php echo \LKS::url_subdomain('account','logout');?>"><i class="mdi mdi-power text-danger"></i> ออกจากระบบ</a>
                                </div>
                            </div>
                        </li>

                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->
            <?php if(isset($shop)):?>
            @include('manage.sidebar_shop_manage')
            <?php else:?>
            @include('manage.sidebar')
            <?php endif;?>

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

        <script src="<?php echo url('');?>/assets/web/js/plugins/toastr/toastr.min.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo (isset($shop)?url($shop->url):url(''));?>';
        </script>
        @yield('js')

        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                // alert(JSON.stringify(data));
                toastr.info(data.msg + ' ' + data.type);
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                window.location.reload();
            };
        </script>
    </body>

</html>