<?php $guard = 'admin'; ?>
@include('Admin.includes.admin_header')

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
                <h3 class="card-title">Add New Related Product</h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('related.store')}}"  enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Related Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter Related name" required>
                    @error('name')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Provider<span class="text-danger">*</span>  </label>
                    <select name="provider" id="" class="form-control" required>
                      <option value=""></option>
                      @foreach ($providers as $provider)
                          <option value="{{$provider->id}}">{{$provider->name}}</option>
                      @endforeach
                    </select>
                    @error('provider')
                        <small class="text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                 </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="C_related" class="btn btn-primary">Create Related Product</button>
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
    <div class="card">
      <div class="card-header bg-secondary mb-2">
        <h3 class="card-title">Related Products</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            {{-- {!! $categories->links() !!} --}}
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 table-responsive">
        <table class="table text-center" id="table">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th>Provider</th>
              <th>Created At</th>
              <th style="width: 40px">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php $i=1;?>
              @foreach ($all_related as $rel)
              <tr>
                <td>{{$i}}</td>
                <td>{{$rel->name}}</td>
                <td>{{$rel->provider->name}}</td>
                <td>{{$rel->created_at->format('Y-m-d')}}</td>
                <td style="width:200px;">
                <a href="{{route('related.edit',['id'=> $rel->id])}}" class="btn btn-info">Update</a>
                <form method="post" action="{{route('related.destroy',['id'=>$rel->id])}}" style="display: inline">
                    @csrf
                    @method('delete')
                <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger">DELETE</button>
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