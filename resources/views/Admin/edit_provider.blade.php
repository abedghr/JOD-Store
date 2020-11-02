<?php $guard = 'admin'; ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Providers</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Update Provider</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('manage_provider.update',['id'=>$provider->id])}}"  enctype="multipart/form-data" >
                @csrf
                @method('put')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Provider Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="prov_name" value="{{$provider->name}}" placeholder="Enter Provider name">
                    @error('prov_name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Provider Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="{{$provider->email}}" name="email" placeholder="Enter Provider email">
                    @error('email')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Provider Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter a new Password if you want to change it">
                    @error('password')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile Number (1)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{$provider->phone1}}" name="phone1" placeholder="Enter Mobile Number (1)">
                            @error('phone1')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile Number (2) <span class="text-danger"> Optional</span></label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{$provider->phone2}}" name="phone2" placeholder="Enter Mobile Number (2)">
                            @error('phone2')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description <span class="text-danger"> Optional</span></label>
                    <textarea name="description" id="" class="form-control">{{$provider->description}}</textarea>
                    @error('description')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
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
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="" class="btn btn-primary">Update Provider</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>
<!-- /.col -->
@include('Admin.includes.admin_footer')