<?php $pageTitle = "Checkout" ?>
@include('public_side.includes.public_header')
<div class="page-head_agile_info_w3l" style="background-image: url({{asset('img/order_done.jpg')}}); background-size:100% 100%;">
    <div class="container">
        <h3>CheckOut</h3>
        <!--/w3_short-->
             <div class="services-breadcrumb">
                    
            </div>
        <!--//w3_short-->
    </div>
</div>
<!--================Checkout Area =================-->
<section class="checkout_area section_gap mb-5 mt-5">
    <div class="container">
        <div class="billing_details">
            <div class="row" style="background-color: #f3f3f3;">
                <div class="col-lg-7">
                    <h3 class="mt-5">Billing Details</h3>
                    <form class="row contact_form mt-3" action="{{route('order.payment')}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-6 form-group">
                            <label for="">First Name <span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control mt-2"  id="first" name="fname" value="@if(isset($user)){{$user_data[0]->name}}@endif" placeholder="First Name">
                            @error('fname')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Last Name <span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control mt-2" id="last" name="lname" value="@if(isset($user)){{$user_data[0]->lname}}@endif" placeholder="Last Name">
                            @error('lname')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Email Address : <span class="text-danger">*</span></label>
                            <input type="email" class="form-control mt-2" id="email" name="email" value="@if(isset($user)){{$user_data[0]->email}}@endif" placeholder="Email Address">
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Phone Number <span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control mt-2" id="number" name="number" value="@if(isset($user)){{$user_data[0]->phone}}@endif" placeholder="Phone number">
                            @error('number')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">City Location <span class="text-danger">*</span> :</label>
                            <select class="form-control mt-2 target city" onchange="changeCity()" id="city" name="city">
                                @foreach ($cities as $city)
                                    <option class='single-city{{$city->city}}' data-price='{{$city->delivery_price}}' value="{{$city->city}}" @if(isset($user) && $user_data[0]->city == $city->city) selected clicked @endif>{{$city->city}}</option>
                                @endforeach
                            </select>
                            @error('city')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label for="">Address Line <span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control mt-2" id="address" name="address" value="@if(isset($user)){{$user_data[0]->Address}}@endif" placeholder="Address">
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <h3>Shipping Details <small class="text-danger">(Optional)</small></h3>
                            </div>
                            <textarea class="form-control mt-2" name="notes" id="notes" rows="4" placeholder="Order Notes"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" onclick="return confirm('Are you Sure that you finished shopping ?')" class="btn-block p-3" style="background-color:#17c3a2; font-weight:bold;">CheckOut</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="order_box">
                        <h2 class="mt-5">Your Order</h2>
                        <ul class="list-group w3-agile mt-3">
                            <li class="list-group-item" style="width:441px">
                                <a class="text-dark"><strong>Product</strong>
                                    <span style="float:right;"><strong>Total</strong></span>
                                </a>
                            </li>
                            <div class="orders-box" style="overflow-y:scroll; height:421px;">
                            <?php $total = 0; ?>
                            @foreach ($providers0 as $provider)
                            <li class="list-group-item">
                                <a class="text-primary" style="color:#2fdab8"><strong>{{$provider['provider']}}</strong>
                                </a>
                            </li>
                            
                            <?php $provider_total = 0; ?>
                            @foreach ($cart as $ca)
                                @foreach ($ca as $car)
                                
                                @if ($car['provider_id'] == $provider['provider_id'])
                                
                            <li class="list-group-item">
                                <a class="text-dark">{{$car['title']}}
                                    <strong class="text-dark">X{{$car['quantity']}}</strong>
                                    <span class="text-dark"style="float:right">{{number_format($car['unit_price']*$car['quantity'],2)}} JOD</span>
                                </a>
                            </li>    
                            <?php $total+= $car['unit_price']*$car['quantity']; ?>
                            <?php $provider_total+= $car['unit_price']*$car['quantity']; ?>
                                @endif
                            @endforeach
                            @endforeach
                            <?php session(['providers_total_'.$provider['provider_id']=>$provider_total]) ?>
                            <li class="list-group-item">
                                <a class="text-dark"><strong>Total</strong>
                                    <span class="text-dark" id="provider_totalPrice" style="float:right"><strong>{{number_format($provider_total,2)}}</strong><small class="delivery"></small></span>
                                </a>
                            </li>
                            @endforeach
                            </div>
                            
                            <li class="list-group-item">
                                <a class="text-dark">
                                    <strong>
                                        Total Price Including Delivery :
                                        <span><span id="totalPrice" data="{{$total}}">{{number_format($total,2)}}</span> JOD</span>
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
@include('public_side.includes.public_footer')
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