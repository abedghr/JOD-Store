<?php $guard = "admin"; ?>
@include('Admin.includes.admin_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Categories</h1>
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
                <h3 class="card-title">Edit Category</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('category.update',['id'=> $category->id])}}"  enctype="multipart/form-data" >
                @csrf
                @method("put")
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" value="{{$category->cat_name}}" id="exampleInputEmail1" name="cat_name" placeholder="Enter Admin name">
                    @error('cat_name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
                <div class="form-group">
                <label for="exampleInputFile">Category Image <span class="text-danger">Optional</span></label>
                <div class="input-group">
                    <div class="custom-file">
                    <input type="file" name="cat_image" class="custom-file-input" id="exampleInputFile">
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
                  <button type="submit" name="C_cat" class="btn btn-primary">Update Category</button>
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
@include('Admin.includes.admin_footer')