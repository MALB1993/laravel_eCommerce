@extends('Admin\partials\master')
@section('title')
    {{ __('ایجاد تگ جدید') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4">
            <h5 class="font-weight-bold">{{ __('ایجاد تگ') }}</h5>
        </div>
        <hr>
        @include('Admin.sections.errors')
        <form action="{{ route('admin.tags.update', ['tag' => $tag->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- brand name input --}}
                <div class="col">
                    <label for="name">{{ __('نام تگ') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('نام تگ را وارد کنید') }}" value="{{ $tag->name }} " />
                </div>
                {{-- end brand name --}}
                {{-- select is active --}}
                <div class="col">
                    <label for="is_active">{{ __('وضعیت') }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select">
                        <option disabled selected>{{ __('وضعیت نمایش تگ را مشخص کنید') }}</option>
                        <option value="1" {{ $tag->getRawOriginal('is_active') ? 'selected' : '' }} >فعال</option>
                        <option value="0" {{ $tag->getRawOriginal('is_active') ? '' : 'selected' }} >غیرفعال</option>
                    </select>
                </div>
                {{-- end select is active --}}
            </div>
            {{-- button --}}
            <div class="my-4">
                <button class="btn btn-md btn-primary" type="submit">{{ __('ویرایش تگ') }}</button>
                <a href="{{ route('admin.tags.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection
