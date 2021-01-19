@section('main')
    <header class="card-header mb-4 bg-light" style="border:1px solid silver height:"><h4>Your Orders :<a href="'.route('user.profile2').'" class=""> View all</a></h4></header>
    @foreach ($orders as $order)
        <li class="list-group-item">({{$order->created_at->format('Y-m-d')}}) &nbsp;Order ID : {{$order->id}}</li>
    @endforeach
@endsection