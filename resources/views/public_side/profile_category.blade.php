<?php $pageTitle = "Store" ?>
@include('public_side.includes.public_header')
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l" style="background-image: url('../../img/Provider_coverImages/{{$provider->cover_image}}') !important; min-height:300px;">
    <div>
    </div>
</div>
<div class="container">
        <div class="col-lg-4 text-center">
            <img src="../../img/provider_images/{{$provider->image}}" height="260"  style="margin-top:-80px; padding:10px; border:1px solid silver" alt="">
        </div>
        <div class="col-lg-8 mt-2">
            
            <h1 class="mt-2">{{$provider->name}} Store</h1>
            
            <hr>
            <p class="mb-3"><strong>{{$provider->description ? $provider->description : "No Description"}}</strong></p>
            @if (isset($user))
            <a href="{{route('chat.show',['id'=>$provider->id])}}" class="btn btn-secondary  btn-block mt-2" style="background-color: #2fdab8 !important">Chat Us</a>
            <small class="text-dark"><strong>&nbsp;</strong></small>
            @else
            <button class="btn btn-secondary  btn-block mt-2 text-light " style="background-color: #2fdab8 !important" disabled>Chat Us</button>
            <small class="text-danger"><strong>you sould be Login to Chat us</strong></small>
            @endif
        </div>
        <div class="col-md-1"></div>
        <div class="col-lg-3">
            <ul class="social-nav model-3d-0 footer-social w3_agile_social two" style="margin:0px !important">
                <li><a href="#" class="facebook">
                    <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                    <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>
                </li>
                <li><a href="#" class="instagram">
                    <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                    <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>
                </li>
                <li><a class="instagram bg-info" id="contact-btn">
                    <div class="front text-light bg-info" style="width:100px; background-color:#2ec2a4;">Contact Us</div>
                    <div class="back" style="width:100px;">Contact Us</div></a>
                </li>
            </ul>
            <div id="info" style="display: none;">
                <p><strong>Phone (1) : </strong>{{$provider->phone1}}</p>
                <p><strong>Phone (2) : </strong>{{$provider->phone2}}</p>
                <p><strong>Email : </strong>{{$provider->email}}</p>
                <p><strong>Address : </strong>{{$provider->address}}</p>
            </div>
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
                        <li><a href="{{route('public_provider.profile2',['id'=>$provider->id])}}"><strong>All Products</strong></a></li>
                    <?php $i= 0; ?>
                    @foreach ($store_categories as $cat)
                        <li><input type="checkbox" id="item-0-{{$i}}" /><label for="item-0-{{$i}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$cat['name']}}</label>
                            <ul>
                                <li><a href="{{route('profile_category.show2',['prov_id'=>$provider->id ,'cat_id'=>$cat['id']])}}" @if ($cat['id'] == $category_active) style="color:#2fdab8 !important;" @endif>All</a></li>
                                <li><a href="{{route('profile_gender.show2',['prov_id'=>$provider->id , 'cat_id'=>$cat['id'] ,  'gender'=>'men'])}}">Men</a></li>
                                <li><a href="{{route('profile_gender.show2',['prov_id'=>$provider->id , 'cat_id'=>$cat['id'] ,  'gender'=>'women'])}}">Women</a></li>
                                <li><a href="{{route('profile_gender.show2',['prov_id'=>$provider->id , 'cat_id'=>$cat['id'] ,  'gender'=>'for both'])}}">For Both</a></li>
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
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('low-to-high')"><i></i>Low to High</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('high-to-low')"><i></i>High to Low</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('less-10')"><i></i>Less Than 10.99JD</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('less-25')"><i></i>Less Than 25.99JD</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('less-35')"><i></i>Less Than 35.99JD</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" onchange="vendor_filter_price('more-35')"><i></i>More Than 35.99JD</label> </div></div>
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>{{$products[0]->cat->cat_name}} <span>Products</span></h5>
			<div class="sort-grid row">
				<div class="col-md-6">
					<input type="search" class="sorting form-control" id="search" onkeyup="search_vendorsCategory_products()" style="width:100% !important" placeholder="Search ..">
					
				</div>
				<div class="col-md-6">
					<div class="frm-field required sect">
                        <span class="text-right">{!! $products->links() !!}</span>
                    </div>
					
				</div>
				
			</div>
            <div class="prod_content">
            @foreach ($products as $product)
            <div class="col-md-4 product-men">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item" style="height: 250px; background-image:url('../../img/Product_images/{{$product->main_image}}'); background-size:100% 100%;">
                        
                        <div class="men-cart-pro">
                            <div class="inner-men-cart-pro">
                                <a href="{{route('product.show2',['id'=>$product->id])}}" class="link-product-add-cart">Quick View</a>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="item-info-product ">
                        <h4><a href="single.html" class="js-name-detail">{{$product->prod_name}}</a></h4>
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

                        @if ($product->inventory == 0)
                        <div class="snipcart-details top_brand_home_details item_add single-item button2">
                        <input type="submit" name="submit" value="Not Available" class="button bg-danger" style="margin-bottom: 8px; top:8px;" />
                        </div>
                        @else
                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                        <input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$product->id}})" />
                        </div>
                        @endif
                        {{-- <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                            <input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca({{$product->id}})" />
                        </div> --}}
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
<div class="sale-w3ls">
	<div style="width: 100%; height:100%; background-color:rgba(0,0,0,0.6); min-height:380px">
		<div class="container">
            <h6 style="padding-top:1em !important">Write Your Feedback</h6>
            <div class="col-md-3"></div>
            <div class="col-md-6 mb-3">
                <center><textarea name="" id="feedback" class="form-control bg-light" rows="4"></textarea></center>

                <a class="hvr-outline-out button2" onclick="sendfeedback()" style="cursor: pointer;">Send </a>
            </div>
        </div>
	</div>
</div>
<!-- //we-offer -->
@include('public_side.includes.public_footer')
<script>
    $('document').ready(function(){
        $("#contact-btn").click(function(){
            $("#info").toggle("10000");
        });
    });
    let old_data = $('.prod_content').html();
    function search_vendorsCategory_products(){
        var data = $('#search').val();
        if(data != ""){
            $.ajax({
                type: "get",
                url : "{{route('vendorsCategory_product.search2')}}",
                data:{
                    'data_search':data,
                    'prov_id':"{{$provider->id}}",
                    'cat_id': "{{$category_active}}"
                },
                dataType : 'json',
                success:function(data){
                    if(data.content != ""){
                    $('.prod_content').html(data.content);
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
             }
         });
     }
 
     function vendor_filter_price (filter){
         $.ajax({
             type: "get",
             url : "{{route('vendors_Categoryfilter.price2')}}",
             data : {
                 'filter':filter,
                 'prov_id':"{{$provider->id}}",
                 'cat_id':"{{$category_active}}"
             },
             success:function(data){
                if(data != ''){
                    $('.prod_content').html(data);
                 }else{
                     $('.prod_content').html('<h4>There is no items</h4>').css('color','red');
                 }
             }
         });
     }
     
    function sendfeedback(){
        var feedback = $('#feedback').val();
        $.ajax({
        type: "get",
        url : "{{route('feedback.send')}}",
        data : {
            'feedback':feedback,
            'provider_id':"{{$provider->id}}"
        },success:function(data){
            $feed = "Your feed has been sent";
            swal($feed, " ", "success");
            $('#feedback').val(data.text);
            
        },error: function(){
            
            $feed = "You must fill the feedback box";
            swal($feed, " ", "error");
            $('.swal-button').css('background-color','red');
        }
        });
    }
 </script>