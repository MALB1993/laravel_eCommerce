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
{{--                ({{ $tags->total() }})--}}
            </h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-fw fa-plus"></i>
                {{ __('ایجاد محصول') }}
            </a>
        </div>

    </div>
</div>

@endsection
