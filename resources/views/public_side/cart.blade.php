<?php $pageTitle = "Shopping Cart" ?>
@include('public_side.includes.public_header')
<div class="page-head_agile_info_w3l" style="background-image: url({{asset('img/eco_shopping_cart.jpg')}}); padding-top:0px !important;">
    <div style="background-color: rgba(0,0,0,0.6); height:200px;">
        <div class="container">
            <h3 class="mt-5">Shopping <span> Cart </span></h3>
        </div>
    </div>
</div>

<!--================Cart Area =================-->
<section class="cart_area p-4">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <?php $total = 0 ;?>
                        @foreach ($providers0 as $provider)
                            <tr class="bg-light">
                                <th>
                                <h4><a href="{{route('public_provider.profile',['id'=>$provider['provider_id']])}}">{{$provider['provider']}}</a></h4>
                                </th>
                                <th scope="col"><strong>Price</strong></th>
                                <th scope="col"><strong>Quantity</strong></th>
                                <th scope="col"><strong>Total</strong></th>
                                <th scope="col"><strong>Remove</strong></th>
                            </tr>
                            @foreach ($cart as $car)
                                @foreach ($car as $ca)
                                @if ($ca['provider_id'] == $provider['provider_id'])
                                    
                                
                                <tr>
                                <td style="width:450px;">
                                    <div class="media">
                                        <div class="d-flex" >
                                            <img src="../../img/Product_images/{{$ca['image']}}" width="80" height="80" alt="">
                                            <a href="{{route('product.show2',['id'=>$ca['id']])}}" >
                                                <p style="display: inline !important; font-size:16px; margin-left:10px; font-weight:bold;">{{$ca['title']}}</p>
                                            </a>
                                        </div>
                                        <div class="media-body" >
                                            
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <h5 style="margin-top:30px;">{{number_format($ca['unit_price'],2)}} JOD</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <h5 style="margin-top:30px;">X{{$ca['quantity']}}</h5>
                                    </div>
                                </td>
                                <td>
                                    <h5 style="margin-top:30px;">{{number_format($ca['unit_price']*$ca['quantity'],2)}} JOD</h5>
                                </td>
                                <td>
                                    <br>
                                    <a href="{{route('cart.remove',['prod_id'=>$ca['id'],'prov_id'=>$ca['provider_id']])}}" style="margin-top:30px;" onclick="return confirm('Are you sure?')"><i class="btn btn-danger fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $total += $ca['unit_price']*$ca['quantity']; ?>
                            @endif
                            @endforeach
                        @endforeach
                        @endforeach
                        {{-- @foreach ($cart as $car)
                        
                         @foreach ($car as $cart)
                             
                        
                        <tr>
                                <td>
                                    <h4><a href="{{route('public_provider.profile',['id'=>$cart['provider_id']])}}">{{$cart['provider']}}</a></h4>
                                    <div class="media mt-3">
                                        <div class="d-flex">
                                            <img src="../../storage/Product_images/{{$cart['image']}}" width="80" height="80" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a href="{{route('product.show',['id'=>$cart['id']])}}">
                                            <p>{{$cart['title']}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>JD{{number_format($cart['unit_price'],2)}}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <h5>X{{$cart['quantity']}}</h5>
                                    </div>
                                </td>
                                <td>
                                    <h5>JD{{number_format($cart['unit_price']*$cart['quantity'],2)}}</h5>
                                </td>
                                <td>
                                    <a href="{{route('cart.remove',['id'=>$cart['id']])}}" onclick="return confirm('Are you sure?')"><i class="btn btn-danger rounded-circle fa fa-remove"></i></a>
                                </td>
                            </tr>
                            <?php/*  $total += $cart['unit_price']*$cart['quantity'];  */?>
                            @endforeach
                        @endforeach --}}
                        
                        <tr class="bottom_button">
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="checkout_btn_inner">
                                            <a class="btn btn-secondary p-2" href="{{route('product.all')}}" style="border-radius: 0px !important;">Continue Shopping</a>
                                            <a href="{{route('checkout2')}}" class="ml-2 hvr-outline-out button2 btn text-light" style="border-radius: 0px !important;">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </td>
                            
                            <td colspan="2" class="text-right">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <h5><strong>SubTotal: &nbsp;JD-{{number_format($total,2)}}</strong></h5>
                                    </div>
                                
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

@include('public_side.includes.public_footer')