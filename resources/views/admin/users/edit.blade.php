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
                <div class="col-md-3">
                    <label for="inlineFormRoles">{{ __('Role') }}</label>
                    <select class="custom-select mr-sm-2" id="inlineFormRoles" name="role">
                      <option selected value="">{{ __('Please select at least one ability.') }}</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-12 my-2">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block  text-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ __('Permissions') }}
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="defaultCheck-{{ $permission->id }}" name="{{ $permission->name }}" {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label mx-3" for="defaultCheck-{{ $permission->id }}">{{ $permission->display_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-12 my-3">
                    <button class="btn btn-md btn-success">{{ __('Save') }}</button>
                </div>
            </div>

        </form>
    </div>


</div>
@endsection