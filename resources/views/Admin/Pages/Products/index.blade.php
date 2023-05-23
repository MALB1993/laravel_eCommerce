@extends('Admin.partials.master')
@section('title')
    {{ __('تگ ها') }}
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4 d-flex justify-content-between">
            <h5 class="font-weight-bold">
                {{ __('تگ ها') }}
                ({{ $tags->total() }})
            </h5>
            <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                {{ __('ایجاد تگ') }}
            </a>
        </div>
        <hr>
        <div>
            <table class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('نام') }}</th>
                        <th scope="col">{{ __('وضعیت') }}</th>
                        <th scope="col">{{ __('عملیات') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key => $tag)
                    <tr>
                        <th scope="row">{{ $tags->firstItem() + $key }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>
                            {{-- add color if active text green or deactive text danger --}}
                            <span class="{{ $tag->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                {{ $tag->is_active }}
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
                                    <a class="dropdown-item d-flex justify-content-between text-success" href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}">
                                        <i class="fa fw-fw fa-eye"></i>
                                        {{ __('جزئیات') }}
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between text-primary" href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}">
                                        <i class="fa fw-fw fa-pen"></i>
                                        {{ __('ویرایش') }}
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}" method="POST">
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
            {{ $tags->links('vendor\pagination\bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
