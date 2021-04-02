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
							{{-- <a href="{{ url($shop->url) }}"><img src="{{ url('')./assets/images/logo-dark.png }}" alt=""  height="35"></a> --}}
							<a href="{{ url($shop->url) }}">
								<img src="{{ $shop->get_photo() }}" alt="" class="img_logo"  height="66" style="border-radius: 0%;">
								{{-- {{ $shop->name }} --}}
							</a>
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
								{{-- <li>
									<a href="#0">ติดต่อเรา</a>
								</li> --}}
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
											<li><a href="<?php echo url($shop->url);?>">ทั้งหมด</a></li>
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
							<input type="text" id="search_product" name="search_product" placeholder="ค้นหาสินค้าของร้าน {{ $shop->name }}" value="{{ !empty($search)?$search:null }}">
							<button type="submit" id="btn_search"><i class="header-icon_search_custom"></i></button>
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
								// dd($b);
                                // $count_item+=count($b['items']);
                            $html.='<ul shop_id="'.$b['shop_id'].'"><li class="title">'.$b['name'].'</li>';
                            foreach($b['items'] as $item){
								// dd($item);
								if(empty($item['price']))
									continue;
								else
									$count_item += 1;
								$item['qty'] = (int)$item['qty'];
								$item['price'] = (float)$item['price'];
                                $qty+=$item['qty'];
                                $total+=$item['qty']*$item['price'];
                                $html.='<li class="items" product_id="'.$item['product_id'].'">';
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
									<a href="#" class="cart_bt"><strong style="display:<?php echo $qty>0?'block':'none';?>"><?php echo $qty;?></strong></a>
									<div class="dropdown-menu">
                                        	<?php echo $html;?>
										<div class="total_drop">
											<div class="clearfix"><strong>รวม</strong><span class="total"><?php echo number_format($total,2);?></span></div>
											<a href="{{ url('cart') }}" class="btn_1 outline">ดูตระกร้า</a>
											{{-- <a href="checkout.html" class="btn_1">ชำระเงิน</a> --}}
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
									<?php $user = \Auth::check() ? \Auth::user() : null ?>
									@if (!empty($user))
										
										<a href="#" class="">
											<img style="width: 40px;border-radius: 50%!important;height: 40px;" class="rounded-circle thumb-sm" alt="user" src="
											{{ !empty($user) && !empty($user->get_photo()) ? $user->get_photo() : '' }}
										"></a>
									@else
										<a href="#" class="access_link">
										</a>
									@endif
									<div class="dropdown-menu">
										@if(empty($user))
											<a href="#" class="btn_login btn_1">Sign In or Sign Up</a>
										@endif
										{{-- <a href="account.html" class="btn_1">Sign In or Sign Up</a> --}}
										<ul style="margin-top:{{ !empty($user) ? '0px' : '15px' }}">
											<li>
												@if (!empty($user))
												<a href="{{ LKS::url_subdomain('account','') }}" class="">
													<i class="ti-user"></i>
													{{  !empty($user) && !empty($user->name) ? $user->name : null}}
												</a>
												@endif
											</li>
											{{-- <li>
												<a href="track-order.html"><i class="ti-truck"></i>Track your Order</a>
											</li> --}}
											<li>
												<a href="{{ LKS::url_subdomain('account','profile?op=myorder') }}"><i class="ti-package"></i>My Orders</a>
											</li>
											
											@if(!empty($user))
											<li>
												<a href="{{ LKS::url_subdomain('account','logout') }}" class="">
													<i class="ti-na"></i>
													{{-- <i class="fas fa-sign-in-alt"></i> --}}
													Logout
												</a>
											</li>
											@endif
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