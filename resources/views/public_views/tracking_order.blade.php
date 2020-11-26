<?php 
$pageTitle = "Tracking Order";
?>

@include('public_views.includes.public_header')

<!--================Tracking Box Area =================-->
<section class="tracking_box_area p_120">
    <h2 style="font-family:Times New Roman; font-weight:bold; padding-left:50px; padding-top:25px; color:black; background-color:rgba(0,0,0,0.1); height:100px"><i>Tracking Orders</i></h2>
    <div class="container"   style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-6 mt-3 mb-5">
                <div class="tracking_box_inner">
                    <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given
                        to you on your receipt and in the confirmation email you should have received.</p>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="order_id" name="order" placeholder="Order ID">
                        </div>
                        <div class="col-md-12 form-group">
                            <button value="submit" onclick="show_tracking()" class="btn submit_btn">Track Order</button>
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
            <div class="col-md-6 mt3">
                <div class="tracking_box_inner">
                    <p class="mt-5">If you want to show your orders just enter your email billing or you mobile number.</p>
                        <div class="col-md-12 form-group">
                            <input type="text" id="user_phone" class="form-control" name="phone" placeholder="Billing Phone">
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn submit_btn" onclick="show_orders()">show Your Orders</button>
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
<!--================End Tracking Box Area =================-->
@include('public_views.includes.public_footer')

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