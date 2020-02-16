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

<!-- Favicon  -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200,500,600,700,800' rel='stylesheet' type='text/css'>

<!-- CSS Style -->

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/bootstrap.min.css');?>">

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

<!-- style CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/style.css');?>" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/css/custom.css');?>" media="all">
</head>

<body class="cms-index-index cms-home-page">

<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]--> 

<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    <li><a href="index.html" class="home1">Home</a>
      <ul>
        <li><a href="index.html"><span>Home Version 1</span></a></li>
        <li><a href="Version2/index.html"><span>Home Version 2</span></a></li>
        <li><a href="Version3/index.html"><span>Home Version 3</span></a></li>
        <li><a href="Version4/index.html"><span>Home Version 4</span></a></li>
        <li><a href="Version5/index.html"><span>Home Version 5</span></a></li>
        <li><a href="rtl-version/index.html"><span>RTL Version</span></a></li>
        <li><a href="rtl-version1/index.html"><span>Home Version 1 RTL</span></a></li>
      </ul>
    </li>
    <li><a href="contact_us.html">Contact us</a></li>
    <li><a href="about_us.html">About us</a></li>
  </ul>
</div>
<!-- end mobile menu -->
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
              <span class="phone hidden-sm">Call Us: +123.456.789</span> </div>
            
            <!-- top links -->
            <div class="headerlinkmenu col-lg-8 col-md-7 col-sm-8 col-xs-12">
              <div class="links">
                  <?php if(\Auth::check()):?>
                <div class="myaccount"><a title="My Account" href="<?php echo LKS::url_subdomain('account','');?>"><i class="fa fa-user"></i><span class="hidden-xs"><?php echo __('home.my_account');?></span></a></div>
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
            <!-- Search -->
            
            <div class="top-search">
              <div id="search">
                <form>
                  <div class="input-group">
                    <select class="cate-dropdown hidden-xs" name="category_id">
                      <option><?php echo __('home.all_categories');?></option>
                      <?php foreach($categories as $cat):?>
                       <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                      <?php endforeach;?>
                    </select>
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- End Search --> 
          </div>
          <!-- top cart -->
          
          <div class="col-lg-3 col-xs-3 top-cart">
            <div class="top-cart-contain">
              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                  <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                  <div class="shoppingcart-inner hidden-xs"><span class="cart-title">Shopping Cart</span> <span class="cart-total">4 Item(s): $520.00</span></div>
                  </a></div>
                <div>
                  <div class="top-cart-content">
                    <div class="block-subtitle hidden-xs">Recently added item(s)</div>
                    <ul id="cart-sidebar" class="mini-products-list">
                      <li class="item odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="http://via.placeholder.com/700x800" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Lorem ipsum dolor sit amet Consectetur</a> </p>
                          <strong>1</strong> x <span class="price">$20.00</span> </div>
                      </li>
                      <li class="item even"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="http://via.placeholder.com/700x800" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Consectetur utes anet adipisicing elit</a> </p>
                          <strong>1</strong> x <span class="price">$230.00</span> </div>
                      </li>
                      <li class="item last odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="http://via.placeholder.com/700x800" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Sed do eiusmod tempor incidist</a> </p>
                          <strong>2</strong> x <span class="price">$420.00</span> </div>
                      </li>
                    </ul>
                    <div class="top-subtotal">Subtotal: <span class="price">$520.00</span></div>
                    <div class="actions">
                      <button class="btn-checkout" type="button"><i class="fa fa-check"></i><span>Checkout</span></button>
                      <button class="view-cart" type="button"><i class="fa fa-shopping-cart"></i> <span>View Cart</span></button>
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
  
  <!-- Navbar -->
  <nav>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4">
          <div class="mm-toggle-wrap">
            <div class="mm-toggle"> <i class="fa fa-align-justify"></i> </div>
            <span class="mm-label">Categories</span> </div>
          <div class="mega-container visible-lg visible-md visible-sm">
            <div class="navleft-container">
              <div class="mega-menu-title">
                <h3><?php echo __('home.product_category');?></h3>
              </div>
              <div class="mega-menu-category" <?php echo (isset($category)?' style="display:none" ':'');?>>
                <ul class="nav">
                    <?php foreach($categories as $cat):?>
                    <li class="nosub"><a href="<?php echo url('category/'.$cat->slug);?>"><i class="icon fa fa-location-arrow fa-fw"></i> <?php echo $cat->name;?></a></li>
                    <?php endforeach;?>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9 col-sm-8">
          <div class="mtmegamenu">
            <ul>
                <li class="mt-root">
                <div class="mt-root-item"><a href="<?php echo url('');?>">
                  <div class="title title_font"><span class="title-text"><?php echo __('home.home');?></span> </div>
                  </a></div>
              </li>
 
             <?php for($i=0;$i<count($categories);$i++):
                if($i==2)
                break;
             ?>
              <li class="mt-root">
                <div class="mt-root-item"><a href="<?php echo url('category/'.$categories[$i]->slug);?>">
                  <div class="title title_font"><span class="title-text"><?php echo $categories[$i]->name;?></span> </div>
                  </a></div>
              </li>
             <?php endfor;?>
          
              <li class="mt-root">
                <div class="mt-root-item"><a href="about_us.html">
                  <div class="title title_font"><span class="title-text"><?php echo __('home.about_us');?></span></div>
                  </a></div>
              </li>
                
    
              <li class="mt-root">
                <div class="mt-root-item"><a href="<?php echo LKS::url_subdomain('manage','shops');?>">
                  <div class="title title_font"><span class="title-text"><?php echo __('home.open_shop');?></span></div>
                </a></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
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
              <li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="https://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
              <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
              <li class="social-network linkedin"><a title="Connect us on Linkedin" target="_blank" href="https://www.pinterest.com/"><i class="fa fa-linkedin"></i></a></li>
              <li class="social-network rss"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/"><i class="fa fa-rss"></i></a></li>
              <li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
          <div class="footer-logo"><a href="index.html"><img src="images/footer-logo.png" alt="fotter logo"></a> </div>
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
  <!--Newsletter Popup Start-->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog newsletter-popup" style="background-image:url(<?php echo url('assets/web/images/newsletter.jpg');?>)">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="modal-body">
          <h4 class="modal-title"><?php echo __('home.signup_for_newsletter');?></h4>
          <form id="newsletter-form" method="post" action="#">
            <div class="content-subscribe">
              <div class="form-subscribe-header">
                <label>ระบุอีเมล์ของท่านเพื่อไม่ให้พลาดสินค้าราคาพิเศษจากเรา</label>
              </div>
              <div class="input-box">
                <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="email" placeholder="<?php echo __('home.please_enter_email');?>">
              </div>
              <div class="actions">
                <button class="button-subscribe" title="Subscribe" type="submit"><?php echo __('home.subscribe');?></button>
              </div>
            </div>
          </form>
          <div class="subscribe-bottom">
            <input name="notshowpopup" id="notshowpopup" type="checkbox">
            ไม่แสดงข้อความนี้อีก </div>
        </div>
      </div>
    </div>
  </div>
  <!--End of Newsletter Popup--> 
</div>

<!-- JS --> 

<!-- jquery js --> 
<script src="<?php echo url('assets/web/js/jquery.min.js');?>"></script> 

<!-- bootstrap js --> 
<script src="<?php echo url('assets/web/js/bootstrap.min.js');?>"></script> 

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

<!-- jquery.mobile-menu js --> 
<script src="<?php echo url('assets/web/js/mobile-menu.js');?>"></script> 

<!--jquery-ui.min js --> 
<script src="<?php echo url('assets/web/js/jquery-ui.js');?>"></script> 

<!-- main js --> 
<script src="<?php echo url('assets/web/js/main.js');?>"></script> 




</body>
</html>
@yield('js')