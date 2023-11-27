@extends('admin.layouts.master')

@section('title', __('create roles'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('roles') }}</h5>
            <a href="{{ route('admin-panel.roles.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index roles') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.roles.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    {{-- name --}}
                    <div class="form-group col-md-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- display_name --}}
                    <div class="form-group col-md-3">
                        <label for="display_name">{{ __('display name') }}</label>
                        <input type="text" name="display_name" id="display_name" class="form-control @error('display_name') is-invalid @enderror" value="{{ old('display_name') }}" dir="auto">
                        @error('display_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="defaultCheck-{{ $permission->id }}" name="{{ $permission->name }}">
                                            <label class="form-check-label mx-3" for="defaultCheck-{{ $permission->id }}">{{ $permission->display_name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>

                </div>

                {{-- buttons --}}
                <div class="btn-group" dir="ltr">

                    <a href="{{ url()->previous() }}" class="btn btn-dark">
                        {{ __('Go back') }}
                    </a>

                    <button type="submit" class="btn btn-md btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>

    </div>


@endsection