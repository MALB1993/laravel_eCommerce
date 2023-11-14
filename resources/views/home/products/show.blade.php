@extends('home.layouts.master')

@section('title', $product->name)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('/home/assets/vendor/fontawesome-free/css/all.min.css') }}">
@endsection

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                </li>
                <li class="active">{{ __('Shop') }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="product-details-area pt-100 pb-95">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                <div class="product-details-content ml-30">
                    <h2 class="text-right">{{ $product->name }}</h2>
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
                            {{ __('Comments') }} : {{ $product->approvedComments->count() }}
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
                                    <select id="" class="form-control variation_select">
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
                                <a href="#">افزودن به سبد خرید</a>
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
                                <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                            </div>
                        </div>
                    @endif

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

            <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                <div class="product-details-img">
                    <div class="zoompro-border zoompro-span">
                        <img class="zoompro" src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" data-zoom-image="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" alt="{{ $product->name }}" />
                    </div>
                    <div id="gallery" class="mt-20 product-dec-slider">
                        @foreach ($product->images as $image)
                            <a
                                data-image      ="{{ asset(env('IMAGE_UPLOAD_PATH').'products/images/'.$image->image)  }}"
                                data-zoom-image ="{{ asset(env('IMAGE_UPLOAD_PATH').'products/images/'.$image->image)  }}">
                                <img src        ="{{ asset(env('IMAGE_UPLOAD_PATH').'products/images/'.$image->image)  }}"

                                alt="" width="90">
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="description-review-area pb-95">
    <div class="container">
        <div class="row" style="direction: rtl;">
            <div class="col-lg-8 col-md-8">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <a class="{{ (count($errors) > 0) ? '' : 'active' }}" data-toggle="tab" href="#des-details1"> توضیحات </a>
                        <a data-toggle="tab" href="#des-details3"> اطلاعات بیشتر </a>
                        <a class="{{ (count($errors) > 0) ? 'active' : '' }}" data-toggle="tab" href="#des-details2">
                            {{ __('Comments') }} : {{$product->approvedComments->count() }}
                        </a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane {{ (count($errors) > 0) ? '' : 'active' }}">
                            <div class="product-description-wrapper">
                                <p class="text-right">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="product-anotherinfo-wrapper text-right">
                                <ul>
                                    @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                        <li>
                                            <span>{{ $attribute->attribute->name }} :</span>
                                            {{ $attribute->value }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane {{ (count($errors) > 0) ? 'active' : '' }} ">

                            <div class="review-wrapper">
                                @foreach ($product->approvedComments as $comment)
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
                                                    <h4>{{ $comment->user->name == null ? __('Client') : $comment->user->name }}</h4>
                                                </div>
                                                <div class="mx-5" data-rating-readonly="true" data-rating-stars="5" data-rating-value="{{ ceil($comment->user->rates()->where('product_id',$product->id)->avg('rate')) }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="ratting-form-wrapper text-right" id="show-errors-comment">
                                <span> نوشتن دیدگاه </span>

                                <div class="star-box-wrap">
                                    <div id="dataReadonlyReview" data-rating-stars="5" data-rating-value="3" data-rating-input="#dataReadonlyInput"></div>
                                </div>

                                <div class="ratting-form">
                                    <form action="{{ route('home.comment.store',['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label> متن دیدگاه : </label>
                                                    <textarea name="text" class="@error('text') in-invalid @enderror">{{ old('text') }}</textarea>
                                                    @error('text')
                                                        <div class="input-error-validation">
                                                            <span class="text-danger">{{ $message }}</span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <input type="hidden" id="dataReadonlyInput" name="rate" value="{{ old('rate') ? old('rate') : 0 }}">

                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" value="ارسال">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="pro-dec-banner">
                    <a href="#"><img src="{{ asset('home/assets/img/banner/banner-7.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
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
                            <h2 class="text-right mb-4">لورم ایپسوم</h2>
                            <div class="product-details-price">
                                <span>
                                    50,000
                                    تومان
                                </span>
                                <span class="old">
                                    75,000
                                    تومان
                                </span>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="pro-details-rating">
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star yellow"></i>
                                    <i class="sli sli-star"></i>
                                    <i class="sli sli-star"></i>
                                </div>
                                <span>3 دیدگاه</span>
                            </div>
                            <p class="text-right">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                گرافیک است. چاپگرها
                                و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                            </p>
                            <div class="pro-details-list text-right">
                                <ul class="text-right">
                                    <li>- لورم ایپسوم</li>
                                    <li>- لورم ایپسوم متن ساختگی</li>
                                    <li>- لورم ایپسوم متن</li>
                                </ul>
                            </div>
                            <div class="pro-details-size-color text-right">
                                <div class="pro-details-size">
                                    <span>Size</span>
                                    <div class="pro-details-size-content">
                                        <ul>
                                            <li><a href="#">s</a></li>
                                            <li><a href="#">m</a></li>
                                            <li><a href="#">l</a></li>
                                            <li><a href="#">xl</a></li>
                                            <li><a href="#">xxl</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="pro-details-color-wrap">
                                    <span>Color</span>
                                    <div class="pro-details-color-content">
                                        <ul>
                                            <li class="blue"></li>
                                            <li class="maroon active"></li>
                                            <li class="gray"></li>
                                            <li class="green"></li>
                                            <li class="yellow"></li>
                                            <li class="white"></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2" />
                                </div>
                                <div class="pro-details-cart">
                                    <a href="#">افزودن به سبد خرید</a>
                                </div>
                                <div class="pro-details-wishlist">
                                    <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                </div>
                                <div class="pro-details-compare">
                                    <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                </div>
                            </div>
                            <div class="pro-details-meta">
                                <span>دسته بندی :</span>
                                <ul>
                                    <li><a href="#">پالتو</a></li>
                                </ul>
                            </div>
                            <div class="pro-details-meta">
                                <span>تگ ها :</span>
                                <ul>
                                    <li><a href="#">لباس, </a></li>
                                    <li><a href="#">پیراهن</a></li>
                                    <li><a href="#">مانتو</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="tab-content quickview-big-img">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="{{ asset('home/assets/img/product/quickview-l1.svg') }}" alt="" />
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="{{ asset('home/assets/img/product/quickview-l2.svg') }}" alt="" />
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="{{ asset('home/assets/img/product/quickview-l3.svg') }}" alt="" />
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="{{ asset('home/assets/img/product/quickview-l2.svg') }}" alt="" />
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="{{ asset('home/assets/img/product/quickview-s1.svg') }}" alt="" /></a>
                                <a data-toggle="tab" href="#pro-2"><img src="{{ asset('home/assets/img/product/quickview-s2.svg') }}" alt="" /></a>
                                <a data-toggle="tab" href="#pro-3"><img src="{{ asset('home/assets/img/product/quickview-s3.svg') }}" alt="" /></a>
                                <a data-toggle="tab" href="#pro-4"><img src="{{ asset('home/assets/img/product/quickview-s2.svg') }}" alt="" /></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{ asset('/home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
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
