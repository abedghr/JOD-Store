<?php $pageTitle = "Empty Cart" ?>
@include('public_side.includes.public_header')
<div class="page-head_agile_info_w3l" style="background-image: url({{asset('img/eco_shopping_cart.jpg')}}); padding-top:0px !important;">
    <div style="background-color: rgba(0,0,0,0.6); height:200px;">
        <div class="container">
            <h3 class="mt-5">Cart <span> is Empty </span></h3>
            <center><a class="hvr-outline-out button2 btn btn-lg mt-2" href="{{route('product.all2')}}" style="border-radius: 0px !important; color:white;">Go Shopping </a></center>
        </div>
    </div>
</div>
@include('public_side.includes.public_footer')