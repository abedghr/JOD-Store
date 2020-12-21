<?php $pageTitle = "Order done" ?>
@include('public_side.includes.public_header')
<div class="page-head_agile_info_w3l" style="background-image: url({{asset('img/order_done.jpg')}}); padding-top:0px !important;">
    <div style="background-color: rgba(0,0,0,0.6); height:200px;">
        <div class="container">
            <h3 class="mt-5">Order <span> Done </span></h3>
        </div>
    </div>
</div>

<!--================Order Details Area =================-->
<section class="order_details p_120">
    <div class="container">
        <h3 class="title_confirmation mt-5 ">Thank you. Your order has been received.</h3>
        <div class="row order_d_inner mb-5 bg-light">
            <div class="col-lg-6">
                <div class="details_item">
                    <h4 class="p-4">Your Order Details</h4>
                    <ul class="list">
                        <li>
                            <a href="#">
                                <span>Your Email</span> : <span class="text-dark">{{$email}}</span></a>
                        </li>
                        <li>
                            <a href="#">
                                <span>City</span> : <span class="text-dark">{{$city}}</span></a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Address</span> : <span class="text-dark">{{$address}}</span></a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Total price</span> : <strong class="text-dark">{{$total_price}} JOD</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="details_item">
                    <h4 class="p-4">Your Orders</h4>
                    <ul class="list">
                        @foreach ($your_orders as $order)
                        <li>
                            <a href="#">
                                <span>Order ID</span> : &nbsp;&nbsp; <strong class="text-dark">{{$order}}</strong></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@include('public_side.includes.public_footer')