@extends('home.layouts.master')

@section('title',__('Compare'))

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                </li>
                <li class="active">{{ __('Compare') }}</li>
            </ul>
        </div>
    </div>
</div>

<!-- compare main wrapper start -->
<div class="compare-page-wrapper pt-100 pb-100" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Compare Page Content Start -->
                <div class="compare-page-content-wrap">
                    <div class="compare-table table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                {{-- products --}}
                                <tr>
                                    <td class="first-column"> محصول </td>
                                    @foreach ($products as $product)
                                    <td class="product-image-title">
                                        {{-- primary image --}}
                                        <a href="{{ route('home.products.show', ['product' => $product->slug]) }}" class="image">
                                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH').$product->primary_image) }}" alt="{{ $product->name }}" width="300" height="300">
                                        </a>
                                        {{-- category --}}
                                        <a href="{{ route('home.categories.show',['category' => $product->category->slug]) }}">
                                            {{ __('categories') }}
                                            :
                                            {{ $product->category->parent->name }} - {{ $product->category->name }}
                                        </a>
                                        {{-- product name --}}
                                        <a href="single-product-sale.html" class="title">{{ $product->name }}</a>
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- descriptions --}}
                                <tr>
                                    <td class="first-column"> توضیحات </td>
                                    @foreach ($products as $product)
                                    <td class="pro-desc">
                                        <p class="text-right">{{ $product->description }}</p>
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- attributes --}}
                                <tr>
                                    <td class="first-column"> ویژگی متغییر </td>
                                    @foreach ($products as $product)
                                        <td>
                                            <ul class="text-right">
                                                <li>-
                                                    {{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}
                                                    :
                                                    @foreach ($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                                        <span>{{ $variation->value }} {{ $loop->last ? '' : ' | ' }}</span>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </td>
                                    @endforeach
                                </tr>

                                {{-- variations --}}
                                <tr>
                                    <td class="first-column"> ویژگی </td>
                                    @foreach ($products as $product)
                                    <td>
                                        <ul class="text-right">
                                            @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                                <li>-
                                                    <span>{{ $attribute->attribute->name }} :</span>
                                                    {{ $attribute->value }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- rates --}}
                                <tr>
                                    <td class="first-column"> امتیاز </td>
                                    @foreach ($products as $product)
                                        <td class="pro-ratting">
                                            <div class="mx-5" data-rating-readonly="true" data-rating-stars="5" data-rating-value="{{ ceil($product->rates()->where('product_id',$product->id)->avg('rate')) }}"></div>
                                        </td>
                                    @endforeach
                                </tr>

                                {{-- delete --}}
                                <tr>
                                    <td class="first-column"> حذف </td>
                                    @foreach ($products as $product)
                                        <td class="pro-remove">
                                            <a href="{{ route('home.compare-remove',['product' => $product->slug]) }}"><i class="sli sli-trash"></i></a>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Compare Page Content End -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{ asset('/home/assets/vendor/rating-star-icons/dist/rating.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection
