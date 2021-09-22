<?php $guard = "provider" ?>
@include('provider_views.includes.provider_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Employees</h1>
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
                <h3 class="card-title">Edit Employee</h3>
              </div>

              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('admin_provider.update',['id'=> $admin->id])}}"  enctype="multipart/form-data" >
                @csrf
                @method("put")
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Employee Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$admin->name}}" id="exampleInputEmail1" name="admin_name" placeholder="Enter Admin name" required>
                        @error('admin_name')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Employee Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" value="{{$admin->email}}" id="exampleInputEmail1" name="email" placeholder="Enter Admin email" required>
                        @error('email')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Employee Password</label>
                        <input type="password" class="form-control"  id="exampleInputPassword1" name="password" placeholder="Enter a new password if you want to change it">
                        @error('password')
                            <small class="text-danger"><strong>{{$message}}</strong></small>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                      <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" placeholder="Confirm password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="U_Admin" class="btn btn-primary">Update Admin</button>
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
@include('provider_views.includes.provider_footer')
