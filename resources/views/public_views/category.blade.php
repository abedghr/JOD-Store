<?php  $pageTitle = "Category"; ?>
@include('public_views.includes.public_header')

	<!--================Home Banner Area =================-->
    <section  style="margin-top: 120px;">
        <h2 style="font-family:Times New Roman; font-weight:bold; padding-left:50px; padding-top:25px; color:black; background-color:rgba(0,0,0,0.1); height:100px">LETS SHOPPING ({{$category->cat_name}})</h2>
	</section>
	<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area mt-5">
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
                                    <a href="{{route('product.all')}}" @if($pageTitle == "shop") class="active-category" @endif>All</a>
                                </li>
                                <hr>
                                @foreach ($categories as $cat)
                                <li>
                                    <a href="{{route('category.show',['id'=>$cat->id])}}" @if ($cat->id == $category->id) class="active-category" @endif >{{$cat->cat_name}}</a>
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

<!--================ Subscription Area ================-->
<section class="subscription-area section_gap mt-5">
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
    

        
    let old_data = $('.prod_content').html();
     function search(){
         var data = $('#search').val();
         if(data != ""){
             $.ajax({
                 type: "get",
                 url : "{{route('single_category.search')}}",
                 data:{
                     'data_search':data,
                     'cat_id':"{{$category->id}}"
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
             url : "{{route('filter_category.price')}}",
             data : {
                 'filter':filter,
                 'cat_id':"{{$category->id}}"
             },
             success:function(data){
             $('.prod_content').html(data.arr);
             }
         });
     }
 </script>