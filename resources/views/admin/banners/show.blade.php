@extends('admin.layouts.master')

@section('title', __('show banners'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('banners') }}</h5>
            <a href="{{ route('admin-panel.banners.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index banners') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <div class="row">

                {{-- title --}}
                <div class="form-group col-md-3">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $banner->title }}" @disabled(true)>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- priority --}}
                <div class="form-group col-md-3">
                    <label for="priority">{{ __('Priority') }}</label>
                    <input type="text" name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror" value="{{ $banner->priority }}" dir="auto" @disabled(true)>
                    @error('priority')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- is active option --}}
                <div class="form-group col-md-3">
                    <label for="is_active">{{ __("Is active") }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select @error('is_active') is-invalid @enderror" @disabled(true)>
                        <option selected disabled>{{ __('Choose an option') }}</option>
                        <option value="1" {{ $banner->getRawOriginal('is_active') == 1 ? 'selected' : '' }} >{{ __('Enable') }}</option>
                        <option value="0" {{ $banner->getRawOriginal('is_active') == 0 ? 'selected' : '' }} >{{ __('Disable') }}</option>
                    </select>
                    @error('is_active')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- type --}}
                <div class="form-group col-md-3">
                    <label for="type">{{ __('Type') }}</label>
                    <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ $banner->type }}" dir="auto" @disabled(true)>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- button_text --}}
                <div class="form-group col-md-3">
                    <label for="button_text">{{ __('button text') }}</label>
                    <input type="text" name="button_text" id="button_text" class="form-control @error('button_text') is-invalid @enderror" value="{{ $banner->button_text }}" @disabled(true)>
                    @error('button_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- button_link --}}
                <div class="form-group col-md-6">
                    <label for="button_link">{{ __('button link') }}</label>
                    <input type="text" name="button_link" id="button_link" class="form-control @error('button_link') is-invalid @enderror" value="{{ $banner->button_link }}" dir="auto" @disabled(true)>
                    @error('button_link')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- button_icon --}}
                <div class="form-group col-md-3">
                    <label for="button_icon">{{ __('button icon') }}</label>
                    <input type="text" name="button_icon" id="button_icon" class="form-control @error('button_icon') is-invalid @enderror" value="{{ $banner->button_icon }}" dir="auto" @disabled(true)>
                    @error('button_icon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- text --}}
                <div class="form-group col-md-12">
                    <label for="text">{{ __('Description') }}</label>
                    <textarea name="text" id="text" cols="30" rows="3" class="form-control @error('text') is-invalid @enderror" placeholder="{{ __('Write Description') }}" @disabled(true)>{{ $banner->text }}</textarea>
                    @error('text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>  

                <div class="form-group col-md-12 my-2">
                    <hr />
                    <img src="{{ asset(env('IMAGE_UPLOAD_PATH').'banners/'.$banner->image) }}" alt="{{ $banner->title }}" class="img-fluid" width="300" height="300" />
                </div>

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
