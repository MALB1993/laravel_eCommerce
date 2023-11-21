@extends('home.layouts.master')
@section('title', __('Check out'))
@section('content')

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                    </li>
                    <li class="active">{{ __('Check out') }}</li>
                </ul>
            </div>
        </div>
    </div>


@endsection
