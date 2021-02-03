<?php $guard = 'admin'; ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Stores</h1>
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
                <h3 class="card-title">Add New Store</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('manage_provider.store')}}"  enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Store Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="prov_name" placeholder="Enter Provider name">
                    @error('prov_name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Store Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Provider email">
                    @error('email')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Store Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Provider Password">
                    @error('password')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile Number (1)<span class="text-danger">*</span></label>
                            <input type="tel" pattern="[079]{3}[0-9]{7}|[078]{3}[0-9]{7}|[077]{3}[0-9]{7}" class="form-control" id="exampleInputPassword1" name="phone1" placeholder="Enter Mobile Number (1)">
                            @error('phone1')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile Number (2) <span class="text-danger"> Optional</span></label>
                            <input type="tel" pattern="[079]{3}[0-9]{7}|[078]{3}[0-9]{7}|[077]{3}[0-9]{7}" class="form-control" id="exampleInputPassword1" name="phone2" placeholder="Enter Mobile Number (2)">
                            @error('phone2')
                                <small class="text-danger"><strong>{{$message}}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description <span class="text-danger"> Optional</span></label>
                    <textarea name="description" id="" class="form-control"></textarea>
                    @error('description')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Store Image<span class="text-danger"> Optional</span></label>
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
                    <label for="exampleInputFile">Store Cover Image<span class="text-danger"> Optional</span></label>
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
                  <button type="submit" name="C_Admin" class="btn btn-primary">Create Store</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>
<!-- /.col -->

<div class="col-md-12">
    <div class="card card-secondary">
      <div class="card-header mb-2">
        <h3 class="card-title">Stores List</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 table-responsive">
        <table class="table text-center" id="table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Subscribe</th>
              <th style="width: 40px">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php $i=1;?>
              
              @foreach ($providers as $provider)
              <tr>
                <td>
                {{-- <img src="../img/Provider_images/{{$provider->image}}" width="60" height="60" class="rounded-circle" alt="">
                 --}}<img src="{{asset('img/Provider_images/'.$provider->image)}}" width="60" height="60" class="rounded-circle" alt="">
                </td>
                <td>{{$provider->name}}</td>
                <td>{{$provider->email}}</td>
                <td>{{$provider->phone1}}</td>
                @if ($provider->subscribe >0)
                <td class="text-success"><strong>Active</strong></td>
                @else
                <td class="text-danger"><strong>Disabled</strong></td>
                @endif
                
                <td style="width:200px;">
                <a href="{{route('manage_provider.show',['id'=> $provider->id])}}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                <a href="{{route('manage_provider.edit',['id'=> $provider->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <form method="post" action="{{route('manage_provider.destroy',['id'=>$provider->id])}}" style="display: inline">
                    @csrf
                    @method('delete')
                <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
                </td>
              </tr>
              <?php $i++; ?>
              @endforeach
              
              
              
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@include('Admin.includes.admin_footer')
<script>
  $(document).ready(function () {
$('#table').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>