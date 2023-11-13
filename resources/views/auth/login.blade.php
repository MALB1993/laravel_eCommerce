@extends('home.layouts.master')

@section('title', __('Log In') )

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                </li>
                <li class="active">{{ __('Login') }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="login-register-area pt-100 pb-100" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> ورود </h4>
                        </a>
                    </div>
                    <div class="tab-content">

                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        @method('POST')

                                        <input name="email" placeholder="{{ __('Email') }}" type="email" value="{{ old('email') }}" class="@error('email') is-invalid mb-1 @enderror">
                                        @error('email')
                                            <div class="input-error-validation">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror

                                        <input type="password" name="password" placeholder="{{ __('Password') }}" class="@error('password') is-invalid mb-1 @enderror">
                                        @error('password')
                                        <div class="input-error-validation">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror

                                        <div class="button-box">
                                            <div class="login-toggle-btn d-flex justify-content-between">
                                                <div>
                                                    <input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
                                                    <label>{{ __('Remember Me') }}</label>
                                                </div>
                                                <a href="{{ route('password.request') }}">{{ __("Forgot Your Password?") }}</a>
                                            </div>
                                            <button type="submit">{{ __('Login') }}</button>
                                            <a href="index.html" class="btn btn-google btn-block mt-4">
                                                <i class="sli sli-social-google"></i>
                                                {{ __('Login with Google') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
