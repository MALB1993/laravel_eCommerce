@extends('home.layouts.master')

@section('title', __('whishlist'))

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
                                    <h3> لیست علاقه مندی ها </h3>
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th> تصویر محصول </th>
                                                    <th> نام محصول </th>
                                                    <th> حذف </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($wishlists as $wishlist)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{ route('home.products.show', ['product' => $wishlist->product->slug]) }}">
                                                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH'). $wishlist->product->primary_image) }}" alt="" width="200" height="200">
                                                        </a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="{{ route('home.products.show', ['product' => $wishlist->product->slug]) }}">{{ $wishlist->product->name }}</a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="{{ route('home.wishlist-remove',['product' => $wishlist->product->slug]) }}">
                                                            <i class="sli sli-trash" style="font-size: 20px"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                {{ __('Empty') }}
                                                @endforelse
                                            </tbody>
                                        </table>
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
