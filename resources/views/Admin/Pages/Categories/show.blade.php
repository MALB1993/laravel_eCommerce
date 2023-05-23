@extends('Admin\partials\master')
@section('title')
    {{ __('نمایش دسته بندی منتخب') }}
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
            <div class="mb-4 d-flex">
                <h5 class="font-weight-bold">
                    <span>{{ __('دسته بندی') }}</span>
                </h5>
                <p> : {{ $category->name }}</p>
            </div>
            <hr>
            <div class="row">
                {{-- category name input --}}
                <div class="col-md-3">
                    <label for="name">{{ __('نام دسته بندی') }}</label>
                    <input type="text" class="form-control" value="{{ $category->name  }}" disabled/>
                </div>
                {{-- end category name --}}

                {{-- category english name (slug) input --}}
                <div class="col-md-3">
                    <label for="slug">{{ __('نام انگلیسی') }}</label>
                    <input type="text" class="form-control" value="{{ $category->slug }}" disabled/>
                </div>
                {{-- end english name name --}}

                {{-- category parent input --}}
                <div class="col-md-3">
                    <label for="parent_id">{{ __('والد') }}</label>
                    <select type="text" class="form-control form-select" disabled>
                        @if($category->parent_id === 0)
                            <option selected>{{ __('بدون والد') }}</option>
                        @else
                            <option selected>{{ __($category->parent->name) }}</option>
                        @endif
                    </select>
                </div>
                {{-- end parent name --}}

                {{-- select is active --}}
                <div class="col-md-3">
                    <label for="is_active">{{ __('وضعیت') }}</label>
                    <select name="is_active" class="form-control form-select" disabled>
                        <option selected disabled>{{ $category->is_active }}</option>
                    </select>
                </div>
                {{-- end select is active --}}
            </div>
            <div class="row my-4">
                {{-- category icon --}}
                <div class="col-md-3">
                    <label for="icon">{{ __('ایکون') }}</label>
                    <input type="text" class="form-control" value="{{ $category->icon  }}" disabled/>
                </div>
                {{-- end category icon --}}

                {{-- category create --}}
                <div class="col-md-3">
                    <label for="icon">{{ __('تاریخ ایجاد') }}</label>
                    <input type="text" class="form-control" value="{{ verta($category->created_at)->format('Y-m-d |  H:i')  }}" disabled/>
                </div>
                {{-- end category create --}}

                {{-- category create --}}
                <div class="col-md-3">
                    <label for="icon">{{ __('تاریخ ویرایش') }}</label>
                    <input type="text" class="form-control" value="{{ verta($category->updated_at)->format('Y-m-d |  H:i')  }}" disabled/>
                </div>
                {{-- end category create --}}
            </div>
            <div class="row my-4">
                <div class="col-12">
                    <label for="description">{{ __('توضیحات') }}</label>
                    <textarea name="description" id="description" class="form-control w-100" rows="4" disabled>{{ $category->description }}</textarea>
                </div>
            </div>
            <hr>
            <div class="row">
                {{-- category attribute input --}}
                <div class="col-md-3">
                    <label for="parent_id">{{ __('ویژگی ها') }}</label>
                    <div type="text" class="form-control form-select bg-gray-200">
                        @foreach($category->attributes as $attribute)
                            {{ $attribute->name }} {{ $loop->last ? '.' : '،' }}
                        @endforeach
                    </div>
                </div>
                {{-- end attribute name --}}

                {{-- category attribute is filter --}}
                <div class="col-md-3">
                    <label for="parent_id">{{ __('ویژگی های قابل فیلتر') }}</label>
                    <div type="text" class="form-control form-select bg-gray-200">
                        @foreach($category->attributes()->wherePivot('is_filter', 1)->get() as $attribute)
                            {{ $attribute->name }} {{ $loop->last ? '.' : '،' }}
                        @endforeach
                    </div>
                </div>
                {{-- end category attribute is filter --}}

                {{-- category attribute is filter --}}
                <div class="col-md-3">
                    <label for="parent_id">{{ __('ویژگی متغیر') }}</label>
                    <div type="text" class="form-control form-select bg-gray-200">
                        @foreach($category->attributes()->wherePivot('is_variation', 1)->get() as $attribute)
                            {{ $attribute->name }} {{ $loop->last ? '.' : '،' }}
                        @endforeach
                    </div>
                </div>
                {{-- end category attribute is filter --}}
            </div>
        </div>
        <div class="col-md-12 my-4">
            {{-- back button --}}
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
        </div>
    </div>
@endsection
