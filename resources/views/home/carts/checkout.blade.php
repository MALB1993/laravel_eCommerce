@extends('home.layouts.master')
@section('title', __('Check out'))
@section('content')

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                    </li>
                    <li class="active">{{ __('Check out') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="checkout-main-area pt-70 pb-70 text-right" style="direction: rtl;">

        <div class="container">

            @if(!session()->has('coupon'))
                <div class="customer-zone mb-20">
                <p class="cart-page-title">
                    کد تخفیف دارید؟
                    <a class="checkout-click3" href="#"> میتوانید با کلیک در این قسمت کد خود را اعمال کنید </a>
                </p>
                <div class="checkout-login-info3">
                    <form action="{{ route('home.check-coupon') }}" method="post">
                        @csrf
                        @method("POST")
                        <input type="text" placeholder="کد تخفیف" name="code">
                        <input type="submit" value="اعمال کد تخفیف">
                    </form>
                </div>
            </div>
            @endif

            <div class="checkout-wrap pt-30">
                <div class="row">

                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3> آدرس تحویل سفارش </h3>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info tax-select mb-20">
                                        <label> انتخاب آدرس تحویل سفارش <abbr class="required" title="required">*</abbr></label>

                                        <select class="email s-email s-wid">
                                            @forelse($addresses as $address)
                                                <option value="{{ $address->id }}">{{ $address->title }}</option>
                                                @empty
                                                <option selected disabled>{{ __('Empty') }}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pt-30">
                                    <button class="collapse-address-create" type="submit"> ایجاد آدرس جدید </button>
                                </div>

                                <div class="col-lg-12">
                                    <div class="collapse-address-create-content" style="{{ count($errors->addressesStore) > 0 ? 'display:block' : '' }}">

                                        <form action="{{ route('home.user-profile.address.store') }}" method="post">
                                            @csrf
                                            @method('POST')

                                            <div class="row">
                                                {{-- title --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    {{-- title --}}
                                                    <label for="title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="@error('title','addressesStore') is-invalid @enderror" dir="auto">
                                                    @error('title','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                                {{-- cellphone --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="cellphone">{{ __('Phone Number') }}</label>
                                                    <input type="text" name="cellphone" value="{{ old('cellphone') }}" class="@error('cellphone','addressesStore') is-invalid @enderror" dir="ltr">
                                                    @error('cellphone','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>

                                                {{-- province --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="province">استان</label>
                                                    <select name="province_id" id="province" class="province-select">
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                                {{-- city --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="city">شهر</label>
                                                    <select id="city" name="city_id" class="city-select"></select>
                                                    @error('city_id','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>

                                                {{-- address --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="address">آدرس</label>
                                                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                                                    @error('address','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                                {{-- postal code --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="postal_code">کد پستی</label>
                                                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" dir="ltr">
                                                    @error('postal_code','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class=" col-lg-12 col-md-12">
                                                    <button class="cart-btn-2" type="submit"> ثبت آدرس</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3> سفارش شما </h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li> محصول <span> جمع </span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach(\Cart::getContent() as $item)
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <p>
                                                        <span>{{ $item->quantity }}</span>
                                                        <span class="mx-2">x</span>
                                                        <span>{{ $item->name }}</span>
                                                    </p>
                                                    <span>
                                                        {{ number_format($item->price) }}
                                                        {{ __('Toman') }}
                                                        @if ($item->attributes->is_sale)
                                                            <p style="font-size:12px" class="text-danger">
                                                                {{ $item->attributes->persent_sale }}
                                                                {{ __('Offer') }}
                                                            </p>
                                                        @endif
                                                    </span>

                                                </div>

                                                <div class="d-flex justify-content-between text-danger">
                                                    <div class="mx-2">
                                                        <span style="font-size:12px">{{ $item->attributes->value }}</span>
                                                        <span style="font-size:12px">:</span>
                                                        <span style="font-size:12px">{{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            <li>
                                                <hr>
                                                @if (cartTotalSaleAmount() > 0)
                                                    <p>
                                                        مبلغ کلی تخفیف :
                                                        <span class="text-danger">
                                                        {{ number_format(cartTotalSaleAmount()) }}
                                                        {{ __('Toman') }}
                                                    </span>
                                                    </p>
                                                @endif

                                                @if (session()->has('coupon'))
                                                    <p>
                                                        ملبغ کد تخفیف:
                                                        <span class="text-danger">
                                                            {{ number_format(session()->get('coupon.amount')) }}
                                                            {{ __('Toman') }}
                                                        </span>
                                                    </p>
                                               @endif
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li>
                                                {{ __('Price') }}
                                                <span>
                                                    {{ number_format(\Cart::getTotal() + cartTotalSaleAmount()) }}
                                                    {{ __('Toman') }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li>
                                                هزینه ارسال :
                                                <span>
                                                @if (totalDeliveryAmount() == 0)
                                                        {{ __('Free') }}
                                                    @else
                                                        {{ number_format(totalDeliveryAmount()) }}
                                                        {{ __('Toman') }}
                                                    @endif
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>
                                                جمع کل
                                                <span>
                                                    {{ number_format(cartTotalAmount() - cartTotalSaleAmount()) }}
                                                    {{ __('Toman') }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="payment-method">
                                    <div class="pay-top sin-payment">
                                        <input id="zarinpal" class="input-radio" type="radio" value="zarinpal"
                                               checked="checked" name="payment_method">
                                        <label for="zarinpal"> درگاه پرداخت زرین پال </label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pay-top sin-payment">
                                        <input id="pay" class="input-radio" type="radio" value="pay"
                                               name="payment_method">
                                        <label for="pay">درگاه پرداخت پی</label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order mt-40">
                                <button type="submit">ثبت سفارش</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
@section('javascript')
    <script>

        $(".province-select").change(function(){

            const provinceID = $(this).val();

            if(provinceID)
            {
                $.ajax({
                    type    :   "GET",
                    url     :   "{{ url('profile/get-province-cities-list') }}?province_id="+provinceID,
                    success : function(res){
                        if(res)
                        {
                            $(".city-select").empty();
                            $.each(res, function(key, city){
                                $(".city-select").append(`<option value="${city.id}">${city.name}</option`);
                            });
                        }else{
                            $(".city-select").empty();
                        }
                    },

                });
            }
        });

    </script>
@endsection
