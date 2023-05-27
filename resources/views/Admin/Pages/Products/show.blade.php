@extends('Admin.partials.master')
@section('title')
    {{ __('نمایش محصول منتخب') }}
@endsection
@section('scripts')
    <script>
        $("#tagSelect").selectpicker({
            title : "نمایش تگ های منتخب"
        })
    </script>
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
            <div class="mb-4">
                <h5 class="font-weight-bold">
                    {{ __('نمایش محصول') }} :
                    {{ $product->name }}
                </h5>
            </div>
            <hr>
            <div class="row">

                {{-- product title --}}
                <div class="col-md-12">
                    <h6 class="font-weight-bold">
                        <i class="fas fa-store mx-2"></i>
                        {{__('اطلاعات محصول')}}
                    </h6>
                </div>
                {{-- End product title --}}

                {{-- brand Product   --}}
                <div class="col">
                    <label for="name">{{ __('نام محصول') }}</label>
                    <input class="form-control" value="{{ $product->name }}" disabled/>
                </div>
                {{-- end Product   --}}

                {{-- Product brand_id --}}
                <div class="col-3">
                    <label for="BrandSelect">{{ __('برندها') }}</label>
                    <select class="form-control" disabled>
                        <option>{{ $product->brand->name }}</option>
                    </select>
                </div>
                {{-- end Product brand_id --}}

                {{-- Product is active --}}
                <div class="col">
                    <label for="is_active">{{ __('وضعیت') }}</label>
                    <select class="form-control form-select" disabled>
                        <option value="1" {{ $product->getRawOriginal('is_active') ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ $product->getRawOriginal('is_active') ? '' : 'selected' }}>غیرفعال</option>
                    </select>
                </div>
                {{-- end Product is active --}}

                {{-- Product tag ids --}}
                <div class="col-3">
                    <label for="TagSelects">{{ __('تگ ها') }}</label>
                    <select class="selectpicker form-control form-select" id="tagSelect" data-live-search="true">
                        @foreach($product->tags as $tag)
                            <option>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- end Product tag ids --}}

                {{-- description --}}
                <div class="col-md-12 my-2">
                    <label for="description">{{ __('توضیحات') }}</label>
                    <textarea id="description" rows="3" class="form-control" disabled>{{ $product->description }}</textarea>
                </div>
                {{-- end description --}}
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h6>
                        <i class="fa fa-fw fa-pen mx-2"></i>
                        <span>{{__('نمایش هزینه ارسال')}}</span>
                        <span id="variationName" class="font-weight-bold"></span>
                    </h6>
                </div>
                <div class="col-md-3">
                    <label>هزینه ارسال</label>
                    <input type="text" class="form-control" disabled value="{{ $product->delivery_amount }}">
                </div>
                <div class="col-md-3">
                    <label>هزینه ارسال اضافی به ازای هر محصول</label>
                    <input type="text" class="form-control" disabled value="{{ $product->delivery_amount_per_pro }}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h6>
                        <i class="fa fa-fw fa-pen mx-2"></i>
                        <span>{{__('نمایش ویژگی ها')}}</span>
                        <span id="variationName" class="font-weight-bold"></span>
                    </h6>
                </div>
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($productAttributes as $productAttribute)
                                <div class="col-md-3">
                                    <label>{{ $productAttribute->attribute->name }}</label>
                                    <input type="text" class="form-control" value="{{ $productAttribute->value }}" />
                                </div>
                            @endforeach
                        </div>
                        <div class="row my-3">
                            @foreach ($productVariations as $variation)
                                <div class="col-md-12 my-1">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <p>قیمت و موجودی و سایز  : {{ $variation->value }}</p>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#collapse-{{$variation->id}}">
                                                {{ __('نمایش') }}
                                            </button>
                                        </div>
                                        <div class="collapse" id="collapse-{{$variation->id}}">
                                            <div class="card-body">
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('شناسه انبار :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->sku }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('موجودی :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->quantity }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('قیمت :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->price }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    @if (is_numeric($variation->value))
                                                        <span class="col">{{ __('سایز :') }}</span>
                                                        @else
                                                        <span> class="col"{{ __('اندازه') }}</span>
                                                    @endif
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->value }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('قیمت حراجی :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->sale_price }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('تاریخ شروع حراجی :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->date_on_sale_from == null ? '00/00/00' : verta($variation->date_on_sale_from) }}</span>
                                                </p>
                                                <p class="d-flex justify-content-between">
                                                    <span class="col">{{ __('تاریخ پایان حراجی :') }}</span>
                                                    <span class="border-bottom border-dark col w-75 mb-3"></span>
                                                    <span class="col text-left">{{ $variation->date_on_sale_to == null ? '00/00/00' : verta($variation->date_on_sale_to) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6>
                        <i class="fa fa-fw fa-pen mx-2"></i>
                        <span>{{__('تصاویر')}}</span>
                        <span id="variationName" class="font-weight-bold"></span>
                    </h6>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            {{ __('تصویر شاخص') }}
                        </div>
                        <div class="card-img-top">
                            <img src="{{ url(env('PRODUCT_IMAGE_PRIMARY').'/'.$product->primary_image) }}" alt="{{ $product->name }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('تصاویر محصول') }}
                        </div>
                    </div>
                </div>
                @foreach ($images as $image)
                <div class="col-md-3 my-2">
                    <div class="card-img-top">
                        @if(strpos($image->image,'.webm'))
                        <video controls autoplay class="img-fluid">
                            <source src="{{ url(env('PRODUCT_IMAGE_PRIMARY'). $image->image) }}" type="video/mp4">
                        </video>
                        @else
                        <img src="{{ url(env('PRODUCT_IMAGE_PRIMARY').$image->image) }}" alt="{{ $product->name }}" class="img-fluid">
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
