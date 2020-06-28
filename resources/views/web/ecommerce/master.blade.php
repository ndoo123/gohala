<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Gohala</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
    <!-- GOOGLE WEB FONT -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet"> -->
    <style>
     
    </style>
    <!-- BASE CSS -->
    <link href="<?php echo url('');?>/assets/web/css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="<?php echo url('');?>/assets/web/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo url('assets/web/js/plugins/toastr/toastr.min.css');?>"></link>
	<!-- SPECIFIC CSS -->
    <link href="<?php echo url('');?>/assets/web/css/home_1.css" rel="stylesheet">
    @yield('css')

    <!-- YOUR CUSTOM CSS -->
    <link href="<?php echo url('');?>/assets/web/css/custom.css" rel="stylesheet">

</head>

<body>
	<?php if(isset($shop)):?>
	<input type="hidden" id="shop_url" value="<?php echo url($shop->url);?>">
	<div id="page" current_page="" last_page="" next_page_url="<?php echo url($shop->url);?>/get/prooduct/json">
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		<div class="main_header">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
						<div id="logo">
							<a href="<?php echo url($shop->url);?>"><img src="<?php echo url('');?>/assets/images/logo-dark.png" alt=""  height="35"></a>
						</div>
					</div>
					<nav class="col-xl-6 col-lg-7">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<a href="<?php echo url($shop->url);?>"><img src="<?php echo url('');?>/assets/images/logo-dark.png" alt="" height="35"></a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								
								<li>
									<a href="<?php echo url($shop->url);?>">หน้าแรก</a>
								</li>
								<li>
									<a href="#0">ติดต่อเรา</a>
								</li>
							</ul>
						</div>
						<!--/main-menu -->
					</nav>
					<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
						
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->

		<div class="main_nav Sticky">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 col-md-3">
						<nav class="categories">
							<ul class="clearfix">
								<li><span>
										<a href="#">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											หมวดหมู่สินค้า
										</a>
									</span>
									<div id="menu">
										<ul>
                                            <?php foreach($categories as $cat):?>
											<li><a href="<?php echo $cat->get_link($shop->url);?>"><?php echo $cat->name;?></a></li>
                                            <?php endforeach;?>
											
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
						<div class="custom-search-input">
							<input type="text" placeholder="Search over 10.000 products">
							<button type="submit"><i class="header-icon_search_custom"></i></button>
						</div>
					</div>
					<div class="col-xl-3 col-lg-2 col-md-3">
                        <?php
                         $html='';
                            $qty=0;
                            $total=0;
                            $count_item=0;
                            $basket=\Cart::get_cart();
                        
                            foreach($basket as $b)
                            {
                                $count_item+=count($b['items']);
                            $html.='<ul shop_id="'.$b['shop_id'].'"><li class="title">'.$b['name'].'</li>';
                            foreach($b['items'] as $item){
                                $qty+=$item['qty'];
                                $total+=$item['qty']*$item['price'];
                                $html.='<li class="item" product_id="'.$item['product_id'].'">';
									$html.='<a href="'.$item['link'].'">';
									$html.='<figure><img src="'.$item['img'].'" data-src="'.$item['img'].'" alt="" width="50" height="50" class="lazy"></figure>';
									$html.='<strong><span class="price" price="'.$item['price'].'"><span class="qty">'.$item['qty'].'</span>x '.$item['name'].'</span> '.number_format($item['price'],2).'</strong>';
									$html.='</a>';
									$html.='<a href="javascript:;" onclick="remove_from_cart('.$item['product_id'].','.$b['shop_id'].')" class="action"><i class="ti-trash"></i></a>';
									$html.='</li>';
                            }
                            $html.='</ul>';
                            }?>
						<ul id="cart_top" class="top_tools">
							<li>
								<div class="dropdown dropdown-cart">
									<a href="javascript:;" class="cart_bt"><strong style="display:<?php echo $count_item>0?'block':'none';?>"><?php echo $count_item;?></strong></a>
									<div class="dropdown-menu">
                                        	<?php echo $html;?>
										<div class="total_drop">
											<div class="clearfix"><strong>รวม</strong><span class="total"><?php echo number_format($total,2);?></span></div>
											<a href="<?php echo url('cart');?>" class="btn_1 outline">ดูตระกร้า</a><a href="checkout.html" class="btn_1">ชำระเงิน</a>
										</div>
									</div>
								</div>
								<!-- /dropdown-cart-->
							</li>
							<li>
								<!-- <a href="#0" class="wishlist"><span>Wishlist</span></a> -->
							</li>
							<li>
								<div class="dropdown dropdown-access">
									<a href="account.html" class="access_link"><span>Account</span></a>
									<div class="dropdown-menu">
										<a href="account.html" class="btn_1">Sign In or Sign Up</a>
										<ul>
											<li>
												<a href="track-order.html"><i class="ti-truck"></i>Track your Order</a>
											</li>
											<li>
												<a href="account.html"><i class="ti-package"></i>My Orders</a>
											</li>
											<li>
												<a href="account.html"><i class="ti-user"></i>My Profile</a>
											</li>
											<li>
												<a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
											</li>
										</ul>
									</div>
								</div>
								<!-- /dropdown-access-->
							</li>
							<li>
								<a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
							</li>
							<li>
								<a href="#menu" class="btn_cat_mob">
									<div class="hamburger hamburger--spin" id="hamburger">
										<div class="hamburger-box">
											<div class="hamburger-inner"></div>
										</div>
									</div>
									Categories
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="search_mob_wp">
				<input type="text" class="form-control" placeholder="Search over 10.000 products">
				<input type="submit" class="btn_1 full-width" value="Search">
			</div>
			<!-- /search_mobile -->
		</div>
		<!-- /main_nav -->
	</header>
	<!-- /header -->
	<?php endif;?>
	<main>
		<div class="container pt-3">
            @yield('content')
		</div>
		<!-- /container -->
        

	</main>
	<!-- /main -->
		
			<footer class="revealed">
		<div class="container">
			<div class="row ">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
						<li>
							<div class="styled-select lang-selector">
								<select>
									<option value="English" selected>English</option>
									<option value="French">French</option>
									<option value="Spanish">Spanish</option>
									<option value="Russian">Russian</option>
								</select>
							</div>
						</li>
						<li>
							<div class="styled-select currency-selector">
								<select>
									<option value="US Dollars" selected>US Dollars</option>
									<option value="Euro">Euro</option>
								</select>
							</div>
						</li>
						<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="additional_links">
						<li><a href="#0">Terms and conditions</a></li>
						<li><a href="#0">Privacy</a></li>
						<li><span>© 2020 Allaia</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="<?php echo url('');?>/assets/web/js/common_scripts.min.js"></script>
    <script src="<?php echo url('');?>/assets/web/js/main.js"></script>
    <script src="<?php echo url('');?>/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="<?php echo url('');?>/assets/web/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo url('');?>/assets/js/plugins/currency.min.js"></script>
    <script src="<?php echo url('');?>/assets/js/plugins/blockUI.js"></script>
    <script src="<?php echo url('');?>/assets/js/lks.js"></script>

    <script src="<?php echo url('');?>/assets/web/js/cart.js"></script>

  
    <script>
		var app=new LKS();
    </script>
    
    @yield('js')
 
</body>
</html>