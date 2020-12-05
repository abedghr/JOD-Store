<?php $pageTitle = "Shop" ?>

@include('public_views.includes.public_header')
<br>
	<!--================Home Banner Area =================-->
	{{-- <section class="container"  style="margin-top: 160px;">
        <h2>LETS SHOPPING...</h2>
	</section> --}}
	<!--================End Home Banner Area =================-->
	<!--================Clients Logo Area =================-->
	<section class="clients_logo_area"  style="margin-top: 110px;">
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
	<!--================Category Product Area =================-->
	<section class="cat_product_area mt-4">
		<div class="container-fluid">
			<div class="row flex-row-reverse">
				<div class="col-lg-9">
					<div class="product_top_bar">
						<div class="left_dorp">
                            <input type="search" class="sorting" id="search" onkeyup="search()" style="width:335px !important" placeholder="Search ..">
						</div>
						<div class="right_page ml-auto">
							{!! $products->links() !!}
						</div>
					</div>
					<div class="latest_product_inner row prod_content">
                            @foreach ($products as $product)
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid rounded" src="../img/Product_images/{{$product->main_image}}" alt="">
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
                                        <span class="text-danger"><strong><del class="text-danger">JD{{number_format($product->old_price,2)}}</del></strong></span>
                                        <span class="text-success ml-2"><strong>JD{{number_format($product->new_price,2)}}</strong></span>
                                </div>
                            </div>
                            @endforeach
					</div>
				</div>
				<div class="col-lg-3">
					<div class="left_sidebar_area">
						<aside class="left_widgets cat_widgets">
							<div class="l_w_title">
								<h3>Browse Categories</h3>
							</div>
							<div class="widgets_inner" style="height:400px; overflow-y: scroll;">
								<ul class="list">
                                    <li>
                                        <a href="{{route('product.all')}}" class="active-category">All</a>
                                    </li>
                                    <hr>
                                    
                                    @foreach ($categories as $category)
                                    <li>
                                        <a href="{{route('category.show',['id'=>$category->id])}}">{{$category->cat_name}}</a>
                                        <ol style="list-style: none;">
                                            <li><a href="{{route('category_gender.show',['id'=>$category->id , 'gender'=>'men'])}}">Men</a></li>
                                            <li style="margin-top: -20px;" ><a href="{{route('category_gender.show',['id'=>$category->id , 'gender'=>'women'])}}">Women</a></li>
                                            <li style="margin-top: -20px;"><a href="{{route('category_gender.show',['id'=>$category->id , 'gender'=>'multiGender'])}}">Multi-Gender</a></li>
                                        </ol>
									</li>
                                    @endforeach
								</ul>
							</div>
						</aside>
						<aside class="left_widgets p_filter_widgets">
							<div class="l_w_title">
								<h3>Product Price Filters</h3>
							</div>
							<div class="widgets_inner">
								<ul class="list">
									<li>
                                        <input type="radio" class="mr-3 price_filter"  onchange="filter_price('low-to-high')" name="price_filter" value="low-to-high">Low to High
									</li>
									<li>
										<input type="radio" class="mr-3 price_filter"  onchange="filter_price('high-to-low')" name="price_filter" value="high-to-low"> High to Low
									</li>
									<li>
										<input type="radio" class="mr-3 price_filter"  onchange="filter_price('less-10')" name="price_filter" value="less-10"> Less Than 10.99JD
									</li>
									<li>
										<input type="radio" class="mr-3 price_filter"  onchange="filter_price('less-25')" name="price_filter" value="less-25"> Less Than 25.99JD
									</li>
									<li>
										<input type="radio" class="mr-3 price_filter"  onchange="filter_price('less-35')" name="price_filter" value="less-35"> Less Than 35.99JD
									</li>
									<li>
										<input type="radio" class="mr-3 price_filter"  onchange="filter_price('more-35')" name="price_filter" value="more-35"> More Than 35.99JD
									</li>
								</ul>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Category Product Area =================-->




@include('public_views.includes.public_footer')
<script>
    

        
   let old_data = $('.prod_content').html();
    function search(){
        var data = $('#search').val();
        if(data != ""){
            $.ajax({
                type: "get",
                url : "{{route('search')}}",
                data:{
                    'data_search':data
                },
                dataType : 'json',
                success:function(data){
                    if(data.row_result != ""){
                    $('.prod_content').html(data.row_result);
                    }else{
                        $('.prod_content').html(old_data);
                    }
                } 
            });
        }else{
            $('.prod_content').html(old_data);
        }
    }
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

    function filter_price (filter){
        $.ajax({
            type: "get",
            url : "{{route('filter.price')}}",
            data : {
                'filter':filter
            },
            success:function(data){
            $('.prod_content').html(data.arr);
            }
        });
    }
</script>