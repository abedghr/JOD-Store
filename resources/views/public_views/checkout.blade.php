<?php $pageTitle = "Checkout" ?>
@include('public_views.includes.public_header')

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap"  style="margin-top: 160px;">
		<div class="container">
			
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-7" style="background-color: #f3f3f3;">
						<h3 class="mt-4">Billing Details</h3>
						<form class="row contact_form" action="{{route('order.payment')}}" method="post" novalidate="novalidate">
							@csrf
							<div class="col-md-6 form-group">
								<label for="">First Name <span class="text-danger">*</span> :</label>
								<input type="text" class="form-control" id="first" name="fname" value="@if(isset($user)){{$user_data[0]->name}}@endif" placeholder="First Name">
								@error('fname')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6 form-group">
								<label for="">Last Name <span class="text-danger">*</span> :</label>
								<input type="text" class="form-control" id="last" name="lname" value="@if(isset($user)){{$user_data[0]->lname}}@endif" placeholder="Last Name">
								@error('lname')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<label for="">Email Address :</label>
								<input type="email" class="form-control" id="email" name="email" value="@if(isset($user)){{$user_data[0]->email}}@endif" placeholder="Email Address">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Phone Number <span class="text-danger">*</span> :</label>
								<input type="text" class="form-control" id="number" name="number" value="@if(isset($user)){{$user_data[0]->phone}}@endif" placeholder="Phone number">
								@error('number')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-6 form-group">
								<label for="">City Location <span class="text-danger">*</span> :</label>
								<select class="country_select target city" onchange="changeCity()" id="city" name="city">
									@foreach ($cities as $city)
										<option class='single-city{{$city->city}}' data-price='{{$city->delivery_price}}' value="{{$city->city}}" @if(isset($user) && $user_data[0]->city == $city->city) selected clicked @endif>{{$city->city}}</option>
									@endforeach
								</select>
								@error('city')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-md-12 form-group">
								<label for="">Address Line <span class="text-danger">*</span> :</label>
								<input type="text" class="form-control" id="address" name="address" value="@if(isset($user)){{$user_data[0]->Address}}@endif" placeholder="Address">
								@error('address')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<h3>Shipping Details</h3>
								</div>
								<textarea class="form-control" name="notes" id="notes" rows="1" placeholder="Order Notes"></textarea>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" onclick="return confirm('Are you Sure that you finished shopping ?')" class="main_btn btn-block p-3">CheckOut</button>
							</div>
						</form>
					</div>
					<div class="col-lg-5">
						<div class="order_box">
							<h2>Your Order</h2>
							<ul class="list">
								<li>
									<a class="text-dark"><strong>Product</strong>
										<span><strong>Total</strong></span>
									</a>
                                </li>
                                <div class="orders-box">
								<?php $total = 0; ?>
								@foreach ($providers as $provider)
								<li>
									<a class="text-primary"><strong>{{$provider['provider']}}</strong>
									</a>
                                </li>
								
								<?php $provider_total = 0; ?>
								@foreach ($cart as $ca)
									@foreach ($ca as $car)
									
									@if ($car['provider_id'] == $provider['provider_id'])
									
                                <li>
									<a>{{$car['title']}}
										<strong class="text-dark">X{{$car['quantity']}}</strong>
										<span class="last">JD{{number_format($car['unit_price']*$car['quantity'],2)}}</span>
									</a>
                                </li>    
								<?php $total+= $car['unit_price']*$car['quantity']; ?>
								<?php $provider_total+= $car['unit_price']*$car['quantity']; ?>
									@endif
								@endforeach
								@endforeach
								<?php session(['providers_total_'.$provider['provider_id']=>$provider_total]) ?>
								<li>
									<a class="text-dark"><strong>Total</strong>
										<span class="text-dark" id="provider_totalPrice"><strong>{{number_format($provider_total,2)}}</strong><small class="delivery"></small></span>
									</a>
                                </li>
                                @endforeach
                                </div>
								
								<li class="">
                                    <a class="text-dark">
                                        <strong>
                                            Total Price Including Delivery :
											<span>JD-<span id="totalPrice" data="{{$total}}">{{number_format($total,2)}}</span></span>
											<?php session(['total_price'=>$total]); ?>
                                        </strong>
                                    </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->
	@include('public_views.includes.public_footer')
	
	<script>
		
		var city_name = $('#city').val();
		var city = $('.single-city'+city_name).attr('data-price');
		var total =  $('#totalPrice').attr('data');
		var totalWithDel = (parseFloat(city)* "{{$count_provider}}") + parseFloat(total);
		$("#totalPrice").text(totalWithDel);
		$('.delivery').html(' + '+ city);
		
		function changeCity(){
			var city_name = $('#city').val();
			var city = $('.single-city'+city_name).attr('data-price');
			if(city == ""){
				city = 0.00;
				$('.delivery').html(' ');
			}
			var total =  $('#totalPrice').attr('data');
			var totalWithDel = (parseFloat(city)* "{{$count_provider}}") + parseFloat(total);
			$("#totalPrice").text(totalWithDel);
			$('.delivery').html(' + '+ city);
		}
	</script>