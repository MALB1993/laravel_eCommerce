@extends('admin.layouts.master')

@section('title', __('show tag'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('Tag') }}</h5>
            <a href="{{ route('admin-panel.tags.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index tags') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.tags.update',['tag' => $tag->id]) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- name --}}
                <div class="form-group">
                    <label for="name">{{ __("Name") }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('Write your tag name') }}" class="form-control @error('name') is-invalid @enderror" value="{{ $tag->name }}">
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
                        {{ __('Edit') }}
                    </button>
                </div>

            </form>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
