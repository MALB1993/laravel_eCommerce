@extends('admin.layouts.master')

@section('title', __('create categories'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('categories') }}</h5>
            <a href="{{ route('admin-panel.categories.index') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index categories') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.categories.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">

                    {{-- name --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" placeholder="{{ __('Write your brand name') }}"
                            value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- slug --}}
                    <div class="form-group col-md-3">
                        <label for="slug">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug"
                            placeholder="{{ __('Write your category slug') }}" value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- parent's --}}
                    <div class="form-group col-md-3">
                        <label for="parent_id">{{ __('Is active') }}</label>
                        <select name="parent_id" id="parent_id"
                            class="form-control form-select @error('parent_id') is-invalid @enderror">
                            <option selected disabled>{{ __('Choose an option') }}</option>
                            <option value="0">{{ __('Without a father') }}</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- is active option --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __('Is active') }}</label>
                        <select name="is_active" id="is_active"
                            class="form-control form-select @error('is_active') is-invalid @enderror">
                            <option selected disabled>{{ __('Choose an option') }}</option>
                            <option value="1">{{ __('Enable') }}</option>
                            <option value="0">{{ __('Disable') }}</option>
                        </select>
                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    {{-- attributes --}}
                    <div class="form-group col-md-3">
                        <label for="attributeSelect">{{ __('Attribute') }}</label>
                        <select class="selectpicker @error('attribute') is-invalid @enderror" name="attribute_ids[]" id="attributeSelect" multiple>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                        @error('attribute')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- attribute is filter --}}
                    <div class="form-group col-md-3">
                        <label for="attributeIsFilterSelecte">{{ __('Attributes is filter') }}</label>
                        <select id="attributeIsFilterSelect"  name="attribute_is_filter_ids[]" class="form-control @error('attribute_is_filter_ids') is-invalid @enderror" multiple></select>
                        @error('attribute_is_filter_ids')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- variations --}}
                    <div class="form-group col-md-3">
                        <label for="variationSelect">{{ __('Variation') }}</label>
                        <select class="selectpicker @error('varition_id') is-invalid @enderror" name="varition_id" id="variationSelect"></select>
                        @error('varition_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- icon --}}
                    <div class="form-group col-md-3">
                        <label for="icon">{{ __('Icon') }}</label>
                        <input type="text" name="icon" id="icon" placeholder="{{ __('Write your icon class') }}"
                            value="{{ old('icon') }}" class="form-control @error('icon') is-invalid @enderror">
                        @error('icon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- description --}}
                <div class="row">
                    <div class="col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Write Description') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- buttons --}}
                <div class="btn-group my-2" dir="ltr">

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

        // attribute
        $('#attributeSelect').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one attribute.') }}"
        });

        // attribute select jquery
        $('#attributeSelect').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
            let attributeSelected = $(this).val();
            let attributes = @json($attributes);
            let attributeForFilter = [];


            attributes.map((attribute) => {
                $.each(attributeSelected, function(i, element) {
                    if (attribute.id == element) {
                        attributeForFilter.push(attribute)
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();

            attributeForFilter.forEach( (element)=>{
                let attributeFilterOption = $('<option/>' , {
                    value : element.id,
                    text : element.name
                });
                let variationOption = $('<option/>' , {
                    value : element.id,
                    text : element.name
                });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');

            });


        });

        // attribute filter select
        $("#attributeIsFilterSelect").selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one filterable feature.') }}"
        });

        // variation select
        $("#variationSelect").selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one filterable feature.') }}"
        });

    </script>
@endsection
