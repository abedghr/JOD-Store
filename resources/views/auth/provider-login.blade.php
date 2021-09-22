@extends('layouts.provider-app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center" style="height: 500px !important;">
        <div class="col-md-10">
            <div class="card bg-light" style="height: 100%">
            <div class="row">
                <div class="col-lg-6">
                    <div style="background-image: url(../img/providerBackgroundLogin.jpg); background-size: 100% 100%; height: 500px; background-repeat: no-repeat;">
                    </div>
                </div>
            <div class="col-lg-5" style="height: 100%">
                <div class="card-body mt-4">
                    <h4>Store Login</h4>
                    <form method="POST" action="{{ route('provider.login.submit') }}">
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
                        <br>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-dark btn-block" style="background-color: #111">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('provider.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group pl-4 pr-4">
                            <a href="{{route('provider.register')}}" class="btn btn-info btn-block" style="background-color: #17c3a2">Create Your Store</a>
                            <a href="/employees/login" class="btn btn-dark btn-block" style="background-color: #111; border-radius:0px;">Store Employees Login</a>
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
