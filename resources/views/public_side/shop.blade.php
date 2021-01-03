<?php $pageTitle = "Shop" ?>
@include('public_side.includes.public_header')
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Shop</h3>
			
	    </div>
</div>

  <!-- banner-bootom-w3-agileits -->
	<div class="banner-bootom-w3-agileits">
	<div class="container">
         <!-- mens -->
		<div class="col-md-4 products-left">
			
			<div class="css-treeview">
				<h4>Categories</h4>
                    <ul>
                        <li><a href="{{route('product.all2')}}"><input type="checkbox" /><label for="" style="color:#2fdab8;">All Products</label></a></li>
                    <?php $i= 0; ?>
                    @foreach ($categories as $cat)
                        <li><input type="checkbox" id="item-0-{{$i}}" /><label for="item-0-{{$i}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$cat->cat_name}}</label>
                            <ul>
                                <li><a href="{{route('category.show2',['id'=>$cat->id])}}">All</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'men'])}}">Men</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'women'])}}">Women</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'both'])}}">For Both</a></li>
                            </ul>
                        </li>
                        <?php $i++; ?>
                    @endforeach
                </ul>
			</div>
			<div class="community-poll">
				<h4>Filters</h4>
				<div class="swit form">	
					<form>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('low-to-high')" checked=""><i></i>Low to High</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('high-to-low')"><i></i>High to Low</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('less-10')"><i></i>Less Than 10.99JD</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('less-25')"><i></i>Less Than 25.99JD</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('less-35')"><i></i>Less Than 35.99JD</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="filter_price('more-35')"><i></i>More Than 35.99JD</label> </div></div>
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>Product <span>Compare(0)</span></h5>
			<div class="sort-grid row">
				<div class="col-md-6">
					<input type="search" class="sorting form-control" id="search" onkeyup="search()" style="width:335px !important" placeholder="Search ..">
					
				</div>
				<div class="col-md-6">
					<div class="frm-field required sect">
                        <span class="text-right">{!! $products->links() !!}</span>
                    </div>
					
				</div>
				
			</div>
			{{-- <div class="men-wear-top">
				
				<div  id="top" class="callbacks_container">
					<ul class="rslides" id="slider3">
						<li>
							<img class="img-responsive" src="../img/Category_images/{{$category->cat_image}}" height="100" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/banner5.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/banner2.jpg" alt=" "/>
						</li>

					</ul>
				</div>
				<div class="clearfix"></div>
            </div> --}}
            <div class="prod_content">
            @foreach ($products as $product)
            <div class="col-md-4 product-men">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                        <img src="../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-front">
                        <img src="../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-back">
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="{{route('product.show2',['id'=>$product->id])}}" class="link-product-add-cart">Quick View</a>
                                </div>
                            </div>
                            <span class="product-new-top">New</span>
                            
                    </div>
                    <div class="item-info-product ">
                        <h4><a href="single.html" class="js-name-detail">{{$product->prod_name}}</a></h4>
                        <p><a href="">Store: {{$product->prov->name}}</a></p>
                        <p>Gender: {{$product->gender}}</p>
                        <div class="info-product-price">
                            <span class="item_price">{{number_format($product->new_price,2)}}JOD</span>
                            <del>{{number_format($product->old_price,2)}}JOD</del>
                        </div>
                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                            <input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$product->id}})" />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		
	</div>
</div>	
<!-- //mens -->
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
    

        
    let old_data = $('.prod_content').html();
     function search(){
         var data = $('#search').val();
         if(data != ""){
             $.ajax({
                 type: "get",
                 url : "{{route('search2')}}",
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
             url : "{{route('filter.price2')}}",
             data : {
                 'filter':filter
             },
             success:function(data){
             $('.prod_content').html(data.arr);
             }
         });
     }
 </script>