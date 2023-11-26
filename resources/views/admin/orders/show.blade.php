@extends('admin.layouts.master')

@section('title', __('order'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('order') }}
            </h5>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">{{ __('ID') }}</label>
                    <input type="text" name="" id="" value="{{ $order->id }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Code') }} {{ __('Coupon') }}</label>
                    <input type="text" name="" id="" value="{{ $order->coupon->name === null ? 'استفاده نشده' : $order->coupon->name }}" class="form-control" @disabled(true) dir="auto">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Name') }}</label>
                    <input type="text" name="" id="" value="{{ $order->user->name === null ? __('Client') : $order->user->name  }}" class="form-control" @disabled(true) dir="auto">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Status') }}</label>
                    <input type="text" name="" id="" value="{{ $order->status }}" class="form-control" @disabled(true)>
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Delivery amount') }}</label>
                    <input type="text" name="" id="" value="{{ number_format($order->delivery_amount) }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Sale price') }}</label>
                    <input type="text" name="" id="" value="{{ number_format($order->coupon_amount) }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('paying amount') }}</label>
                    <input type="text" name="" id="" value="{{ number_format($order->paying_amount) }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('Type') }}</label>
                    <input type="text" name="" id="" value="{{ $order->payment_type }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="form-group col-md-3">
                    <label for="">{{ __('created_at') }}</label>
                    <input type="text" name="" id="" value="{{ Verta($order->created_at) }}" class="form-control" @disabled(true) dir="ltr">
                </div>
                <div class="col-md-12">
                    <label for="">{{ __('Address') }}</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="3" @disabled(true)>{{ $order->address->address }}</textarea>
                </div>
                <div class="col-md-12 my-4">
                    <table class="table table-bordered table-hover text-center">
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
                                <td class="product-name">
                                    <a href="{{ route('home.products.show',[$item->product->slug]) }}">
                                        {{ $item->product->name }}
                                        {{ $item->variation }}

                                    </a>
                                </td>
                                <td class="product-price-cart">
                                    <span class="amount">
                                        {{ number_format($item->price) }}
                                        {{ __('Toman') }}
                                    </span>
                                </td>
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
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
