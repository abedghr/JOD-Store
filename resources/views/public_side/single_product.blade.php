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
					<h3 class="js-name-detail">{{$product->prod_name}}</h3>
					<p><span class="item_price">{{number_format($product->new_price,2)}} JOD</span> <del> {{number_format($product->old_price,2)}} JOD</del></p>
                    <a class="active" href="#">
                        <span>Category</span> : <strong class="text-dark">{{$product->cat->cat_name}}</strong>
                    </a>
                    <a class="active" href="{{route('public_provider.profile2',['id'=>$product->provider])}}"><br>
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
							<h5>Quantity :</h5>
							<input type="number" name="qty" id="sst" class="form-control qty" style="width: 80px;" min="1" max="30" value="1">
						</div>
					</div><br>
					<div class="occasion-cart">
						<button class="hvr-outline-out button2 btn text-light js-addcart-detail" id="addCart" style="border-radius: 0px !important;">ADD TO CART</button>												
					</div>
		      </div>
	 			<div class="clearfix"> </div>
	<!--================Product Description Area =================-->
	<section class="product_description_area mt-4">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content mt-2" id="myTabContent" style="padding:0px !important;border-bottom: 0px !important;">
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" style="border-bottom: 1px solid #eee;				">
					<div class="row">
						<div class="col-lg-6 comments-box" style="overflow-y: scroll; height:270px;">
							<div class="comment_list" id="comment_list">
								
									@foreach ($comments as $comment)
									<div class="review_item" style="margin-bottom: 15px;">
										<div class="media">
											<div class="media-body pl-4 pt-3 pr-3">
                                                <h4>{{$comment->user->name}}</h4>
												<small style="font-size:11px;">{{$comment->created_at->format('Y-m-d')}}</small>
												@if (isset($user))
													@if ($comment->user_id == $user['user_id'])
													<a class="btn-danger text-light reply_btn mr-3" onclick="delete_comment({{$comment->id}})" id="delete_comment"><i class="fa fa-trash text-light"></i></a>	
													@endif
												@endif
											</div>
										</div>
										<p class="pl-4 mt-1">{{$comment->comment}}</p>
									</div>
									<hr>
									@endforeach
										
								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form p-2" onclick="event.preventDefault()" method="post" id="contactForm" novalidate="novalidate">
									@csrf
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Enter your comment"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										@if (isset($user))
										<button class="btn submit_btn" id="comment_btn" style="background-color: #2fdab8">Comment</button>	
										@else
										<button class="btn btn-primary" disabled title="You Must be login" style="background-color: #2fdab8">Comment</button>	
										@endif
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade active in" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div>
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-12">
									<div class="box_total">
										<h5 class="mb-2">Product Rate</h5>
										<a href="#" style="color:#2fdab8;">
											<i class="fa fa-star fa-4x"></i>
											<h4 class="text-dark">{{$product_rate}} STAR</h4>
										</a>
										@if (isset($rating[0]))
										<div class="rating_list text-left mt-2 ml-4" id="yourRateBox">
											<h3>Your Rate:</h3>
											<ul class="list" style="color:#2fdab8">
												<li>	
													<a href="#" class="text-dark">{{$rating[0]->rating}} STAR
													@for ($i = 0; $i < $rating[0]->rating; $i++)
														<i class="fa fa-star" style="color:#2fdab8"></i>
													@endfor	
													</a>	
												</li>
											</ul>
										</div>
									@endif
									</div>
								</div>
								<div class="col-12" >
									
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							@if (isset($user))
							<div class="review_box">
								<h4 style="padding: 20px; background-color: #f9f9ff; margin: 15px;
								">Add a Review</h4>
								<div class="pb-2 ml-3">
									<a id="star5" style="cursor:pointer">
										<ul class="list" style="color:#2fdab8;">
											<li>
												<label class="text-dark">5 Star</label>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
											</li>
										</ul>
									</a><br>
									<a id="star4" style="cursor:pointer">
										<ul class="list" style="color:#2fdab8">
											<li>
												<label class="text-dark">4 Star</label>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
											</li>
										</ul>
									</a><br>
									<a id="star3" style="cursor:pointer">
										<ul class="list" style="color:#2fdab8">
											<li>
												<label class="text-dark">3 Star</label>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
											</li>
										</ul>
									</a><br>
									<a id="star2" style="cursor:pointer">
										<ul class="list" style="color:#2fdab8">
											<li>
												<label class="text-dark">2 Star</label>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
											</li>
										</ul>
									</a><br>
									<a id="star1" style="cursor:pointer">
										<ul class="list" style="color:#2fdab8">
											<li>
												<label class="text-dark">1 Star</label>
													<i class="fa fa-star"></i>
											</li>
										</ul>
									</a>
								</div>
							</div>
							@endif

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
	
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
{{-- <script type="text/javascript" src="{{asset('pub_libraries/js/bootstrap.js')}}"></script> --}}
@if (isset($user)){
	<script type="text/javascript">
		$(document).ready(function() {
            $('#review-tab').click(function(){
                $(this).addClass('active');
                $("#contact-tab").removeClass('active');
            });
            $('#contact-tab').click(function(){
                $(this).addClass('active');
                $("#review-tab").removeClass('active');
            });
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
                        $("#sst").val(1);
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
                        $("#sst").val(1);
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
