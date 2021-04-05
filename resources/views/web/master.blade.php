<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GOHALA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- logo -->
  <!-- <link rel = "icon" href =  "assets/img/logo-dark.png" type = "image/x-icon">  -->

  <!-- Favicons -->
  <link href="{{ url('assets_home2/img/favicon.png') }}" rel="icon">
  <link href="{{ url('assets_home2/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
 
  <!-- Vendor CSS Files -->
  <link href="{{ url('assets_home2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets_home2/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ url("assets_home2/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
  <link href="{{ url("assets_home2/vendor/venobox/venobox.css") }}" rel="stylesheet">
  <link href="{{ url("assets_home2/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
  <link href="{{ url("assets_home2/vendor/owl.carousel/assets/owl.carousel.min.css") }}" rel="stylesheet">
  <link href="{{ url("assets_home2/vendor/aos/aos.css") }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url("assets_home2/css/style.css") }}" rel="stylesheet">

  <!-- CND icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <!-- CDN fas fa icon  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="{{ url("path/to/font-awesome/css/font-awesome.min.css") }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- animeion-text -->
  <link href="{{ url("assets_home2/css/animeion-text.css") }}" rel="stylesheet">



  <!-- =======================================================

  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{ url("") }}"><span><img src="{{ url("assets_home2/img/logo-dark.png") }}" alt=""></span></a></h1>

      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="mr-2"><a href="{{ LKS::url_subdomain('manage','shops') }}">
              <div id="navbi1"class="icon-cente"><i class="bi bi-box-arrow-in-left mr-1" ></i></div>
              ไปยังร้านของคุณ
            </a></li>
          <li id="nava"> <a href="{{ LKS::url_subdomain('manage','') }}" class="btn-get-started3 scrollto">เปิดร้านค้าฟรี ที่นี่!</a></li>


        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>
  <!-- End Header -->


  @yield('content')
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top section-bg">
      <div class="container">
        <div id="ul-li" class="row">

          <div class="col-lg-8 col-md-10 ">
            <div class="mb-4">
              <img src="{{ url("assets_home2/img/logo-dark.png") }}">

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
            <img src="{{ url("assets_home2/img/qr.png") }}" alt="">
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

  {{-- start plugin messager --}}
  <div class="fb-customerchat" page_id="346672293114200"> logged_in_greeting="สอบถามเพิ่มเติม ?" logged_out_greeting="สอบถามเพิ่มเติม"</div> 
  {{-- end --}}
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ url("assets_home2/vendor/jquery/jquery.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/jquery.easing/jquery.easing.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/php-email-form/validate.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/venobox/venobox.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/waypoints/jquery.waypoints.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/counterup/counterup.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/owl.carousel/owl.carousel.min.js") }}"></script>
  <script src="{{ url("assets_home2/vendor/aos/aos.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url("assets_home2/js/main.js") }}"></script>

</body>

</html>

<script>

    window.fbAsyncInit = function () {
        FB.init({
            appId: '2934897193194069',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v7.0'
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

$(window).resize(function () {
    if ($(window).width() < 992) {
      // $("#banner").css({"border": "20px solid black", "top":"-1.5rem"});
      $("#banner").css({ "top":"-1rem"});
      
    }
    else {
      $("#banner").css({ "top":"-2.5rem"});
    
    }



  });
  if ($(window).width() < 992) {
      // $("#banner").css({"border": "20px solid black", "top":"-1.5rem"});
      $("#banner").css({ "top":"-1rem"});
      
    }
    else {
      $("#banner").css({ "top":"-2.5rem"});
    
    }

</script>
@yield('script')



