<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GOHALA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- logo -->
  <!-- <link rel = "icon" href =  "assets_home/img/logo-dark.png" type = "image/x-icon">  -->

  <!-- Favicons -->
  <link href="{{ url('assets_home/img/favicon.png') }}" rel="icon">
  <link href="{{ url('assets_home/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
 
  <!-- Vendor CSS Files -->
  <link href="{{ url('assets_home/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('assets_home/css/style.css') }}" rel="stylesheet">

  <!-- CND icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



  <!-- =======================================================

  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span><img src="{{ url('assets_home/img/logo-dark.png') }}" alt=""></span></a></h1>

      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="mr-2"><a href="{{ LKS::url_subdomain('manage','shops') }}">
              <div id="navbi1"class="icon-cente"><i class="bi bi-box-arrow-in-left mr-1" ></i></div>
              ไปยังร้านของคุณ
            </a></li>
          <li id="nava"> <a href="{{ LKS::url_subdomain('manage','') }}"  class="btn-get-started3 scrollto">เปิดร้านค้าฟรีที่นี้!</a></li>


        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
        {{ LKS::has_alert() }}

      <div class="row d-flex align-items-center text-center justify-content-center">
        <div class="col-lg-9 pt-5 pt-lg-0">
          <div data-aos="zoom-out">
            <h1>สร้างยอดขาย เพิ่มยอดขาย ฟรี! </h1>
            <h1 class="mb-3">ให้กับธุรกิจของคุณด้วย GOHALA</h1>
            <h2>เปิดร้านค้าออนไลน์ แชทกับลูกค้าออนไลน์ จัดการออเดอร์ ฟรี! เพียงแค่สมัคร </h2>
            <h2>GOHALA เครื่องมือที่ช่วยเพิ่มประสิทธิภาพการขายของคุณให้ดียิ่งขึ้น</h2>
            <div class="text-center mt-5">
              <a href="#about" id="hero-a1"class="btn-get-started1 scrollto mb-3 mr-4">เรียนดูเพิ่มเติม</a>
              <a href="{{ LKS::url_subdomain('manage','') }}" class="btn-get-started3 scrollto">เปิดร้านค้าฟรีที่นี้!</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" style="z-index:1000;" data-aos="zoom-out" data-aos-delay="300">
          <img src="{{ url("assets_home/img/gohala/3255316-01.png") }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 699.77 92.2">

      <path class="cls-1" d="M.23,57.8S308.05,106,700,57.8V150H.23Z" transform="translate(-0.23 -57.8)" />
    </svg>

  </section><!-- End Hero -->

  <main id="main">
    <section class="section section-bg-icon">

      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-5" data-aos="fade-up">
            <h2 class="section-heading">ตอบโจทย์ ทุกช่องทางการขาย</h2>
          </div>
        </div>

        <div class="row d-flex justify-content-center">
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="icon bi bi-chat-left-text"></i>
              </div>
              <!-- <h3 class="mb-3"></h3> -->
              <!-- <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script> -->
              <p>แชตผ่านเว็บได้เลย</p>
            </div>
          </div>
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="icon bi bi-cart3"></i>
              </div>
              <!-- <h3 class="mb-3">ซื้อง่าย ขายคล่อง</h3> -->
              <p>ซื้อง่าย ขายคล่อง</p>
            </div>
          </div>
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon bi bi-cash-stack"></span>
              </div>
              <!-- <h3 class="mb-3">Design To Development</h3> -->
              <p>ช่องทางจ่ายเงินที่หลากหลาย</p>
            </div>
          </div>
          <div class="col-md-2 " data-aos="fade-up" data-aos-delay="300">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon bi bi-link"></span>
              </div>
              <!-- <h3 class="mb-3">Design To Development</h3> -->
              <p>โพสต์สินค้าได้หลายๆร้านในคลิกเดียว</p>
            </div>
          </div>
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="400">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon bi bi-shield-check"></span>
              </div>
              <!-- <h3 class="mb-3">Design To Development</h3> -->
              <p>ปลอดภัยจากการถูกโจรกรรมได้ 100%</p>
            </div>
          </div>
        </div>

      </div>
    </section>






    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">
        <div class="row content">

          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="{{ url('assets_home/img/gohala/2992776-01.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>จัดการออเดอร์ของคุณอย่างง่าย สะดวก ปลอดภัย และรวดเร็ว ปิดการขายได้รวดเร็วทันใจ!</h3>
            <ul class="pt-3">
              <li><i class="icofont-check"></i> แชตกับลูกค้าผ่านหน้าเว็บได้ทันที</li>
              <li><i class="icofont-check"></i> รับออเดอร์และชำระเงินได้ทันที</li>
              <li><i class="icofont-check"></i> รับการแจ้งเตือนทันทีเมื่อมีคำสั่งซื้อใหม่</li>
              <li><i class="icofont-check"></i> ปลอดภัย 100% ด้วยระบบการควบคุมที่ทันสมัย</li>
            </ul>
          </div>

        </div>

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="{{ url('assets_home/img/gohala/4706263-01.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5" data-aos="fade-up">
            <h3>ซื้อง่าย ขายคล่อง</h3>
            <p>ไม่ใช่เพียงระบบบริหารร้านค้า GOHALA ยังพร้อมช่วยให้ลูกค้าของคุณซื้อของได้สะดวกยิ่งขึ้น
              ประทับใจมากกว่าเดิม</p>
            <ul>
              <li><i class="icofont-check"></i> ช่วยจดจำข้อมูลของลูกค้า ทำให้ลูกค้าไม่ต้อง</li>
              <li><i class="icofont-check"></i> สร้างบัญชีหรือกรอกที่อยู่ใหม่เมื่อต้องการซื้อสินค้าจากร้านค้าคุณ</li>
              <li><i class="icofont-check"></i> ซื้อขายง่ายให้ลูกค้าของคุณช็อบได้อย่างวางใจมั่นใจและเป็นกันเอง</li>
              <li><i class="icofont-check"></i> และอื่น ๆ อีกมากมาย ที่กำลังพัฒนาออกมาอย่างต่อเนื่อง</li>
            </ul>

          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="{{ url('assets_home/img/gohala/29116 [Converted]-01.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>จัดการสต็อกสินค้าด้วยระบบจัดการสต็อกแบบเรียลไทม์</h3>
            <p>
              อัพเดตข้อมูลการขายและคลังสินค้าของคุณแบบเรียลไทม์
              เพื่อให้คุณไม่พลาดออเดอร์สำคัญพร้อมทั้งคอยบริหารและตรวจสอบคลังสินค้าเพื่อให้สินค้าของคุณมีความพร้อมสำหรับการขายอยู่เสมอ
            </p>


          </div>
        </div>

      </div>
    </section><!-- End Details Section -->


    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing about">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-12" data-aos="fade-up">
            <h2 class="section-heading" style="color: black;">ตอบโจทย์ ทุกช่องทางการขาย ได้แล้ววันนี้!!</h2>
          </div>
        </div>
        ' <div class="row justify-content-center text-center mb-2">
          <div class="col-xl-8 col-lg-8 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-up">
            <a href="https://www.youtube.com/watch?v=pW-MiecDNfQ" class="venobox play-btn mb-4" data-vbtype="video"
              data-autoplay="true"></a>
          </div>

        </div>
        <div class="row mb-5" data-aos="fade-left">
          <div class=" col-lg-3 col-md-6 mt-4 mt-md-3 px-md-4 d-flex">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <ul>
                <li>
                  <span class="btn-title">1</span>
                </li>
                <li>
                  <h4>สมัครบัญชี GOHALA</h4>
                </li>
                <li>คุณจำเป็นต้องสมัครบัญชี GOHALA MEMBER ก่อน จึงจะสามารถเปิดร้านได้หากยังไม่มีบัญชี</li>
                <a href="#about" class="btn">
                  <h3><a href="{{ LKS::url_subdomain('manage','') }}">คลิกที่นี้เพื่อเปิดบัญชี GOHALA MEMBER</a></h3>
                </a>
              </ul>
            </div>
          </div>

          <div class=" col-lg-3 col-md-6 mt-4 mt-md-3 px-md-4  d-flex">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <ul>
                <li>
                  <span class="btn-title">2</span>
                </li>
                <li>
                  <h4>ลงทะเบียนเปิดร้านค้า</h4>
                </li>
                <li>เปิดร้านค้ากับเรา รวมทุกฟังก์ชันที่ช่วยคุณเพิ่มยอดขาย, สร้างใบคำสั่งซื้อ, จัดการสต๊อก,
                  พิมพ์ใบจัดส่งสินค้า, แจ้งหมายเลขพัสดุ รวมถึงรายงานสรุปกิจกรรมการขาย</li>
              </ul>
            </div>
          </div>

          <div class=" col-lg-3 col-md-6 mt-4 mt-md-3 px-md-4  d-flex">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <ul>
                <li>
                  <span class="btn-title">3</span>
                </li>
                <li>
                  <h4>ยืนยันตัวตนผ่านอีเมล์</h4>
                </li>
                <li>
                  เพื่อความน่าเชื่อถือและความปลอดภัยของทางผู้ขายและผู้ซื้อคุณจำเป็นต้องยืนยันร้านค้าของคุณผ่านอีเมล์ที่ได้ลงทะเบียนไว้ก่อนที่จะเริ่มเปิดร้านของคุณ
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-3 px-md-4  d-flex">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <ul>
                <li>
                  <span class="btn-title">4</span>
                </li>
                <li>
                  <h4>เพลิดเพลินกับร้านค้าของคุณอย่างเต็มที่</h4>
                </li>
                <li>เพื่อสร้างแคตตาล็อกสินค้า และเปิดขายบนหน้าร้านออนไลน์ของคุณ พร้อมออกใบคำสั่งซื้อได้ทันที</li>
              </ul>
            </div>
          </div>


        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->

    <!-- <section id="faq"class="faq section-bg"> -->
    <section class="section section-bg-icon1">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
            <div data-aos="zoom-out">
              <h1>เปิดร้านค้ากับเราฟรี!</h1>
              <h4>ฟรี! เพียงแค่สมัคร GOHALA เครื่องมือที่ช่วยเพิ่มประสิทธิภาพการขายของคุณให้ดียิ่งขึ้น
                <span>GOHALA</span></h4>

              <div class="text-center text-lg-left">
                <a href="{{ LKS::url_subdomain('manage','') }}" class="btn-get-started1 scrollto">เปิดร้านค้าฟรีที่นี้!</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-2 order-lg-1 hero-img" data-aos="zoom-out" data-aos-delay="300">
            <img src="{{ url('assets_home/img/gohala/3255316-01.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>


      </div>
    </section><!-- End F.A.Q Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top section-bg">
      <div class="container">
        <div id="ul-li" class="row">

          <div class="col-lg-8 col-md-10 ">
            <div class="mb-4">
              <img src="{{ url("assets_home/img/logo-dark.png") }}">

              <p class="mt-1">
                เครื่องมือที่ช่วยเพิ่มประสิทธิภาพการขายของคุณให้ดียิ่งขึ้น
              </p>

            </div>
            <div  class="row">
              <div class="col-lg-4 col-md-4 footer-links">
                <h4>ร้านค้าใหม่</h4>
                <ul>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">เริ่มต้นกับ GOHALA</a></li>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">GOHALA คืออะไร</a></li>


                </ul>
              </div>

              <div class="col-lg-4 col-md-4 footer-links">
                <h4>ร้านค้าสมาชิก</h4>
                <ul>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">คำถามที่พบบ่อย</a></li>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">ลงโฆษณาและค้าขาย</a></li>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">โปรโมทร้านค้า</a></li>


                </ul>
              </div>

              <div class="col-lg-4 col-md-4 footer-links">
                <h4>GOHALA GOLD MEMBER</h4>
                <ul>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">GOLD MEMBER คืออะไร</a></li>
                  <li><!-- <i class="bx bx-chevron-right"></i> --> <a href="#">สถาณะ GOLD MEMBER</a></li>

                </ul>
              </div>
            </div>
          </div>



          <div id="qr-code" class="col-lg-4 col-md-6 footer-newsletter text-right">
            <h4 class="contact-us">CONTACT US ติดต่อ GOHALA</h4>
            <img src="{{ url("assets_home/img/qr.png") }}" alt="">
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        <strong>
          SMARTUP TECHNOLOGY Co. Ltd &copy;All rights reserved
        </strong>
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ url("assets_home/vendor/jquery/jquery.min.js") }}"></script>
  <script src="{{ url('assets_home/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url("assets_home/vendor/jquery.easing/jquery.easing.min.js") }}"></script>
  <script src="{{ url("assets_home/vendor/php-email-form/validate.js") }}"></script>
  <script src="{{ url("assets_home/vendor/venobox/venobox.min.js") }}"></script>
  <script src="{{ url("assets_home/vendor/waypoints/jquery.waypoints.min.js") }}"></script>
  <script src="{{ url("assets_home/vendor/counterup/counterup.min.js") }}"></script>
  <script src="{{ url("assets_home/vendor/owl.carousel/owl.carousel.min.js") }}"></script>
  <script src="{{ url("assets_home/vendor/aos/aos.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url("assets_home/js/main.js") }}"></script>

</body>

</html>

<script>

$(window).resize(function () {
  if ($(window).width() < 405) {
      $( "#hero-a1" ).removeClass('mr-4');
    
      
    }
    else {
      $( "#hero-a1" ).addClass('mr-4');
    }
    if ($(window).width() < 768) {
      $( "#ul-li div div div ul li" ).addClass('justify-content-center');
      $( "#ul-li" ).addClass('text-center');
      $( "#qr-code" ).addClass('text-center');
      
    }
    else {
      $( "#ul-li div div div ul li" ).removeClass('justify-content-center');
      $( "#ul-li" ).removeClass('text-center');
      $( "#qr-code" ).removeClass('text-center');
    }
  });

  
</script>



