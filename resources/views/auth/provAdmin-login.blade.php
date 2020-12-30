@extends('layouts.provAdmin-app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center" style="height: 450px !important;">
        <div class="col-md-10">
            <div class="card bg-light" style="height: 100%">
                {{-- <div class="card-header bg-primary text-light">
                    {{ __('Admin Login') }}
                </div> --}}
            <div class="row">
                <div class="col-lg-7">
                    <div style="background-image: url({{asset('../img/providerBackgroundLogin.jpg')}}); background-size: 100% 100%; height: 450px; background-repeat: no-repeat;">
                        <div style="background-color:rgba(0,0,0,0.3); height:100%">
                            <a href="/provider/login" class="btn btn-dark btn-block pt-3 pb-3" style="background-color: #111; border-radius:0px;">Store Login</a>
                        </div>
                        
                        
                    </div>
                </div>
            <div class="col-lg-5" style="height: 100%"> 
                <div class="card-body mt-5">
                    <h4>Employees Login</h4>
                    <form method="POST" action="{{ route('provAdmin.login.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group mt-4">
                            <div>
                                <button type="submit" class="btn btn-dark btn-block" style="background-color: #111">
                                    {{ __('Login') }}
                                </button>
                        {{--
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('provider.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div> --}}
                        
                    </form>
                </div> 
            </div>
            
                
            </div>
            </div> 
        </div>
    </div>
</div>

@endsection
