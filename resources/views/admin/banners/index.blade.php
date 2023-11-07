@extends('admin.layouts.master')

@section('title', __('Index banners'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index banners') }}
                <sup class="badge badge-success">{{ $banners->total() }}</sup>
            </h5>
            <a href="{{ route('admin-panel.banners.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('create banners') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Images') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($banners as $key => $banner)
                        <tr>
                            <td>{{ $banners->firstItem() + $key }}</td>
                            <td>
                                <img src="{{ asset(env('IMAGE_UPLOAD_PATH').'/banners/'.$banner->image) }}" alt="" class="img-fluid img-thumbnail" width="100" height="100">
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->type }}</td>
                            <td>{{ $banner->is_active }}</td>
                            <td>{{ Verta($banner->created_at) }}</td>

                            <td>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-primary" href="{{ route('admin-panel.banners.edit', ['banner' => $banner->id]) }}">
                                            <i class="fa fa-fw fa-pen"></i>
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="dropdown-item text-info" href="{{ route('admin-panel.banners.show',['banner' => $banner->id]) }}">
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
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $banners->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
