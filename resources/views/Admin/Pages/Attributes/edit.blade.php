@extends('Admin\partials\master')
@section('title')
    {{ __('ویرایش ویژگی جدید') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4">
            <h5 class="font-weight-bold">ایجاد ویژگی</h5>
        </div>
        <hr>
        @include('Admin.sections.errors')
        <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- brand name input --}}
                <div class="col">
                    <label for="name">{{ __('نام ویژگی') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('نام ویژگی را وارد کنید') }}" value="{{ $attribute->name }}" />
                </div>
                {{-- end brand name --}}
            </div>
            {{-- button --}}
            <div class="my-4">
                <button class="btn btn-md btn-primary" type="submit">{{ __('ویرایش ویژگی') }}</button>
                <a href="{{ route('admin.attributes.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection