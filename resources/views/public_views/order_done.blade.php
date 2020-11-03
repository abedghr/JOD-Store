<?php $pageTitle="Order Done" ?>
@include('public_views.includes.public_header')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="background-image:url('../../img/order_done.jpg'); background-size:100% 100% !important; margin-top: 120px !important;">
        <div class="overlay"></div>
        <div class="container">
            <div class="banner_content text-center text-light">
                <h2 class="order-done">Thank You For Order...<i class="fa fa-heart"></i> </h2>
                <p><strong>If You want to tracking your order :</strong></p>
                <p><strong>( Save This Information )</strong></p>
                <p><strong>Your Email : &nbsp;{{$email}}</strong></p>
                 @foreach ($your_orders as $order)
                    <p>order ID : <strong>{{$order}}</strong></p>
                    @endforeach
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<br>
@include('public_views.includes.public_footer')