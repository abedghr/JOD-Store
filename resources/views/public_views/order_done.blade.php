<?php $pageTitle="Order Done" ?>
@include('public_views.includes.public_header')

<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center"  style="background-image:url('../../img/order_done.jpg');">
        <div class="container"><br>
            <div class="banner_content text-center text-light" style="margin-top: 80px !important;">
                <h2 class="order-done">Order Done</h2>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Order Details Area =================-->
<section class="order_details p_120">
    <div class="container">
        <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
        <div class="row order_d_inner">
            <div class="col-lg-6">
                <div class="details_item">
                    <h4>Your Info</h4>
                    <ul class="list">
                        <li>
                            <a href="#">
                                <span>Your Email</span> : {{$email}}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>City</span> : {{$city}}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Address</span> : {{$address}}</a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Total price</span> : <strong>JD{{$total_price}}</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="details_item">
                    <h4>Your Orders</h4>
                    <ul class="list">
                        @foreach ($your_orders as $order)
                        <li>
                            <a href="#">
                                <span>Order ID</span> : &nbsp; <strong>{{$order}}</strong></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
<br>
@include('public_views.includes.public_footer')