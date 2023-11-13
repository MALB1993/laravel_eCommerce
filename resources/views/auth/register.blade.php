@extends('home.layouts.master')

@section('title', __('Register') )

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
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4>{{ __('Register') }}</h4>
                        </a>
                    </div>
                    <div class="tab-content">

                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input name="name" placeholder="{{ __('Name') }}" type="text" value="{{ old('name') }}" class="@error('name') is-invalid mb-1 @enderror">
                                        @error('name')
                                            <div class="input-error-validation">
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror

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


                                        <input type="password" name="password_confirmation" placeholder="{{ __('Password confirmation') }}">
                                        @error('password_confirmation')
                                        <div class="input-error-validation">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror

                                        <div class="button-box">
                                            <button type="submit">عضویت</button>
                                            <a href="index.html" class="btn btn-google btn-block mt-4">
                                                <i class="sli sli-social-google"></i>
                                                ایجاد اکانت با گوگل
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
