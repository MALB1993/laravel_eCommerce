@extends('home.layouts.master')

@section('title',__('profile'))

@section('content')
<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                </li>
                <li class="active">{{ __('profile') }}</li>
            </ul>
        </div>
    </div>
</div>

<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row text-right" style="direction: rtl;">
                        <div class="col-lg-3 col-md-4">
                            @include('home.sections.sidebar')
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content">
                                <h3> نظرات </h3>
                                <div class="review-wrapper">
                                    @foreach ($comments as $comment)
                                        <div class="single-review">
                                            <div class="review-img">
                                                <img src="{{ $comment->user->avatar == null ? asset('home/assets/img/logo/user.png') : $comment->user->avatar }}" alt="">
                                            </div>
                                            <div class="review-content text-right">
                                                <p class="text-right">
                                                    {{ $comment->text }}
                                                </p>
                                                <div class="review-top-wrap">
                                                    <div class="review-name mt-2">
                                                        <h4>
                                                            {{ __('Name') }} :
                                                            {{ $comment->user->name == null ? __('Client') : $comment->user->name }}
                                                        </h4>
                                                    </div>

                                                    <div data-rating-readonly="true" data-rating-stars="5" data-rating-value="{{ ceil($comment->user->rates()->where('user_id',$comment->user->id)->avg('rate')) }}"></div>
                                                    <span class="mx-2">|</span>
                                                    <div>
                                                        {{ __('Date') }} :
                                                        {{ Verta($comment->created_at)->format('%d / %B / %Y') }}
                                                    </div>
                                                    <span class="mx-2">|</span>
                                                    <div>
                                                        {{ __('Name') }} {{ __('Product') }}  : <a href="{{ route('home.products.show',['product' => $comment->product->slug]) }}" class="text-danger">{{ $comment->product->name }}</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->

@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{ asset('/home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection
