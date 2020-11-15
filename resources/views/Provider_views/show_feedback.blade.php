<?php $guard = "provider"; ?>
@include('provider_views.includes.provider_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">FeedBack</div>
                
                <div class="card-body">
                    <strong>From : {{-- {{$feedback->user_id ?  $feedback->users->name :  "Unknown"}} --}}</strong><br>
                    <p class="mt-2">{{$feedback->feedback}}</p>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>

@include('provider_views.includes.provider_footer')