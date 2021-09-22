<?php $guard = "provider" ?>
@include('provider_views.includes.provider_header')
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
                  <h3>{{$orders_number}}</h3>

                  <p>Total Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>{{$total_price}}<sup style="font-size: 20px">JD</sup></h3>

                  <p>Total Sales</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer disabled"><i class="fas fa-arrow-circle-up"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$products_number}}</h3>

                  <p>Products Number</p>
                </div>
                <div class="icon">
                  <i class="ion fa fa-product-hunt"></i>
                </div>
                <a href="{{route('product_provider.create')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>{{$visitors}}</h3>

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
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$ordersDone}}</h3>

                  <p>Orders Done</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('order.filters',['status'=>3])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$ordersDeclined}}</h3>

                  <p>Orders Declined</p>
                </div>
                <div class="icon">
                  <i class="fa fa-ban"></i>
                </div>
                <a href="{{route('order.filters',['status'=>-1])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$ordersOnDelivery}}</h3>

                  <p>Orders In Delivery</p>
                </div>
                <div class="icon">
                  <i class="fa fa-car"></i>
                </div>
                <a href="{{route('order.filters',['status'=>1])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$ordersFailed}}</h3>

                  <p>Orders Failed</p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-down"></i>
                </div>
                <a href="{{route('order.filters',['status'=>-2])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>All notifications</h3>

                  <p>&nbsp;</p>
                </div>
                <div class="icon">
                  <i class="far fa-bell"></i>
                </div>
                <a href="{{route('provider.allNotifications')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$feedbacks}}</h3>

                  <p>Feedbacks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="{{route('provider_feedback.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
</div>
    </section>
</div>
@include('provider_views.includes.provider_footer')
