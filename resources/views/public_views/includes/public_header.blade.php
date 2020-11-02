<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{asset('public_libraries/img/lookalikelogo.jpg')}}" type="image/jpg">
    <title>{{$pageTitle ? $pageTitle : 'Default'}}</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('public_libraries/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/linericon/style.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/owl-carousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/lightbox/simpleLightbox.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/nice-select/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/animate-css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/vendors/jquery-ui/jquery-ui.css')}}">
	<!-- main css -->
	<link rel="stylesheet" href="{{asset('public_libraries/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/css/mystyles.css')}}">
	<link rel="stylesheet" href="{{asset('public_libraries/css/responsive.css')}}">
</head>

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
			<div class="container-fluid">
				<div class="float-left">
					<ul class="right_side">
						<li>
							Multi-vendors Ecommerce
						</li>
					</ul>
				</div>
				<div class="float-right">
					<ul class="right_side">
						
						@if ($user != null || $user != [])
						<li>
							<span><a href="">{{$user['userName']}}</a></span>
						</li>
						<li>
							<span><a href="{{route('user.logout')}}" class="ml-0">Logout</a></span>
						</li>
						@else
						<li>
							<span><a href="/login">Login</a></span>
						</li>
						<li>
							<span><a href="{{route('view.register')}}" class="ml-0">Register</a></span>
						</li>
						@endif
						
					</ul>
				</div>
			</div>
		</div>
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="">
                        {{-- <img src="{{asset('public_libraries/img/logo.png')}}" alt=""> --}}
                       <h3>Jordan<sup><small class="text-primary">Store</small></sup></h3>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					 aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<div class="row w-100">
							<div class="col-lg-8 pr-0">
								<ul class="nav navbar-nav center_nav pull-right">
									<li class="nav-item @if ($pageTitle == "Home") active @endif ">
										<a class="nav-link" href="{{route('home')}}">Home</a>
									</li>
									<li class="nav-item @if ($pageTitle == "Shop") active @endif">
										<a href="{{route('product.all')}}" class="nav-link" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
									</li>
									<li class="nav-item @if ($pageTitle == "Vendors") active @endif">
										<a href="{{route('provider.all')}}" class="nav-link" role="button" aria-haspopup="true" aria-expanded="false">Vendors</a>
									</li>
									<li class="nav-item @if ($pageTitle == "Contact Us") active @endif">
										<a class="nav-link" href="{{route('contact-us')}}">Contact</a>
									</li>
									<li class="nav-item @if ($pageTitle == "Tracking Order") active @endif">
										<a class="nav-link" href="{{route('order.tracking')}}">Tracking order</a>
									</li>
									<li class="nav-item @if ($pageTitle == "Cart Shopping") active @endif">
										<a class="nav-link" href="{{route('cart.index')}}">Shopping Cart</a>
									</li>
								</ul>
							</div>

							<div class="col-lg-4">
								<ul class="nav navbar-nav navbar-right right_nav pull-right">

									<hr>
                                    <li class="nav-item">
										<a href="#" class="icons">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									</li>
                                    <hr>

									<li class="nav-item">
										<a href="{{route('cart.index')}}" class="icons">
											<i class="fa fa-shopping-cart"></i>
											<small id="cart_count" class="text-danger"><strong>{{session('counter') ? session('counter') : 0}}</strong></small>
										</a>
									</li>

									<hr>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->
  {{--   <br><br><br><br><br> --}}