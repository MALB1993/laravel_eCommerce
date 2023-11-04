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
                    <div class="div-disabled form-control text-left">
                        {{ Verta($product->created_at) }}
                    </div>
                </div>


                {{-- created_at --}}
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
