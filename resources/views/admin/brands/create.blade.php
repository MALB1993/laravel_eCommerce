@extends('admin.layouts.master')

@section('title', __('create brands'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('brands') }}</h5>
            <a href="{{ route('admin-panel.brands.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                {{ __('create brands') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.brands.store') }}" method="POST">
                @csrf
                @method('POST')
                {{-- name --}}
                <div class="form-group">
                    <label for="name">{{ __("Name") }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('Write your brand name') }}" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- is active option --}}
                <div class="form-group">
                    <label for="name">{{ __("Is active") }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select @error('is_active') is-invalid @enderror">
                        <option selected disabled>{{ __('Choose an option') }}</option>
                        <option value="1">{{ __('Enable') }}</option>
                        <option value="0">{{ __('Disable') }}</option>
                    </select>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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

@endsection
