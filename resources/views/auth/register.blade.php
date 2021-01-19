@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center" style="height: 100% !important;">
    
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card bg-light" style="height: 100%">
            <div class="row">
                <div class="col-lg-7">
                    <div style="background-image: url({{asset("img/userbackgroundlogin.jpg")}}); background-size: 100% 100%; height: 100%; background-repeat: no-repeat;">
                            <div style="height:100%">
                                <a href="/login" class="btn btn-dark btn-block pt-3 pb-3" style="background-color: #111; border-radius:0px;">Login User</a>
                            </div>
                    </div>
                </div>
                <div class="col-lg-5" style="height: 100%"> 
                    <div class="card-body mt-2">
                        <h4>User Register</h4>
                        <form method="POST"  action="{{ route('user.register') }}">
                            @csrf
                            <strong>
                            <div class="form-group">
                                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span class="text-danger">*</span></label>

                                <input id="name" style="margin:0px;" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Your Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                    
                            </div>

                            <div class="form-group">
                                <label for="email" class="">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Your Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="">{{ __('Password') }}<span class="text-danger">*</span></label>

                                
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                            </div>
                            <div class="form-group">
                                <label for="phone1" class="">Mobile Number <span class="text-danger">*</span></label>                 
                                <input id="phone1" style="margin:0px;" name="phone1" type="text" class="form-control @error('phone1') is-invalid @enderror" required  placeholder="Enter your mobile number">
                                @error('phone1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            </strong>
                            <div class="form-group mt-4">
                                <div>
                                    <button type="submit" class="btn btn-dark btn-block" style="background-color: #111; border-daius:0px;">
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


@endsection

