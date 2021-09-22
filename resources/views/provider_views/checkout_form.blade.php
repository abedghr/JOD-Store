@section('main')
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$res['id']}}"></script>
<form action="{{route('subscribe_renewal')}}" class="paymentWidgets" data-brands="VISA MASTER"></form>
@stop


