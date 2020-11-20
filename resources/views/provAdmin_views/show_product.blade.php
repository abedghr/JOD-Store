<?php $guard = "admin_provider" ?>
@include('provAdmin_views.includes.provAdmin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Products</h1>
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
              <h3 class="card-title">Product Details</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p class="text-center mt-3"><strong> Product Image </strong></p>
                    <img src="../../img/Product_images/{{$product->main_image}}" style="height:435px; width:100%;" class="rounded" alt="...">
                </div>
                
                <div class="col-md-8">
                    <div class="card-body mt-1">
                        <div class="card-text mt-5">
                            <p><strong>Product Name :</strong> {{$product->prod_name}}</p>
                            <p><strong>Description :</strong> {{$product->description}}</p>
                            <p><strong>Product Old Price :</strong> JD{{$product->old_price ? $product->old_price : 00}}</p>
                            <p><strong>Product New Price :</strong> JD{{$product->new_price}}</p>
                            <p><strong> Category :</strong> {{$product->cat->cat_name}}</p>
                            <p><strong> Gender :</strong> {{$product->gender}}</p>
                            <p><strong> Provider :</strong> {{$product->prov->name}}</p>
                            <p><strong> Availability :</strong> {{$product->availability == 1 ? 'Available' : 'Un-available'}}</p>
                            <p><strong> Status :</strong> {{$product->prod_status ? $product->prod_status : "none"}}</p>
                            <p><strong> Related :</strong> {{$product->related ? $product->related->name : "....."}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@include('provAdmin_views.includes.provAdmin_footer')