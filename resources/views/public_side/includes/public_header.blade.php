<!DOCTYPE html>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<!--/tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elite Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//tags -->

<link rel="stylesheet" href="{{asset('/pub_libraries/css/flexslider.css')}}" type="text/css" media="screen" />
<link href="{{asset('/pub_libraries/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('/pub_libraries/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('/pub_libraries/css/font-awesome.css')}}" rel="stylesheet"> 
<link href="{{asset('/pub_libraries/css/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css'/>
<!-- //for bootstrap working -->
<link href="fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href='fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>


<style>
    .swal-button {
    background-color: #2fdab8 !important;
    border-radius: 0px !important;
}
.pagination {
    margin: 0px !important;
}
.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #2fdab8;
}
.track .step.active-failed:before {
    background: red
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #2fdab8;
    color: #fff
}
.track .step.active-failed .icon {
    background: red;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.itemside .aside {
    position: relative;
    -ms-flex-negative: 0;
    flex-shrink: 0
}
.tab-content>.active {
    display: block !important;
}
.product_description_area .tab-content .total_rate .box_total {
    background: #f9f9ff;
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px;
}
.review_box h4 {
    font-size: 24px;
    color: #222222;
    margin-bottom: 20px;
}
.review_box .list {
    display: inline-block;
    padding-left: 10px;
    padding-right: 10px;
}
.list {
    list-style: none;
    margin: 0px;
    padding: 0px;
}
.product_description_area .nav.nav-tabs {
    background: #f9f9ff;
    text-align: center !important;
    display: block;
    border: none;
    padding: 10px 0px;
    width:100%;
}
.product_description_area .nav.nav-tabs li a {
    padding: 0px;
    border: none;
    line-height: 38px;
    background: #fff;
    border: 1px solid #eeeeee;
    border-radius: 0px;
    padding: 0px 30px;
    color: #222222;
    font-size: 13px;
    font-weight: normal;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.product_description_area .tab-content {
    border-left: 1px solid #eee;
    border-right: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 30px;
}
.product_description_area .tab-content .total_rate .box_total h5 {
    color: #222222;
    margin-bottom: 0px;
    font-size: 24px;
}
.review_box h4 {
    font-size: 24px;
    color: #222222;
    margin-bottom: 20px;
}
.review_item .media .media-body h5 {
    font-size: 13px !important;
    font-weight: normal !important;
    color: #777777 !important;
}
.review_item .media .media-body .reply_btn {
    border: 1px solid #e0e0e0;
    padding: 0px 28px;
    display: inline-block;
    line-height: 32px;
    border-radius: 16px;
    font-size: 14px;
    font-family: "Roboto", sans-serif;
    color: #222222;
    position: absolute;
    right: 0px;
    top: 14px;
}
.product_description_area .tab-content .total_rate .box_total h4 {
    color: #2fdab8;
    font-size: 48px;
    font-weight: bold;
}
.product_description_area .tab-content .total_rate .box_total h5 {
    color: #222222;
    margin-bottom: 0px;
    font-size: 24px;
}
.product_description_area .nav.nav-tabs li a.active {
    background: #2fdab8;
    color: #fff;
    border-color: #2fdab8;
}
.review_item .media .media-body {
    vertical-align: middle;
    align-self: center;
}
comments-box {
    height: 300px !important;
    overflow-y: scroll;
}
.review_item .media .media-body .reply_btn {
    background-color: #2fdab8 !important;
    cursor: pointer;
}
.order_details .title_confirmation {
    text-align: center;
    color: #28d500;
    font-size: 18px;
    margin-bottom: 80px;
}
.order_d_inner .details_item .list {
    padding-left: 18px;
}
.list {
    list-style: none;
    margin: 0px;
    padding: 0px;
}
.order_d_inner .details_item .list li {
    margin-bottom: 8px;
}
.order_d_inner .details_item .list li a span {
    width: 145px;
    display: inline-block;
    color: #777777;
}
.header ul li {
    width: 49% !important;
    border-right: none !important;
}
@media (max-width: 384px)
.carousel-indicators {
    bottom: -10% !important;
}
</style>
</head>
<body>
<!-- header -->
<div class="header" id="home">
	<div class="container">
		<ul>
            @if (isset($user))
		    <li> <a href="{{route('user.profile2')}}"><i class="fa fa-user" aria-hidden="true"></i> {{$user['userName']}} </a></li>
			<li> <a href="{{route('user.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a></li>
			@else
            <li> <a href="/login"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign In </a></li>
			<li> <a href="{{route('view.register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up </a></li>
            @endif
           
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
			<h4 style="margin-top:15px;" class="text-center">Multi-vendors Ecommerce</h4>
		</div>
		<!-- header-bot -->
			<div class="col-md-4 logo_agile">
				<h1><a href="{{route('home2')}}"><span>J</span>ordan Stores</a></h1>
			</div>
        <!-- header-bot -->
		<div class="col-md-4 agileits-social top_content">
            <ul class="social-nav model-3d-0 footer-social w3_agile_social">
                <li class="share">Share On : </li>
                <li><a href="#" class="facebook">
                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
                <li><a href="#" class="instagram">
                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
            </ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //header-bot -->
<!-- banner -->
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav menu__list">
					<li class="active @if($pageTitle == "Home") menu__item menu__item--current @endif"><a class="menu__link" href="{{route('home2')}}">Home <span class="sr-only">(current)</span></a></li>
					<li class="dropdown menu__item @if($pageTitle == "home") menu__item menu__item--current @endif">
						<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="agile_inner_drop_nav_info">
									<div class="col-sm-12 multi-gd-img">
										<ul class="multi-column-dropdown row">
                                            <div class="col-sm-4 text-left">
                                            <li><a href="{{route('product.all2')}}"><strong>Shop all</strong></a></li>
                                            </div>
                                            @foreach ($categories as $category)
                                            <div class="col-sm-4 text-left">
                                            <li><a href="{{route('category.show2',['id'=>$category->id])}}">{{$category->cat_name}}</a></li>
                                            </div>
                                            @endforeach
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
					</li>
					<li class="dropdown menu__item @if($pageTitle == "Stores") menu__item menu__item--current @endif">
						<a href="#" class="dropdown-toggle menu__link " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stores<span class="caret"></span></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="agile_inner_drop_nav_info">
									<div class="col-sm-12 multi-gd-img">
										<ul class="multi-column-dropdown row">
                                            <div class="col-sm-4 text-left">
                                            <li><a href="{{route('provider.all2')}}"><strong>All Stores</strong></a></li>
                                            </div>
                                            @foreach ($providers as $provider)
                                            <div class="col-sm-4 text-left">
                                            <li><a href="{{route('public_provider.profile2',['id'=>$provider->id])}}">{{$provider->name}}</a></li>
                                            </div>
                                            @endforeach						
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
					</li>
					{{-- <li class="dropdown menu__item">
						<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Women's wear <span class="caret"></span></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="agile_inner_drop_nav_info">
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li><a href="womens.html">Clothing</a></li>
											<li><a href="womens.html">Wallets</a></li>
											<li><a href="womens.html">Footwear</a></li>
											<li><a href="womens.html">Watches</a></li>
											<li><a href="womens.html">Accessories</a></li>
											<li><a href="womens.html">Bags</a></li>
											<li><a href="womens.html">Caps & Hats</a></li>
										</ul>
									</div>
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li><a href="womens.html">Jewellery</a></li>
											<li><a href="womens.html">Sunglasses</a></li>
											<li><a href="womens.html">Perfumes</a></li>
											<li><a href="womens.html">Beauty</a></li>
											<li><a href="womens.html">Shirts</a></li>
											<li><a href="womens.html">Sunglasses</a></li>
											<li><a href="womens.html">Swimwear</a></li>
										</ul>
									</div>
									<div class="col-sm-6 multi-gd-img multi-gd-text ">
										<a href="womens.html"><img src="{{asset('images/top1.jpg')}}" alt=" "/></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
					</li> --}}
					{{-- <li class="menu__item dropdown">
					   <a class="menu__link" href="#" class="dropdown-toggle" data-toggle="dropdown">Short Codes <b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="icons.html">Web Icons</a></li>
									<li><a href="typography.html">Typography</a></li>
								</ul>
					</li> --}}
					<li class=" menu__item @if($pageTitle == "Contact Us") menu__item menu__item--current @endif"><a class="menu__link" href="{{route('contact-us2')}}">Contact</a></li>
					<li class=" menu__item @if($pageTitle == "Tracking Order") menu__item menu__item--current @endif"><a class="menu__link " href="{{route('order.tracking2')}}">Tracking Order</a></li>
					<li class=" menu__item @if($pageTitle == "Shopping Cart") menu__item menu__item--current @endif"><a class="menu__link" href="{{route('cart.index2')}}">Shopping Cart</a></li>
				  </ul>
				</div>
			  </div>
			</nav>	
		</div>
		<div class="top_nav_right">
			<div class="wthreecartaits wthreecartaits2 cart cart box_1">
                <a href="{{route('cart.index2')}}"> 
                    <button class="w3view-cart" type="submit" name="submit" value="" style="width:65px;"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <small id="cart_count"><strong>{{session('counter') ? session('counter') : 0}}</strong></small></button>
                </a>
            </div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //banner-top -->
