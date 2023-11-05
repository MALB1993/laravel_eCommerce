@extends('admin.layouts.master')

@section('title', __('Index products'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index products') }}
                <sup class="badge badge-success">{{ $products->total() }}</sup>
            </h5>
            <a href="{{ route('admin-panel.products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('create products') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Brand') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $key }}</td>
                            <td>
                                <a href="{{ route('admin-panel.products.show',['product' => $product->slug]) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin-panel.brands.show',['brand' => $product->brand->slug]) }}">
                                    {{ $product->brand->name }}
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('admin-panel.categories.show',['category' => $product->category->id]) }}">
                                    {{ $product->category->name }}
                                </a>
                            </td>
                            <td>{{ $product->is_active }}</td>
                            <td>{{ Verta($product->created_at) }}</td>
                            <td>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-dark" href="{{ route('admin-panel.products.edit',['product' => $product->slug]) }}">
                                            <i class="fa fa-fw fa-pen"></i>
                                            {{ __('Edit') }} {{ __('Products') }}
                                        </a>
                                        <a class="dropdown-item text-dark" href="{{ route('admin-panel.products.image.edit',['product' => $product->slug]) }}">
                                            <i class="fa fa-fw fa-pen"></i>
                                            {{ __('Edit') }} {{ __('Images') }}
                                        </a>
                                        <a class="dropdown-item text-dark" href="{{ route('admin-panel.products.category.edit',['product' => $product->slug]) }}">
                                            <i class="fa fa-fw fa-pen"></i>
                                            {{ __('Edit') }} {{ __('Attribute') }} - {{ __('Category') }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
