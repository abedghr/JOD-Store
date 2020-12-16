
@include('public_side.includes.public_header')
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>LETS FIND YOUR BEST STORE</h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li>All Stores</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>


	<!-- team -->
    <div class="banner_bottom_agile_info team">
        <div class="container">
                    <h3 class="wthree_text_info">All <span>Stores</span></h3>
                    <div class="header-bot mb-5">
                        <div class="header-bot_inner_wthreeinfo_header_mid">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 header-middle">
                                <form action="#" method="post">
                                        <input type="search" name="search" id="vendor_search" onkeyup="search_vendors()" placeholder="Search here..." required="">
                                        <input type="submit" value=" ">
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                <div class="inner_w3l_agile_grids">
                    <div class="vendors_content row">
                    @foreach ($all_providers as $provider)
                    <div class="col-md-3">
                        <div class="thumbnail team-w3agile">
                            <img src="./img/Provider_images/{{$provider->image}}" class="img-responsive" alt="">
                            <div class="social-icons team-icons right-w3l fotw33">
                            <div class="caption">
                                <h4>{{$provider->name}}</h4>						
                            </div>
                                <ul class="social-nav model-3d-0 footer-social w3_agile_social two" style="margin:0px !important">
                                    <li><a href="#" class="facebook">
                                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>
                                    </li>
                                    <li><a href="#" class="instagram">
                                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>
                                    </li>
                                </ul><br>
                                <a class="hvr-outline-out button2 btn btn-block text-light mt-1" href="single.html"><strong>Shopping</strong></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>    
                        <div class="clearfix"> </div>
                    </div>
               </div>
            </div>
    <!-- //team -->


@include('public_side.includes.public_footer')

<script>
    let old_content = $('.vendors_content').html();
    function search_vendors(){
        var search = $('#vendor_search').val();
        $.ajax({
            type: "get",
            url : "{{route('search.vendors2')}}",
            data:{
                'vendor': search
            },
            dataType : 'json',
            success:function(data){
                if(data != ""){
                    $('.vendors_content').html(data.vendor_arr);
                }else{
                    $('.vendors_content').html(old_content);
                }
            }
        })
    }
</script>