@extends('admin.layouts.master')

@section('title', __('show products'))

@section('stylesheet')
    <style>
        .custom-file-label::after{
            content : "{{ __('File') }}" !important;
        }

        .custom-file-label:after{
            right: unset;
            left: 0;
            border-left: unset;
            border-right: inherit;
            border-radius: 0.35rem 0 0 0.35rem;
        }

    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ $product->name }}</h5>
            <a href="{{ route('admin-panel.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index products') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">

            <div class="row">
                {{-- name --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('Name') }}</label>
                    <div class="div-disabled form-control">
                        {{ $product->name }}
                    </div>
                </div>

                {{-- brand --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('Brand') }}</label>
                    <div class="div-disabled form-control">
                        {{ $product->brand->name }}
                    </div>
                </div>

                {{-- brand --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('Category') }}</label>
                    <div class="div-disabled form-control">
                        {{ $product->category->name }}
                    </div>
                </div>

                {{-- Is Active --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('Is active') }}</label>
                    <div class="div-disabled form-control">
                        {{ $product->is_active }}
                    </div>
                </div>

                {{-- created_at --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('created_at') }}</label>
                    <div class="div-disabled form-control text-right">
                        @foreach ($product->tags as $tag)
                            {{ $tag->name }} {{ $loop->last ? "" : "|" }}
                        @endforeach
                    </div>
                </div>


                {{-- created_at --}}
                <div class="col-md-3 form-group">
                    <label>{{ __('created_at') }}</label>
                    <div class="div-disabled form-control text-left">
                        {{ Verta($product->created_at) }}
                    </div>
                </div>


                {{-- description --}}
                <div class="col-md-12 form-group">
                    <label>{{ __('Description') }}</label>
                    <textarea @disabled(true) class="form-control" cols="3" rows="5">{{ $product->description }}</textarea>
                </div>


            </div>

            <div class="row">
                {{-- divider --}}
                <div class="col-md-12">
                    <hr>
                    <h6>
                        <b>{{ __('Delivery amount') }}</b>
                    </h6>
                </div>

                {{-- deliviry amount --}}
                <div class="form-group col-md-3">
                    <label for="delivery_amount">{{ __("Delivery amount") }}</label>
                    <input type="text" name="delivery_amount" id="delivery_amount" placeholder="{{ __('Write') }} {{ __('Delivery amount') }}" value="{{ $product->delivery_amount }}" class="form-control" b; @disabled(true) dir="auto">
                </div>
                {{-- deliviry amount per product --}}
                <div class="form-group col-md-3">
                    <label for="delivery_amount_per_product">{{ __("Delivery amount per product") }}</label>
                    <input type="text" id="delivery_amount_per_product" placeholder="{{ __('Write') }} {{ __('Delivery amount per product') }} " value="{{ $product->delivery_amount_per_product }}" class="form-control" @disabled(true) dir="auto">
                </div>

            </div>

            <div class="row">
                {{-- divider --}}
                <div class="col-md-12">
                    <hr>
                    <h6>
                        <b>{{ __('Attributes') }}</b>
                    </h6>
                </div>

                @foreach ($productAttributes as $productAttribute)
                    {{-- deliviry amount --}}
                    <div class="form-group col-md-3">
                        <label>{{ $productAttribute->attribute->name }}</label>
                        <input type="text" value="{{ $productAttribute->value }}" class="form-control" b; @disabled(true) dir="auto">
                    </div>
                @endforeach

                <hr>

                @foreach ($productVariations as $key => $productVariation)
                    <div class="col-md-12">
                        <hr>
                        <button class="btn btn-sm btn-light my-2" type="button" data-toggle="collapse" data-target="#collapseExample_{{ $key }}" aria-expanded="false" aria-controls="collapseExample_{{ $key }}">
                            {{ __('Price and inventory subject to change') }} : {{ $productVariation->value }}
                        </button>

                        <div class="collapse" id="collapseExample_{{ $key }}">
                            <div class="card card-body">

                                <div class="row">
                                    {{-- price --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Price') }}</label>
                                        <input type="text" value="{{ number_format($productVariation->price) }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                    {{-- quantity --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Quantity') }}</label>
                                        <input type="text" value="{{ number_format($productVariation->quantity) }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                    {{-- sku --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Sku') }}</label>
                                        <input type="text" value="{{ $productVariation->sku }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                    {{-- sale price --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Sale price') }}</label>
                                        <input type="text" value="{{ number_format($productVariation->sale_price) }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                    {{-- date on sale from --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Date on sale from') }}</label>
                                        <input type="text" value="{{ $productVariation->date_on_sale_from == null ? null : Verta($productVariation->date_on_sale_from) }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                    {{-- date on sale to --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Date on sale to') }}</label>
                                        <input type="text" value="{{ $productVariation->date_on_to_from == null ? null : Verta($productVariation->date_on_to_from) }}" class="form-control" b; @disabled(true) dir="auto">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach



            </div>


            <div class="row my-2">
                {{-- divider --}}
                <div class="col-md-12">
                    <hr>
                    <h6>
                        <b>{{ __('Images') }}</b>
                    </h6>
                </div>

                <div class="col-md-12 border p-3">
                    <p>{{ __('Primary image') }}</p>
                    <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH') .$product->primary_image ) }}" alt="" width="200" height="200" class="img-thumbnail img-fluid">
                </div>

                <hr>

                <div class="col-md-12 border p-3 my-2">
                    <p>{{ __('Images') }}</p>
                    @foreach ($product->images as $item)
                        <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH') .$item->image ) }}" alt="" width="200" height="200" class="img-thumbnail img-fluid mx-auto my-1">
                    @endforeach
                </div>


            </div>

            {{-- buttons --}}
            <div class="btn-group" dir="ltr">
                <a href="{{ url()->previous() }}" class="btn btn-dark">
                    {{ __('Go back') }}
                </a>
            </div>
        </div>
    </div>

@endsection
