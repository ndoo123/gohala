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

        <style>
            .container-fluid {
                padding-right: 0px;
                padding-left: 0px;
            }
            .wrapper {
                padding-top: 150px;
            }
            .pos-rl {
                padding: 4px;
            }
            .pos-top1 {
                margin-top: -30px;
            }


        </style>
    </head>

    <body>

        <div class="header-bg">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 pos-rl">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">{{ $shop->name }}</h4>
                                </div>
                                <div class="col-sm-6">

                                    <ul class="navbar-right list-inline float-right mb-0">
                            
                
                                        <!-- full screen -->
                                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                            <a class="nav-link" href="#" id="btn-fullscreen">
                                                <i class="ion ion-md-qr-scanner noti-icon"></i>
                                            </a>
                                        </li>
                
                                        <li class="dropdown notification-list list-inline-item">
                                            <div class="dropdown notification-list nav-pro-img">
                                                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="<?php echo url('assets/manage/images/users/user-4.jpg');?>" alt="user" class="rounded-circle">
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
                
                
                <div class="row">

                    <div class="col-lg-4 pos-rl">

                        <div class="card text-white bg-primary">
                            <div class="card-header">
                                <h5 class="font-16 my-0"><i class="fa fa-money-bill-wave-alt mr-3"></i>จำนวนเงิน</h5>
                            </div>
                            <div class="card-body">
                                <div class="ml-3 text-right">
                                    <p>
                                        <div id="sum_cash" class="text-white h2 sum_cash">0</div>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <label for="barcode-input" class="col-sm-4 col-form-label">แสกนบาร์โค้ด</label>
                                    <div class="col-sm-8">
                                                                   
                                        <form name="frm_barcode" id="frm_barcode">
                                            <input type="hidden" id="t_sn" value="" class="clear_end">
                                            <input type="hidden" id="t_ck" value="" class="clear_end">
                                            <input type="hidden" id="t_pid" value="" class="clear_end">
                                        <div class="input-group mb-2">
                                            <input type="text" class="typeahead form-control clear_end" id="t_search" name="t_search" placeholder="ค้นหา" autofocus>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>   
                                
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 70%;">ชื่อสินค้า</th>
                                                <th class="text-center" style="width: 10%;">#</th>
                                                <th class="text-center" style="width: 10%;">ราคา</th>
                                                <th class="text-center" style="width: 10%;">ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_body"></tbody>
                                    </table>
                                </div>

                                <hr>

                                <button type="button" class="btn btn-success btn-block m-0" id="btn-pay" txt="{{ URL('salebill_product') }}" onclick="click_pay()">
                                    <i class="fa fa-money-bill-wave-alt"></i> ชำระเงิน
                                </button>
                                <a href="#" class="text-danger pull-right" onclick="list_del()">
                                    <i class="fa fa-trash"></i> ลบทั้งหมด
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12 pos-rl">
                                <div class="card">
                                    <div class="card-body">
                                    
                                        <button type="button" class="btn btn-outline-primary waves-effect waves-light">ทั้งหมด</button>
                                        @foreach($pcats as $pcat)
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">{{ $pcat->name }}</button>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>     

                        <div class="row pos-top1">

                            @foreach($products as $product)

                                <div class="col-xl-2 col-md-4 pos-rl">
                                    <a id="pid{{ $product->id }}" get_product="{{ URL::to('pos/read-barcode/'.$product->sku.'/'.$shop->id) }}" onclick="click_product({{ $product->id }})" title="{{ $product->name }}">
                                        <div class="card product-box">
                                            <div class="card-body p-1">
                                                <div class="product-img">
                                                    <img src="{{ $product->get_photo() }}" class="img-fluid rounded-top mx-auto d-block" alt="work-thumbnail">
                                                </div>
                                                
                                                <div class="detail mt-3">
                                                    <h4 class="font-14">{{ mb_substr($product->name,0,35,'UTF-8') }} </h4>
                                                    <h5 class="my-0 font-14 float-right">
                                                        <b>{{ number_format($product->price,2,'.',',') }}</b></h5>
                                                    <span class="badge badge-soft-primary">sku {{ $product->sku }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end product-box -->
                                    </a>
                                </div>

                            @endforeach
                            
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
        <script src="<?php echo url('assets/js/lks.js');?>"></script>
        <script src="<?php echo url('assets/js/pos.js');?>"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>
    </body>

</html>