<?php $pageTitle = "Home" ?>
@include('public_views.includes.public_header')

	<!--================Home Banner Area =================-->
	<section class="text-center" style="margin-top: 120px; background-image: url({{asset('img/ecom2.jpg')}}); background-size:100% 100%; height:250px; position:relative;">
		<h2 style="font-family:Times New Roman; font-weight:bold; padding-left:50px; padding-top:25px; padding-bottom:25px; color:white; background-color:rgba(0,0,0,0.6); position: absolute; bottom:-8px; width:100%;">WELCOME TO JORDAN STORES</h2>
	</section>
	<!--================End Home Banner Area =================-->
 <!--================Blog Categorie Area =================-->
 
 <section class="blog_categorie_area">
	<div class="container">
		<div class="row">
			@foreach ($categories as $category)
			<a class="text-light" href="{{route('category.show',['id'=>$category->id])}}">
				<div class="col-lg-4 mb-3">
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
	<section class="feature_product_area section_gap">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>Best Sellers</h2>
						<p>Who are in extremely love with eco friendly system.</p>
					</div>
				</div>
			</div>
				<section class="clients_logo_area mt-5">
				<div class="container-fluid">
					<div class="clients_slider owl-carousel">
                    @foreach ($featured_products as $product)
					<div class="">
						<div class="col-12">
							<div class="f_p_item">
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
									<h4 class="product-name"><a href="#" class="product-name js-name-detail">{{$product->prod_name}}</a></h4>
									<p class="product-details"><strong>Provider : {{$product->prov->name}}</strong></p>
									<p class="product-details"><strong>Category : {{$product->cat->cat_name}}</strong></p>
									<p class="product-details"><strong>Gender : {{$product->gender}}</strong></p>
									<span class="text-danger"><strong><del class="text-danger">JD{{number_format($product->old_price,2)}}</del></strong></span><br>
									<span class="text-success"><strong>JD{{number_format($product->new_price,2)}}</strong></span>
							</div>
						</div>
						
					</div>
					@endforeach
					</div>
				</div>
				</section>
		</div>
	</section>
	<!--================End Feature Product Area =================-->

	<!--================ Subscription Area ================-->
	<section class="subscription-area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
                        <h2>Subscribe With Us</h2>
                        <span>If you have a business and you want to join us send your email</span>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div id="mc_embed_signup">
						<form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01"
						 method="get" class="subscription relative">
							<input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"
							 required="">
							<button type="submit" class="newsl-btn">Send</button>
							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!--================ End Subscription Area ================-->
    
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