<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Gohala </title>
<meta name="description" content="">

<!-- Mobile specific metas  -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Favicon  -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800' rel='stylesheet' type='text/css'>

<!-- CSS Style -->

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/bootstrap.min.css');?>">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo url('assets/js/plugins/bootstrap4/dist/css/bootstrap.min.css');?>"> -->

<!-- font-awesome & simple line icons CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/font-awesome.css');?>" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/simple-line-icons.css');?>" media="all">

<!-- owl.carousel CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/owl.carousel.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/owl.theme.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/owl.transitions.css');?>">

<!-- animate CSS  -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/animate.css');?>" media="all">

<!-- flexslider CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/flexslider.css');?>" >

<!-- jquery-ui.min CSS  -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/jquery-ui.css');?>">

<!-- Revolution Slider CSS -->
<link href="<?php echo url('assets/web/css/revolution-slider.css');?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/plugins/toastr/toastr.min.css');?>"></link>
<!-- style CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/style.css');?>" media="all">
@yield('css')
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/custom.css');?>" media="all">
</head>

<body class="cms-index-index cms-home-page">

<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]--> 


<div id="page"> 
  
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-sm-4 hidden-xs"> 
              <!-- Default Welcome Message -->
              <div class="welcome-msg "><?php echo __('view.welcome');?> </div>
              <span class="phone hidden-sm"><?php echo \Auth::user()->name;?></span> </div>
            
            <!-- top links -->
            <div class="headerlinkmenu col-lg-8 col-md-7 col-sm-8 col-xs-12">
              <div class="links">
                  <?php if(\Auth::check()):?>
                <div class="myaccount">
                <a title="My Account" href="<?php echo LKS::url_subdomain('account','');?>"><i class="fa fa-user"></i><span class="hidden-xs"><?php echo __('home.my_account');?></span></a>
                <a title="My Shop" href="<?php echo LKS::url_subdomain('manage','shops');?>"><i class="fa fa-home"></i><span class="hidden-xs">ร้านของฉัน</span></a>
                </div>
                <div class="login"><a href="<?php echo url('logout');?>"><i class="fa fa-unlock-alt"></i><span class="hidden-xs"><?php echo __('home.logout');?></span></a></div>
                <?php else:?>
                <div class="login"><a href="<?php echo url('login');?>"><i class="fa fa-unlock-alt"></i><span class="hidden-xs"><?php echo __('home.login');?></span></a></div>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-xs-12"> 
            <!-- Header Logo -->
            <div class="logo"><a title="e-commerce"  href="<?php echo url('');?>"><img height="55" alt="e-commerce" src="<?php echo url('assets/images/logo-dark.png');?>"></a> </div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-xs-9 col-sm-6 col-md-6"> 
          
          </div>
          <!-- top cart -->
          <?php
            $html='';
            $qty=0;
            $total=0;
            $basket=\Cart::get_cart();
           
            foreach($basket as $b)
            {
              $html.='<li shop_id="'.$b['shop_id'].'" class="shop_basket_header">'.$b['name'].'</li>';
              foreach($b['items'] as $item){
                $qty+=$item['qty'];
                $total+=$item['qty']*$item['price'];
                $html.='<li shop_id="'.$b['shop_id'].'" product_id="'.$item['product_id'].'" class="item odd"> <a href="'.$item['link'].'" title="'.$item['name'].'" class="product-image"><div style="background-image:url('.$item['img'].')" class="cart_photo"></div></a>';
                  $html.='<div class="product-details"> <a href="javascript:;" product_id="'.$item['product_id'].'" title="ลบสินค้า" class="remove-cart"><i class="icon-close"></i></a>';
                  $html.='<p class="product-name"><a href="'.$item['link'].'">'.$item['name'].'</a> </p>';
                  $html.='<strong>'.$item['qty'].'</strong> x <span class="price" price="'.$item['price'].'">'.number_format($item['price'],2).'</span> </div>';
                  $html.='</li>';
              }
            }
          ?>
          <div class="col-lg-3 col-xs-3 top-cart">
            <div class="top-cart-contain">
              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                  <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                  <div class="shoppingcart-inner hidden-xs"><span class="cart-title">ตระกร้าสินค้า</span> <span class="cart-total"><?php echo $qty;?> รายการ: <?php echo number_format($total,2);?></span></div>
                  </a></div>
                <div>
                  <div class="top-cart-content">
                    <div class="block-subtitle hidden-xs">รายการในตะกร้า</div>
                  
               
                    <ul id="cart-sidebar" class="mini-products-list">
                     <?php echo $html;?>
                    </ul>
                    <div class="top-subtotal">รวม: <span class="price"><?php echo number_format($total,2);?></span></div>
                    <div class="actions">
                      <a href="<?php echo url('/cart');?>" class="btn-checkout" type="button"><i class="fa fa-shopping-cart"></i><span>จัดการตระกร้า</span></a>
                      <!-- <button class="view-cart" type="button"><i class="fa fa-shopping-cart"></i> <span>ดูตระกร้า</span></button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header --> 
  
  @yield('bredcrumb')
  <!-- end nav --> 

 @yield('slider')
  

 @yield('content')

  
  <footer>
    <div class="footer-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-7">
            <form id="newsletter-validate-detail" method="post" action="#">
              <h3 class="hidden-sm">Sign up for newsletter</h3>
              <div class="newsletter-inner">
                <input class="newsletter-email" name='Email' placeholder='Enter Your Email'/>
                <button class="button subscribe" type="submit" title="Subscribe">Subscribe</button>
              </div>
            </form>
          </div>
          <div class="social col-md-4 col-sm-5">
            <ul class="inline-mode">
              <li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
             
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
          <div class="footer-logo"><a href="<?php echo url('');?>"><img src="<?php echo url('assets/images/logo-dark.png');?>" height="80" alt="fotter logo"></a> </div>
          <p>Lorem Ipsum is simply dummy text of the print and typesetting industry.</p>
          <div class="footer-content">
            <div class="email"> <i class="fa fa-envelope"></i>
              <p>Support@themes.com</p>
            </div>
            <div class="phone"> <i class="fa fa-phone"></i>
              <p>(800) 0123 456 789</p>
            </div>
            <div class="address"> <i class="fa fa-map-marker"></i>
              <p> My Company, 12/34 - West 21st Street, New York, USA</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <h3 class="links-title">Information<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
                <li><a href="#s">Delivery Information</a></li>
                <li><a href="#">Discount</a></li>
                <li><a href="sitemap.html">Sitemap</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="faq.html">FAQs</a></li>
                <li><a href="#">Terms &amp; Condition</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <h3 class="links-title">Insider<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
            <div class="tabBlock" id="TabBlock-3">
              <ul class="list-links list-unstyled">
                <li> <a href="sitemap.html"> Sites Map </a> </li>
                <li> <a href="#">News</a> </li>
                <li> <a href="#">Trends</a> </li>
                <li> <a href="about_us.html">About Us</a> </li>
                <li> <a href="contact_us.html">Contact Us</a> </li>
                <li> <a href="#">My Orders</a> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-2 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <h3 class="links-title">Service<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
            <div class="tabBlock" id="TabBlock-4">
              <ul class="list-links list-unstyled">
                <li> <a href="account_page.html">Account</a> </li>
                <li> <a href="wishlist.html">Wishlist</a> </li>
                <li> <a href="shopping_cart.html">Shopping Cart</a> </li>
                <li> <a href="#">Return Policy</a> </li>
                <li> <a href="#">Special</a> </li>
                <li> <a href="#">Lookbook</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12 coppyright"> Copyright © 2016 <a href="#"> MyStore </a>. All Rights Reserved. </div>
          <div class="col-sm-6 col-xs-12">
            <div class="payment">
              <ul>
                <li><a href="#"><img title="Visa" alt="Visa" src="<?php echo url('assets/web/images/visa.png');?>"></a></li>
                <li><a href="#"><img title="Paypal" alt="Paypal" src="<?php echo url('assets/web/images/paypal.png');?>"></a></li>
                <li><a href="#"><img title="Discover" alt="Discover" src="<?php echo url('assets/web/images/discover.png');?>"></a></li>
                <li><a href="#"><img title="Master Card" alt="Master Card" src="<?php echo url('assets/web/images/master-card.png');?>"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="#" class="totop"> <!-- End Footer --> 

</div>

<!-- JS --> 

<!-- jquery js --> 
<script src="<?php echo url('assets/web/js/jquery.min.js');?>"></script> 
<!-- jquery.mobile-menu js --> 
<script src="<?php echo url('assets/web/js/mobile-menu.js');?>"></script> 

<!--jquery-ui.min js --> 
<script src="<?php echo url('assets/web/js/jquery-ui.js');?>"></script> 
<!-- bootstrap js --> 
<script src="<?php echo url('assets/web/js/bootstrap.min.js');?>"></script> 
<!-- <script src="<?php echo url('assets/js/plugins/bootstrap4/dist/js/bootstrap.min.js');?>"></script>  -->

<!-- owl.carousel.min js --> 
<script src="<?php echo url('assets/web/js/owl.carousel.min.js');?>"></script> 

<!-- bxslider js --> 
<script src="<?php echo url('assets/web/js/jquery.bxslider.js');?>"></script> 

<!-- Slider Js --> 
<script src="<?php echo url('assets/web/js/revolution-slider.js');?>"></script> 

<!-- megamenu js --> 
<script src="<?php echo url('assets/web/js/megamenu.js');?>"></script> 
<script>
  /* <![CDATA[ */   
  var mega_menu = '0';
  
  /* ]]> */
  </script> 

<script src="<?php echo url('assets/web/plugins/toastr/toastr.min.js');?>"></script>
<script src="<?php echo url('assets/js/plugins/currency.min.js');?>"></script>
<!-- main js --> 
<script src="<?php echo url('assets/js/plugins/blockUI.js');?>"></script>
<script src="<?php echo url('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
<script src="<?php echo url('assets/js/lks.js');?>"></script> 
<script src="<?php echo url('assets/web/js/main.js');?>"></script> 
<script src="<?php echo url('assets/web/js/ecom.js');?>"></script> 
<!-- flexslider js --> 
<script src="<?php echo url('assets/web/js/jquery.flexslider.js');?>"></script> 



<script>
  var app=new LKS();
  app.url='<?php echo url('');?>';
load_basket();
</script>


</body>
</html>
@yield('js')