@extends('admin.layouts.master')

@section('title', __('create coupons'))

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('admin/vendor/MD.BootstrapPersianDateTimePicker-master-bs4/dist/jquery.md.bootstrap.datetimepicker.style.css') }}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('Coupon') }}</h5>
            <a href="{{ route('admin-panel.coupons.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('index coupons') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.coupons.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    {{-- name --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">{{ __("Name") }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('Coupon name') }}" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- code --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="code">{{ __("Coupon Code") }}</label>
                            <input type="text" name="code" id="code" placeholder="{{ __('Coupon Code') }}" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror">
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- type --}}
                    <div class="form-group col-md-3">
                        <label for="type">{{ __('Type') }}</label>
                        <select name="type" id="type" class="form-control form-select @error('type') is-invalid @enderror">
                            <option value="amount">{{ __('Amount') }}</option>
                            <option value="percentage">{{ __('Percentage') }}</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- amount --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="amount">{{ __("Amount") }}</label>
                            <input type="text" name="amount" id="amount" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- percentage --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="percentage">{{ __("Percentage") }}</label>
                            <input type="text" name="percentage" id="percentage" placeholder="{{ __('Percentage') }}" value="{{ old('percentage') }}" class="form-control @error('percentage') is-invalid @enderror">
                            @error('percentage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- max_percentage_amount --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="max_percentage_amount">{{ __("Max Percentage Amount") }}</label>
                            <input type="text" name="max_percentage_amount" id="max_percentage_amount" placeholder="{{ __('Max Percentage Amount') }}" value="{{ old('max_percentage_amount') }}" class="form-control @error('max_percentage_amount') is-invalid @enderror">
                            @error('max_percentage_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- expired_at --}}
                    <div class="form-group col-md-3">
                        <label for="expired_at">{{ __('expired_at') }}</label>
                        <input type="text" value="" name="expired_at" id="expired_at" class="form-control"  dir="auto">
                    </div>

                    {{-- description --}}
                    <div class="form-group col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Write Description') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
    <script src="{{ asset('/admin/vendor/MD.BootstrapPersianDateTimePicker-master-bs4/dist/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        // type
        $('#type').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: "{{ __('Searching') }}",
            multipleSeparator: " | ",
            title: "{{ __('Please select at least one attribute.') }}"
        });

        $("#expired_at").MdPersianDateTimePicker({
            targetTextSelector: "#expired_at",
            englishNumber : true,
            textFormat : "yyyy-MM-dd HH:mm:ss",
            modalMode : true,
            trigger : 'click',
            enableTimePicker : true
        });

    </script>
@endsection
