@section('main')
    @foreach ($vendors as $vendor)
    <div class="col-md-3">
        <div class="thumbnail team-w3agile">
            <img src="./img/Provider_images/{{$vendor->image}}" class="img-responsive" alt="" style="height: 180px !important">
            <div class="social-icons team-icons right-w3l fotw33">
            <div class="caption">
                <h4>{{$vendor->name}}</h4>						
            </div>
                <ul class="social-nav model-3d-0 footer-social w3_agile_social two" style="margin:0px !important">
                    <li><a href="#" class="facebook">
                        <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>
                    </li>
                    <li><a href="#" class="instagram">
                        <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>
                    </li>
                </ul><br>
                <a class="hvr-outline-out button2 btn btn-block text-light mt-1" href="single.html"><strong>Shopping</strong></a>
            </div>
        </div>
    </div>
    @endforeach
@endsection