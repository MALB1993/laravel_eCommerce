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

<!-- Modal Order -->
<div class="modal fade" id="ordersDetiles" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                        <form action="#">
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th> تصویر محصول </th>
                                            <th> نام محصول </th>
                                            <th> فی </th>
                                            <th> تعداد </th>
                                            <th> قیمت کل </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="assets/img/cart/cart-3.svg" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"> لورم ایپسوم </a></td>
                                            <td class="product-price-cart"><span class="amount">
                                                    20000
                                                    تومان
                                                </span></td>
                                            <td class="product-quantity">
                                                2
                                            </td>
                                            <td class="product-subtotal">
                                                40000
                                                تومان
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="assets/img/cart/cart-4.svg" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"> لورم ایپسوم متن ساختگی </a>
                                            </td>
                                            <td class="product-price-cart"><span class="amount">
                                                    10000
                                                    تومان
                                                </span></td>
                                            <td class="product-quantity">
                                                3
                                            </td>
                                            <td class="product-subtotal">
                                                30000
                                                تومان
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="assets/img/cart/cart-5.svg" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"> لورم ایپسوم </a></td>
                                            <td class="product-price-cart"><span class="amount">
                                                    40000
                                                    تومان
                                                </span></td>
                                            <td class="product-quantity">
                                                2
                                            </td>
                                            <td class="product-subtotal">
                                                80000
                                                تومان
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{ asset('/home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection
