@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Provider Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('provider.register.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone1" class="col-md-4 col-form-label text-md-right">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="phone1" type="text" class="form-control" name="phone1">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
<div class="container-fluid">
    <div class="row justify-content-center" style="height: 500px !important;">
        
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card" style="height: 100%">
                {{-- <div class="card-header bg-primary text-light">
                    {{ __('Admin Login') }}
                </div> --}}
                <div class="row">
                    <div class="col-lg-7">
                        <div style="background-image: url(https://img.freepik.com/free-photo/woman-typing-keyboard-laptop-account-login-screen-working-office-table-background-safety-concepts-about-internet-use_2034-1339.jpg?size=626&ext=jpg); background-size: 100% 100%; height: 630px; background-repeat: no-repeat;">
                            <div style="background-color:rgba(0,0,0,0.6); height:100%">
                                <h1 class="text-light" style="font-family:Arial, Helvetica, sans-serif; position: relative; top: 35%; margin-left:25px;">JOD-Store</h1>
                                <p class="text-light ml-2 mr-2" style="font-size: 16px; position:relative; top:37%; margin-right: 25px !important; margin-left: 25px !important;">Admin dashboard for manage providers, products and other things that relation in this store, also tracking payments .</p>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-lg-5" style="height: 100%"> 
                        <div class="card-body mt-5">
                            <h4>Provider Register</h4>
                            <form method="POST"  action="{{ route('provider.register.submit') }}">
                                @csrf
                                <strong>
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span class="text-danger">*</span></label>

                                    
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter your name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                </div>

                                <div class="form-group">
                                    <label for="email" class="">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>

                                    
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                </div>

                                <div class="form-group">
                                    <label for="password" class="">{{ __('Password') }}<span class="text-danger">*</span></label>

                                    
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone1" class="">Mobile Number <span class="text-danger"> Optional</span></label>                 
                                    <input id="phone1" name="phone1" type="text" class="form-control @error('phone1') is-invalid @enderror"  placeholder="Enter your mobile number">
                                    @error('phone1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                                </strong>
                                <div class="form-group mt-4">
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>

                </div>
            </div> 
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection
