<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gohala - ข้อมูลผู้ใช้</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="<?php echo url('assets/manage/login/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/style.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/js/plugins/sweetalert2/sweetalert2.min.css');?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/js/plugins/toastr/toastr.min.css');?>">
        <style>
            *{
                font-family: 'Kanit';
            }
            .flatpickr{
                background-color: #e9ecef;
            }
            .table td{
                /* word-break: break-word; */
            }
        </style>
    </head>

    <body>
        <input type="hidden" id="url" value="{{ $url }}">
        <input type="hidden" id="url_current" value="{{ $url }}">
        <input type="hidden" id="notify_type" value="">
        <input type="hidden" id="master_order_id" value="">
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
                        <!-- End Logo container-->

                        <div class="menu-extras topbar-custom">

                            <ul class="navbar-right list-inline float-right mb-0">

                                @include('account.notify')
                                <li class="dropdown notification-list list-inline-item">
                                    <div class="dropdown notification-list nav-pro-img">
                                        <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <img src="<?php echo \Auth::user()->get_photo();?>" alt="user" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                            <!-- item-->
                                     
                                            <a class="dropdown-item" href="<?php echo \LKS::url_subdomain('manage','shops');?>"><i class="mdi mdi-wallet"></i> ร้านของฉัน</a>
                                           
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="<?php echo url('logout');?>"><i class="mdi mdi-power text-danger"></i> ออกจากระบบ</a>
                                        </div>
                                    </div>
                                </li>
            
                            </ul>
                        </div>
                        <!-- end menu-extras -->

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
                                    <h4 class="page-title"><?php echo __('view.profile');?></h4>        
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
                        <?php
                            $button = '<a href="'.LKS::url_subdomain('manage','shops').'" class="btn btn-sm btn-primary">ร้านค้า</a>';
                            if($shop_count<1) 
                            {
                                echo "คุณยังไม่มีร้านใดๆ เริ่มสร้าง ".$button." ได้เลย";
                            }  
                            else
                            {
                                echo "ไปที่ ".$button." ของคุณ";
                            }
                        ?>
                        
                    </div>
                </div>  
               <div class="row">
                   <div class="col-md-4">
                       <div class="card directory-card">
                            <div class="card-body">
                                <div class="float-left mr-4">
                                    {{-- {{dd(\Auth::user()->get_photo())}} --}}
                                    <img src="<?php echo \Auth::user()->get_photo();?>" alt="" class="img-fluid img-thumbnail rounded-circle thumb-lg">
                                      <br>
                                      <form action="<?php echo url('profile/update/profile_image');?>" method="post" enctype="multipart/form-data">
                                      <?php echo csrf_field();?>
                                      <input type="file" name="profile_image" id="profile_image" style="display:none">
                                      </form>
                                      <button type="button" id="change_profile_image" class="btn btn-sm btn-primary" style="margin-left:10px">เปลี่ยนรูป</button>
                                </div>
                                <ul class="list-unstyled social-links float-right">
                                    <?php if($user->facebook!=""):?>
                                    <li><a href="http://facebook.com/<?php echo $user->facebook;?>" class="btn-primary"><i class="mdi mdi-facebook"></i></a></li>
                                    <?php endif;?>
                                </ul>
                                <h5 class="text-primary font-18 mt-0 mb-1"><?php echo $user->name;?></h5>
                                <p class="font-12 mb-2">เป็นสมาชิกเมื่อ: <?php echo date('d/m/Y H:i:s',strtotime($user->created_at));?></p>
                                <p class="mb-4"><?php echo $user->email.($user->is_verify_email==1?' (ยืนยันเรียบร้อย)':'');?></p>
                                <div class="clearfix"></div>
                                <hr>
                                <?php if($user->is_verify_email==0):?>
                             <a type="button" href="<?php echo url('/send/email/verify');?>" class="btn btn-block btn-success waves-effect waves-light">ยืนยันตัวตน</a>
                             <?php endif;?>
                            </div>
                            
                        </div>
                   </div>
                   <div class="col-md-8">
                       <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs " role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link <?=($op != "myorder")?'active':null?>" data-toggle="tab" href="#profile" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo __('view.profile');?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#address" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo __('view.address_delivery');?></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link myorder <?=($op == "myorder")?'active':null?>" data-toggle="tab" href="#order" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block"><?php echo __('view.order_list');?></span>   
                                                </a>
                                            </li>
                                        </ul>
        
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane p-3 <?=($op != "myorder")?'active':null?>" id="profile" role="tabpanel">
                                                <form method="post" action="<?php echo url('profile/save');?>">
                                                    <?php echo csrf_field();?>
                                                    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
                                                    <h5 class="text-primary"><?php echo __('view.user_info');?></h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.fullname');?> <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" class="form-control" value="<?php echo (old('name')?old('name'):$user->name);?>">
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.email');?> <span class="text-danger">*</span></label>
                                                                <input type="text" name="email" class="form-control" value="<?php echo (old('email')?old('email'):$user->email);?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary"><?php echo __('view.contact_info');?></h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.phone');?> </label>
                                                                <input type="text"  name="phone" class="form-control" value="<?php echo (old('phone')?old('phone'): $user->phone);?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.line');?> </label>
                                                                <input type="text" name="line" class="form-control" value="<?php echo (old('line')?old('line'): $user->line);?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                           <div class="form-group">
                                                                <label class="control-label"><?php echo __('view.facebook');?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon input-group-prepend">
                                                                        <span class="input-group-text">facebook.com/</span>
                                                                    </span>
                                                                    <input type="text" value="<?php echo (old('facebook')?old('facebook'): $user->facebook);?>" name="facebook" class="form-control">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary"><?php echo __('view.password_info')?></h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.password');?> <span class="text-sm text-danger"><?php echo __('view.empty_if_dont_change');?></span> </label>
                                                                <input type="password" name="password" class="form-control" >
                                                            </div>
                                                           
                                                        </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo __('view.password_confirm');?> </label>
                                                                <input type="password" name="password_confirm" class="form-control" >
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-block btn-primary">บันทึกข้อมูล</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane p-3" id="address" role="tabpanel">
                                            
                                                    <?php foreach($address as $index=>$addr):?>
                                                    <div user_address_id="<?php echo $addr->id;?>" class="card card_user_address p-10" style="border:1px solid #bdbcbc">
                                                        <div class="card-body m-b-0">
                                                            <div class="address_action float-right text-center">
                                                            <?php
                                                            $addr_class = 'btn-outline-success';
                                                            if($addr->is_default == 1)
                                                            {
                                                                $addr_class = 'btn-success';
                                                            }
                                                            ?>
                                                                <button address_id="{{ $addr->id }}" address_default="{{ $addr->is_default }}" type="button" style="margin-bottom:5px" class="btn btn-sm  waves-effect waves-light {{ $addr_class }} default_addr"><i class="fas fa-check"></i> ที่อยู่หลัก</button>
                                                                <br>
                                                                <button type="button" class="btn btn-sm btn-outline-danger delete_user_address"><i class="far fa-trash-alt"></i> ลบ</button>
                                                                <button type="button" class="btn btn-sm btn-outline-info edit_user_address"><i class="far fa-edit"></i> แก้ไข</button>
                                                            </div>
                                                            <?php echo $addr->name_address;?>
                                                            <h6 style="margin-bottom:0px"><?php echo $addr->address.' '.$addr->province->name,' ',$addr->zipcode;?></h6>
                                                            <span class="text-muted" style="margin-bottom:0px"><i class="fas fa-user-tag"></i> <?php echo $addr->name_contact.' ,'.$addr->phone;?></span>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php endforeach;?>
                                                   <button type="button" id="add_new_address_btn" class="btn btn-primary">+ <?php echo __('view.address');?></button>
                                                
                                            </div>
                                            <div class="tab-pane p-3 <?=($op == "myorder")?'active':null?>" id="order" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12" style="overflow-x:auto;">
                                                        <table class="table table-hover w-100" id="table_order" remote_url="{{ $url.'/user_order_datatables' }}">
                                                            <thead>
                                                                <tr>
                                                                    <th width="15%">{{ __('view.order_id') }}</th>
                                                                    <th width="20%">{{ __('view.order_date') }}</th>
                                                                    <th width="20%">ชื่อร้าน</th>
                                                                    <th width="15%">{{ __('view.total') }}</th>
                                                                    <th width="15%">{{ __('view.status') }}</th>
                                                                    <th ></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                        
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                   
                                        </div>
        
                                    </div>
                                </div>
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
        <script src="<?php echo url('assets/js/plugins/sweetalert2/sweetalert2.all.min.js');?>"></script>
        <script src="<?php echo url('assets/js/lks.js');?>"></script>
        <script src="<?php echo url('assets/js/Met.js');?>"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>
        <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>

        {{-- ห้ามสลับ --}}
        @include('modal.master_user')
        @include('pusher')
        <script src="<?php echo url('assets/account/js/account.js');?>"></script> 
        <script>
            $(document).ready(function(){
                // setInterval(function(){ table_order.ajax.reload(null,false); }, 5000);
                table_order_datatables();
                notify();
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                window.location.reload();
            };

            function table_order_datatables()
            {
                return $('#table_order').DataTable(
                {
                    serverSide: true,
                    processing: false,
                    destroy: true,
                    // retrieve: true,
                    // order: [[ 1, "asc" ]],
                    search: {
                        search: $("#master_order_id").val()
                    },
                    ajax: {
                        url: $('#table_order').attr('remote_url'),
                        data: {},
                    },
                    columns: [
                        { data: 'id', name: 'id', class: 'text-center' },
                        { data: 'order_date', name: 'order_date', class: 'text-center' },
                        { data: 'shop_name', name: 'shop_name', class: 'text-center',"orderable": false, "searchable": false },
                        { data: 'get_sold_price', name: 'get_sold_price', class: 'text-center',"orderable": false, "searchable": false },
                        { data: 'status', name: 'status', class: 'text-center',"orderable": false, "searchable": false },
                        { data: 'action', name: 'action', class: 'text-center',"orderable": false, "searchable": false },
                    ],
                    createdRow: function( row, data, dataIndex ) {
                        var td_length = $('td',row).length-1;
                        $.each($('td',row),function(index){
                            if(index != td_length)
                            {
                                // $(this).attr('id', 'data');
                                $(this).addClass('order_detail');
                                $(this).attr('style','cursor: context-menu;');
                            }
                            $(this).attr('order_id',data.id);
                            // console.log(td_length);
                        });
                        // console.log(data);
                    },
                    initComplete: function(settingss,json){
                        // console.log( 'initComplete' );
                        var order_id = $("#master_order_id").val();
                        var td = $(this).find('td.order_detail.sorting_1');
                        td.each(function(){
                            if($(this).attr('order_id') == order_id)
                            {
                                // console.log(this);
                                if($("#notify_type").val() == 'order')
                                {
                                    $(this).click();
                                }
                                else if($("#notify_type").val() == 'payment')
                                {
                                    $(this).closest('tr').find('.btn_order_payment_view').click();
                                }
                                $("#notify_type").val('');
                            }
                        });
                    },
                });
            }

            function get_url()
            {
                var url = location.origin;
                return url;
            }
            function notify()
            {
                var url = get_url()+'/notify_bar';
                var obj = new Object();
                obj._token = $('meta[name=csrf-token]').attr('content');

                // console.log(url);
                // console.log(obj);
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: obj,
                    success: function(res){
                        // console.log(res);
                        if(res.result == 1)
                        {
                            $('.notify_unread_element').html(res.notify_unread_element);
                            $('.notify_unread_global').html(res.notify_unread_global);
                            $('.notify_all_element').html(res.notify_all_element);
                            if(res.notify_unread_global > 0)
                                $(".notify_unread_global").fadeIn();
                            if(res.notify_unread_global < 1)
                            {
                                $(".notify_unread_global").fadeOut();
                            }
                            if(res.notify_unread_element > 0)
                            {
                                var icon = [ '',
                                '<div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>',
                                '<div class="notify-icon bg-info"><i class="mdi mdi-cash-multiple"></i></div>',
                                '<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>',
                                ];
                                var append = '<!-- item-->';
                                $.each(res.notify, function(key,value){
                                    // console.log(key);
                                    // console.log(value);
                                    var unread = '';
                                    var font_weight = ' style="font-weight: 400" ';
                                    var event_name = res.event_name[value.event_id];
                                    if(value.user_is_read == 0)
                                    {
                                        unread = '<span class="notify-unread"></span>';
                                        font_weight = ' style="font-weight: 600" ';
                                    }
                                    if(res.from_shop == 1)
                                    {
                                        event_name += ' <span style="font-size:12px">ร้าน '+value.shop_name+'</span>';
                                    }
                                    append += 
                                    '<a href="javascript:void(0);" class="dropdown-item notify-item" order_id="'+value.order_id+'" shop_url="'+value.shop_url+'" event_id="'+value.event_id+'">'
                                        + icon[value.event_id]
                                        + '<p class="notify-details"'+ font_weight +'>' +event_name
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

            $(document).on('shown.bs.dropdown','.notify',function(e){ 
                    var url = get_url()+'/notify_update_global';
                    var obj = new Object();
                    obj._token = $('meta[name=csrf-token]').attr('content');
                    // console.log(obj);
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: obj,
                        success: function(res){
                            // console.log(res);
                            if(res.result == 1)
                            {
                                notify();
                            }
                        }
                    });
            }); // เมื่อคลิกกระดิ่งให้เปลี่ยนเป็นอ่านให้หมด

            $(document).on('click','.notify-item',function(){ // เปลี่ยนแต่คลิกแต่ละออเดอร์เป็นอ่านแล้ว
                var order_id = $(this).attr('order_id');
                var event_id = $(this).attr('event_id');
                var shop_url = $(this).attr('shop_url');
                var url = get_url()+'/notify_read';
                // console.log(url);
                var obj = new Object();
                obj._token = $('meta[name=csrf-token]').attr('content');
                obj.order_id = order_id;
                obj.event_id = event_id;
                // console.log(obj);
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: obj,
                    success: function(res){
                        // console.log(res);
                        if(res.result == 1)
                        {
                            // console.log(res);
                            $("ul.nav.nav-tabs a.nav-link.myorder").click();
                            var notify_type = '';
                            if(res.notify.event_id == 1)
                            {
                                notify_type = 'order';
                            }
                            else if(res.notify.event_id == 2)
                            {
                                notify_type = 'payment';
                            }
                            $("#notify_type").val(notify_type);
                            $("#master_order_id").val(res.notify.order_id);
                            table_order_datatables();
                        }
                    }
                });
            });
        </script>
    </body>

</html>