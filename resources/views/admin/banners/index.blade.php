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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($banners as $key => $tag)
                        <tr>
                            <td>{{ $banners->firstItem() + $key }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ Verta($tag->created_at) }}</td>

                            <td>
                                <a href="{{ route('admin-panel.banners.edit',['tag' => $tag->id]) }}">
                                    <i class="fa fa-fw fa-pen-nib"></i>
                                </a>
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
