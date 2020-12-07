<?php $pageTitle="User Profile"; ?>
@include('public_views.includes.public_header')
<!-- Start Align Area -->
<br><br>
<div class="whole-wrap mt-5">
    <div class="container">
        <div class="section-top-border">
            <h2 class="mb-30 title_color">User Profile</h2>
            <div class="row">
                <div class="col-md-5">
                    <h3 class="mb-5">User Information :</h3>
                    <h4><strong class="text-dark">Name :</strong> {{$userData->name}}</h4>
                    <h4><strong class="text-dark">Email :</strong> {{$userData->email}}</h4>
                    <h4><strong class="text-dark">Phone :</strong> {{$userData->phone}}</h4>
                    <h4><strong class="text-dark">City :</strong> {{$userData->city}}</h4>
                    <h4><strong class="text-dark">Address :</strong> {{$userData->Address}}</h4>
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
                                    <select class="country_select w-100" name="user_city">
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
                            <input type="submit" value="Update" class="main_btn btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>


<div class="container mt-5">
    <h2 class="text-dark">Your Orders :</h2>
@foreach ($yourOrders as $order)

<div class="card mb-4">
    <h5 class="card-header bg-secondary text-light">Order ID : {{$order->id}} , <small ><strong>Created At : </strong>{{$order->created_at}}</small></h5>
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
                <p>Product Name : {{$prod['prod_name']}}</p>
                <p>Price : JD{{$prod['price']}}</p>
                <p>Quantity : {{$prod['quantity']}}</p>
                <p>Category : {{$prod['category']}}</p>
                <p>Store : {{$prod['provider']}}</p>
              </div>
              @endif
        @endforeach
      </div>        
      </div>
      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
    </div>
@endforeach
</div>
@include('public_views.includes.public_footer')