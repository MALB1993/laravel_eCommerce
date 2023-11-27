@extends('admin.layouts.master')

@section('title', __('show brands'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('brands') }}</h5>
            <a href="{{ route('admin-panel.brands.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index brands') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.brands.update',['brand' => $brand->slug]) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- name --}}
                <div class="form-group">
                    <label for="name">{{ __("Name") }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('Write your brand name') }}" class="form-control @error('name') is-invalid @enderror" value="{{ $brand->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- is active option --}}
                <div class="form-group">
                    <label for="name">{{ __("Is active") }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select @error('is_active') is-invalid @enderror">
                        <option selected disabled>{{ __('Choose an option') }}</option>
                        <option value="1" {{ $brand->getRawOriginal('is_active') == 1 ? 'selected' : '' }} >{{ __('Enable') }}</option>
                        <option value="0" {{ $brand->getRawOriginal('is_active') == 0 ? 'selected' : '' }} >{{ __('Disable') }}</option>
                    </select>
                    @error('is_active')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- buttons --}}

                <div class="btn-group" dir="ltr">

                    <a href="{{ url()->previous() }}" class="btn btn-dark">
                        {{ __('Go back') }}
                    </a>

                    <button type="submit" class="btn btn-md btn-primary">
                        {{ __('Edit') }}
                    </button>
                </div>

            </form>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
