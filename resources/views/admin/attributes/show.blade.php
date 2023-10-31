@extends('admin.layouts.master')

@section('title', __('show attributes'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('Attributes') }}</h5>
            <a href="{{ route('admin-panel.attributes.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index attributes') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            {{-- name --}}
            <div class="form-group">
                <label for="name">{{ __("Name") }}</label>
                <input type="text" name="name" id="name" placeholder="{{ __('Write your attribute name') }}" class="form-control @error('name') is-invalid @enderror" value="{{ $attribute->name }}" @disabled(true)>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            {{-- name --}}
            <div class="form-group">
                <label for="name">{{ __("created_at") }}</label>
                <input type="text" name="name" id="name" placeholder="{{ __('Write your attribute name') }}" class="form-control @error('name') is-invalid @enderror" value="{{ Verta($attribute->created_at) }}" @disabled(true) dir="auto">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- buttons --}}
            <div class="btn-group" dir="ltr">
                <a href="{{ url()->previous() }}" class="btn btn-dark">
                    {{ __('Go back') }}
                </a>
            </div>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
