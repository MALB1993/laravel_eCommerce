@extends('admin.layouts.master')
@section('title', __('Users'))
@section('content')
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
        <h5 class="font-weight-bold">
            {{ __('Index users') }}
            <sup class="badge badge-success">{{ $users->total() }}</sup>
        </h5>
        <a href="{{ route('admin-panel.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-eye fa-sm text-white-50"></i>
            {{ __('create users') }}
        </a>
    </div>

    <div class="my-2 bg-white border shadow rounded p-4">
        <table class="table table-responsive-lg table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Photo') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>اطلاعات تماس</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('created_at') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>
                            <img src="{{ $user->avatar === null ? asset('home/assets/img/logo/user.png') : asset('uploads/users/image/'.$user->avatar) }}" alt="" width="70" height="70" class="rounded-circle">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <p>{{ __('Phone Number') }} : {{ $user->cellphone === null ? __('Not Found') : $user->cellphone }}</p>
                            <p>{{ __('Email') }} : {{ $user->email}}</p>
                        </td>
                        <td class="{{ $user->getRawOriginal('status') ? 'text-success' : "text-danger" }}">{{ $user->status }}</td>
                        <td>{{ Verta($user->created_at) }}</td>

                        <td>
                            <a class="btn btn-md btn-success" href="{{ route('admin-panel.users.edit',['user' => $user->id]) }}">
                                <i class="fa fa-fw fa-pen-nib"></i>
                            </a>
                            <a class="btn btn-md btn-danger" href="{{ route('admin-panel.users.show',['user' => $user->id]) }}">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div dir="ltr" class="col-md-12 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>


</div>
@endsection