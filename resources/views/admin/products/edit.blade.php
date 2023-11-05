@extends('admin.layouts.master')

@section('title', __('edit product'))

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('admin/vendor/MD.BootstrapPersianDateTimePicker-master-bs4/dist/jquery.md.bootstrap.datetimepicker.style.css') }}">
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
            @include('errors.error')
            <form action="{{ route('admin-panel.products.update',['product' => $product->slug]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row my-2">
                    <div class="col-md-12">
                        <h6>
                            <b>{{ __('create products') }}</b>
                        </h6>
                    </div>
                    {{-- name --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __("Name") }}</label>
                        <input type="text" name="name" id="name" placeholder="{{ __('Write your product name') }}" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- brands --}}
                    <div class="form-group col-md-3">
                        <label for="brand_id">{{ __("Brand") }}</label>
                        <select name="brand_id" id="brand_id" class="form-control form-select @error('brand_id') is-invalid @enderror">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand->id ? 'selected' : '' }} >{{ __($brand->name) }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- is active option --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __('Is active') }}</label>
                        <select name="is_active" id="is_active" class="form-control form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ $product->getRawOriginal('is_active') === 1 ? 'selected' : '' }} >{{ __('Enable') }}</option>
                            <option value="0" {{ $product->getRawOriginal('is_active') === 0 ? 'selected' : '' }} >{{ __('Disable') }}</option>
                        </select>
                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- tags --}}
                    <div class="form-group col-md-3">
                        <label for="attributeSelect">{{ __('Tags') }}</label>
                        <select class="selectpicker @error('tag_ids') is-invalid @enderror" name="tag_ids[]" id="tagSelect" multiple>
                            @php
                                $productTagIds = $product->tags()->pluck('id')->toArray();
                            @endphp
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id ,$productTagIds) ? 'selected' : '' }} >{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tag_ids')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="form-group col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Write Description') }}">{{ $product->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                        <input type="text" name="delivery_amount" id="delivery_amount" placeholder="{{ __('Write') }} {{ __('Delivery amount') }}" value="{{ $product->delivery_amount }}" class="form-control @error('delivery_amount') is-invalid @enderror" dir="auto">
                        @error('delivery_amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- deliviry amount per product --}}
                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">{{ __("Delivery amount per product") }}</label>
                        <input type="text" name="delivery_amount_per_product" id="delivery_amount_per_product" placeholder="{{ __('Write') }} {{ __('Delivery amount per product') }} " value="{{ $product->delivery_amount_per_product }}" class="form-control @error('delivery_amount_per_product') is-invalid @enderror" dir="auto">
                        @error('delivery_amount_per_product')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                        <input type="text" name="attribute_values[{{ $productAttribute->id }}]" value="{{ $productAttribute->value }}" class="form-control"  dir="auto">
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
                                        <input type="text" value="{{ $productVariation->price }}" name="variation_values[{{ $productVariation->id }}][price]" class="form-control"  dir="auto">
                                    </div>

                                    {{-- quantity --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Quantity') }}</label>
                                        <input type="text" value="{{ $productVariation->quantity }}" name="variation_values[{{ $productVariation->id }}][quantity]" class="form-control" dir="auto">
                                    </div>

                                    {{-- sku --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Sku') }}</label>
                                        <input type="text" value="{{ $productVariation->sku }}" name="variation_values[{{ $productVariation->id }}][sku]" class="form-control" dir="auto">
                                    </div>

                                    {{-- sale price --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Sale price') }}</label>
                                        <input type="text" value="{{ $productVariation->sale_price }}" name="variation_values[{{ $productVariation->id }}][sale_price]" value="variation_values[{{ $productVariation->id }}][sale_price]" class="form-control"  dir="auto">
                                    </div>

                                    {{-- date on sale from --}}
                                    <div class="form-group col-md-4">
                                        <label id="date_on_sale_from_label_{{$productVariation->id}}">{{ __('Date on sale from') }}</label>
                                        <input type="text" value="{{ $productVariation->date_on_sale_from == null ? null : Verta($productVariation->date_on_sale_from) }}" name="variation_values[{{ $productVariation->id }}][date_on_sale_from]" id="date_on_sale_from_{{ $productVariation->id }}" class="form-control"  dir="auto">
                                    </div>

                                    {{-- date on sale to --}}
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Date on sale to') }}</label>
                                        <input type="text" value="{{ $productVariation->date_on_to_from == null ? null : Verta($productVariation->date_on_to_from) }}" name="variation_values[{{ $productVariation->id }}][date_on_to_from]" id="date_on_to_from_{{ $productVariation->id }}" class="form-control" dir="auto">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach



            </div>



                {{-- buttons --}}
                <div class="btn-group my-2" dir="ltr">

                    <a href="{{ url()->previous() }}" class="btn btn-dark">
                        {{ __('Go back') }}
                    </a>

                    <button type="submit" class="btn btn-md btn-primary">
                        {{ __('Edit') }}
                    </button>
                </div>

            </form>
        </div>
    </div>


@endsection

@section('javascript')
    <script src="{{ asset('/admin/vendor/MD.BootstrapPersianDateTimePicker-master-bs4/dist/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        let productVariations =  @json($productVariations);

        productVariations.forEach(variation => {
                $(`#date_on_sale_from_${variation.id}`).MdPersianDateTimePicker({
                targetTextSelector: `#date_on_sale_from_${variation.id}`,
                englishNumber : true,
                textFormat : "yyyy-MM-dd HH:mm:ss",
                modalMode : true,
                trigger : 'click',
                enableTimePicker : true
            });

            $(`#date_on_to_from_${variation.id}`).MdPersianDateTimePicker({
                targetTextSelector: `#date_on_to_from_${variation.id}`,
                englishNumber : true,
                textFormat : "yyyy-MM-dd HH:mm:ss",
                modalMode : true,
                trigger : 'click',
                enableTimePicker : true
            });

        });

        // brands
        $('#brand_id').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one brand.') }}"
        });

        $('#tagSelect').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one tags.') }}"
        });

    </script>
@endsection
