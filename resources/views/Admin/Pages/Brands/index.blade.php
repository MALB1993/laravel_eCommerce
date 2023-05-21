@extends('Admin.partials.master')
@section('title', 'برندها')
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
                        <th scope="col">نام</th>
                        <th scope="col">اسلاگ</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">عملیات</th>
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
                                    <a class="btn btn-sm my-1 btn-info" href="#">{{ __('ویرایش') }}</a>
                                    <a class="btn btn-sm my-1 btn-danger" href="#">{{ __('حذف') }}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection