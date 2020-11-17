<?php $guard = "admin_provider" ?>
@include('provAdmin_views.includes.provAdmin_header')
<div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Profile</h3>
              </div>
              
              <!-- /.card-header -->
             
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="../../img/default_user.png" class="rounded" width="275" height="275" alt="">
                        </div>
                        <div class="col-md-8 mt-2">
                            <h4><strong>Name :</strong> {{Auth::user()->name}}</h4>
                            <h4><strong>Email :</strong> {{Auth::user()->email}}</h4>
                            <h4><strong>Provider : "{{Auth::user()->MainProvider->name}}"</strong></h4>
                            <h4><strong>Created At :</strong> {{Auth::user()->created_at->format('Y-m-d')}}</h4>
                        </div>
                    </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>
<!-- /.col -->

<!-- Main content -->
<section class="content mt-5">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
          </div>
          
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{route('provAdmin.profile.update',['id'=>Auth::user()->id])}}"  enctype="multipart/form-data" >
            @csrf
            @method("put")
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Provider Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->name}}" name="name" placeholder="Enter Provider name">
                @error('prov_name')
                    <small class="text-danger"><strong>{{$message}}</strong></small>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Provider Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->email}}" name="email" placeholder="Enter Provider email">
                @error('email')
                    <small class="text-danger"><strong>{{$message}}</strong></small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Provider Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter a new password if you want to change it">
                @error('password')
                    <small class="text-danger"><strong>{{$message}}</strong></small>
                @enderror
            </div> 
            <div class="card-footer">
              <button type="submit" name="" class="btn btn-primary">Update Profile</button>
            </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@include('provAdmin_views.includes.provAdmin_footer')