@extends('Admin\partials\master')
@section('title')
    {{ __('نمایش ویژگی منتخب') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4 d-flex">
            <h5 class="font-weight-bold">
                <span>{{ __('ویژگی') }}</span>
            </h5>
            <p> : {{ $attribute->name }}</p>
        </div>
        <hr>
        <div class="row">
            {{-- show name --}}
            <div class="col">
                <label for="name">{{ __('نام ویژگی') }}</label>
                <input type="text" disabled value="{{ $attribute->name }} " class="form-control" />
            </div>
            {{-- end brand name --}}

            {{-- created brand date --}}
            <div class="col">
                <label for="name">{{ __('تاریخ ایجاد') }}</label>
                <input type="text" disabled value="{{ verta($attribute->created_at)->format('l dS F | ساعت H:i') }} " class="form-control" />
            </div>

            {{-- updated brand date --}}
            <div class="col">
                <label for="name">{{ __('تاریخ ویرایش') }}</label>
                <input type="text" disabled value="{{ verta($attribute->updated_at)->format('l dS F | ساعت H:i') }} " class="form-control" />
            </div>

        </div>
        <div class="my-4">
            {{-- back button --}}
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
        </div>
    </div>
</div>

@endsection