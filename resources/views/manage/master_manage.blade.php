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
            <input type="hidden" id="manage_url" value="{{ LKS::url_subdomain('manage','') }}">
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

                        @include('notify')

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
        <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

        <script src="<?php echo url('');?>/assets/web/js/plugins/toastr/toastr.min.js"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo (isset($shop)?url($shop->url):url(''));?>';
        

        notify();
        function notify()
        {
            if($("#shop_url").val() !== undefined)
            {
                var base_url = location.origin+'/'+$("#shop_url").val();
                var url = base_url+'/notify_bar';
                // console.log(url);
                var obj = new Object();
                obj._token = $('meta[name=csrf-token]').attr('content');
                // console.log(obj);
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: obj,
                    success: function(res){
                        console.log(res);
                        if(res.result == 1)
                        {
                            $(".notify_unread_global").fadeIn();
                            $('.notify_unread_element').html(res.notify_unread_element);
                            $('.notify_unread_global').html(res.notify_unread_global);
                            if(res.notify_unread_global < 1)
                            {
                                $(".notify_unread_global").fadeOut();
                            }
                            if(res.notify_unread_element > 0)
                            {
                                var icon = [ '',
                                '<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>',
                                '<div class="notify-icon bg-info"><i class="mdi mdi-cash-multiple"></i></div>',];
                                var append = '<!-- item-->';
                                $.each(res.notify, function(key,value){
                                    // console.log(key);
                                    // console.log(value);
                                    var unread = '';
                                    var font_weight = ' style="font-weight: 400" ';
                                    if(value.is_read == 0)
                                    {
                                        unread = '<span class="notify-unread"></span>';
                                        font_weight = ' style="font-weight: 600" ';
                                    }
                                    append += 
                                    '<a href="javascript:void(0);" class="dropdown-item notify-item" order_id="'+value.order_id+'" shop_url="'+res.shop_url+'" >'
                                        + icon[value.event_id]
                                        + '<p class="notify-details"'+ font_weight +'>' +res.event_name[value.event_id]
                                            + unread
                                            + '<span class="text-muted">'+ value.info +'</span>'
                                            + '<span class="text-info">'+ value.created_show +'</span>'
                                        + '</p>'
                                    + '</a>';
                                });
                                
                                $('.notify_body').css('height','auto').html(append);
                            }
                            else
                            {
                                $('.notify_body').css('height','auto').html('<span class="text-center d-block">ยังไม่มีการแจ้งเตือน</span>');
                            }
                        }
                    }
                });
            }
            else
            {
                $(".dropdown.notification-list.list-inline-item.notify").fadeOut();
            }
        }
        $(document).on('shown.bs.dropdown','.notify',function(e){ 
            // e.preventDefault();
            var base_url = location.origin+'/'+$("#shop_url").val();
            var url = baseurl+'/notify_update_global';
            var obj = new Object();
            obj._token = $('meta[name=csrf-token]').attr('content');
            // console.log(obj);
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: obj,
                success: function(res){
                    console.log(res);
                    if(res.result == 1)
                    {
                        notify();
                    }
                }
            });
        }); // เมื่อคลิกกระดิ่งให้เปลี่ยนเป็นอ่านให้หมด

        $(document).on('click','.notify-item',function(){ // เปลี่ยนแต่คลิกแต่ละออเดอร์เป็นอ่านแล้ว
            var order_id = $(this).attr('order_id');
            var shop_url = $(this).attr('shop_url');
            var base_url = location.origin+'/'+$("#shop_url").val();
            var url = base_url+'/notify_read';
            console.log(url);
            var obj = new Object();
            obj._token = $('meta[name=csrf-token]').attr('content');
            obj.order_id = order_id;
            console.log(obj);
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: obj,
                success: function(res){
                    console.log(res);
                    if(res.result == 1)
                    {
                        var go_location = $("#manage_url").val()+'/'+shop_url+'/order?';
                        if(res.notify.event_id == 1)
                        {
                            go_location += 'order_id='+res.notify.order_id;
                        }
                        else if(res.notify.event_id == 2)
                        {
                            go_location += 'payment_id='+res.notify.order_id;
                        }
                        window.location.href = go_location;
                    }
                }
            });
        });

        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
            window.location.reload();
        };
        </script>
        @include('pusher')

        @yield('js')
        
    </body>

</html>