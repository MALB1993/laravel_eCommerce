@extends('Admin.partials.master')
@section('title')
    {{ __('برندها') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4 d-flex justify-content-between">
            <h5 class="font-weight-bold">
                {{ __('برندها') }}
                ({{ $brands->total() }})
            </h5>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                {{ __('ایجاد برند') }}
            </a>
        </div>
        <hr>
        <div>
            <table class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('نام') }}</th>
                        <th scope="col">{{ __('اسلاگ') }}</th>
                        <th scope="col">{{ __('وضعیت') }}</th>
                        <th scope="col">{{ __('عملیات') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $key => $brand)
                    <tr>
                        <th scope="row">{{ $brands->firstItem() + $key }}</th>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            {{-- add color if active text green or deactive text danger --}}
                            <span class="{{ $brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                {{ $brand->is_active }}
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
                                    <a class="dropdown-item d-flex justify-content-between text-success" href="{{ route('admin.brands.show', $brand->id) }}">
                                        <i class="fa fw-fw fa-eye"></i>
                                        {{ __('جزئیات') }}
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between text-primary" href="{{ route('admin.brands.edit', $brand->id) }}">
                                        <i class="fa fw-fw fa-pen"></i>
                                        {{ __('ویرایش') }}
                                    </a>
                                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
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
            {{ $brands->links('vendor\pagination\bootstrap-4') }}
        </div>
    </div>
</div>

@endsection