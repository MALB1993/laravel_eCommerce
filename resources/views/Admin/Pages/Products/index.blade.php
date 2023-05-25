@extends('Admin.partials.master')
@section('title')
    {{ __('محصولات ها') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4 d-flex justify-content-between">
            <h5 class="font-weight-bold">
                {{ __('محصولات ها') }}
                ({{ $products->total() }})
            </h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                {{ __('ایجاد محصول') }}
            </a>
        </div>
        <div>
            <table class="table table-bordered text-center table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('نام') }}</th>
                    <th scope="col">{{ __('تصویر شاخص') }}</th>
                    <th scope="col">{{ __('نام برند') }}</th>
                    <th scope="col">{{ __('نام دسته') }}</th>
                    <th scope="col">{{ __('وضعیت') }}</th>
                    <th scope="col">{{ __('عملیات') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <th scope="row">{{ $products->firstItem() + $key }}</th>
                        <td>
                            <a href="{{ route('admin.products.show',['product' => $product->id]) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            <img src="{{ asset('/upload/product/files/images'.'/'.$product->primary_image ) }}" alt="" width="100" height="100" class="rounded border border-dark">
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show',['product' => $product->id]) }}">
                                {{ $product->brand->name }}
                            </a>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            {{-- add color if active text green or deactive text danger --}}
                            <span class="{{ $product->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                            {{ $product->is_active }}
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
                                    <a class="dropdown-item d-flex justify-content-between text-success" href="{{ route('admin.products.show', ['product' => $product->id]) }}">
                                        <i class="fa fw-fw fa-eye"></i>
                                        {{ __('جزئیات') }}
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between text-primary" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                        <i class="fa fw-fw fa-pen"></i>
                                        {{ __('ویرایش') }}
                                    </a>
                                    <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
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
            {{ $products->links('vendor\pagination\bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
