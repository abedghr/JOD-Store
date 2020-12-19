<?php $pageTitle = $category->cat_name."Gen" ?>
@include('public_side.includes.public_header')
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>{{$category->cat_name}} "{{$gen}}"</h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li>{{$category->cat_name}}({{$gen}})</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
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
                    <?php $i= 0; ?>
                    @foreach ($categories as $cat)
                        <li><input type="checkbox" id="item-0-{{$i}}" /><label for="item-0-{{$i}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$cat->cat_name}}</label>
                            <ul>
                                <li><a href="{{route('category.show2',['id'=>$cat->id])}}">All</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'men'])}}"@if ($gen == 'men' && $cat->id == $category->id) style="color:#2fdab8;" @endif>Men</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'women'])}}"@if ($gen == 'women' && $cat->id == $category->id) style="color:#2fdab8;" @endif>Women</a></li>
                                <li><a href="{{route('category_gender2.show',['id'=>$cat->id , 'gender'=>'multiGender'])}}"@if ($gen == 'both' && $cat->id == $category->id) style="color:#2fdab8;" @endif>For Both</a></li>
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
                @if ($products[0] == null)
                <h3 class="text-danger">There is no products</h3>
                @endif
            @foreach ($products as $product)
            
            
            <div class="col-md-4 product-men">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                        <img src="../../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-front">
                        <img src="../../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-back">
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

@include('public_side.includes.public_footer')
<script>
    

        
    let old_data = $('.prod_content').html();
     function search(){
         var data = $('#search').val();
         if(data != ""){
             $.ajax({
                 type: "get",
                 url : "{{route('single_gender.search2')}}",
                 data:{
                     'data_search':data,
                     'cat_id':"{{$category->id}}",
                     'gender':"{{$gen}}"
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
             url : "{{route('filter_gender.price2')}}",
             data : {
                 'filter':filter,
                 'cat_id':"{{$category->id}}",
                 'gender':"{{$gen}}"
             },
             success:function(data){
             $('.prod_content').html(data.arr);
             }
         });
     }
 </script>