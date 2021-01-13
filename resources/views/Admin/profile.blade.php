<?php $guard = "admin" ?>
@include('Admin.includes.admin_header')
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
                        <div class="col-md-4">
                            <img src="../img/default_user.png" class="rounded" width="275" height="275" alt="">
                        </div>
                        <div class="col-md-8 mt-5">
                            <h4><strong>Name :</strong> {{Auth::user()->name}}</h4>
                            <h4><strong>Email :</strong> {{Auth::user()->email}}</h4>
                            <h4><strong>Created At :</strong> {{Auth::user()->created_at->format('Y-m-d')}}</h4>
                            <h4><strong>Share Store On Facebook : </strong><div class="fb-share-button" data-href="http://jordan-store.herokuapp.com/home" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></h4>  
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

</div>
@include('Admin.includes.admin_footer')