@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        
                            <li class="user" id="{{ $provider->id }}">

                                <div class="media">
                                    <div class="media-left">
                                        <img src="../storage/Provider_images/{{$provider->image}}" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $provider->name }}</p>
                                        <p class="email">{{ $provider->email }}</p>
                                        
                                    </div>
                                </div>
                            </li>

                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">
                
            </div>
        </div>
    </div>
@endsection