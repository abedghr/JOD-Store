<?php $pageTitle = "Vendors" ?>
@include('public_views.includes.public_header')
<br>


<section class="">
    <div class="d-flex align-items-center"  style="margin-top: 160px;">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Lets Find Your Best Store</h2>
            </div>
            <div class="banner_content text-center mt-5">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8">
                            <input type="search" id="vendor_search" onkeyup="search_vendors()" class="form-control bg-light" style="border-radius:20px" placeholder="Search Store...">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

	<!--================Hot Deals Area =================-->
	<section class="hot_deals_area header_gap">
		<div class="container-fluid">
			<div class="row vendors_content">
                @foreach ($providers as $provider)
                <a href="{{route('public_provider.profile',['id'=>$provider->id])}}">
                    <div class="col-lg-4 mb-3">
                        <div class="hot_deal_box"  style="height:300px;">
                            <img src="../storage/Provider_images/{{$provider->image}}" height="100%" width="100%"  alt="">
                            <div class="content">
                                <h2>{{$provider->name}}</h2>
                                <p>shop now</p>
                            </div>
                            <a class="hot_deal_link" href="{{route('public_provider.profile',['id'=>$provider->id])}}"></a>
                        </div>
                    </div>
                </a>
                @endforeach
				
			</div>
		</div>
	</section>
	<!--================End Hot Deals Area =================-->

@include('public_views.includes.public_footer')

<script>
    let old_content = $('.vendors_content').html();
    function search_vendors(){
        var search = $('#vendor_search').val();
        $.ajax({
            type: "get",
            url : "{{route('search.vendors')}}",
            data:{
                'vendor': search
            },
            dataType : 'json',
            success:function(data){
                console.log(data.vendor_arr);
                if(data != ""){
                    $('.vendors_content').html(data.vendor_arr);
                }else{
                    $('.vendors_content').html(old_content);
                }
            }
        })
    }
</script>