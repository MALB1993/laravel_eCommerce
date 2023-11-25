@extends('home.layouts.master')

@section('title', __('order'))

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                    </li>
                    <li class="active">{{ __('order') }}</li>
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
                                    <h3>سفارشات</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th> سفارش </th>
                                                    <th> تاریخ </th>
                                                    <th> وضعیت </th>
                                                    <th> جمع کل </th>
                                                    <th> عملیات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $key => $order)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ Verta($order->created_at)->format('H:i:s | %d / %B / %Y') }}</td>
                                                        <td class="{{ $order->getRawOriginal('status') ? 'text-success' : 'text-danger'  }}">{{ $order->status }}</td>
                                                        <td>
                                                            {{ number_format($order->paying_amount) }}
                                                            {{ __('Toman') }}
                                                            
                                                        </td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#ordersDetiles-{{ $order->id }}" class="check-btn sqr-btn ">نمایش جزئیات </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td> - </td>
                                                        <td> - </td>
                                                        <td> - </td>
                                                        <td> - </td>
                                                        <td> - </td>
                                                    </tr>
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

    <!-- Modal Order -->
    @foreach ($orders as $order)
        <div class="modal fade" id="ordersDetiles-{{ $order->id }}" tabindex="-1" role="dialog">
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
                                                @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{ route('home.products.show',[$item->product->slug]) }}">
                                                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$item->product->primary_image) }}" alt="" width="70" height="70">
                                                        </a>
                                                    </td>
                                                    <td class="product-name"><a href="{{ route('home.products.show',[$item->product->slug]) }}">{{ $item->product->name }}</a></td>
                                                    <td class="product-price-cart"><span class="amount">
                                                            {{ number_format($item->price) }}
                                                            {{ __('Toman') }}
                                                        </span></td>
                                                    <td class="product-quantity">
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td class="product-subtotal">
                                                        {{ number_format($item->subtotals) }}
                                                        {{ __('Toman') }}
                                                    </td>
                                                </tr>
                                                @endforeach
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
    @endforeach
    <!-- Modal end -->

@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection
