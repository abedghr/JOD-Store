<?php 
	$pageTitle = "Single Product";
	ob_start();
?>

@include('public_views.includes.public_header')
	<!--================Single Product Area =================-->
	<div class="single-style mb-5"  style="margin-top: 160px;">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php $i=1; $x=""; ?>
								<li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" hidden>
									<img src="../storage/Product_images/{{$product->main_image}}" width="60" height="60" alt="">
								</li>
								@foreach ($images as $image)
								<li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}">
									<img src="../storage/Product_images/{{$image->image}}" width="60" height="60" alt="">
								</li>
								
								<?php $i++; $x=$image->image; ?>
								@endforeach
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="../storage/Product_images/{{$product->main_image}}">
								</div>
								@foreach ($images as $item)
								<div class="carousel-item">
									<img class="d-block w-100" src="../storage/Product_images/{{$item->image}}">
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<strong>
					<div class="s_product_text">
						<h3 class="js-name-detail">{{$product->prod_name}}</h3>
                        <h2>JD{{number_format($product->new_price,2)}}</h2>
                        <h4><del class="text-danger">JD{{number_format($product->old_price,2)}}</del></h4>
                        <ul class="list">
							<li>
								<a class="active" href="#">
									<span>Category</span> : {{$product->cat->cat_name}}
								</a>
								<a class="active" href="{{route('public_provider.profile',['id'=>$product->provider])}}"><br>
									<span>Provider</span> : {{$product->prov->name}}
								</a>
							</li>
							<li>
								<a href="#">
									<span>Availibility</span> : @if ($product->availability == 1)
                                        <span class="text-success">Available</span>
                                    @else
                                    <span class="text-danger">Un-available</span>
                                    @endif</a>
							</li>
						</ul>
                        <p>{{$product->description}}</p>
						
							@if ($product->availability == 1)
							<div class="product_count">
								<label for="qty">Quantity:</label>
								<input type="text" name="qty" id="sst" minlength="1" maxlength="12" value="1" title="Quantity:" class="input-text qty">
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
								 class="increase items-count" type="button">
									<i class="lnr lnr-chevron-up"></i>
								</button>
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
								 class="reduced items-count" type="button">
									<i class="lnr lnr-chevron-down"></i>
								</button>
							</div>
							<div class="card_area">
								<a class="main_btn js-addcart-detail text-light" id="addCart">Add to Cart</a>	
							</div>
							@else
							<div class="car-area">
								<h5 class="text-danger">This Product is now Un-available</h5>
							</div>	
							@endif
							
						
					</div>
					</strong>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">
						<div class="col-lg-6 comments-box">
							<div class="comment_list" id="comment_list">
								
									@foreach ($comments as $comment)
									<div class="review_item">
										<div class="media">
											<div class="media-body">
												<h4>{{$comment->user->name}}</h4>
												<h5>{{$comment->created_at->format('Y-m-d')}}</h5>
												@if ($comment->user_id == $user['user_id'])
												<a class="btn-danger text-light reply_btn" onclick="delete_comment({{$comment->id}})" id="delete_comment"><i class="fa fa-trash text-light"></i></a>	
												@endif
											</div>
										</div>
										<p>{{$comment->comment}}</p>
									</div>
									<hr>
									@endforeach
										
								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form" onclick="event.preventDefault()" method="post" id="contactForm" novalidate="novalidate">
									@csrf
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="comment" id="comment" rows="1" placeholder="Enter your comment"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										@if ($user != null)
										<button class="btn submit_btn" id="comment_btn">Comment</button>	
										@else
										<button class="btn btn-primary" disabled title="You Must be login">Comment</button>	
										@endif
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-12">
									<div class="box_total">
										<h5 class="mb-2">Product Rate</h5>
										<a href="#" style="color:#fbd600;">
											<i class="fa fa-star fa-4x"></i>
											<h4>{{$product_rate}} STAR</h4>
										</a>
									</div>
								</div>
								<div class="col-12" id="yourRateBox">
									@if (isset($rating[0]))
									<div class="rating_list">
										<h3>Your Rate:</h3>
										<ul class="list" style="color:#fbd600">
											<li>	
												<a href="#">{{$rating[0]->rating}} STAR
												@for ($i = 0; $i < $rating[0]->rating; $i++)
													<i class="fa fa-star"></i>
												@endfor	
												</a>	
											</li>
										</ul>
									</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							@if ($user != null)
							<div class="review_box">
								<h4>Add a Review</h4>
								<a id="star5" style="cursor:pointer">Click to Rate:</a>
								<ul class="list" style="color:#fbd600">
									<li>
										<label class="text-dark">5 Star</label>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
									</li>
								</ul><br>
								<a id="star4" style="cursor:pointer">Click to Rate:</a>
								<ul class="list" style="color:#fbd600">
									<li>
										<label class="text-dark">4 Star</label>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
									</li>
								</ul><br>
								<a id="star3" style="cursor:pointer">Click to Rate:</a>
								<ul class="list" style="color:#fbd600">
									<li>
										<label class="text-dark">3 Star</label>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
									</li>
								</ul><br>
								<a id="star2" style="cursor:pointer">Click to Rate:</a>
								<ul class="list" style="color:#fbd600">
									<li>
										<label class="text-dark">2 Star</label>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
									</li>
								</ul><br>
								<a id="star1" style="cursor:pointer">Click to Rate:</a>
								<ul class="list" style="color:#fbd600">
									<li>
										<label class="text-dark">1 Star</label>
											<i class="fa fa-star"></i>
									</li>
								</ul>
							</div>
							@endif

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

<br><br>
    @include('public_views.includes.public_footer')
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