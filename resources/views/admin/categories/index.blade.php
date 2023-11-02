@extends('admin.layouts.master')

@section('title', __('Index categories'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index categories') }}
                <sup class="badge badge-success">{{ $categories->total() }}</sup>
            </h5>
            <a href="{{ route('admin-panel.categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('create categories') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Parent id') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $key }}</td>
                            <td class="text-right"><a href="{{ route('admin-panel.categories.show',['category' => $category->id]) }}" target="_blank" rel="noopener noreferrer">{{ $category->name }}</a></td>
                            <td class="text-left">{{ $category->slug }}</>
                            @if ($category->parent_id === 0)
                                <td>{{ $category->name }}</td>
                                @else
                                <td>{{ $category->parent->name }}</td>
                            @endif
                            <td>
                                <p class="{{ $category->getRawOriginal('is_active') ? "text-success" : "text-danger" }}">
                                    {{ $category->is_active }}
                                </p>
                            </td>
                            <td>{{ Verta($category->created_at) }}</td>
                            <td>
                                <a href="{{ route('admin-panel.categories.edit',['category' => $category->id]) }}">
                                    <i class="fa fa-fw fa-pen-nib"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
