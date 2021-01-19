<?php $pageTitle = "Home" ?>
@include('public_side.includes.public_header')
<!-- banner -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1" class=""></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<div style="width:100%; height:100%; background-color:rgba(0,0,0,0.6)">
					<div class="container">
						<div class="carousel-caption">
							<h3>Welcome <span>To</span> Jordan <span>Stores</span></h3>
							<p>You can find everything that you want</p>
							<a class="hvr-outline-out button2" href="{{route('product.all2')}}">Shop Now </a>
						</div>
					</div>
				</div>
			</div>
			<div class="item item3"> 
				<div style="width:100%; height:100%; background-color:rgba(0,0,0,0.6)">
					<div class="container">
						<div class="carousel-caption">
							<h3>Find <span>your</span> best <span>Store</span></h3>
							<p>Make shopping from your best store</p>
							<a class="hvr-outline-out button2" href="{{route('provider.all2')}}">Stores </a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		<!-- The Modal -->
    </div> 
	<!-- //banner -->
    {{-- <div class="banner_bottom_agile_info">
	    <div class="container">
            <div class="banner_bottom_agile_info_inner_w3ls">
    	           <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="{{asset('pub_libraries/images/bottom1.jpg')}}" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>F</span>all Ahead</h3>
								<p>New Arrivals</p>
							</figcaption>			
						</figure>
					</div>
					 <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="{{asset('pub_libraries/images/bottom2.jpg')}}" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>F</span>all Ahead</h3>
								<p>New Arrivals</p>
							</figcaption>			
						</figure>
					</div>
					<div class="clearfix"></div>
		    </div> 
		 </div> 
    </div> --}}
  <!-- banner-bootom-w3-agileits -->
	{{-- <div class="banner-bootom-w3-agileits">
	<div class="container">
		<h3 class="wthree_text_info">What's <span>Trending</span></h3>
	
		<div class="col-md-5 bb-grids bb-left-agileits-w3layouts">
			<a href="womens.html">
			   <div class="bb-left-agileits-w3layouts-inner grid">
					<figure class="effect-roxy">
							<img src="{{asset('pub_libraries/images/bb1.jpg')}}" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>S</span>ale </h3>
								<p>Upto 55%</p>
							</figcaption>			
						</figure>
			    </div>
			</a>
		</div>
		<div class="col-md-7 bb-grids bb-middle-agileits-w3layouts">
		      <a href="mens.html">
		       <div class="bb-middle-agileits-w3layouts grid">
			           <figure class="effect-roxy">
							<img src="{{asset('pub_libraries/images/bottom3.jpg')}}" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>S</span>ale </h3>
								<p>Upto 55%</p>
							</figcaption>			
						</figure>
		        </div>
				</a>
				<a href="mens.html">
		      <div class="bb-middle-agileits-w3layouts forth grid">
						<figure class="effect-roxy">
							<img src="{{asset('pub_libraries/images/bottom4.jpg')}}" alt=" " class="img-responsive">
							<figcaption>
								<h3><span>S</span>ale </h3>
								<p>Upto 65%</p>
							</figcaption>		
						</figure>
					</div>
					</a>
		<div class="clearfix"></div>
	</div>
	</div>
    </div> --}}
<!--/grids-->
      {{-- <div class="agile_last_double_sectionw3ls">
            <div class="col-md-6 multi-gd-img multi-gd-text ">
					<a href="womens.html"><img src="{{asset('pub_libraries/images/bot_1.jpg')}}" alt=" "><h4>Flat <span>50%</span> offer</h4></a>
					
			</div>
			 <div class="col-md-6 multi-gd-img multi-gd-text ">
					<a href="womens.html"><img src="{{asset('pub_libraries/images/bot_2.jpg')}}" alt=" "><h4>Flat <span>50%</span> offer</h4></a>
			</div>
			<div class="clearfix"></div>
	   </div> --}}							
<!--/grids-->
<!-- /new_arrivals --> 
<div class="new_arrivals_agile_w3ls_info"> 
	<div class="container">
		<h3 class="wthree_text_info">Newest <span>Products</span></h3>		
			<div id="horizontalTab">
				@foreach ($newest_prod as $product)
				<div class="col-md-3 product-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item" style="height: 250px; background-image:url('../img/Product_images/{{$product->main_image}}'); background-size:100% 100%;">
                        
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="{{route('product.show2',['id'=>$product->id])}}" class="link-product-add-cart">Quick View</a>
                                </div>
                            </div>
                            
                            
                    </div>
						<div class="item-info-product ">
							<h4><a href="" class="js-name-detail">{{$product->prod_name}}</a></h4>
							<p><a href="">Store: {{$product->prov->name}}</a></p>
							<p>Gender: {{$product->gender}}</p>
							@if ($product->old_price != null)
							<div class="info-product-price">
								<span class="item_price">{{number_format($product->new_price,2)}}JOD</span>
								<del>{{number_format($product->old_price,2)}}JOD</del>
							</div>
							@else
							<div class="info-product-price">
								<span class="item_price">{{number_format($product->new_price,2)}}JOD</span>
							</div>
							@endif
							
							<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
								<input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$product->id}})" />
							</div>
						</div>
					</div>
				</div>
				@endforeach
				
				
				<div class="clearfix"></div>
					
			</div>
		</div>	
	</div>
	<div class="new_arrivals_agile_w3ls_info"> 
		<div class="container">
		    <h3 class="wthree_text_info">Top <span>Sellers</span></h3>		
				<div id="horizontalTab">
                    @foreach ($top_products as $product)
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item simpleCart_shelfItem">
                            <div class="men-thumb-item" style="height: 250px; background-image:url('../img/Product_images/{{$product->main_image}}'); background-size:100% 100%;">
                        
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="{{route('product.show2',['id'=>$product->id])}}" class="link-product-add-cart">Quick View</a>
									</div>
								</div>
								
								
						</div>
                            <div class="item-info-product ">
                                <h4><a href="" class="js-name-detail">{{$product->prod_name}}</a></h4>
                                <p><a href="">Store: {{$product->prov->name}}</a></p>
                                <p>Gender: {{$product->gender}}</p>
								@if ($product->old_price != null)
								<div class="info-product-price">
                                    <span class="item_price">{{number_format($product->new_price,2)}}JOD</span>
                                    <del>{{number_format($product->old_price,2)}}JOD</del>
								</div>
								@else
								<div class="info-product-price">
                                    <span class="item_price">{{number_format($product->new_price,2)}}JOD</span>
								</div>
								@endif
								
                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                                    <input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$product->id}})" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                    <div class="clearfix"></div>
						
                </div>
            </div>	
        </div>
    </div>
	<!-- //new_arrivals --> 
<!-- /we-offer -->
<div class="sale-w3ls footerReg">
	<div style="width: 100%; height:100%; background-color:rgba(0,0,0,0.6); min-height:380px">
		<div class="container">
			<h6>Register With Us</h6>
			<p class="text-light"><strong>If you have a business and you want to join us and get your own store</strong></p>

			<a class="hvr-outline-out button2" href="{{route('provider.register')}}">Register </a>
		</div>
	</div>
</div>
<!-- //we-offer -->

@include('public_side.includes.public_footer')
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