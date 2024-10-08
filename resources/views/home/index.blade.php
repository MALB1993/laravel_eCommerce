@extends('home.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('home/assets/vendor/fontawesome-free/css/all.min.css') }}">
@endsection
@section('content')
    {{-- sliders --}}
    <div class="slider-area section-padding-1">
        <div class="slider-active owl-carousel nav-style-1">

            @foreach ($sliders as $slider)
                    <div class="single-slider slider-height-1 bg-paleturquoise">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6 text-right">
                                <div class="slider-content slider-animated-1">
                                    <h1 class="animated">{{ $slider->title }}</h1>
                                    <p class="animated">{{ $slider->text }}</p>
                                    <div class="slider-btn btn-hover">
                                        <a class="animated" href="{{ $slider->button_link }}">
                                            <i class="{{ $slider->button_icon }}"></i>
                                            {{ $slider->button_text }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                                <div class="slider-single-img slider-animated-1">
                                    <img class="animated" src="{{ asset(env('IMAGE_UPLOAD_PATH').'banners/'.$slider->image) }}" alt="{{ $slider->title }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>

    <div class="banner-area pt-100 pb-65">
        <div class="container">
            <div class="row">
                @forelse ($index_banners_top->chunk(3)->first() as $banner)
                    <div class="col-lg-4 col-md-4">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="{{ $banner->button_link }}">
                                <img class="animated" src="{{ asset(env('IMAGE_UPLOAD_PATH').'banners/'.$banner->image) }}" alt="{{ $banner->title }}" />
                            </a>
                            <div class="banner-content-2 banner-position-5">
                                <h4>{{ $banner->title }}</h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-4 col-md-4">
                        ...
                    </div>
                @endforelse
                
                @forelse ($index_banners_top->chunk(3)->last() as $banner)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="{{ $banner->button_link }}">
                                <img class="animated" src="{{ asset(env('IMAGE_UPLOAD_PATH').'banners/'.$banner->image) }}" alt="{{ $banner->title }}" />
                            </a>
                            <div class="{{ $loop->last ? 'banner-content-3 banner-position-7' : 'banner-content banner-position-6 text-right' }}">
                                <h3>{{ $banner->title }}</h3>
                                <h2>{{ $banner->text }}</h2>
                                <a href="{{ $banner->button_link }}">{{ $banner->button_text }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    ...
                @endforelse
            </div>
        </div>
    </div>
    {{-- prodduct area --}}
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-40">
                <h2> لورم ایپسوم </h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                    متون
                    بلکه روزنامه و مجله
                </p>
            </div>
            <div class="product-tab-list nav pb-60 text-center flex-row-reverse">
                <a class="active" href="#product-1" data-toggle="tab">
                    <h4>مردانه</h4>
                </a>
                <a href="#product-2" data-toggle="tab">
                    <h4>زنانه</h4>
                </a>
                <a href="#product-3" data-toggle="tab">
                    <h4>بچه گانه</h4>
                </a>
            </div>
            <div class="tab-content jump-2">
                <div id="product-1" class="tab-pane active">
                    <div class="ht-products product-slider-active owl-carousel">
                        @foreach ($products as $product)
                            <!--Product Start-->
                            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                            <div class="ht-product-inner">
                                <div class="ht-product-image-wrap">
                                    <a href="{{ route('home.products.show',['product' => $product->slug]) }}" class="ht-product-image">
                                        <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" alt="{{ $product->name }}" />
                                    </a>
                                    <div class="ht-product-action">
                                        <ul>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#productModal_{{$product->id}}">
                                                    <i class="sli sli-magnifier"></i>
                                                    <span class="ht-product-action-tooltip">مشاهده سریع</span>
                                                </a>
                                            </li>
                                            <li>
                                                @auth
                                                    @if($product->checkuserWishlist(auth()->user()->id))
                                                        <a title="Add To Wishlist" href="{{ route('home.wishlist-remove',$product->slug) }}"><i class="fas fa-heart" style="color:red;font-size:20px"></i></a>
                                                    @else
                                                        <a title="Add To Wishlist" href="{{ route('home.wishlist-add',$product->slug) }}"><i class="sli sli-heart"></i></a>
                                                    @endif
                                                @else
                                                    <a title="Add To Wishlist" href="{{ route('home.wishlist-add',$product->slug) }}"><i class="sli sli-heart"></i></a>
                                                @endauth
                                            </li>
                                            <li>
                                                <a href="{{ route('home.compare-add',['product' => $product->slug]) }}">
                                                    <i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">{{ __('Compare') }}</span>
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <a href="#">
                                                    <i class="sli sli-bag"></i>
                                                    <span class="ht-product-action-tooltip"> افزودن به سبد خرید </span>
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="ht-product-content">
                                    <div class="ht-product-content-inner">
                                        <div class="ht-product-categories">
                                            <a href="#">{{ $product->category->name }}</a>
                                        </div>
                                        <h4 class="ht-product-title text-right">
                                            <a href="#">{{ $product->name }}</a>
                                        </h4>
                                        <div class="ht-product-price">
                                            @if ($product->quantity_check)
                                                @if($product->sale_check)
                                                    <span class="new">
                                                        {{ number_format($product->sale_check->price) }}
                                                        {{ __('Toman') }}
                                                    </span>
                                                    <span class="old">
                                                        {{ number_format($product->sale_check->sale_price) }}
                                                        {{ __('Toman') }}
                                                    </span>
                                                    @else
                                                    <span class="new">
                                                        {{ number_format($product->price_check->price) }}
                                                        {{ __('Toman') }}
                                                    </span>
                                                @endif
                                                @else
                                                <div class="not-in-stock">
                                                    <p class="text-white">{{ __('Unavailable') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ht-product-ratting-wrap">
                                            <div data-rating-stars="5" data-rating-readonly="true" data-rating-value="{{ ceil($product->rates->avg('rate')) }}"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <!--Product End-->
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="testimonial-area pt-80 pb-95 section-margin-1" style="background-image: url(home/assets/img/bg/bg-1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1">
                        <div class="single-testimonial text-center">
                            <img src="/home/assets/img/testimonial/testi-1.png" alt="" />
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                چاپگرها و
                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و
                                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته،
                                حال و
                                آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            </p>
                            <div class="client-info">
                                <img src="{{ asset('/home/assets/img/icon-img/testi.png') }}" alt="" />
                                <h5>لورم ایپسوم</h5>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="/home/assets/img/testimonial/testi-2.png" alt="" />
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                چاپگرها و
                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و
                                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته،
                                حال و
                                آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            </p>
                            <div class="client-info">
                                <img src="{{ asset('/home/assets/img/icon-img/testi.png') }}" alt="" />
                                <h5>لورم ایپسوم</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- pt-95 bt-70 --}}

    <div class="banner-area pb-120">
        <div class="container">
            <div class="row">
                @foreach ($index_banners_bottom as $banner)
                    <div class="col-lg-6 col-md-6 text-right">
                <div class="single-banner mb-30 scroll-zoom">
                    <a href="{{ route('home.products.show',['product' => $product->slug]) }}">
                        <img src="{{ asset(env('IMAGE_UPLOAD_PATH').'banners/'.$banner->image) }}" alt="{{ $banner->title }}" />
                    </a>
                    <div class="{{ $loop->last ? 'banner-content banner-position-3' : 'banner-content banner-position-4' }}">
                        <h3>{{ $banner->title }}</h3>
                        <h2>{{ $banner->text }}</h2>
                        <a href="{{ $banner->button_link }}">{{ $banner->button_text }}</a>
                    </div>
                </div>
            </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="feature-area" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="{{ asset('/home/assets/img/icon-img/free-shipping.png') }}" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="{{ asset('/home/assets/img/icon-img/support.png') }}" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>24x7 لورم ایپسوم</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="{{ asset('/home/assets/img/icon-img/security.png') }}" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
@foreach ($products as $product)
    <div class="modal fade" id="productModal_{{$product->id}}" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                    <div class="product-details-content quickview-content">
                        <h2 class="text-right mb-4">{{ $product->name }}</h2>
                        <div class="product-details-price variation_price">
                            @if ($product->quantity_check)
                                @if($product->sale_check)
                                    <span class="new">
                                        {{ number_format($product->sale_check->price) }}
                                        {{ __('Toman') }}
                                    </span>
                                    <span class="old">
                                        {{ number_format($product->sale_check->sale_price) }}
                                        {{ __('Toman') }}
                                    </span>
                                    @else
                                    <span class="new">
                                        {{ number_format($product->price_check->price) }}
                                        {{ __('Toman') }}
                                    </span>
                                @endif
                                @else
                                <div class="not-in-stock">
                                    <p class="text-white">{{ __('Unavailable') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div data-rating-stars="5" data-rating-readonly="true" data-rating-value="{{ ceil($product->rates->avg('rate')) }}"></div>
                            <span class="mx-3">|</span>
                            <span>
                                {{ __('Comments') }}
                                :
                                {{ $product->approvedComments->count() }}
                            </span>
                        </div>
                        <p class="text-right">
                            {{ $product->description }}
                        </p>
                        <div class="pro-details-list text-right">
                            <ul class="text-right">
                                @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                    <li>{{ $attribute->attribute->name }} : {{ $attribute->value }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="{{ route('home.cart-add') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @if ($product->quantity_check)
                                @php
                                    if($product->sale_check)
                                    {
                                        $variationProductSelected = $product->sale_check;
                                    }else {
                                        $variationProductSelected = $product->price_check;
                                    }
                                @endphp
                                <div class="pro-details-size-color text-right">
                                    <div class="pro-details-size w-50">
                                        <span>{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                        <div class="pro-details-size">
                                            <select id="variation" name="variation" class="form-control variation_select">
                                                @foreach ($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                                    <option value="{{ json_encode($variation->only(['id', 'quantity', 'sale_price', 'is_sale', 'price'])) }}" {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}>{{ $variation->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1" data-max="5" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button type="submit">افزودن به سبد خرید</button>
                                    </div>
                                    <div class="pro-details-wishlist">
                                        @auth
                                            @if($product->checkuserWishlist(auth()->user()->id))
                                                <a title="Add To Wishlist" href="{{ route('home.wishlist-remove',$product->slug) }}"><i class="fas fa-heart" style="color:red;font-size:20px"></i></a>
                                            @else
                                                <a title="Add To Wishlist" href="{{ route('home.wishlist-add',$product->slug) }}"><i class="sli sli-heart"></i></a>
                                            @endif
                                        @else
                                            <a title="Add To Wishlist" href="{{ route('home.wishlist-add',$product->slug) }}"><i class="sli sli-heart"></i></a>
                                        @endauth
                                    </div>
                                    <div class="pro-details-compare">
                                        <a href="{{ route('home.compare-add',['product' => $product->slug]) }}">
                                            <i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">{{ __('Compare') }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </form>
                        <div class="pro-details-meta">
                            <span>{{ __('Category') }} :</span>
                            <ul>
                                <li>
                                    <a href="#">{{ $product->category->parent->name }} , {{ $product->category->name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-meta">
                            <span>{{ __('Tags') }} :</span>
                            <ul>
                                @foreach ($product->tags as $tag)
                                    <li>
                                        <a href="#">{{ $tag->name }}</a> {{ $loop->last ? '' : '|' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="tab-content quickview-big-img">
                        <div id="pro-{{ $product->id }}" class="tab-pane fade show active">
                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" alt="{{ $product->name }}" />
                        </div>
                        @foreach ($product->images as $key => $image)
                        <div id="pro-primary-{{ $image->id }}" class="tab-pane fade">
                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH'). $image->image) }}" alt="{{ $product->name }}" />
                        </div>
                        @endforeach

                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="quickview-wrap mt-15">
                        <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                            <a class="active" data-toggle="tab" href="#pro-{{ $product->id }}">
                                <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" alt="{{ $product->name }}" />
                            </a>
                            @foreach ($product->images as $key => $image)
                            <a data-toggle="tab" href="#pro-primary-{{ $image->id }}">
                                <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH'). $image->image) }}" alt="{{ $product->name }}" />
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
<!-- Modal end -->

@endsection
@section('javascript')
    <script src="{{ asset('home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <script src="{{ asset('home/assets/vendor/fontawesome-free/js/all.min.js') }}"></script>
    <script>
        $('.variation_select').on('change',function(){
            let variation = JSON.parse(this.value);
            let variationPriceDiv  = $('.variation_price');

            variationPriceDiv.empty();

            if(variation.is_sale){
                // create span sale price by class new
                let spanSale = $('<span/>',{
                    class : 'new',
                    text  :  toPersianNum(number_format(variation.sale_price)) + "{{ __('Toman') }}"
                });
                // create span by class old
                let spanPrice = $('<span/>',{
                    class : 'old',
                    text  : toPersianNum(number_format(variation.price)) + "{{ __('Toman') }}"
                });
                // append up spans
                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            }else{
                let spanPrice = $('<span/>',{
                    class : 'new',
                    text  : toPersianNum(number_format(variation.price)) + "{{ __('Toman') }}"
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max',variation.quantity);
            $('.quantity-input').val(1);

        });
    </script>
@endsection
