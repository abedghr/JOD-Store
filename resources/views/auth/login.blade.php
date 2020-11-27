@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="height: 500px !important;">
        <div class="col-md-10">
            <div class="card bg-light" style="height: 100%">
                
            <div class="row">
                <div class="col-lg-7">
                    <div style="background-image: url('{{asset("img/ecommerce1.jpg")}}'); background-size: 100% 100%; height: 500px; background-repeat: no-repeat;">
                        <div style="height:100%">
                            <a href="/provider/login" class="btn btn-dark btn-block">Provider Login</a>
                        </div>
                        
                        
                    </div>
                </div>
            <div class="col-lg-5" style="height: 100%"> 
                <div class="card-body mt-5">
                    <h4>User Login</h4>
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group mt-5">
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group pl-4 pr-4">
                            <a href="{{route('view.register')}}" class="btn btn-info btn-block">Register</a>
                        </div>
                    </form>
                </div> 
            </div>
            
                
            </div>
            </div> 
        </div>
    </div>
</div>

@endsection
