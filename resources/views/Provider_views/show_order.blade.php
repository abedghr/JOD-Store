<?php $guard="provider" ?>
@include('Provider_views.includes.provider_header')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Order Details</h3>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    
                <div class="col-md-4">
                    <p class="text-center mt-3"><strong> Product Image </strong></p>
                    <img src="../../img/Product_images/{{$product->main_image}}" style="height:250px; width:100%;" class="rounded" alt="...">
                </div>
                
                <div class="col-md-8">
                    <div class="card-body mt-1">
                        <div class="card-text mt-5">
                            <p><strong>Product Name :</strong> {{$product->prod_name}}</p>
                            <p><strong>Product New Price :</strong> JD{{$product->new_price}}</p>
                            <p><strong> Category :</strong> {{$product->cat->cat_name}}</p>
                            <p><strong> Provider :</strong> {{$product->provid->name}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </div>
    <div class="card-body mt-1">
        <div class="card-text mt-5">
            <p><strong>Customer Name :</strong> {{$order->fname.' '.$order->lname}}</p>
            <p><strong>Customer Email :</strong> {{$order->email}}</p>
            <p><strong>Customer Phone :</strong> {{$order->phone}}</p>
            <p><strong>Customer Addrss :</strong> {{$order->Address}}</p>
            <p><strong>Customer Notes  :</strong> {{$order->notes ? $order->notes : '...'}}</p>
            <p><strong>Total Price   :</strong> JD-{{$order->total_price}}</p>
            <p><strong>Delivery Price   :</strong> JD-{{$order->city}}</p>
            <p><strong>Order Date   :</strong>{{$order->created_at->format('Y-m-d')}}</p>
            @if ($order->order_status == 0)
            <div style="width:250px;" id="first_state{{$order->id}}">
                <a class="btn btn-primary text-light" id="accept_order" onclick="accept_order({{$order->id}})" style="display: inline">Accept</a>
                <a class="btn btn-danger text-light" id="decline_order" onclick="decline_order({{$order->id}})" style="display: inline">Decline</a>
            </div>
            <div style="width: 250px; display:none;" id="second_state1{{$order->id}}">
                <a class="btn btn-primary text-light" id="delivery_process" onclick="delivery_process({{$order->id}})" style="display: inline">Delivery Process</a>
            </div>
            <div style="width: 250px; display:none;" id="second_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
            </div>
            <div style="width: 250px; display:none;" id="third_state{{$order->id}}">
                <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
            <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
            </div>    
            @endif
            @if ($order->order_status == 1)
            <div style="width: 250px;" id="second_state1{{$order->id}}">
                <a class="btn btn-primary text-light" id="delivery_process" onclick="delivery_process({{$order->id}})" style="display: inline">Delivery Process</a>
            </div>
            <div style="width: 250px; display:none;" id="second_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
            </div>
            <div style="width: 250px; display:none;" id="third_state{{$order->id}}">
                <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
            <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
            </div>
            @endif
            @if ($order->order_status == -1)
            <div style="width: 250px;" id="second_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
            </div>
            @endif
            @if ($order->order_status == 2)
            <div style="width: 250px;" id="third_state{{$order->id}}">
                <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
            <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
            </div>
            <div style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
            </div>
            @endif
            @if ($order->order_status == 3)
            <div style="width: 250px;" id="fourth_state1{{$order->id}}">
                <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
            </div>
            @endif
            @if ($order->order_status == -2)
            <div style="width: 250px;" id="fourth_state2{{$order->id}}">
                <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
            </div>
            @endif
        </div>
    </div>
    </div>
    <!-- /.card -->
  </div>


@include('Provider_views.includes.provider_footer')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script>
    function accept_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.accept')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state1"+id).show();
                    $("#second_state2"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                }
            });
    }

    function decline_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.decline')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).show();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                }
            });
    }

    function delivery_process(id){
        
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.delivery_process')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                    $("#third_state"+id).show();
                }
            });
    }
    function received_order(id){
        var order_id =id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.received')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).show();
                    $("#fourth_state2"+id).hide();
                }
            });
    }
    function unreceived_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.unreceived')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).show();
                }
            });
    }
</script>
