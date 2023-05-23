@extends('Admin.partials.master')
@section('title')
    {{ __('ویرایش دسته بندی') }}
@endsection
@section('scripts')
    <script>
        //__________________________________Attribute ids
        $('#attributeSelect').selectpicker({
            'title': 'انتخاب ویژگی ها'
        });

        $('#attributeSelect').on('changed.bs.select', function () {
            let attributeSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributeSelected, function (i, element) {
                    if (attribute.id == element) {
                        attributeForFilter.push(attribute)
                    }
                });
            });

            $("#variationSelect").find("option").remove();
            $("#attributeIdFilterSelect").find("option").remove();

            attributeForFilter.forEach((element) => {
                let attributeFilterOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });

                let variationOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });


                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');

                $("#attributeIdFilterSelect").append(attributeFilterOption);
                $("#attributeIdFilterSelect").selectpicker('refresh');

            });
        });

        //__________________________________ Attribute filter ids
        $('#attribute_is_filter_ids').selectpicker({
            'title': 'انتخاب ویژگی قابل فیلتر'
        });

        //__________________________________ Attribute variation id
        $('#variationSelect').selectpicker({
            'title': 'انتخاب ویژگی متغییر'
        });
    </script>
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
            <div class="mb-4">
                <h5 class="font-weight-bold">{{ __('ویرایش دسته بندی')}} : {{$category->name}}</h5>
            </div>
            <hr>
            @include('Admin.sections.errors')
            <form action="{{ route('admin.categories.update',['category' => $category->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- category name input --}}
                    <div class="col">
                        <label for="name">{{ __('نام دسته بندی') }}</label>
                        <input type="text" name="name" id="name" class="form-control"
                               placeholder="{{ __('نام دسته بندی را وارد کنید') }}" value="{{ $category->name }}"/>
                    </div>
                    {{-- end category name --}}

                    {{-- category english name (slug) input --}}
                    <div class="col">
                        <label for="slug">{{ __('نام انگلیسی') }}</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               placeholder="{{ __('نام دسته بندی را به انگلیسی وارد کنید') }}" value="{{ $category->slug }}"/>
                    </div>
                    {{-- end english name name --}}

                    {{-- category english name (slug) input --}}
                    <div class="col">
                        <label for="parent_id">{{ __('والد') }}</label>
                        <select type="text" name="parent_id" id="parent_id" class="form-control form-select">
                            <option value="0">{{ __('بدون والد') }}</option>
                            {{-- Get parent category items --}}
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}"
                                    {{ $category->parent_id === $parentCategory->id ? 'selected' : ''  }}
                                >
                                    {{ __($parentCategory->name) }}
                                </option>
                            @endforeach
                            {{-- End Get parent category items --}}
                        </select>
                    </div>
                    {{-- end english name name --}}

                    {{-- select is active --}}
                    <div class="col">
                        <label for="is_active">{{ __('وضعیت') }}</label>
                        <select name="is_active" id="is_active" class="form-control form-select">
                            <option disabled selected>{{ __('وضعیت نمایش برند را مشخص کنید') }}</option>
                            <option value="1" {{ $category->getRawOriginal('is_active') ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $category->getRawOriginal('is_active') ? '' : 'selected' }}>غیرفعال</option>
                        </select>
                    </div>
                    {{-- end select is active --}}
                </div>
                <div class="row my-5">
                    {{-- attribute ids --}}
                    <div class="col-3">
                        <label for="attributeSelect">{{ __('ویژگی ها') }}</label>
                        <select class="selectpicker form-control" name="attribute_ids[]" id="attributeSelect" multiple="" data-live-search="true">
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $category->attributes()->pluck('id')->toArray()) ? 'selected' : '' }} >
                                    {{ $attribute->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- end attribute ids --}}

                    {{-- attribute ids --}}
                    <div class="col-3">
                        <label for="attributeIdFilterSelect">{{ __('انتخاب ویژگی قابل فیلتر') }}</label>
                        <select class="selectpicker form-control" name="attribute_is_filter_ids[]" id="attributeIdFilterSelect" multiple="" data-live-search="true">
                            @foreach($category->attributes()->wherePivot('is_filter', 'LIKE', 1)->get() as $attribute)
                                <option value="{{ $attribute->id }}" selected>{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- end attribute ids --}}

                    {{-- attribute ids --}}
                    <div class="col-3">
                        <label for="variationSelect">{{ __('ویژگی متغیر') }}</label>
                        <select class="form-control" name="variation_id" id="variationSelect">
                            <option value="{{ $category->attributes()->wherePivot('is_variation', 'LIKE', 1)->first()->id }}" selected>
                                {{ $category->attributes()->wherePivot('is_variation', 'LIKE', 1)->first()->name }}
                            </option>
                        </select>
                    </div>
                    {{-- end attribute ids --}}

                    {{-- category icon input --}}
                    <div class="col">
                        <label for="icon">{{ __('کلاس آیکون') }}</label>
                        <input type="text" name="icon" id="icon" class="form-control"
                               placeholder="{{ __('ایکون دسته بندی را انتخاب کنید') }}" value="{{ $category->icon  }}"/>
                    </div>
                    {{-- end category name --}}
                </div>
                {{-- description --}}
                <div class="row">
                    <label for="description">{{ __('توضیحات') }}</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $category->description }}</textarea>
                </div>
                {{-- end description --}}

                {{-- button --}}
                <div class="my-4">
                    <button class="btn btn-md btn-primary" type="submit">{{ __('ویرایش دسته بندی') }}</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
                </div>
            </form>
        </div>
    </div>

@endsection
