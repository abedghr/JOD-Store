<?php $pageTitle = "Single Product"; ?>
@include('public_side.includes.public_header')
<!--/single_page-->
       <!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Single <span>Page </span></h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li>Single Page</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>

  <!-- banner-bootom-w3-agileits -->
<div class="banner-bootom-w3-agileits">
	<div class="container">
	     <div class="col-md-4 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">
						<li data-thumb="../img/Product_images/{{$product->main_image}}">
							<div class="thumb-image"> <img src="../img/Product_images/{{$product->main_image}}" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                        @foreach ($images as $image)
                        @if ($product->main_image != $image->image)
                        <li data-thumb="../img/Product_images/{{$image->image}}">
							<div class="thumb-image"> <img src="../img/Product_images/{{$image->image}}" data-imagezoom="true" class="img-responsive"> </div>
						</li>    
                        @endif
							
						@endforeach
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-8 single-right-left simpleCart_shelfItem">
					<h3>{{$product->prod_name}}</h3>
					<p><span class="item_price">{{number_format($product->new_price,2)}} JOD</span> <del> {{number_format($product->old_price,2)}} JOD</del></p>
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked="">
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
                    </div>
                    <br>
                    <a class="active" href="#">
                        <span>Category</span> : <strong class="text-dark">{{$product->cat->cat_name}}</strong>
                    </a>
                    <a class="active" href="{{route('public_provider.profile',['id'=>$product->provider])}}"><br>
                        <span>Provider</span> : <strong class="text-dark">{{$product->prov->name}}</strong>
                    </a><br>
                    <a href="#">
                        <span>Availibility</span> : @if ($product->availability == 1)
                            <span class="text-success">Available</span>
                        @else
                        <span class="text-danger">Un-available</span>
                        @endif
                    </a>
                    <div class="description">
						<h5>{{$product->description}}</h5>
					</div>
					<div class="color-quality">
						<div class="color-quality-right">
							<h5>Quality :</h5>
							<input type="number" class="form-control" style="width: 80px;" min="1" max="30" value="1">
						</div>
					</div><br>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="#" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart">
																	<input type="hidden" name="add" value="1">
																	<input type="hidden" name="business" value=" ">
																	<input type="hidden" name="item_name" value="Wing Sneakers">
																	<input type="hidden" name="amount" value="650.00">
																	<input type="hidden" name="discount_amount" value="1.00">
																	<input type="hidden" name="currency_code" value="USD">
																	<input type="hidden" name="return" value=" ">
																	<input type="hidden" name="cancel_return" value=" ">
																	<input type="submit" name="submit" value="Add to cart" class="button">
																</fieldset>
															</form>
														</div>
																			
					</div>
					<ul class="social-nav model-3d-0 footer-social w3_agile_social single_page_w3ls">
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
	 			<div class="clearfix"> </div>
				<!-- /new_arrivals --> 
	<div class="responsive_tabs_agileits"> 
				<div id="horizontalTab">
						<ul class="resp-tabs-list" style="margin-left: -15px;">
							<li>Reviews</li>
							<li>Information</li>
						</ul>
					<div class="resp-tabs-container">
						<div class="tab">
							<div class="row">
                                    <div class="single_page_agile_its_w3ls " style="padding: 0px !important;">
                                        <div class="col-md-6" style="overflow-y:scroll; height:332px;">    
                                            <div class="bootstrap-tab-text-grids">
                                            @foreach ($comments as $comment)
                                            <div class="bootstrap-tab-text-grid">
                                                <div class="bootstrap-tab-text-grid-right"  style="float: none !important; padding-left:20px;">
                                                    <ul>
                                                        <li><a href="#">{{$comment->user->name}}</a><br><small>{{$comment->created_at->format('Y-m-d')}}</small></li>
                                                        
                                                        <li>@if (isset($user))
                                                            @if ($comment->user_id == $user['user_id'])
                                                            <a onclick="delete_comment({{$comment->id}})" id="delete_comment" style="cursor: pointer;"><i class="fa fa-trash-o fa-lg"></i></a>
                                                            @endif
                                                            @endif
                                                        </li>
                                                    </ul>
                                                    <p style="margin-top:5px !important;">{{$comment->comment}}.</p>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <hr>
                                            @endforeach
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">    
                                            <div class="bootstrap-tab-text-grids">
                                            <div class="add-review">
                                                <h4>add a comment</h4>
                                                <form action="#" method="post" style="margin:0px !important;" onclick="event.preventDefault()">
                                                        <textarea name="comment" id="comment" required=""></textarea>
                                                        @if (isset($user))
                                                        <input type="submit" value="SEND" id="comment_btn" style="margin-bottom: 45px">    
                                                        @else
                                                        <button disabled title="You Must be login" class="btn btn-secondary" style="outline: none; padding: 14px 0; background: #2fdab8; border: none; width: 20%; font-size: 1em; color: #fff;font-weight: 700; letter-spacing: 2px;">Send</button>
                                                        @endif
                                                </form>
                                            </div>
                                            </div>
                                        </div>
								</div>
							</div>
						 </div>
						   <div class="tab3">

							<div class="single_page_agile_its_w3ls">
							  <h6>Big Wing Sneakers (Navy)</h6>
							   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore magna aliqua.</p>
							   <p class="w3ls_para">Lorem ipsum dolor sit amet, consectetur adipisicing elPellentesque vehicula augue eget nisl ullamcorper, molestie blandit ipsum auctor. Mauris volutpat augue dolor.Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut lab ore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. labore et dolore magna aliqua.</p>
							</div>
						</div>
					</div>
				</div>	
			</div>
	<!-- //new_arrivals --> 
	  	<!--/slider_owl-->
	
			<div class="w3_agile_latest_arrivals">
			<h3 class="wthree_text_info">Related <span>Products</span></h3>
					@foreach ($related_products as $Rproduct)	
					  	<div class="col-md-3 product-men single">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="../img/Product_images/{{$Rproduct->main_image}}" alt="" class="pro-image-front">
									<img src="../img/Product_images/{{$Rproduct->main_image}}" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{route('product.show2',['id'=>$Rproduct->id])}}" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
								</div>
								<div class="item-info-product ">
									<h4><a href="" class="js-name-detail">{{$Rproduct->prod_name}}</a></h4>
									<p><a href="">Store: {{$Rproduct->prov->name}}</a></p>
									<p>Gender: {{$Rproduct->gender}}</p>
									<div class="info-product-price">
										<span class="item_price">{{number_format($Rproduct->new_price,2)}}JOD</span>
										<del>{{number_format($Rproduct->old_price,2)}}JOD</del>
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
										<input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$Rproduct->id}})" />
									</div>
								</div>
							</div>
						</div>
						@endforeach
						<div class="clearfix"> </div>
					<!--//slider_owl-->
		         </div>
	        </div>
 </div>
<!--//single_page-->
@include('public_side.includes.public_footer')
<!-- js -->
<script type="text/javascript" src="{{asset('pub_libraries/js/jquery-2.1.4.min.js')}}"></script>
<!-- //js -->
<script src="{{asset('pub_libraries/js/modernizr.custom.js')}}"></script>
	<!-- Custom-JavaScript-File-Links --> 
	<!-- cart-js -->
	<script src="{{asset('pub_libraries/js/minicart.min.js')}}"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>

	<!-- //cart-js --> 
	<!-- single -->
<script src="{{asset('pub_libraries/js/imagezoom.js')}}"></script>
<!-- single -->
<!-- script for responsive tabs -->						
<script src="{{asset('pub_libraries/js/easy-responsive-tabs.js')}}"></script>
<script>
	$(document).ready(function () {
	$('#horizontalTab').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion           
	width: 'auto', //auto or any width like 600px
	fit: true,   // 100% fit in a container
	closed: 'accordion', // Start closed if in accordion view
	activate: function(event) { // Callback function if tab is switched
	var $tab = $(this);
	var $info = $('#tabInfo');
	var $name = $('span', $info);
	$name.text($tab.text());
	$info.show();
	}
	});
	$('#verticalTab').easyResponsiveTabs({
	type: 'vertical',
	width: 'auto',
	fit: true
	});
	});
</script>
<!-- FlexSlider -->
<script src="{{asset('pub_libraries/js/jquery.flexslider.js')}}"></script>
						<script>
						// Can also be used with $(document).ready()
							$(window).load(function() {
								$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
								});
							});
						</script>
					<!-- //FlexSlider-->
<!-- //script for responsive tabs -->		
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('pub_libraries/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('pub_libraries/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- here stars scrolling icon -->
<!-- for bootstrap working -->
<script type="text/javascript" src="{{asset('pub_libraries/js/bootstrap.js')}}"></script>
@if (isset($user)){
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/

			$("#addCart").click(function(){
                var quantity = $("#sst").val();
                $.ajax({
                    type: "get",
                    url : "{{route('addtocart')}}",
                    data: {
                        '_token' : "{{csrf_token()}}",
                        'product_id': {{$product->id}},
                        'quantity': quantity,
                    },
                    success:function(data){
                        $('#cart_count').html(data.counter);
                        
                    }
                });
            });
            
            $('#comment_btn').click(function(){
                var comment = $('#comment').val();
                if(comment != ""){
                    $.ajax({
                    type: "POST",
                    url : "{{route('comment.store')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'comment': comment,
                        'prod_id': "{{$product->id}}",
                        'user_id': "{{$user['user_id']}}"
                    },
                    success:function(data){
                        $("#comment_list").html(data);
                        $('#comment').val('');
                        $feed = "Comment done";
                        swal($feed, " ", "success");
                    }
                    });
                }else{
                    $feed = "You must fill the comment box";
                    swal($feed, " ", "error");
                    $('.swal-button').css('background-color','red');
                }
            });
            $("#star5").click(function(){
                $.ajax({
                    type : "GET",
                    url : "{{route('rating.store')}}",
                    data : {
                        'rating':5,
                        'user_id': "{{$user['user_id']}}",
                        'prod_id': "{{$product->id}}"
                    },success:function(data){
                        $feed = "Your Rate is "+data.rating+" Star";
                        swal($feed, " ", "success");
                        $("#yourRateBox").html(data.yourRate);
                    }
                });
            });
            $("#star4").click(function(){
                $.ajax({
                    type : "GET",
                    url : "{{route('rating.store')}}",
                    data : {
                        'rating':4,
                        'user_id': "{{$user['user_id']}}",
                        'prod_id': "{{$product->id}}"
                    },success:function(data){
                        $feed = "Your Rate is "+data.rating+" Star";
                        swal($feed, " ", "success");
                        $("#yourRateBox").html(data.yourRate);
                    }
                });
            });
            $("#star3").click(function(){
                $.ajax({
                    type : "GET",
                    url : "{{route('rating.store')}}",
                    data : {
                        'rating':3,
                        'user_id': "{{$user['user_id']}}",
                        'prod_id': "{{$product->id}}"
                    },success:function(data){
                        $feed = "Your Rate is "+data.rating+" Star";
                        swal($feed, " ", "success");
                        $("#yourRateBox").html(data.yourRate);
                    }
                });
            });
            $("#star2").click(function(){
                $.ajax({
                    type : "GET",
                    url : "{{route('rating.store')}}",
                    data : {
                        'rating':2,
                        'user_id': "{{$user['user_id']}}",
                        'prod_id': "{{$product->id}}"
                    },success:function(data){
                        $feed = "Your Rate is "+data.rating+" Star";
                        swal($feed, " ", "success");
                        $("#yourRateBox").html(data.yourRate);
                    }
                });
            });
            $("#star1").click(function(){
                $.ajax({
                    type : "GET",
                    url : "{{route('rating.store')}}",
                    data : {
                        'rating':1,
                        'user_id': "{{$user['user_id']}}",
                        'prod_id': "{{$product->id}}"
                    },success:function(data){
                        $feed = "Your Rate is "+data.rating+" Star";
                        swal($feed, " ", "success");
                        console.log(data)
                        $("#yourRateBox").html(data.yourRate);
                    }
                });
            });
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
			function delete_comment(id){
				$.ajax({
						type: "GET",
						url : "{{route('comment.destroy')}}",
						data: {
							'comment_id':id,
							'prod_id': "{{$product->id}}"
						},
						success:function(data){
							$("#comment_list").html(data);
						}
					});
        }
	</script>
<!-- //here ends scrolling icon -->
@else
<script>
    $("document").ready(function(){
            $("#addCart").click(function(){
                var quantity = $("#sst").val();
                $.ajax({
                    type: "get",
                    url : "{{route('addtocart')}}",
                    data: {
                        '_token' : "{{csrf_token()}}",
                        'product_id': {{$product->id}},
                        'quantity': quantity,
                    },
                    success:function(data){
                        $('#cart_count').html(data.counter);
                        
                    }
                });
            });
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
</script>
@endif
<script>
    function addca(id){
    var nameProduct = $('.js-addcart-detail').parent().parent().parent().parent().find('.js-name-detail').html();
    swal(nameProduct, "is added to cart !", "success");
    $.ajax({
        type: "get",
        url : "{{route('addtocart')}}",
        data: {
            '_token' : "{{csrf_token()}}",
            'product_id': id,
            'quantity': 1
        },
        success:function(data){
            $('#cart_count').html(data.counter);
            
        }
    });
}
</script>
