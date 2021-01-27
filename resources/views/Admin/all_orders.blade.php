<?php $guard = "admin" ?>
@include('Admin.includes.admin_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<!-- /.col -->

<div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-secondary text-light">
        <div class="row">
            <div class="col-sm-1">
                <h3 class="card-title mt-2"><strong>Orders</strong></h3>
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
      <div class="card-body p-0 table-responsive mt-5">
        <table class="table text-center" id="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>phone</th>
                <th>City</th>
                <th>Store</th>
                <th>Total Price</th>
                <th>Delivery Price</th>
                <th>Created At</th>
                <th>Order Status</th>
            </thead>
            <tbody>
  
                @foreach ($orders as $order)
                <?php $del = $order->total_With_Delivery - $order->total_price; ?>
                <tr>
                  <input type="hidden" value="{{$order->id}}" id="order_id">
                  <td>{{$order->fname.' '.$order->lname}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->city}}</td>
                  <td><strong>{{$order->prov->name}}</strong></td>
                  <td>JD-{{$order->total_price}}</td>
                  <td>JD-{{$del}}</td>
                  <td>{{$order->created_at->format('Y-m-d')}}</td>
                  @if ($order->order_status == 1)
                  <td style="width: 250px;" id="second_state1{{$order->id}}">
                    <p class="text-primary"><strong>Delivery Process</strong></p>
                  </td>
                  @endif
                  @if ($order->order_status == -1)
                  <td style="width: 250px;" id="second_state2{{$order->id}}">
                    <p class="text-danger"><strong>Declined</strong></p>
                  </td>
                  
                  @endif
                  @if ($order->order_status == 2)
                  <td style="width: 250px;" id="third_state{{$order->id}}">
                        <p class="text-success" style="display: inline"><strong>Received</strong></p> / 
                        <p class="text-danger" style="display: inline"><strong>Un-received</strong></p>
                  </td>
                  @endif
                  @if ($order->order_status == 3)
                  <td style="width: 250px;">
                    <p class="text-success"><strong>Done</strong></p>
                  </td>
                  @endif
                  @if ($order->order_status == -2)
                  <td style="width: 250px;">
                      <p class="text-danger"><strong>Failed</strong></p>
                  </td>
                  
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

@include('Admin.includes.admin_footer')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
<script>
    $(document).ready(function () {
  $('#table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>