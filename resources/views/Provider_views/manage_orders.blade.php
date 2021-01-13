<?php $guard="provider" ?>
@include('Provider_views.includes.provider_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<!-- /.col -->

<div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-secondary text-light mb-2">
        <div class="row">
            <div class="col-sm-1">
                <h3 class="card-title mt-2"><strong>Orders</strong></h3>
            </div>
            <div class="col-sm-5">
                <a class="btn btn-light" href="{{route('order.filters',['status'=>0])}}">All</a>
                <a class="btn btn-light" href="{{route('order.filters',['status'=>1])}}"> In Delivery</a>
                <a class="btn btn-light" href="{{route('order.filters',['status'=>3])}}"> Done</a>
                <a class="btn btn-light" href="{{route('order.filters',['status'=>-1])}}"> Declined</a>
                <a class="btn btn-light" href="{{route('order.filters',['status'=>-2])}}"> Failed</a>
            </div>
            <div class="col-sm-6">
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        
                    </ul>
                  </div>
            </div>
        </div>
        

        
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 table-responsive">
        <table class="table text-center" id="table">
            <thead>
              <tr>
                <th>Actions</th>
                <th>Order ID</th>
                <th>Name</th>
                <th>phone</th>
                <th>City</th>
                <th>address</th>
                <th>Products Order</th>
                <th>Total</th>
                <th>Delivery Price</th>
                <th>Date</th>
                <th>Order Status</th>
                <th class="th-sm" style="display:none;">
                </th>
                <th class="th-sm" style="display:none;">
                </th>
                <th class="th-sm" style="display:none;">
                </th>
                <th class="th-sm" style="display:none;">
                </th>
                <th class="th-sm" style="display:none;">
                </th>
                </tr>
            </thead>
            <tbody>
  
                @foreach ($orders as $order)
                <?php $del = $order->total_With_Delivery - $order->total_price; ?>
                <tr>
                  <td>
                      <a href="{{route('order.showDetails',['order_id'=> $order->id])}}" class="btn btn-warning mb-1"><i class="fa fa-eye"></i></a>
                      <form method="post" action="{{route('order.destroy',['id'=>$order->id])}}" style="display: inline">
                          @csrf
                          @method('delete')
                          <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                  </td>
                  <td>{{$order->id}}</td>
                  <input type="hidden" value="{{$order->id}}" id="order_id">
                  <td>{{$order->fname.' '.$order->lname}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->city}}</td>
                  <td>{{$order->Address}}</td>
                  <td><a href="{{route('order.show',['order_id'=>$order->id])}}" class="badge badge-secondary text-light">({{count($order->prodOfOrder)}}) View Orders</a></td>
                  <td>JD-{{$order->total_price}}</td>
                  <td>JD-{{$del}}</td>
                  <td>{{$order->created_at->format('Y-m-d')}}</td>
                  @if ($order->order_status == 0)
                  <td style="width:250px;" id="first_state{{$order->id}}">
                      <a class="btn btn-primary text-light" id="accept_order" onclick="accept_order({{$order->id}})" style="display: inline">Accept</a>
                      <a class="btn btn-danger text-light" id="decline_order" onclick="decline_order({{$order->id}})" style="display: inline">Decline</a>
                  </td>
                  <td style="width: 250px; display:none;" id="second_state1{{$order->id}}">
                      <a class="btn btn-primary text-light" id="delivery_process" onclick="delivery_process({{$order->id}})" style="display: inline">Delivery Process</a>
                  </td>
                  <td style="width: 250px; display:none;" id="second_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
                  </td>
                  <td style="width: 250px; display:none;" id="third_state{{$order->id}}">
                      <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
                  <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                      <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
                  </td>    
                  @endif
                  @if ($order->order_status == 1)
                  <td style="width: 250px;" id="second_state1{{$order->id}}">
                      <a class="btn btn-primary text-light" id="delivery_process" onclick="delivery_process({{$order->id}})" style="display: inline">Delivery Process</a>
                  </td>
                  <td style="width: 250px; display:none;" id="second_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
                  </td>
                  <td style="width: 250px; display:none;" id="third_state{{$order->id}}">
                      <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
                  <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                      <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
                  </td>
                  <td style="display:none;"></td>
                  @endif
                  @if ($order->order_status == -1)
                  <td style="width: 250px;" id="second_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" style="display: inline">Declined</a>
                  </td>
                  <td style="display:none;" id="second_state2{{$order->id}}"></td>
                  <td style="display:none;" id="second_state2{{$order->id}}"></td>
                  <td style="display:none;" id="second_state2{{$order->id}}"></td>
                  <td style="display:none;" id="second_state2{{$order->id}}"></td>
                  <td style="display:none;" id="second_state2{{$order->id}}"></td>

                  @endif
                  @if ($order->order_status == 2)
                  <td style="width: 250px;" id="third_state{{$order->id}}">
                      <a class="btn btn-primary text-light" id="received_order" onclick="received_order({{$order->id}})" style="display: inline">Received</a>
                  <a class="btn btn-danger text-light" id="unreceived_order" onclick="unreceived_order({{$order->id}})" style="display: inline">Un-received</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state1{{$order->id}}">
                      <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
                  </td>
                  <td style="width: 250px; display:none;" id="fourth_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
                  </td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>
                  <td style="display:none;" id="received_order"></td>

                  @endif
                  @if ($order->order_status == 3)
                  <td style="width: 250px;" id="fourth_state1{{$order->id}}">
                      <a class="btn-success text-light p-1 rounded" id="done_order" style="display: inline">Done</a>
                  </td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state1{{$order->id}}"></td>

                  @endif
                  @if ($order->order_status == -2)
                  <td style="width: 250px;" id="fourth_state2{{$order->id}}">
                      <a class="btn-danger text-light p-1 rounded" id="failed_order" style="display: inline">Failed</a>
                  </td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>
                  <td style="display:none;" id="fourth_state2{{$order->id}}"></td>

                  @endif
                </tr>
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script>
    $(document).ready(function () {
  $('#table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
    function accept_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.accept')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state1"+id).show();
                    $("#second_state2"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                }
            });
    }

    function decline_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.decline')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).show();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                }
            });
    }

    function delivery_process(id){
        
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.delivery_process')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).hide();
                    $("#third_state"+id).show();
                }
            });
    }
    function received_order(id){
        var order_id =id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.received')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).show();
                    $("#fourth_state2"+id).hide();
                }
            });
    }
    function unreceived_order(id){
        var order_id = id;  
            $.ajax({
                type: "GET",
                url: "{{route('orders.unreceived')}}",
                data:{
                    "id": order_id
                },
                success:function(data){
                    $("#second_state2"+id).hide();
                    $("#second_state1"+id).hide();
                    $("#first_state"+id).hide();
                    $("#third_state"+id).hide();
                    $("#fourth_state1"+id).hide();
                    $("#fourth_state2"+id).show();
                }
            });
    }
</script>