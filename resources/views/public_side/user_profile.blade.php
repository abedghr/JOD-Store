<?php $pageTitle = "User Profile" ?>
@include('public_side.includes.public_header')
<div class="whole-wrap mt-5">
    <div class="container">
        <div class="section-top-border">
            <h2 class="mb-30 title_color mb-3 bg-light p-4">User Profile</h2>
            <div class="row">
                <div class="col-md-5">
                    <h3 class="mb-3">User Information :</h3>
                    <h4 class="mb-2"><strong class="text-dark">Name :</strong> &nbsp;{{$userData->name}}</h4>
                    <h4 class="mb-2"><strong class="text-dark">Email :</strong> &nbsp;{{$userData->email}}</h4>
                    <h4 class="mb-2"><strong class="text-dark">Phone :</strong> &nbsp;{{$userData->phone}}</h4>
                    <h4 class="mb-2"><strong class="text-dark">Phone (2) :</strong> &nbsp;{{$userData->phone2}}</h4>
                    <h4 class="mb-2"><strong class="text-dark">City :</strong> &nbsp;{{$userData->city}}</h4>
                    <h4 class="mb-2"><strong class="text-dark">Address :</strong> &nbsp;{{$userData->Address}}</h4>
                    
                </div>
                <div class="col-md-7 mt-sm-20 left-align-p">
                    <form method="POST" action="{{route('user.update',['id'=>$userData->id])}}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">First Name :</label>
                                    <input type="text" name="user_name" value="{{$userData->name}}" class="form-control" placeholder="Enter Your First Name">                        
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Last Name :</label>
                                    <input type="text" name="user_lname" value="{{$userData->lname}}" class="form-control" placeholder="Enter Your Last Name">                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">User Email :</label>
                            <input type="email" name="user_email" value="{{$userData->email}}" class="form-control" placeholder="Enter Your Email">                        
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">User Phone(1) :</label>
                                    <input type="text" name="user_phone1" value="{{$userData->phone}}" class="form-control" placeholder="Enter Your Phone(1)">                        
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">User Phone(2) :</label>
                                    <input type="text" name="user_phone2" value="{{$userData->phone2}}" class="form-control" placeholder="Enter Your Phone(2)">                        
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">City :</label><br>
                                    <select class="form-control w-100" name="user_city">
                                        <option class="w-100"></option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->city}}" @if ($userData->city == $city->city) 
                                                selected
                                            @endif class="form-control">{{$city->city}}</option>
                                        @endforeach
                                    </select>                        
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Address :</label>
                                    <input type="text" name="user_address" value="{{$userData->Address}}" class="form-control" placeholder="Enter Your Address">                        
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            {{-- <input type="submit" value="Update" class="main_btn btn-block"> --}}
                            <button type="submit" class="btn-block p-3" style="background-color:#17c3a2; font-weight:bold;">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="container mt-5">
@if (isset($yourOrders[0]))
<h2 class="text-dark mb-4">Your Orders :</h2>
@foreach ($yourOrders as $order)

<div class="card mb-4">
    <h5 class="card-header bg-dark text-light p-4">Order ID : {{$order->id}} , <strong>Created At : </strong>{{$order->created_at}}</h5>
    <div class="card-body row">
      <div class="col-md-2">
        <p class="card-text"><strong>Store : {{$order->Prov->name}}</strong></p>
      </div>
      <div class="col-md-3">
        <p class="card-text">Email : {{$order->email}}</p>
      </div>
      <div class="col-md-2">
        <p class="card-text">City : {{$order->city}}</p>
      </div>
      <div class="col-md-2">
        <p class="card-text">Address : {{$order->Address}}</p>
      </div>
      <div class="col-md-1">
        <p class="card-text">Total : JD{{$order->total_price}}</p>
      </div>
      <div class="col-md-2">
        <p class="card-text">Total Price Including Delivery : {{$order->total_With_Delivery}}</p>
      </div>
      <div class="col-md-12">
          <hr>
      </div>
      <div class="col-md-12 row">
        @foreach ($productsOrder as $prod)
              @if ($order->id == $prod['order_id'])
              <div class="col-md-3 mt-3">
                  <img src="../../img/Product_images/{{$prod['image']}}" width="100%" height="200" alt="">
              </div>
              <div class="col-md-9 mt-3">
                <strong>
                    <p class="mb-3">Product Name : {{$prod['prod_name']}}</p>
                    <p class="mb-3">Price : JD{{$prod['price']}}</p>
                    <p class="mb-3">Quantity : {{$prod['quantity']}}</p>
                    <p class="mb-3">Category : {{$prod['category']}}</p>
                    <p class="mb-3">Store : {{$prod['provider']}}</p>
                </strong>
            </div>
              @endif
        @endforeach
      </div>        
      </div>
      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
    </div>
@endforeach
@endif

</div>
@include('public_side.includes.public_footer')