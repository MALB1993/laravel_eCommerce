@extends('admin.layouts.master')

@section('title', __('Index brands'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index brands') }}
                <sup class="badge badge-success">{{ $brands->total() }}</sup>
            </h5>
            <a href="{{ route('admin-panel.brands.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('create brands') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($brands as $key => $brand)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</>
                            <td>{{ Verta($brand->created_at) }}</td>
                            <td>{{ $brand->is_active }}</td>
                            <td>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-primary" href="{{ route('admin-panel.brands.edit', ['brand' => $brand->slug]) }}">
                                            <i class="fa fa-fw fa-pen"></i>
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="dropdown-item text-info" href="{{ route('admin-panel.brands.show',['brand' => $brand->slug]) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                            {{ __('Show Content') }}
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
