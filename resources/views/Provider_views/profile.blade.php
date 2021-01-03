<?php $guard = "provider" ?>
@include('Provider_views.includes.provider_header')
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
                            <img src="../img/Provider_images/{{Auth::user()->image}}" class="rounded" width="275" height="275" alt="">
                        </div>
                        <div class="col-md-8 mt-2">
                            <h4><strong>Name :</strong> {{Auth::user()->name}}</h4>
                            <h4><strong>Email :</strong> {{Auth::user()->email}}</h4>
                            <h4><strong>Mobile Number (1) :</strong> {{Auth::user()->phone1}}</h4>
                            <h4><strong>Mobile Number (2) :</strong> {{Auth::user()->phone2}}</h4>
                            <h4><strong>Subscribe :</strong> {{Auth::user()->subscribe}}</h4>
                            <h4><strong>Created At :</strong> {{Auth::user()->created_at->format('Y-m-d')}}</h4>
                            <h4><strong>Share Store On Facebook : </strong><div class="fb-share-button" data-href="http://jordan-store.herokuapp.com/store/{{Auth::user()->id}}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></h4>
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
          <form method="post" action="{{route('provider_profile.update',['id'=>Auth::user()->id])}}"  enctype="multipart/form-data" >
            @csrf
            @method("put")
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Provider Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->name}}" name="prov_name" placeholder="Enter Provider name">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mobile Number (1)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->phone1}}" name="phone1" placeholder="Enter Mobile Number (1)">
                        @error('phone1')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mobile Number (2) <span class="text-danger"> Optional</span></label>
                        <input type="text" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->phone2}}" name="phone2" placeholder="Enter Mobile Number (2)">
                        @error('phone2')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description <span class="text-danger"> Optional</span></label>
                <textarea name="description" id="" class="form-control">{{Auth::user()->description}}</textarea>
            </div>
            <div class="row">
              <div class="col-md-3">
                <img src="../img/Provider_images/{{Auth::user()->image}}" height="200" width="200" alt="">
              </div>
              <div class="col-md-9 mt-5">
                <div class="form-group">
                  <label for="exampleInputFile">Provider Image<span class="text-danger"> Optional</span></label>
                  <div class="input-group">
                      <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-3">
                <img src="../img/Provider_coverimages/{{Auth::user()->cover_image}}" height="175" width="200" alt="">
              </div>
              <div class="col-md-9 mt-5">
                <div class="form-group">
                  <label for="exampleInputFile">Provider Cover Image<span class="text-danger"> Optional</span></label>
                  <div class="input-group">
                      <div class="custom-file">
                      <input type="file" name="cover_image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Facebook Page<span class="text-danger"> Optional</span></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->facebook}}" name="facebook" placeholder="Send your facebook page url">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Instagram Page<span class="text-danger"> Optional</span></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->instagram}}" name="instagram" placeholder="Send your instagram page url">
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Type of store :<span class="text-danger"> Optional</span></label>
                  <select name="store_type" id="" class="form-control">
                    <option value=""></option>
                    <option value="Online-store" @if (Auth::user()->store_type == 'Online-store') selected @endif >Online Store</option>
                    <option value="Real-store" @if (Auth::user()->store_type == 'Real-store') selected @endif >Real Store</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Address :<span class="text-danger"> Optional</span></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->address}}" name="address" placeholder="Send your Address">
                </div>
              </div>
            </div>
            
              
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" name="" class="btn btn-primary">Update Profile</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
</div>
</section>
<!-- /.col -->


</div>
@include('Provider_views.includes.provider_footer')