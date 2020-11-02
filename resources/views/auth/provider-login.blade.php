@extends('layouts.provider-app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="height: 500px !important;">
        <div class="col-md-10">
            <div class="card" style="height: 100%">
                {{-- <div class="card-header bg-primary text-light">
                    {{ __('Admin Login') }}
                </div> --}}
            <div class="row">
                <div class="col-lg-7">
                    <div style="background-image: url(https://img.freepik.com/free-photo/woman-typing-keyboard-laptop-account-login-screen-working-office-table-background-safety-concepts-about-internet-use_2034-1339.jpg?size=626&ext=jpg); background-size: 100% 100%; height: 500px; background-repeat: no-repeat;">
                        <div style="background-color:rgba(0,0,0,0.6); height:100%">
                            <h1 class="text-light" style="font-family:Arial, Helvetica, sans-serif; position: relative; top: 35%; margin-left:25px;">JOD-Store</h1>
                            <p class="text-light ml-2 mr-2" style="font-size: 16px; position:relative; top:37%; margin-right: 25px !important; margin-left: 25px !important;">Admin dashboard for manage providers, products and other things that relation in this store, also tracking payments .</p>
                        </div>
                        
                        
                    </div>
                </div>
            <div class="col-lg-5" style="height: 100%"> 
                <div class="card-body mt-5">
                    <h4>Provider Login</h4>
                    <form method="POST" action="{{ route('provider.login.submit') }}">
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

                        <div class="form-group">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
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
                            <a href="{{route('provider.register')}}" class="btn btn-info btn-block">Create Provider Account</a>
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
