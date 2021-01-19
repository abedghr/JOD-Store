@section('main')
<article class="card">
    <header class="card-header bg-light"><h4>Order ID: {{$order_id}}</h4></header>
    <div class="card-body">
        <div class="track">
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
            <div class="step active-failed"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Un-received Order</span> </div>
        </div>
        <hr>
        <a href="#" class="hvr-outline-out button2 btn text-light" data-abc="true" style="border-radius: 0px !important;"> <i class="fa fa-eye"></i> Show The order</a>
    </div>
</article>
@endsection