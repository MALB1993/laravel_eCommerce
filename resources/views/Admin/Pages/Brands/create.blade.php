@extends('Admin\partials\master')
@section('title')
    {{ __('ایجاد برند جدید') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4">
            <h5 class="font-weight-bold">{{ __('ایجاد برند') }}</h5>
        </div>
        <hr>
        @include('Admin.sections.errors')
        <form action="{{ route('admin.brands.store') }}" method="post">
            @csrf
            <div class="row">
                {{-- brand name input --}}
                <div class="col">
                    <label for="name">{{ __('نام برند') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('نام برند را وارد کنید') }}" value="{{ old('name')}} " />
                </div>
                {{-- end brand name --}}
                {{-- select is active --}}
                <div class="col">
                    <label for="is_active">{{ __('وضعیت') }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select">
                        <option disabled selected>{{ __('وضعیت نمایش برند را مشخص کنید') }}</option>
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                {{-- end select is active --}}
            </div>
            {{-- button --}}
            <div class="my-4">
                <button class="btn btn-md btn-primary" type="submit">{{ __('ثبت برند') }}</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection