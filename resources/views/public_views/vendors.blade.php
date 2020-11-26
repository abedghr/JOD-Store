<?php $pageTitle = "Vendors" ?>
@include('public_views.includes.public_header')
<br>


<section class="">
    <!-- d-flex align-items-center -->
    <div class="row"  style="font-family:Times New Roman; font-weight:bold; padding-left:50px; padding-top:25px; color:black; background-color:rgba(0,0,0,0.1); height:100px; margin-top:98px;">
        <div class="col-md-4">
            <h3 style="font-family: Times new roman; font-weight: bold;"><i>LETS FIND YOUR BEST STORE</i></h3>
        </div>
        <div class="col-md-7">
            <input type="search" id="vendor_search" onkeyup="search_vendors()" class="form-control bg-light" placeholder="Search Store...">
        </div>
        <div class="container">
            
            <div class="banner_content text-center mt-5">
                {{-- <div class="">
                    <div class="row">
                        

                        </div>
                        
                    </div>

                </div> --}}
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
                            <img src="../img/Provider_images/{{$provider->image}}" height="100%" width="100%"  alt="">
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