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
	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
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

	<?php

	$url = url('');
	$arr_url = explode('.',$url);
	$extend = end($arr_url);
	// dd($url,$arr_url,$extend);
	if($extend == 'com')
	{
		echo '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">';
	}
	?>
</head>

<body>
	@include('web.ecommerce.header')
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
							{{-- <a href="//"> --}}
							<a href="{{ !empty($shop) && !empty($shop->get_url()) ? $shop->get_url() : url('') }}">
								<img src="{{ url('').'/assets/images/logo-dark.png' }}" data-src="{{ url('').'/assets/images/logo-dark.png' }}" alt="" height="50" class="lazy" style="background: white;border-radius: 5px">
							</a>
						</li>
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
						{{-- <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li> --}}
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
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="<?php echo url('');?>/assets/js/lks.js"></script>

    <script src="<?php echo url('');?>/assets/web/js/cart.js"></script>

  
    <script>
		var app=new LKS();
    </script>
    
    @yield('js')
 
</body>
</html>