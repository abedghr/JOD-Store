<?php $guard="provider" ?>
@include('Provider_views.includes.provider_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<!-- /.col -->

<div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-secondary text-light">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="card-title mt-2"><strong>Orders</strong></h3>
            </div>
            
            <div class="col-sm-6">
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                      {!! $categories->links() !!}
                    </ul>
                  </div>
            </div>
        </div>
        

        
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 table-responsive">
        <table class="table text-center">
          <thead>
            <tr>
              <th>Category Image</th>
              <th>Category Name</th>
              <th>Created At</th>
              <th>View</th>              
            </tr>
          </thead>
          <tbody>

              @foreach ($categories as $category)
                <tr>
                  <td><img src="../storage/Category_images/{{$category->cat_image}}" width="60" height="60" class="rounded-circle" alt=""></td>
                  <td>{{$category->cat_name}}</td>
                  <td>{{$category->created_at->format('Y-m-d')}}</td>
                  <td>
                    <a href="{{route('provider_category.show',['id'=>$category->id])}}" class="btn btn-warning mb-1"><i class="fa fa-eye"></i></a> 
                  </td>
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

@include('Provider_views.includes.provider_footer')
