@extends('web.master')
@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero">
 
    <!-- <video  width="100%" height="200px" autoplay loop>
      <source src="GOHALA_WEBBANNER.mp4" type="video/mp4" >
    </video>  -->

    <div id="banner">
         <video width="60%" height="auto" autoplay loop muted plays-inline>
      <source src="GOHALA_WEBBANNERTEST.mp4" type="video/mp4" >
    </video> 
  </div>

 
    
      <!-- <iframe width="100%" height="auto" src="GOHALA_WEBBANNER.mp4" autoplay loop
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    
 
    <!-- <div class="video-holder">
      <div id="video-container">
          <video autoplay loop >
            <source src="GOHALA_WEBBANNER.mp4" type="video/mp4" >
          </video> 
    </div>
    </div> -->
    
    
    


    <div class="container">

      <div class="row d-flex align-items-center text-center justify-content-center">
     
        <div class="col-lg-9 pt-5 pt-lg-0">
          <div data-aos="zoom-out">
            <h1>สร้างยอดขาย ลดต้นทุน เพิ่มกำไร  
            </h1>
            <h1 class="mb-3">ด้วยแพลทฟอร์มอัจฉริยะ <img class="img-solution" src="{{ url("assets_home2/img/logo-dark.png") }}" alt=""> : Total Solution</h1>
            <h2>เพียงสมัครใช้งานแพลทฟอร์มของเรา สินค้าของคุณจะพร้อมขายในทุกช่องทาง</h2>
            <h2>เครื่องขายหน้าร้าน (POS) บนหน้าเว็บไซท์ (Web E-Commerce) รวมถึงเว็บมาร์เก็ตเพลสต่างๆ</h2>

            <div class="text-center mt-5">
            <h1 style="color: #0e81b3;" id="text_run"></h1>
            </div>

            <div class="text-center mt-2">
              <a href="{{ LKS::url_subdomain('manage','') }}" class="btn-get-started3 scrollto">สมัครเลย!!</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" style="z-index:1000;" data-aos="zoom-out" data-aos-delay="300">
          <img src="{{ url("assets_home2/img/gohala/3255316-01.png") }}" class="img-fluid animated" alt="">
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
                <i style="font-size: 3rem;transform: translate(-50%, -30%)" class="icon fas fa-cash-register"></i>
              </div>
       
              <p>ระบบจัดการ<BR/>หน้าร้าน</p>
            </div>
          </div>
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="icon bi bi-display"></i><i class="icon bi bi-cart4" style="font-size: 1.5rem;transform: translate(-50%, -30%)" ></i>
            
              </div>
              <!-- <h3 class="mb-3">ซื้อง่าย ขายคล่อง</h3> -->
              <p>ระบบร้านค้า<BR/>ออนไลน์</p>
            </div>
          </div>
          <div class="col-md-2" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon bi bi-cash-stack"></span>
              </div>
              <!-- <h3 class="mb-3">Design To Development</h3> -->
              <p>ช่องทางจ่ายเงิน<BR/>ที่หลากหลาย</p>
            </div>
          </div>
          <div class="col-md-2 " data-aos="fade-up" data-aos-delay="300">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon bi bi-link"></span>
              </div>
              <!-- <h3 class="mb-3">Design To Development</h3> -->
              <p>โพสต์สินค้าได้หลายๆ<BR/>ร้านในคลิกเดียว</p>
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

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing about">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-12" data-aos="fade-up">
            <h2 class="section-heading" style="color: black;">ใช้งานง่ายเพียงไม่กี่ขั้นตอน</h2>
            <a href="{{ url("manual") }}" class="btn-get-started3 scrollto"> 
                <i class="icon fas fa-hand-point-right"></i> 
                ขั้นตอนการใช้งาน GOHALA 
                <i class="icon fas fa-hand-point-left"></i>
            </a>
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
                <a href="{{ LKS::url_subdomain('manage','') }}" class="btn">
                  <h3>คลิกที่นี้เพื่อเปิดบัญชี GOHALA MEMBER</h3>
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
    </section>
    <!-- End Pricing Section -->
  </main><!-- End #main -->

@stop