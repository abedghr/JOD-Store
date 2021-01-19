<?php $guard="admin_provider" ?>
@include('provAdmin_views.includes.provAdmin_header')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Expire Subscribe</h1>
                </div><!-- /.col -->
              </div>
            </div>
        </div>
    </section>
    <div class="container mt-5">
        <div class="row" id="pay_cards">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center card">
                <div class="card-body"style="border-bottom: 1px solid silver">
                    <h3 class="text-danger">Expire Subscribe</h3>
                    <img src="{{asset('img/close.png')}}" />
                    <p><strong>Please wait for the admin to renew the subscription.</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('provAdmin_views.includes.provAdmin_footer')

