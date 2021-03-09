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
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="pb-0">
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '2934897193194069',
                cookie     : true,
                xfbml      : true,
                version    : 'v7.0'
                });
                
                FB.AppEvents.logPageView();   
                
            };
              (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
       
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
                            <?php LKS::has_alert();?>
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
                                        <a data-toggle="modal" data-target="#forgot_pass_modal" href="javascript:;"><i class="mdi mdi-lock"></i> <?php echo __('view.forgot_password');?></a>
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
                        <div class="row">
                            <div class="col-md-12 text-center">
                             <div class="fb-login-button" onlogin="checkLoginState()" data-size="medium" data-button-type="login_with" data-layout="default" data-scope="email,public_profile" data-width=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-0 text-center">
                        <a href="#" class="btn_privacy text-primary pull-left">นโยบายความเป็นส่วนตัว</a>
                        <p>© 2019 Gohala.com</p>
                    </div>
                </div>
                  

            </div>

          
        </div>
        <!-- end wrapper-page -->

        <div class="modal" id="forgot_pass_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ลืมรหัสผ่าน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group input_email">
                    <label for="register_email">ระบุ Email ที่ได้ทำการลงทะเบียนไว้</label>
                    <input type="text" class="form-control register_email"  placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="reset_password_btn" class="btn btn-primary">Reset รหัสผ่าน</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
            </div>
        </div>
        </div>
        <!-- modal_privacy -->
        <div class="modal fade" id="modal_privacy" tabindex="-1" role="dialog" aria-labelledby="modal_privacy_label" aria-hidden="true">
            {{-- <form action="{{ $action }}" method="{{ $method }}" class="needs-validation" novalidate id="form_privacy"> --}}
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto" id="modal_privacy_label"><img src="assets/images/logo-dark.png" height="55" alt="logo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row modal_privacy_body">
                            <div class="col-12">
                                <h1>นโยบายความเป็นส่วนตัวสำหรับลูกค้า</h1>
                                <p>บริษัท โกฮาล่า จำกัด ให้ความสำคัญกับการคุ้มครองข้อมูลส่วนบุคคลของคุณ โดยนโยบายความเป็นส่วนตัวฉบับนี้ได้อธิบายแนวปฏิบัติเกี่ยวกับการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล รวมถึงสิทธิต่าง ๆ ของเจ้าของข้อมูลส่วนบุคคล ตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล</p>

                                <h2>การเก็บรวบรวมข้อมูลส่วนบุคคล</h2>
                                <p>
                                เราจะเก็บรวบรวมข้อมูลส่วนบุคคลที่ได้รับโดยตรงจากคุณผ่านช่องทาง ดังต่อไปนี้
                                </p><ul>
                                <li>การสมัครสมาชิก</li>
                                <li>อีเมล</li>
                                <li>Facebook Login</li>
                                </ul>
                                <p></p>

                                <h2>ประเภทข้อมูลส่วนบุคคลที่เก็บรวบรวม</h2>
                                <p><b>ข้อมูลส่วนบุคคล</b> เช่น ชื่อ นามสกุล อายุ วันเดือนปีเกิด สัญชาติ เลขประจำตัวประชาชน หนังสือเดินทาง เป็นต้น</p>
                                <p><b>ข้อมูลการติดต่อ</b> เช่น ที่อยู่ หมายเลขโทรศัพท์ อีเมล เป็นต้น</p>

                                <h2>ผู้เยาว์</h2>
                                <p>หากคุณมีอายุต่ำกว่า 20 ปีหรือมีข้อจำกัดความสามารถตามกฎหมาย เราอาจเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เราอาจจำเป็นต้องให้พ่อแม่หรือผู้ปกครองของคุณให้ความยินยอมหรือที่กฎหมายอนุญาตให้ทำได้ หากเราทราบว่ามีการเก็บรวบรวมข้อมูลส่วนบุคคลจากผู้เยาว์โดยไม่ได้รับความยินยอมจากพ่อแม่หรือผู้ปกครอง เราจะดำเนินการลบข้อมูลนั้นออกจากเซิร์ฟเวอร์ของเรา</p>

                                <h2>วิธีการเก็บรักษาข้อมูลส่วนบุคคล</h2>
                                <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณในรูปแบบเอกสารและรูปแบบอิเล็กทรอนิกส์</p>
                                <p>เราเก็บรักษาข้อมูลส่วนบุคคลของคุณ ดังต่อไปนี้</p>
                                <ul>
                                <li>เซิร์ฟเวอร์บริษัทของเราในประเทศไทย</li>
                                </ul>

                                <h2>การประมวลผลข้อมูลส่วนบุคคล</h2>
                                <p>เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณเพื่อวัตถุประสงค์ดังต่อไปนี้</p>
                                <ul>
                                <li>เพื่อสร้างและจัดการบัญชีผู้ใช้งาน</li>
                                <li>เพื่อจัดส่งสินค้าหรือบริการ</li>
                                <li>เพื่อชำระค่าสินค้าหรือบริการ</li>
                                <li>เพื่อปฏิบัติตามข้อตกลงและเงื่อนไข (Terms and Conditions)</li>
                                <li>เพื่อปฏิบัติตามกฎหมายและกฎระเบียบของหน่วยงานราชการ</li>
                                </ul>

                                <h2>ระยะเวลาจัดเก็บข้อมูลส่วนบุคคล</h2>
                                <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณไว้ตามระยะเวลาที่จำเป็นในระหว่างที่คุณเป็นลูกค้าหรือมีความสัมพันธ์อยู่กับเราหรือตลอดระยะเวลาที่จำเป็นเพื่อให้บรรลุวัตถุประสงค์ที่เกี่ยวข้องกับนโยบายฉบับนี้ ซึ่งอาจจำเป็นต้องเก็บรักษาไว้ต่อไปภายหลังจากนั้น หากมีกฎหมายกำหนดไว้ เราจะลบ ทำลาย หรือทำให้เป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้ เมื่อหมดความจำเป็นหรือสิ้นสุดระยะเวลาดังกล่าว</p>

                                <h2>สิทธิของเจ้าของข้อมูลส่วนบุคคล</h2>
                                <p>ภายใต้กฎหมายคุ้มครองข้อมูลส่วนบุคคล  คุณมีสิทธิในการดำเนินการดังต่อไปนี้</p>

                                <p><b>สิทธิขอถอนความยินยอม (right to withdraw consent)</b> หากคุณได้ให้ความยินยอม เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ ไม่ว่าจะเป็นความยินยอมที่คุณให้ไว้ก่อนวันที่กฎหมายคุ้มครองข้อมูลส่วนบุคคลใช้บังคับหรือหลังจากนั้น คุณมีสิทธิที่จะถอนความยินยอมเมื่อใดก็ได้ตลอดเวลา</p>

                                <p><b>สิทธิขอเข้าถึงข้อมูล (right to access)</b> คุณมีสิทธิขอเข้าถึงข้อมูลส่วนบุคคลของคุณที่อยู่ในความรับผิดชอบของเราและขอให้เราทำสำเนาข้อมูลดังกล่าวให้แก่คุณ  รวมถึงขอให้เราเปิดเผยว่าเราได้ข้อมูลส่วนบุคคลของคุณมาได้อย่างไร</p>

                                <p><b>สิทธิขอถ่ายโอนข้อมูล (right to data portability)</b> คุณมีสิทธิขอรับข้อมูลส่วนบุคคลของคุณในกรณีที่เราได้จัดทำข้อมูลส่วนบุคคลนั้นอยู่ในรูปแบบให้สามารถอ่านหรือใช้งานได้ด้วยเครื่องมือหรืออุปกรณ์ที่ทำงานได้โดยอัตโนมัติและสามารถใช้หรือเปิดเผยข้อมูลส่วนบุคคลได้ด้วยวิธีการอัตโนมัติ รวมทั้งมีสิทธิขอให้เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นเมื่อสามารถทำได้ด้วยวิธีการอัตโนมัติ และมีสิทธิขอรับข้อมูลส่วนบุคคลที่เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นโดยตรง เว้นแต่ไม่สามารถดำเนินการได้เพราะเหตุทางเทคนิค</p>

                                <p><b>สิทธิขอคัดค้าน (right to object)</b>  คุณมีสิทธิขอคัดค้านการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณในเวลาใดก็ได้ หากการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณที่ทำขึ้นเพื่อการดำเนินงานที่จำเป็นภายใต้ประโยชน์โดยชอบด้วยกฎหมายของเราหรือของบุคคลหรือนิติบุคคลอื่น โดยไม่เกินขอบเขตที่คุณสามารถคาดหมายได้อย่างสมเหตุสมผลหรือเพื่อดำเนินการตามภารกิจเพื่อสาธารณประโยชน์</p>

                                <p><b>สิทธิขอให้ลบหรือทำลายข้อมูล (right to erasure/destruction)</b> คุณมีสิทธิขอลบหรือทำลายข้อมูลส่วนบุคคลของคุณหรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวคุณได้ หากคุณเชื่อว่าข้อมูลส่วนบุคคลของคุณถูกเก็บรวบรวม ใช้ หรือเปิดเผยโดยไม่ชอบด้วยกฎหมายที่เกี่ยวข้องหรือเห็นว่าเราหมดความจำเป็นในการเก็บรักษาไว้ตามวัตถุประสงค์ที่เกี่ยวข้องในนโยบายฉบับนี้ หรือเมื่อคุณได้ใช้สิทธิขอถอนความยินยอมหรือใช้สิทธิขอคัดค้านตามที่แจ้งไว้ข้างต้นแล้ว</p>

                                <p><b>สิทธิขอให้ระงับการใช้ข้อมูล (right to restriction of processing)</b> คุณมีสิทธิขอให้ระงับการใช้ข้อมูลส่วนบุคคลชั่วคราวในกรณีที่เราอยู่ระหว่างตรวจสอบตามคำร้องขอใช้สิทธิขอแก้ไขข้อมูลส่วนบุคคลหรือขอคัดค้านของคุณหรือกรณีอื่นใดที่เราหมดความจำเป็นและต้องลบหรือทำลายข้อมูลส่วนบุคคลของคุณตามกฎหมายที่เกี่ยวข้องแต่คุณขอให้เราระงับการใช้แทน</p>

                                <p><b>สิทธิขอให้แก้ไขข้อมูล (right to rectification)</b> คุณมีสิทธิขอแก้ไขข้อมูลส่วนบุคคลของคุณให้ถูกต้อง เป็นปัจจุบัน สมบูรณ์ และไม่ก่อให้เกิดความเข้าใจผิด</p>

                                <p><b>สิทธิร้องเรียน (right to lodge a complaint)</b> คุณมีสิทธิร้องเรียนต่อผู้มีอำนาจตามกฎหมายที่เกี่ยวข้อง หากคุณเชื่อว่าการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เป็นการกระทำในลักษณะที่ฝ่าฝืนหรือไม่ปฏิบัติตามกฎหมายที่เกี่ยวข้อง</p>


                                <p>คุณสามารถใช้สิทธิของคุณในฐานะเจ้าของข้อมูลส่วนบุคคลข้างต้นได้ โดยติดต่อมาที่เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราตามรายละเอียดท้ายนโยบายนี้ เราจะแจ้งผลการดำเนินการภายในระยะเวลา 30 วัน นับแต่วันที่เราได้รับคำขอใช้สิทธิจากคุณ ตามแบบฟอร์มหรือวิธีการที่เรากำหนด ทั้งนี้ หากเราปฏิเสธคำขอเราจะแจ้งเหตุผลของการปฏิเสธให้คุณทราบผ่านช่องทางต่าง ๆ เช่น ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น</p>


                                <h2>เทคโนโลยีติดตามตัวบุคคล (Cookies)</h2>
                                <p>เพื่อเพิ่มประสบการณ์การใช้งานของคุณให้สมบูรณ์และมีประสิทธิภาพมากขึ้น เราใช้คุกกี้ (Cookies)หรือเทคโนโลยีที่คล้ายคลึงกัน เพื่อพัฒนาการเข้าถึงสินค้าหรือบริการ โฆษณาที่เหมาะสม และติดตามการใช้งานของคุณ เราใช้คุกกี้เพื่อระบุและติดตามผู้ใช้งานเว็บไซต์และการเข้าถึงเว็บไซต์ของเรา หากคุณไม่ต้องการให้มีคุกกี้ไว้ในคอมพิวเตอร์ของคุณ คุณสามารถตั้งค่าบราวเซอร์เพื่อปฏิเสธคุกกี้ก่อนที่จะใช้เว็บไซต์ของเราได้</p>

                                <h2>การรักษาความมั่งคงปลอดภัยของข้อมูลส่วนบุคคล</h2>
                                <p>เราจะรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคลของคุณไว้ตามหลักการ การรักษาความลับ (confidentiality) ความถูกต้องครบถ้วน (integrity) และสภาพพร้อมใช้งาน (availability) ทั้งนี้ เพื่อป้องกันการสูญหาย เข้าถึง ใช้ เปลี่ยนแปลง แก้ไข หรือเปิดเผย นอกจากนี้เราจะจัดให้มีมาตรการรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคล ซึ่งครอบคลุมถึงมาตรการป้องกันด้านการบริหารจัดการ (administrative safeguard) มาตรการป้องกันด้านเทคนิค (technical safeguard) และมาตรการป้องกันทางกายภาพ (physical safeguard) ในเรื่องการเข้าถึงหรือควบคุมการใช้งานข้อมูลส่วนบุคคล (access control)</p>

                                <h2>การแจ้งเหตุละเมิดข้อมูลส่วนบุคคล</h2>
                                <p>ในกรณีที่มีเหตุละเมิดข้อมูลส่วนบุคคลของคุณเกิดขึ้น เราจะแจ้งให้สำนักงานคณะกรรมการคุ้มครองข้อมูลส่วนบุคคลทราบโดยไม่ชักช้าภายใน 72 ชั่วโมง นับแต่ทราบเหตุเท่าที่สามารถกระทำได้ ในกรณีที่การละเมิดมีความเสี่ยงสูงที่จะมีผลกระทบต่อสิทธิและเสรีภาพของคุณ เราจะแจ้งการละเมิดให้คุณทราบพร้อมกับแนวทางการเยียวยาโดยไม่ชักช้าผ่านช่องทางต่าง ๆ เช่น  เว็บไซต์ ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น</p>

                                <h2>การแก้ไขเปลี่ยนแปลงนโยบายความเป็นส่วนตัว</h2>
                                <p>เราอาจแก้ไขเปลี่ยนแปลงนโยบายนี้เป็นครั้งคราว โดยคุณสามารถทราบข้อกำหนดและเงื่อนไขนโยบายที่มีการแก้ไขเปลี่ยนแปลงนี้ได้ผ่านทางเว็บไซต์ของเรา</p>
                                <p>นโยบายนี้แก้ไขล่าสุดและมีผลใช้บังคับตั้งแต่วันที่ 25 กุมภาพันธ์ 2564</p>

                                <h2>นโยบายความเป็นส่วนตัวของเว็บไซต์อื่น</h2>
                                <p>นโยบายความเป็นส่วนตัวฉบับนี้ใช้สำหรับการเสนอสินค้า บริการ และการใช้งานบนเว็บไซต์สำหรับลูกค้าของเราเท่านั้น หากคุณเข้าชมเว็บไซต์อื่นแม้จะผ่านช่องทางเว็บไซต์ของเรา การคุ้มครองข้อมูลส่วนบุคคลต่าง ๆ จะเป็นไปตามนโยบายความเป็นส่วนตัวของเว็บไซต์นั้น ซึ่งเราไม่มีส่วนเกี่ยวข้องด้วย</p>

                                <h2>รายละเอียดการติดต่อ</h2>
                                <p>หากคุณต้องการสอบถามข้อมูลเกี่ยวกับนโยบายความเป็นส่วนตัวฉบับนี้ รวมถึงการขอใช้สิทธิตามต่าง ๆ คุณสามารถติดต่อเราหรือเจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราได้ ดังนี้</p>

                                <p><b>ผู้ควบคุมข้อมูลส่วนบุคคล</b></p>
                                <p>บริษัท โกฮาล่า จำกัด</p>

                                <p>
                                72/74 ถ.มิตรเกษม ตลาด เมืองสุราษฎร์ธานี สุราษฎร์ธานี 84000
                                </p>

                                <p>อีเมล contact@gohala.com</p>
                                <p>เว็บไซต์ http://gohala.com</p>
                                <p>หมายเลขโทรศัพท์ 0916879646</p>

                                <p><b>เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคล</b></p>
                                <p>ทีมโกฮาล่า</p>

                                <p>
                                72/74 ถ.มิตรเกษม ตลาด เมืองสุราษฎร์ธานี สุราษฎร์ธานี 84000
                                </p>

                                <p>อีเมล contact@gohala.com</p>
                                <p>หมายเลขโทรศัพท์ 0916879646</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
            {{-- </form> --}}
        </div>
        <!-- end modal_privacy -->
       <!-- jQuery  -->
        <script src="<?php echo url('assets/manage/js/jquery.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo url('assets/manage/js/waves.min.js');?>"></script>
        <script src="<?php echo url('assets/js/plugins/blockUI.js');?>"></script>
        <!-- App js -->
      <script src="<?php echo url('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
        <script src="<?php echo url('assets/js/lks.js?v='.time());?>"></script>
       
        <script src="<?php echo url('assets/account/js/account.js');?>"></script>
        <script>
        var app=new LKS();
        app.url='<?php echo url('');?>';
        </script>
    </body>

</html>

<script>

$(document).on('click','.btn_privacy',function(){
    $("#modal_privacy").modal('show');
});
function checkLoginState() {
    
    
  FB.getLoginStatus(function(response) {

      if(response.status=="connected")
      {
          var uid=response.authResponse.userID;
          var accessToken=response.authResponse.accessToken;
        
         console.log('uid');
         console.log(uid);
         console.log(accessToken);
         console.log('accessToken');
        FB.api('/'+uid+"?fields=name,email", function(response) {
          
           console.log(response);
            Load('div.accountbg',true)
            var obj=new Object();
            obj.fb_login=1;
            obj.fb_id=uid;
            obj.name=response.name;
            obj.email=response.email;
            var post=new JPost();
            post.url='<?php echo url('auth/facebook');?>';
            post.success=function(r){
                if(r.result==0)
                {
                    alert(r.msg);
                    return;
                }
                // console.log(r);
                location.reload(); 
            }
            post.send(obj);
            
        });
      }
 
  });
}
</script>