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
                        <!-- End Logo container-->

                        <div class="menu-extras topbar-custom">

                            <ul class="navbar-right list-inline float-right mb-0">
        
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
                                                <a class="nav-link <?=($op == "myorder")?'active':null?>" data-toggle="tab" href="#order" role="tab">
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
                                                                <div class="input-group"><span class="input-group-addon input-group-prepend"><span class="input-group-text">facebook.com/</span></span><input type="text" value="<?php echo (old('facebook')?old('facebook'): $user->facebook);?>" name="facebook" class="form-control"></div>
                                                                
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
                                                <table class="table table-hover" id="order_table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>วันที่สั่งซื้อ</th>
                                                        <th>ยอดรวม</th>
                                                        <th>สถานะ</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($orders as $order):?>
                                                        <tr>
                                                            <td class="order_detail" order_id="{{ $order->id }}"><?php echo $order->id;?></td>
                                                            <td class="order_detail" order_id="{{ $order->id }}"><?php echo date('d/m/Y H:i:s',strtotime($order->order_date));?></td>
                                                            <td class="order_detail" order_id="{{ $order->id }}"><?php echo number_format($order->total+$order->total_delivery,2);?></td>
                                                            <td class="order_detail" order_id="{{ $order->id }}"><?php echo $order->get_status_show();?></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
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

<div id="new_address_modal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="new_address_modal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="address_info_form" method="post" action="<?php echo url('profile/address/update');?>">
            <?php echo csrf_field();?>
            <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
            <input type="hidden" name="address_id" class="input_address" value="">
            <div class="modal-header">
                <h5 class="modal-title mt-0">ข้อมูลที่อยู่</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo __('view.contact_name');?> <span class="text-danger">*</span></label>
                            <input type="text" name="contact_name" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <label><?php echo __('view.address_name');?> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control input_address" value="">
                        </div>
                       
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.contact_phone');?> <span class="text-danger">*</span></label>
                            <input type="text" name="contact_phone" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo __('view.address');?> <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control input_address" value="">
                        </div>
                    </div>
                      
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.province');?> <span class="text-danger">*</span></label>
                            <select name="province" class="form-control select_address">
                                <?php foreach($provinces as $province):?>
                                <option value="<?php echo $province->id;?>"><?php echo $province->name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo __('view.zipcode');?> <span class="text-danger">*</span></label>
                            <input type="text" name="zipcode" class="form-control input_address" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                <button type="button" id="save_address_btn" class="btn btn-primary waves-effect waves-light">บันทึกที่อยู่</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@include('modal.order_detail')
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
        <script src="<?php echo url('assets/js/plugins/datatable/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo url('assets/account/js/account.js');?>"></script>
        <script src="<?php echo url('assets/modal/order_detail.js');?>"></script>
        <script>
            $("#order_table").DataTable({
                order: [[1, 'desc']],
                "columnDefs": [
                { "type": "date-de", targets: 1 }
                ],
            });
        </script>
    </body>

</html>