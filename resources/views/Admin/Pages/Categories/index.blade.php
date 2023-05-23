@extends('Admin.partials.master')
@section('title')
    {{ __('دسته بندی ها') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4 d-flex justify-content-between">
            <h5 class="font-weight-bold">
                {{ __('دسته بندی ها') }}
                ({{ $categories->total() }})
            </h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                {{ __('ایجاد دسته بندی') }}
            </a>
        </div>
        <hr>
        <div>
            <table class="table table-bordered text-center table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('نام') }}</th>
                    <th scope="col">{{ __('نام انگلیسی') }}</th>
                    <th scope="col">{{ __('والد') }}</th>
                    <th scope="col">{{ __('وضعیت') }}</th>
                    <th scope="col">{{ __('عملیات') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <th scope="row">{{ $categories->firstItem() + $key }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        @if($category->parent_id === 0)
                            <td>{{ __('بدون والد') }}</td>
                            @else
                        <td>{{ $category->parent->name }}</td>
                        @endif
                        <td>
                            {{-- add color if active text green or deactive text danger --}}
                            <span class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                            {{ $category->is_active }}
                        </span>
                        </td>
                        <td>
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <button
                                    type="button"
                                    class="btn btn-light dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ __('عملیات') }}
                                </button>
                                <div class="dropdown-menu text-center p-3">
                                    <a class="dropdown-item d-flex justify-content-between text-success" href="{{ route('admin.categories.show', $category->id) }}">
                                        <i class="fa fw-fw fa-eye"></i>
                                        {{ __('جزئیات') }}
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between text-primary" href="{{ route('admin.categories.edit', $category->id) }}">
                                        <i class="fa fw-fw fa-pen"></i>
                                        {{ __('ویرایش') }}
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item d-flex justify-content-between text-danger">
                                            <i class="fa fw-fw fa-trash"></i>
                                            {{ __('حذف') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $categories->links('vendor\pagination\bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
