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

</style>
</head>
<body>
<!-- header -->
<div class="header" id="home">
	<div class="container">
		<ul>
		    <li> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign In </a></li>
			<li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up </a></li>
			<li><i class="fa fa-phone" aria-hidden="true"></i> Call : +962 790714916</li>
			<li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:info@example.com">jordan.stores@gmail.com</a></li>
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
			<h3 style="margin-top:15px;">Multi-vendors Ecommerce</h3>
		</div>
		<!-- header-bot -->
			<div class="col-md-4 logo_agile">
				<h1><a href="index.html"><span>J</span>ordan Stores</a></h1>
			</div>
        <!-- header-bot -->
		<div class="col-md-4 agileits-social top_content">
            <ul class="social-nav model-3d-0 footer-social w3_agile_social">
                <li class="share">Share On : </li>
                <li><a href="#" class="facebook">
                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
                <li><a href="#" class="twitter"> 
                        <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
                <li><a href="#" class="instagram">
                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
                <li><a href="#" class="pinterest">
                        <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
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
									<div class="col-sm-6 multi-gd-img1 multi-gd-text ">
										<a href="mens.html"><img src="{{asset('pub_libraries/images/banner3.jpg')}}" alt=" "/></a>
									</div>
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown row">
                                            @foreach ($categories as $category)
                                            <div class="col-sm-4 text-center">
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
									<div class="col-sm-6 multi-gd-img1 multi-gd-text ">
                                        <a href="{{route('provider.all2')}}"><strong>All Stores</strong></a><br>
										<a href="mens.html"><img src="{{asset('img/store.jpg')}}" alt=" "/></a>
									</div>
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown row">
                                            @foreach ($providers as $provider)
                                            <div class="col-sm-4 text-center">
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
					<li class=" menu__item @if($pageTitle == "Shopping Cart") menu__item menu__item--current @endif"><a class="menu__link" href="contact.html">Shopping Cart</a></li>
				  </ul>
				</div>
			  </div>
			</nav>	
		</div>
		<div class="top_nav_right">
			<div class="wthreecartaits wthreecartaits2 cart cart box_1">
                <a href=""> 
                    <button class="w3view-cart" type="submit" name="submit" value="" style="width:100px;"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <small id="cart_count"><strong>{{session('counter') ? session('counter') : 0}}</strong></small></button>
                </a>
            </div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //banner-top -->
<!-- Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body modal-body-sub_agile">
                <div class="col-md-8 modal_body_left modal_body_left1">
                <h3 class="agileinfo_sign">Sign In <span>Now</span></h3>
                            <form action="#" method="post">
                    <div class="styled-input agile-styled-input-top">
                        <input type="text" name="Name" required="">
                        <label>Name</label>
                        <span></span>
                    </div>
                    <div class="styled-input">
                        <input type="email" name="Email" required=""> 
                        <label>Email</label>
                        <span></span>
                    </div> 
                    <input type="submit" value="Sign In">
                </form>
                  <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
                                                    <li><a href="#" class="facebook">
                                                          <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="twitter"> 
                                                          <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="instagram">
                                                          <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="pinterest">
                                                          <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <p><a href="#" data-toggle="modal" data-target="#myModal2" > Don't have an account?</a></p>

                </div>
                <div class="col-md-4 modal_body_right modal_body_right1">
                    <img src="{{asset('images/log_pic.jpg')}}" alt=" "/>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
<!-- //Modal1 -->
<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <div class="modal-body modal-body-sub_agile">
                <div class="col-md-8 modal_body_left modal_body_left1">
                <h3 class="agileinfo_sign">Sign Up <span>Now</span></h3>
                 <form action="#" method="post">
                    <div class="styled-input agile-styled-input-top">
                        <input type="text" name="Name" required="">
                        <label>Name</label>
                        <span></span>
                    </div>
                    <div class="styled-input">
                        <input type="email" name="Email" required=""> 
                        <label>Email</label>
                        <span></span>
                    </div> 
                    <div class="styled-input">
                        <input type="password" name="password" required=""> 
                        <label>Password</label>
                        <span></span>
                    </div> 
                    <div class="styled-input">
                        <input type="password" name="Confirm Password" required=""> 
                        <label>Confirm Password</label>
                        <span></span>
                    </div> 
                    <input type="submit" value="Sign Up">
                </form>
                  <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
                                                    <li><a href="#" class="facebook">
                                                          <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="twitter"> 
                                                          <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="instagram">
                                                          <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
                                                    <li><a href="#" class="pinterest">
                                                          <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                                                          <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <p><a href="#">By clicking register, I agree to your terms</a></p>

                </div>
                <div class="col-md-4 modal_body_right modal_body_right1">
                    <img src="{{asset('images/log_pic.jpg')}}" alt=" "/>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
<!-- //Modal2 -->