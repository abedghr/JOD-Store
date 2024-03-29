<?php $guard="provider" ?>
@include('provider_views.includes.provider_header')

<div class="content-wrapper mt-5">
<!-- /.col -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-secondary text-light">
            <h3 class="card-title">Order Products</h3>
        </div>
        <div class="card-body p-0">
            <table class="table text-center">
                <thead>
                    <th>#</th>
                    <th>Product_name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>quantity</th>
                    <th>Price With Delivery</th>
                    <th>Date</th>
                </thead>
            <tbody>
                <?php $i=1;?>
                @foreach ($orders as $order)
                @if ($order['provider']==Auth::user()->id)

                <tr>
                    <td>{{$i}}</td>
                    <td>
                        <a href="../../img/Product_images/{{$order['main_image']}}">
                        <img src="../../img/Product_images/{{$order['main_image']}}" width="80" height="80" class="rounded" alt="">
                        </a>
                    </td>
                    <td><strong>{{$order['prod_name']}}</strong></td>
                    <td><strong>JD-{{$order['new_price']}}</strong></td>
                    <td><strong>{{$order['quantity']}}</strong></td>
                    <td><strong>JD-{{$order['new_price'] * $order['quantity']}}</strong></td>
                    <td><strong>{{$order['created_at']->format('Y-m-d')}}</strong></td>
                </tr>
                @endif
                <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
</div>

@include('provider_views.includes.provider_footer')
