@extends('admin.layouts.master')

@section('title', __('Index products'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index products') }}
                {{-- <sup class="badge badge-success">{{ $products->total() }}</sup> --}}
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
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">

            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
