@extends('home.layouts.master')
@section('title', __('Card'))
@section('content')
    
<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __("Original") }}</a>
                </li>
                <li class="active">{{ __('Card') }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="cart-main-area pt-95 pb-100 text-right" style="direction: rtl;">
    @if(Cart::isEmpty())
        <div class="container cart-empty-content">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <i class="sli sli-basket"></i>
                    <h2 class="font-weight-bold my-4">سبد خرید خالی است.</h2>
                    <p class="mb-40">شما هیچ کالایی در سبد خرید خود ندارید.</p>
                    <a href="{{ route('home.index') }}" > ادامه خرید </a>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <h3 class="cart-page-title"> سبد خرید شما </h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    <form action="{{ route('home.cart.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th> تصویر محصول </th>
                                        <th> نام محصول </th>
                                        <th> فی </th>
                                        <th> تعداد </th>
                                        <th> قیمت </th>
                                        <th> عملیات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::getContent() as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('home.products.show',['product' => $item->associatedModel->slug]) }}">
                                                <img alt="" src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$item->associatedModel->primary_image) }}" width="100" height="100" class="rounded-circle"/>
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('home.products.show',['product' => $item->associatedModel->slug]) }}">
                                                {{ $item->name }}
                                            </a>
                                            <div style="font-size: 12px">
                                                <span>{{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}</span>
                                                <span>:</span>
                                                <span>{{ $item->attributes->value }}</span>
                                            </div>
                                            @if ($item->attributes->is_sale)
                                                <p style="font-size:12px" class="text-danger">
                                                    {{ $item->attributes->persent_sale }}
                                                    {{ __('Offer') }}
                                                </p>
                                            @endif
                                        </td>
                                        <td class="product-price-cart">
                                            <span class="amount">{{ $item->quantity }} * {{ number_format($item->price) }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton[{{ $item->id }}]" value="{{ $item->quantity }}" data-max="{{ $item->attributes->quantity }}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            {{ number_format($item->quantity * $item->price) }}
                                            {{ __('Toman') }}
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{ route('home.cart.remove',['rowId' => $item->id]) }}"><i class="sli sli-close"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('home.index') }}"> ادامه خرید </a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit"> به روز رسانی سبد خرید </button>
                                        <a href="{{ route('home.cart.clear') }}"> پاک کردن سبد خرید </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row justify-content-between">
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray"> کد تخفیف </h4>
                                </div>
                                <div class="discount-code">
                                    <p> لورم ایپسوم متن ساختگی با تولید سادگی </p>
                                    <form>
                                        <input type="text" required="" name="name">
                                        <button class="cart-btn-2" type="submit"> ثبت </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart"> مجموع سفارش </h4>
                                </div>
                                <h5>
                                    مبلغ سفارش :
                                    <span>
                                        {{ number_format(Cart::getTotal() + cartTotalSaleAmount()) }}
                                        {{ __('Toman') }}
                                    </span>
                                </h5>
                                @if (cartTotalSaleAmount() > 0)
                                    <hr>
                                    <h5>
                                        مبلغ کلی تخفیف :
                                        <span class="text-danger">
                                            {{ number_format(cartTotalSaleAmount()) }}
                                            {{ __('Toman') }}
                                        </span>
                                    </h5>
                                @endif
                                <div class="total-shipping">
                                    <h5>
                                        هزینه ارسال :
                                        <span>
                                            @if (totalDeliveryAmount() == 0)
                                                {{ __('Free') }}
                                                @else
                                                {{ number_format(totalDeliveryAmount()) }}
                                                {{ __('Toman') }}
                                            @endif
                                        </span>
                                    </h5>

                                </div>
                                <h4 class="grand-totall-title">
                                    جمع کل:
                                    <span>
                                        {{ number_format(Cart::getTotal() + totalDeliveryAmount()) }}
                                        {{ __('Toman') }}
                                    </span>
                                </h4>
                                <a href="./checkout.html"> ادامه فرآیند خرید </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
@endsection