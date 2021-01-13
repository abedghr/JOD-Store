<?php $guard = "provider" ?>
@include('Provider_views.includes.provider_header')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Renewal Subscribe</h1>
                </div><!-- /.col -->
              </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row" id="pay_cards">
            <div class="col-md-1"></div>
            <div class="col-md-4 text-center card">
                <div class="card-header">
                    Subscribe for 1 Month
                </div>
                <div class="card-body"style="border-bottom: 1px solid silver">
                    <a id="checkout1" style="cursor: pointer;">
                        <img src="{{asset('img/credit.png')}}" alt="">
                    </a>
                </div>
                <div class="card-body">
                    <a id="checkout1" style="cursor: pointer;">
                        <h3 class="text-center text-dark" style=" font-weight:bold">1 Month(<span class="text-success">30 JOD</span>)</h3>
                    </a>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4 text-center card">
                <div class="card-header">
                    Subscribe for 2 Month
                </div>
                <div class="card-body" style="border-bottom: 1px solid silver">
                    <a id="checkout2" style="cursor: pointer;">
                        <img src="{{asset('img/credit.png')}}" alt="">
                    </a>
                </div>
                <div class="card-body">
                    <a id="checkout2" style="cursor: pointer;">
                        <h3 class="text-center text-dark" style=" font-weight:bold">2 Month <del class="text-danger">60 JOD</del> (<span class="text-success">50 JOD</span>)</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <center>
                <div id="pay_form"></div>
                @if (isset($success))
                    <div class="alert alert-success">Payment Successfully</div>
                @endif

                @if (isset($failed))
                    <div class="alert alert-danger">Payment Failed</div>
                @endif
            </center>
        </div>
    </div>
</div>
@include('Provider_views.includes.provider_footer')
<script>
    $(document).ready(function(){
        
        $('#checkout1').click(function(){
        $.ajax({
            type: 'get',
            url: "{{route('get.checkout')}}",
            data: {
                price : '30'
            },
            success:function(data){
                $('#pay_form').empty().html(data.content);
                $('#pay_cards').fadeOut(500);
            }
        });
        });

        $('#checkout2').click(function(){
        $.ajax({
            type: 'get',
            url: "{{route('get.checkout')}}",
            data: {
                price : '50'
            },
            success:function(data){
                $('#pay_form').empty().html(data.content);
                $('#pay_cards').fadeOut(700);
            }
        });
        });
       
    });
       
</script>