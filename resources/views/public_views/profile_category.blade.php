<?php $pageTitle = "Profile" ?>
@include('public_views.includes.public_header')
<br>

<!--================Home Banner Area =================-->
    <section class="bg-profile" style="margin-top: 160px; background-image: url('../../storage/Provider_coverImages/{{$provider->cover_image}}')">
        <div class="d-flex align-items-center">
            <div class="container">
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 text-center">
                <img src="../../img/provider_images/{{$provider->image}}" class="rounded-circle" width="250" height="250" style="margin-top:-80px; padding:10px; border:1px solid silver" alt="">
            </div>
            <div class="col-lg-6">
                <small>Online Store</small>
                <h1>{{$provider->name}}</h1>
                <hr>
                <p>{{$provider->description ? $provider->description : "No Description"}}</p>
            </div>
            <div class="col-lg-3">
                <a href=""><span style="font-size:40px"><i class="fa fa-instagram" style="color:purple;"></i></span></a>
                <a href=""><span style="font-size:40px; margin-left:10px;"><i class="fa fa-facebook-square text-primary"></i></span></a>
                <span style="font-size:25px; margin-left:10px;">Follow Us</span>
                
            </div>
        </div>
    </div>
    
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area mt-5">
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <div class="left_dorp">
                        <input type="search" class="sorting" id="search" onkeyup="search_vendorsCategory_products()" style="width:335px !important" placeholder="Search ..">
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
                                    <img class="img-fluid rounded" src="../../img/Product_images/{{$product->main_image}}" alt="">
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
                                    <span class="text-danger"><strong><del class="text-danger">JD{{number_format($product->old_price,2)}}</del></strong></span><br>
                                    <span class="text-success"><strong>JD{{number_format($product->new_price,2)}}</strong></span>
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
                        <div class="widgets_inner">
                            <ul class="list">
                                <li>
                                    <a href="{{route('vendor_product.all',['provider_id'=>$provider->id])}}" @if($category_active == "all") class="active-category" @endif>All</a>
                                </li>
                                <hr>
                                @foreach ($categories as $category)
                                <li>
                                    <a href="{{route('profile_category.show',['prov_id'=>$provider->id ,'cat_id'=>$category['id']])}}"  @if ($category['id'] == $category_active) class="active-category" @endif>{{$category['name']}}</a>
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
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('low-to-high')" name="price_filter" value="low-to-high">Low to High
                                </li>
                                <li>
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('high-to-low')" name="price_filter" value="high-to-low"> High to Low
                                </li>
                                <li>
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('less-10')" name="price_filter" value="less-10"> Less Than 10.99JD
                                </li>
                                <li>
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('less-25')" name="price_filter" value="less-25"> Less Than 25.99JD
                                </li>
                                <li>
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('less-35')" name="price_filter" value="less-35"> Less Than 35.99JD
                                </li>
                                <li>
                                    <input type="radio" class="mr-3 price_filter"  onchange="vendor_filter_price('more-35')" name="price_filter" value="more-35"> More Than 35.99JD
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

<!--================ Subscription Area ================-->
<section class="subscription-area section_gap mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2>Your Feedback</h2>
                    <span>If you have a note and you want to tell us, send your it.</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <textarea name="feedback" id="" cols="30" class="form-control feedback-box" rows="3"></textarea>
                <br>
                <button class="btn btn-primary btn-feedback">Send Feedback</button>
            </div>
        </div>
    </div>
</section>
<!--================ End Subscription Area ================-->

@include('public_views.includes.public_footer')
<script>

    let old_data = $('.prod_content').html();
    function search_vendorsCategory_products(){
        var data = $('#search').val();
        if(data != ""){
            $.ajax({
                type: "get",
                url : "{{route('vendorsCategory_product.search')}}",
                data:{
                    'data_search':data,
                    'prov_id':"{{$provider->id}}",
                    'cat_id': "{{$category_active}}"
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
             }
         });
     }
 
     function vendor_filter_price (filter){
         $.ajax({
             type: "get",
             url : "{{route('vendors_filter.price')}}",
             data : {
                 'filter':filter,
                 'prov_id':"{{$provider->id}}"
             },
             success:function(data){
             $('.prod_content').html(data.arr);
             }
         });
     }
 </script>