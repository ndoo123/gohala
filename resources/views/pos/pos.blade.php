<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Gohala - ข้อมูลผู้ใช้</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="<?php echo  url('favicon.ico') ; ?>">
        <meta name="csrf-token" content="<?php echo  csrf_token() ; ?>" />
        <link href="<?php echo url('assets/manage/login/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('assets/manage/login/css/style.css');?>" rel="stylesheet" type="text/css">

        <style>
            .container-fluid {
                padding-right: 0px;
                padding-left: 0px;
            }
            .wrapper {
                padding-top: 120px;
            }
            .pos-rl {
                padding: 4px;
            }
            .pos-b {
                margin-bottom: -50px;
            }
            .card-b {
                margin-bottom: 5px;
            }
            .pos-product {
                margin-bottom: -30px;
            }

            div figure{
                width: 150px;
                max-width: 150px;
                height: 150px;
                max-height: 150px;
                overflow: hidden;
                margin: 3px;
                position: relative;
                margin:0 auto;
                background-size: cover;
                background-position: 50% 50%;
            }

            .page-title-box {
                padding: 0px 20px 0px 20px;
            }
            
            .container-fluid {
                width: 95%;
            }

            .box-detail {
                line-height:14pt;
                height:40pt;
                overflow:hidden;
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
                                    <h4 class="page-title">
                                    <img src="<?php echo $shop->get_photo();?>" alt="user" class="" height="45">
                                    <?php echo $shop->name ;?></h4>
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
                                            <input type="hidden" id="shopid" value="<?php echo $shop->id; ?>">
                                        <div class="input-group mb-2">
                                            <input type="text" class="typeahead form-control clear_end" id="t_search" name="t_search" placeholder="บาร์โค้ด" autofocus>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>   
                                
                                <div class="table-responsive">

                                        <form name="frm_save" id="frm_save" method="POST" action="<?php echo  url($shop->url.'/pos/save') ; ?>">
                                            <?php echo  csrf_field() ; ?>
                                            <input type="hidden" name="h_total" id="h_total" value="">
                                            <input type="hidden" name="h_amount" id="h_amount" value="">
                                            <input type="hidden" name="h_discount" id="h_discount" value="">
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
                                        </form>
                                </div>

                                <hr>

                                <button id="btn-pay" type="button" class="btn btn-primary waves-effect waves-light btn-block m-0" data-toggle="modal" data-target=".bs-example-modal-xl" onclick="click_pay()"><i class="fa fa-money-bill-wave-alt"></i> ชำระเงิน</button>
                                <a href="#" class="text-danger pull-right" onclick="list_del()">
                                    <i class="fa fa-trash"></i> ลบทั้งหมด
                                </a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row pos-product">
                            <div class="col-12 pos-rl">
                                <div class="card">
                                    <div class="card-body">
                                    
                                        <button type="button" class="btn btn-outline-primary waves-effect waves-light btn-cat" id="btncat0" get_cat="<?php echo  '/pos/readData/0/'.$shop->id ; ?>" onclick="click_cat(0)">ทั้งหมด</button>
                                        @foreach($pcats as $pcat)
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light btn-cat" id="btncat<?php echo  $pcat->id ; ?>" get_cat="<?php echo '/pos/readData/'.$pcat->id.'/'.$shop->id ; ?>" onclick="click_cat(<?php echo  $pcat->id ; ?>)"><?php echo  $pcat->name ; ?></button>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>     

                        <div class="row pos-product" id="block-product">
                            <!-- แสดงสินค้า -->
                        </div>

                    </div>
                    
                </div>
                
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->




        <!--  Modal ชำระเงิน -->
        <div id="modalPay" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">ชำระเงิน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <!-- ฟอร์มชำระเงิน -->

                        <div class="row">
                            <div class="col-lg-12 col-xl-12">

                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >ยอดเงินรวม</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control sum_cash text-right text-primary" value="" readonly id="sumprice" name="sumprice" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >ส่วนลด</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control sum_cash text-right text-danger" value="0" readonly id="discounttotal" name="discounttotal" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >ยอดเงินที่ต้องชำระ</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control sum_cash text-right text-primary" value="" readonly id="pricetotal" name="pricetotal" >
                                            </div>
                                        </div>

                                        <div class="payScroll">
                                        <table id="tb-pay-etc" class="table table-striped table-hover table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 60%;">รายการชำระเงิน</th>
                                                    <th class="text-center" style="width: 30%;">จำนวน</th>
                                                    <th class="text-center" style="width: 10%;">ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody class="pay-etc">
                                                
                                            </tbody>
                                            
                                        </table>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >รวม</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control pay-total-footer text-right" value="0" readonly id="pay-total-footer" name="pay-total-footer" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label" >เงินทอน</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control pay-change-footer text-right text-danger" value="0" readonly id="pay-change-footer" name="pay-change-footer" >
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="getdiscount">ส่วนลด</label>
                                                    <input type="decimal" class="form-control getmoney text-right" onkeyup="discount()"  id="discount" name="discount" maxlength="11" value="0">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                
                                                <div class="form-group">
                                                    <label class="d-block">ประเภทส่วนลด</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="typeDiscount" value="bath" checked >
                                                        <label class="form-check-label" for="example-radios-inline1">บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="typeDiscount" value="percent">
                                                        <label class="form-check-label" for="example-radios-inline2">เปอร์เซ็นต์</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="">ชำระโดยเงินสด</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_cash(20)">20</button>
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_cash(50)">50</button>
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_cash(100)">100</button>
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_cash(500)">500</button>
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_cash(1000)">1000</button>
                                                <button type="button" class="m-1 btn btn-outline-primary waves-effect waves-light" onclick="get_balance()">พอดี</button>
                                                <button type="button" class="m-1 btn btn-square btn-outline-danger" onclick="get_clear()">ล้าง</button>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="t_name">รับเงิน</label>
                                            <input type="decimal" class="form-control getmoney text-right" onkeyup="torn()"  id="getmoney" name="getmoney" maxlength="11" value="0">
                                        </div>

                                        {{-- <div class="form-group m-2">
                                            <label for="">ชำระโดยวิธีอื่น</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <button type="button" class="btn btn-outline-info open_modal" id="b-credit" data-href="{{ url('payment/add/credit') }}"><small>บัตรเครดิต</small></button>

                                                <button type="button" class="btn btn-outline-info open_modal" id="b-check" data-href="{{ url('payment/add/check') }}"><small>เช็ค</small></button>

                                                <button type="button" class="btn btn-outline-info open_modal" id="b-transfer" data-href="{{ url('payment/add/transfer') }}"><small>เงินโอน</small></button>
                                                
                                            </div>
                                        </div> --}}


                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-block pull-right" id="btn-save" disabled="" onclick="pay()" txt="<?php echo  URL('save_print') ; ?>">
                                    <i class="fa fa-print"></i>
                                    บันทึก / พิมพ์
                                </button>
                            </div>
                        </div>
                        
                        <!-- END ฟอร์มชำระเงิน -->
                                    
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        


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
        <script src="<?php echo url('assets/js/pos.js');?>"></script>
    </body>

</html>