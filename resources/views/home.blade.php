<?php $pageTitle = "Home" ?>
@include('public_views.includes.public_header')

	<!--================Home Banner Area =================-->
	<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
	<!--Indicators-->
	<ol class="carousel-indicators">
	  <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
	  <li data-target="#carousel-example-1z" data-slide-to="1"></li>
	  <li data-target="#carousel-example-1z" data-slide-to="2"></li>
	</ol>
	<!--/.Indicators-->
	<!--Slides-->
	<div class="carousel-inner" role="listbox" style="height:450px;">
	  <!--First slide-->
	  <div class="carousel-item active">
		<img class="d-block w-100" src="{{asset('img/shop.jpg')}}"
		  alt="First slide">
	  </div>
	  <!--/First slide-->
	  <!--Second slide-->
	  <div class="carousel-item">
		<img class="d-block w-100" src="{{asset('img/shopcat2.png')}}"
		  alt="Second slide">
	  </div>
	  <!--/Second slide-->
	  <!--Third slide-->
	  <div class="carousel-item">
		<img class="d-block w-100" src="{{asset('img/ecommerce1.jpg')}}"
		  alt="Third slide">
	  </div>
	  <!--/Third slide-->
	</div>
	<!--/.Slides-->
	<!--Controls-->
	<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev" style=>
	  <span class="carousel-control-prev-icon" aria-hidden="true" style="    position: relative;
	  top: 61px;"></span>
	  <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true" style="    position: relative;
	  top: 61px;"></span>
	  <span class="sr-only">Next</span>
	</a>
	<!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->
	<!--================End Home Banner Area =================-->
 <!--================Blog Categorie Area =================-->
 
 <section class="blog_categorie_area">
	<div class="container">
		<div class="row">
			@foreach ($categories as $category)
			<a class="text-light" href="{{route('category.show',['id'=>$category->id])}}">
				<div class="col-lg-3 mb-3">
					<div class="categories_post"   style="height:200px;">
						<img src="../img/Category_images/{{$category->cat_image}}" height="100%" width="100%" alt="post">
						<div class="categories_details">
							<div class="categories_text">
								<a class="text-light" href="{{route('category.show',['id'=>$category->id])}}">
									<h5>{{$category->cat_name}}</h5>
								</a>
								<div class="border_line"></div>
								<p><a href="{{route('category.show',['id'=>$category->id])}}" class="text-light">shop now</a></p>
							</div>
						</div>
					</div>
				</div>
			</a>
			@endforeach
		</div>
	</div>
</section>
<!--================Blog Categorie Area =================-->

	<!--================Clients Logo Area =================-->
	<section class="clients_logo_area">
		<div class="container-fluid">
			<div class="clients_slider owl-carousel">
                @foreach ($providers_logo as $logo)
                    <div class="item">
                        <a href="{{route('public_provider.profile',['id'=>$logo->id])}}">
                            <img src="../img/Provider_images/{{$logo->image}}" width="120" height="75" class="rounded-circle" alt="">
                            <label class="text-secondary">{{$logo->name}}</label>
                        </a>
                    </div>
                @endforeach
			</div>
		</div>
	</section>
	<!--================End Clients Logo Area =================-->

	<!--================Feature Product Area =================-->
	<section class="feature_product_area section_gap" style="padding-bottom: 50px;">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>Top Sellers</h2>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
				<section class="clients_logo_area mt-5 pl-5 pr-5">
					<div class="clients_slider owl-carousel text-dark">
                    @foreach ($featured_products as $product)
					<div>
						<div class="col-12">
							<div class="f_p_item text-dark">
								<div class="f_p_img">
									<img class="img-fluid rounded" src="../img/Product_images/{{$product->main_image}}" width="100%" alt="">
									<div class="p_icon">
										<a href="{{route('product.show',['id'=>$product->id])}}">
											<i class="lnr lnr-eye"></i>
										</a>
										<a class="js-addcart-detail" style="cursor: pointer" onclick="addca({{$product->id}})">
											<i class="lnr lnr-cart"></i>
										</a>
									</div>
								</div>
									<h4 class="product-name"><a href="#" class="product-name js-name-detail text-dark">{{$product->prod_name}}</a></h4>
									<p class="product-details"><strong>Provider : {{$product->prov->name}}</strong></p>
									<!--<p class="product-details"><strong>Category : {{$product->cat->cat_name}}</strong></p>-->
									<p class="product-details"><strong>Gender : {{$product->gender}}</strong></p>
									<span class="text-danger"><strong><del class="text-danger">{{number_format($product->old_price,2)}}JOD</del></strong></span>
									<span class="text-success ml-2"><strong>{{number_format($product->new_price,2)}}JOD</strong></span>
							</div>
						</div>
						
					</div>
					@endforeach
					</div>
				</section>
		</div>
	</section>
	<!--================End Feature Product Area =================-->

	
    
@include('public_views.includes.public_footer')
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
                console.log(data);
            }
        });
    }
</script>