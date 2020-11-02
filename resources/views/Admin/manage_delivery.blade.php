<?php $guard='admin' ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Delivery</h1>
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
                <h3 class="card-title">Add New City</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('city.store')}}"  enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="city_name" placeholder="Enter Category name">
                                @error('city_name')
                                    <small class="text-danger"><strong>{{$message}}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">City Price<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="delivery_price" placeholder="Enter City Price">
                                @error('delivery_price')
                                    <small class="text-danger"><strong>{{$message}}</strong></small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="C_Admin" class="btn btn-primary">Create</button>
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
      <div class="card-header">
        <h3 class="card-title">Cities List</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            {!! $cities->links() !!}
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table text-center">
          <thead>
            <tr>
              <th>City</th>
              <th>Delivery Price</th>
              <th>Created At</th>
              <th style="width: 40px">Actions</th>
            </tr>
          </thead>
          <tbody>
              
              @foreach ($cities as $city)
              <tr>
                <td>{{$city->city}}</td>
                <td>JD-{{number_format($city->delivery_price,2)}}</td>
                <td>{{$city->created_at->format('Y-m-d')}}</td>
                <td style="width:200px;">
                    <a href="{{route('delivery.edit',['id'=> $city->id])}}" class="btn btn-info">Update</a>
                    <form method="post" action="{{route('delivery.destroy',['id'=>$city->id])}}" style="display: inline">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger">DELETE</button>
                </form>
                </td>
              </tr>
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