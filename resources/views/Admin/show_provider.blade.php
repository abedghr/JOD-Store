<?php $guard="admin" ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Provider Details</h1>
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
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-center mt-3">Provider Image</p>
                    <img src="../../storage/Provider_images/{{$provider->image}}" style="height:275px; width:100%;" class="rounded" alt="...">
                </div>
                
                <div class="col-md-4">
                    <div class="card-body mt-1">
                        <div class="card-text text-center mt-5">
                            <p><strong>Provider Name :</strong> {{$provider->name}}</p>
                            <p><strong>Provider Email :</strong> {{$provider->email}}</p>
                            <p><strong>Provider Phone 1 :</strong> {{$provider->phone1}}</p>
                            <p><strong>Provider Phone 2 :</strong> {{$provider->phone2 ? $provider->phone2 : "000-000-0000"}}</p>
                            <p><strong>Verified  :</strong> 
                              @if ($provider->email_verified_at != null)
                                <span class="text-success"><strong>Verified at : {{$provider->email_verified_at}}</strong></span>
                              @else
                                <span class="text-danger"><strong>Not Verified</strong></span>
                              @endif</p>
                            <p><strong>Subscribe :</strong> {{$provider->subscribe}}</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="text-center mt-3">Provider Cover Image</p>
                    <img src="../../storage/Provider_coverimages/{{$provider->cover_image}}" style="height:275px; width:100%;" class="rounded" alt="...">
                </div>
            </div>
            <hr>
            <h5 class="ml-3 mr-3"><strong>description :</strong></h5>
            <p class="ml-3 mr-3">{{$provider->description}}</p>
        </div>
    </div>
</div>
@include('Admin.includes.admin_footer')