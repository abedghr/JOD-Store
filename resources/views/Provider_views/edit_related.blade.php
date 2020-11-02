<?php $guard = 'provider'; ?>
@include('Provider_views.includes.provider_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Related Products</h1>
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
                <h3 class="card-title">Edit Related Product</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('related_provider.update',['id'=> $related->id])}}"  enctype="multipart/form-data" >
                @csrf
                @method("put")
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Related Name</label>
                  <input type="text" class="form-control" value="{{$related->name}}" id="exampleInputEmail1" name="name" placeholder="Enter Admin name">
                    @error('name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="U_related" class="btn btn-primary">Update Related Product</button>
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