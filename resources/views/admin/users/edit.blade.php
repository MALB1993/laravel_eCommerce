@extends('admin.layouts.master')
@section('title', __('Users'))
@section('content')
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
        <h5 class="font-weight-bold">
            {{ __('Index users') }}
        </h5>
        <a href="{{ route('admin-panel.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-eye fa-sm text-white-50"></i>
            {{ __('create users') }}
        </a>
    </div>

    <div class="my-2 bg-white border shadow rounded p-4">
        <form action="{{ route('admin-panel.users.update',['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-3">
                    <label for="">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">{{ __('Email') }}</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">{{ __('Phone Number') }}</label>
                    <input type="text" name="cellphone" value="{{ $user->cellphone }}" class="form-control">
                </div>
                <div class="col-md-12 my-3">
                    <button class="btn btn-md btn-success">{{ __('Save') }}</button>
                </div>
            </div>

        </form>
    </div>


</div>
@endsection