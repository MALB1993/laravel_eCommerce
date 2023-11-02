@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('categories') }}</h5>
            <a href="{{ route('admin-panel.categories.index') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index categories') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">

            {{-- categories --}}
            <div class="row">

                {{-- name --}}
                <div class="form-group col-md-3">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('Write your brand name') }}" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror" @disabled(true)>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- slug --}}
                <div class="form-group col-md-3">
                    <label for="slug">{{ __('Slug') }}</label>
                    <input type="text" name="slug" id="slug"
                        placeholder="{{ __('Write your category slug') }}" value="{{ $category->slug }}" class="form-control @error('slug') is-invalid @enderror" @disabled(true)>
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- parent's --}}
                <div class="form-group col-md-3">
                    <label for="parent_id">{{ __('Is active') }}</label>
                    <div class="form-control div-disabled">
                        @if ($category->parent_id === 0)
                            {{ $category->name }}
                        @else
                            {{ $category->parent->name }}
                        @endif
                    </div>
                </div>

                {{-- is active option --}}
                <div class="form-group col-md-3">
                    <label for="name">{{ __('Is active') }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select @error('is_active') is-invalid @enderror" @disabled(true)>
                        <option value="1" {{ $category->getRawOriginal('is_active') == 1 ? 'selected' : '' }} >{{ __('Enable') }}</option>
                        <option value="0" {{ $category->getRawOriginal('is_active') == 0 ? 'selected' : '' }} >{{ __('Disable') }}</option>
                    </select>
                    @error('is_active')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- icon --}}
                <div class="form-group col-md-3">
                    <label for="icon">{{ __('Icon') }}</label>
                    <input type="text" name="icon" id="icon"
                        placeholder="{{ __('Write your category icon') }}" value="{{ $category->icon }}" class="form-control @error('icon') is-invalid @enderror" @disabled(true) dir="auto">
                    @error('icon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- created_at --}}
                <div class="form-group col-md-3">
                    <label for="created_at">{{ __('created_at') }}</label>
                    <input type="text" name="created_at" id="created_at"
                        placeholder="{{ __('Write your category created_at') }}" value="{{ $category->created_at }}" class="form-control @error('created_at') is-invalid @enderror" @disabled(true) dir="auto">
                    @error('created_at')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- description --}}
                <div class="col-md-12">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Write Description') }}" @disabled(true)>{{ $category->description }}</textarea>
                </div>

            </div>
            <hr>
            {{-- attribute category --}}
            <div class="row my-2">

                {{-- attribute --}}
                <div class="col-md-3">
                    <label for="attribute">{{ __('Attribute') }}</label>
                    <div class="div-disabled form-control">
                        @foreach ($category->attributes as $attribute)
                            {{ $attribute->name }}
                            @if(!$loop->last)
                                |
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- attribute filters --}}
                <div class="col-md-3">
                    <label for="attribute">{{ __('Attributes is filter') }}</label>
                    <div class="div-disabled form-control">
                        @foreach ($category->attributes()->wherePivot('is_filter',1)->get() as $attribute)
                            {{ $attribute->name }}
                            @if(!$loop->last)
                                |
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- attribute variation --}}
                <div class="col-md-3">
                    <label for="attribute">{{ __('Variation') }}</label>
                    <div class="div-disabled form-control">
                        @foreach ($category->attributes()->wherePivot('is_variation',1)->get() as $attribute)
                            {{ $attribute->name }}
                            @if(!$loop->last)
                                |
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- buttons --}}
            <div class="btn-group my-2" dir="ltr">

                <a href="{{ url()->previous() }}" class="btn btn-dark">
                    {{ __('Go back') }}
                </a>

            </div>

        </div>
    </div>

@endsection
