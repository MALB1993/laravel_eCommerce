@extends('admin.layouts.master')

@section('title', __('create products'))

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
            <h5 class="font-weight-bold">{{ __('Products') }}</h5>
            <a href="{{ route('admin-panel.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index products') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row my-2">
                    <div class="col-md-12">
                        <h6>
                            <b>{{ __('create products') }}</b>
                        </h6>
                    </div>
                    {{-- name --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __("Name") }}</label>
                        <input type="text" name="name" id="name" placeholder="{{ __('Write your product name') }}" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- brands --}}
                    <div class="form-group">
                        <label for="name">{{ __("Brand") }}</label>
                        <select name="brand_id" id="brand_id" class="form-control form-select @error('brand_id') is-invalid @enderror">
                            <option selected disabled>{{ __('Choose an option') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ __($brand->name) }}</option>
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
                            <option selected disabled>{{ __('Choose an option') }}</option>
                            <option value="1">{{ __('Enable') }}</option>
                            <option value="0">{{ __('Disable') }}</option>
                        </select>
                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- tags --}}
                    <div class="form-group col-md-3">
                        <label for="attributeSelect">{{ __('Tags') }}</label>
                        <select class="selectpicker @error('attribute_ids') is-invalid @enderror" name="tag_ids[]" id="tagSelect" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tag_ids')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Write Description') }}">{{ old('description') }}</textarea>
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
                            <b>{{ __('Product Images') }}</b>
                        </h6>
                    </div>

                    {{-- primary image --}}
                    <div class="form-group col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="primary_image" name="primary_image" aria-describedby="primary_image">
                                <label class="custom-file-label" for="primary_image">{{ __('Choose File') }}</label>
                            </div>
                    </div>

                    {{-- images --}}
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3" dir="ltr">

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images" name="images[]" aria-describedby="images" multiple="true ">
                                <label class="custom-file-label" for="images">{{ __('Choose Files') }}</label>
                            </div>
                        </div>
                    </div>


                </div>

                {{-- buttons --}}

                <div class="btn-group" dir="ltr">

                    <a href="{{ url()->previous() }}" class="btn btn-dark">
                        {{ __('Go back') }}
                    </a>

                    <button type="submit" class="btn btn-md btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>

    </div>


@endsection

@section('javascript')
<script>
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

    $("#primary_image").change(function(){
        let fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName)
    });

    $("#images").change(function(){
        let fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName)
    });


</script>
@endsection
