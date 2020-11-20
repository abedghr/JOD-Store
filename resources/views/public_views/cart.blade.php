<?php $pageTitle = "Cart Shopping" ?>
@include('public_views.includes.public_header')

<!--================Home Banner Area =================-->
<section class="text-center" style="margin-top: 160px;">
	<h1><span class="bg-light welcome_header">Shopping Cart</span></h1>
</section>
<!--================End Home Banner Area =================-->

	<!--================Cart Area =================-->
	<section class="cart_area">
		<div class="container">
			<div class="cart_inner">
				<div class="table-responsive">
					<table class="table">
						<thead>
							
						</thead>
						<tbody>
							<?php $total = 0 ;?>
							@foreach ($providers as $provider)
								<tr>
									<th>
									<h4><a href="{{route('public_provider.profile',['id'=>$provider['provider_id']])}}">{{$provider['provider']}}</a></h4>
									</th>
									<th scope="col"><strong>Price</strong></th>
									<th scope="col"><strong>Quantity</strong></th>
									<th scope="col"><strong>Total</strong></th>
									<th scope="col"><strong>Remove</strong></th>
								</tr>
								@foreach ($cart as $car)
									@foreach ($car as $ca)
									@if ($ca['provider_id'] == $provider['provider_id'])
										
									
									<tr>
                                    <td>
                                        <div class="media mt-3">
                                            <div class="d-flex">
                                                <img src="../../img/Product_images/{{$ca['image']}}" width="80" height="80" alt="">
                                            </div>
                                            <div class="media-body">
												<a href="{{route('product.show',['id'=>$ca['id']])}}">
												<p>{{$ca['title']}}</p>
												</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>JD{{number_format($ca['unit_price'],2)}}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <h5>X{{$ca['quantity']}}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>JD{{number_format($ca['unit_price']*$ca['quantity'],2)}}</h5>
									</td>
									<td>
										<a href="{{route('cart.remove',['prod_id'=>$ca['id'],'prov_id'=>$ca['provider_id']])}}" onclick="return confirm('Are you sure?')"><i class="btn btn-danger rounded-circle fa fa-remove"></i></a>
									</td>
								</tr>
								<?php $total += $ca['unit_price']*$ca['quantity']; ?>
								@endif
								@endforeach
							@endforeach
							@endforeach
							{{-- @foreach ($cart as $car)
							
							 @foreach ($car as $cart)
								 
							
							<tr>
                                    <td>
                                        <h4><a href="{{route('public_provider.profile',['id'=>$cart['provider_id']])}}">{{$cart['provider']}}</a></h4>
                                        <div class="media mt-3">
                                            <div class="d-flex">
                                                <img src="../../storage/Product_images/{{$cart['image']}}" width="80" height="80" alt="">
                                            </div>
                                            <div class="media-body">
												<a href="{{route('product.show',['id'=>$cart['id']])}}">
												<p>{{$cart['title']}}</p>
												</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>JD{{number_format($cart['unit_price'],2)}}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <h5>X{{$cart['quantity']}}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>JD{{number_format($cart['unit_price']*$cart['quantity'],2)}}</h5>
									</td>
									<td>
										<a href="{{route('cart.remove',['id'=>$cart['id']])}}" onclick="return confirm('Are you sure?')"><i class="btn btn-danger rounded-circle fa fa-remove"></i></a>
									</td>
                                </tr>
								<?php/*  $total += $cart['unit_price']*$cart['quantity'];  */?>
								@endforeach
                            @endforeach --}}
							
							<tr class="bottom_button">
								<td colspan="2">
									<div class="row">
										<div class="col-md-8">
											<div class="checkout_btn_inner">
												<a class="btn btn-secondary p-2" href="{{route('product.all')}}">Continue Shopping</a>
												<a class="main_btn" href="{{route('checkout')}}" style="display:inline-block; margin-top:4px;">Proceed to checkout</a>
											</div>
										</div>
									</div>
									
								</td>
								
								<td colspan="2">
									<div class="row">
										<div class="col-sm-12">
											<h5><strong>SubTotal: &nbsp;JD-{{number_format($total,2)}}</strong></h5>
										</div>
                                    
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
                </div>
                
			</div>
		</div>
	</section>
	<!--================End Cart Area =================-->
@include('public_views.includes.public_footer')