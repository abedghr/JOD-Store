<?php $guard="admin_provider" ?>
@include('provAdmin_views.includes.provAdmin_header')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Details</h1>
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
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Category Details</h3>
            </div>
            <div class="row">
                
                    
                <div class="col-md-4">
                    <p class="text-center mt-3"><strong> Product Image </strong></p>
                    <img src="../../storage/Category_images/{{$category->cat_image}}" style="height:250px; width:100%;" class="rounded" alt="...">
                </div>
                
                <div class="col-md-8">
                    <div class="card-body mt-1">
                        <div class="card-text mt-5">
                            <h3><strong>Category Name :</strong> {{$category->cat_name}}</h3>
                            <h3><strong>Created At :</strong> {{$category->created_at->format('Y-m-d')}}</h3>
                        </div>
                    </div>
                </div>
               
            </div>
            
        </div>
    </div>
</div>
@include('provAdmin_views.includes.provAdmin_footer')