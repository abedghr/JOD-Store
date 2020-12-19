<?php $pageTitle = "Tracking Order" ?>
@include('public_side.includes.public_header')

<div class="page-head_agile_info_w3l" style="background-image: url({{asset('img/track.jpg')}}); background-size:100% 100%;">
    <div class="container">
        <h3 class="text-dark">Tracking<span> Order </span></h3>
</div>
</div>
<!--================Tracking Box Area =================-->
<section class="tracking_box_area p_120 mt-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-3 mb-5">
                <div class="tracking_box_inner">
                    <p class="ml-3">To track your order please enter your Order ID in the box below and press the "Track" button.</p>
                        <div class="col-md-12 form-group mt-3">
                            <input type="text" class="form-control" id="order_id" name="order" placeholder="Order ID">
                        </div>
                        <div class="col-md-12 form-group">
                            <a class="hvr-outline-out button2 btn text-light" onclick="show_tracking()" style="border-radius: 0px !important;">Track Order </a>
                        </div>
                </div>
                <br>
            </div>
            <div class="col-md-6 mt-3" id="tracking-box">
                {{-- <article class="card">
                    <header class="card-header"><h6>Order ID: OD45345345435</h6></header>
                    <div class="card-body">
                        <div class="track">
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Order confirmed</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Order Done</span> </div>
                        </div>
                        <hr>
                        <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                    </div>
                </article> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tracking_box_inner mt-2">
                    <p class="ml-3">If you want to show your orders just enter your email billing or you mobile number.</p>
                        <div class="col-md-12 form-group mt-3">
                            <input type="text" id="user_phone" class="form-control" name="phone" placeholder="Billing Phone">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="hvr-outline-out button2 btn text-light" onclick="show_orders()" style="border-radius: 0px !important;">show Your Orders</button>
                        </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 35px;">
                <strong>
                    
                    <ul class="list-group" id="orders_view">
                        
                    </ul>
                </strong>
            </div>
        </div>
    </div>
</section>
@include('public_side.includes.public_footer')
<script>
    function show_tracking(){
        var order_id = $('#order_id').val();
        $.ajax({
            type : "GET",
            url : "{{route('show.tracking')}}",
            data : {
                'order_id':order_id
            },
            success:function(data){
                if(data != 'Not Exist!'){
                    $('#tracking-box').html(data);
                }else{
                    $feed = "There Is No Order in this ID";
                    swal($feed, " ", "error");
                    $('.swal-button').css('background-color','red');
                }
            }
        });
    }
    function show_orders(){
        var phone = $('#user_phone').val();

        $.ajax({
            type : "GET",
            url : "{{route('show.user.orders')}}",
            data : {
                'user_phone':phone
            },
            success:function(data){
                if(data != 'Not Exist!'){
                $('#orders_view').html(data);
                }else{
                    $feed = "You Dont Have Orders";
                    swal($feed, " ", "error");
                    $('.swal-button').css('background-color','red');
                }
            }
        });
    }

</script>