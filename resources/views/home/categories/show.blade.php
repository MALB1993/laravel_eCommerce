@extends('home.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('home/assets/vendor/fontawesome-free/css/all.min.css') }}">
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
    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse text-right">

                <!-- sidebar -->
                <div class="col-lg-3 order-2 order-sm-2 order-md-1">
                    <div class="sidebar-style mr-30">
                        {{-- search --}}
                        <div class="sidebar-widget">
                            <div class="pro-sidebar-search mb-50 mt-25 position-relative">
                                <div>
                                    <input type="text" placeholder="{{ __('Search') }}" dir="rtl" class="form-control" id="search-input" value="{{ request()->has('search') ? request()->search : ''  }}">
                                    <button class="position-absolute btn btn-md btn-dark" style="left: 2px; top: 2px" onclick="filter()" type="button">
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title"> دسته بندی </h4>
                            <div class="sidebar-widget-list mt-30">
                                <ul>
                                    <li>
                                        <a
                                            href="{{ route('home.categories.show', ['category' => $category->slug]) }}">{{ $category->parent->name }}</a>
                                    </li>
                                    @foreach ($category->parent->children as $children)
                                        <li class="mr-3">
                                            <a href="{{ route('home.categories.show', ['category' => $children->slug]) }}"
                                                style="color :{{ $children->name == $category->name ? '#ff3535' : '#000000' }}">{{ $children->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>
                        @foreach ($attributes as $attribute)
                            <div class="sidebar-widget mt-30">
                                <h4 class="pro-sidebar-title">{{ $attribute->name }}</h4>
                                <div class="sidebar-widget-list mt-20">
                                    <ul>
                                        @foreach ($attribute->values as $value)
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" class="attribute-{{ $attribute->id }}" value="{{ $value->value }}" onchange="filter()" {{ (request()->has('attribute.'.$attribute->id) && in_array($value->value, explode('-',request()->attribute[$attribute->id]))) ? 'checked' : '' }}  />
                                                    <a href="#">{{ $value->value }}</a>
                                                    <span class="checkmark"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                        {!! !$loop->last ? "<hr/>" : "" !!}
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <div class="sidebar-widget mt-30">
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    @foreach ($variation->variationsValues as $value)
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" class="variation" value="{{ $value->value }}" onchange="filter()" {{ (request()->has('variation') && in_array($value->value, explode('-',request()->variation))) ? 'checked' : '' }} />
                                                <a href="#">{{ $value->value }}</a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- content -->
                <div class="col-lg-9 order-1 order-sm-1 order-md-2">
                    <!-- shop-top-bar -->
                    <div class="shop-top-bar" style="direction: rtl;">
                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <label for="sort-by">{{ __('Ordering') }} : </label>
                                <select class="form-control" onchange="filter()" id="sort-by">
                                    <option value="default">{{ __('Ordering') }} &#x2BB6; </option>
                                    <option value="max"     {{ (request()->has('sortBy') && request()->sortBy == 'max' )     ? 'selected' : '' }} >
                                        {{ __('The highest price') }}
                                    </option>
                                    <option value="min"     {{ (request()->has('sortBy') && request()->sortBy == 'min' )     ? 'selected' : '' }} >
                                        {{ __('Lowest price') }}
                                    </option>
                                    <option value="latest"  {{ (request()->has('sortBy') && request()->sortBy == 'latest' )  ? 'selected' : '' }} >
                                        {{ __('The newest') }}
                                    </option>
                                    <option value="oldest"  {{ (request()->has('sortBy') && request()->sortBy == 'oldest' )  ? 'selected' : '' }} >
                                        {{ __('The oldest') }}
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">

                            <div class="row ht-products" style="direction: rtl;">
                                @foreach ($products as $product)
                                <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
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
                                                            <a href="#"><i class="sli sli-heart"></i>
                                                                <span class="ht-product-action-tooltip"> افزودن به علاقه مندی ها </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="sli sli-refresh"></i><span class="ht-product-action-tooltip"> مقایسه</span>
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
                                </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="pro-pagination-style text-center mt-30" id="pagination">
                            {{ $products->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="filter-form">
        @foreach ($attributes as $attribute)
            <input type="hidden" id="filter-attribute-{{$attribute->id}}" name="attribute[{{$attribute->id}}]">
        @endforeach
        <input type="hidden" id="filter-variation"  name="variation">
        <input type="hidden" id="filter-sort-by"    name="sortBy">
        <input type="hidden" id="filter-search"     name="search">
    </form>
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
                                        <a href="{{ route('home.compare-add',['product' => $product->slug]) }}">
                                            <i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">
                                        </a>
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

        function filter()
        {
            let attributes = @json($attributes);

            attributes.map(attribute => {
                let valueAttribute = $(`.attribute-${attribute.id}:checked`).map(function(){
                return this.value;
            }).get().join('-');

                if(valueAttribute == ""){
                    $(`#filter-attribute-${attribute.id}`).prop('disabled', true);
                }else{

                    $(`#filter-attribute-${attribute.id}`).val(valueAttribute);
                }
            });

            let variation = $(".variation:checked").map(function(){
                return this.value;
            }).get().join('-');

            if(variation == ""){
                $("#filter-variation").prop('disabled', true);
            }else{

                $("#filter-variation").val(variation);
            }

            let sortBy =  $("#sort-by").val();

            if(sortBy == "default"){
                $("#filter-sort-by").prop('disabled', true);
            }else{

                $("#filter-sort-by").val(sortBy);
            }

            let searchInput =  $("#search-input").val();

            if(searchInput == ""){
                $("#filter-search").prop('disabled', true);
            }else{

                $("#filter-search").val(searchInput);
            }

            $("#filter-form").submit();
        }

        $("#filter-form").on('submit',function(event){
            event.preventDefault();
            let currentUrl = "{{ url()->current() }}";
            let url =   currentUrl + "?" + decodeURIComponent($(this).serialize());

            $(location).attr('href',url);

        });


        $('.variation_select').on('change', function() {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation_price');

            variationPriceDiv.empty();

            if (variation.is_sale) {
                // create span sale price by class new
                let spanSale = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + "{{ __('Toman') }}"
                });
                // create span by class old
                let spanPrice = $('<span/>', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + "{{ __('Toman') }}"
                });
                // append up spans
                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            } else {
                let spanPrice = $('<span/>', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + "{{ __('Toman') }}"
                });
                variationPriceDiv.append(spanPrice);
            }

            $('.quantity-input').attr('data-max', variation.quantity);
            $('.quantity-input').val(1);

        });

        $("#pagination li a").map(function(){

            let decodeUrl = decodeURIComponent($(this).attr('href'));

            if($(this).attr('href') !== undefined)
            {
                $(this).attr('href',decodeUrl);
            }

        });

    </script>
@endsection
