<?php $guard = "admin" ?>
@include('Admin.includes.admin_header')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
              </div>
            </div>
        </div>
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$users_messages}}</h3>
                  <p>Users Messages</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="{{route('message.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>{{$cities}}</h3>
  
                  <p>Cities Involved</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-globe"></i>
                </div>
                <a href="{{route('delivery.price')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$providers_number}}</h3>
  
                  <p>Stores Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-users"></i>
                </div>
                <a href="{{route('manage_provider.create')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$providers_active}}</h3>
  
                  <p>Active Stores</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$all_users}}</h3>
  
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>44</h3>
  
                  <p>Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer disabled"><i class="fas fa-arrow-circle-up"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$count_categories}}</h3>
  
                  <p>Categories</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-list-alt"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$providers_disabled}}</h3>
  
                  <p>Disabled Stores</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
</div>
    </section>
</div>
@include('Admin.includes.admin_footer')
