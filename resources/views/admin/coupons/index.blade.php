@extends('admin.layouts.master')

@section('title', __('Index coupons'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('index coupons') }}
                <sup class="badge badge-success">{{ $coupons->total() }}</sup>
            </h5>
            <a href="{{ route('admin-panel.coupons.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('create coupon') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Percentage') }}</th>
                        <th>{{ __('max_percentage_amount') }}</th>
                        <th>{{ __('expired_at') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($coupons as $key => $coupon)
                        <tr>
                            <td>{{ $coupons->firstItem() + $key }}</td>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>{{ number_format($coupon->amount) }}</td>
                            <td>%{{ $coupon->percentage }}</td>
                            <td>{{ number_format($coupon->max_percentage_amount) }}</td>
                            <td>{{ Verta($coupon->expired_at) }}</td>
                            <td>{{ $coupon->description }}</td>
                            <td>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <form action="{{ route('admin-panel.coupons.destroy',['coupon' => $coupon->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn text-danger">
                                            <i class="fa fa-fw fa-trash"></i>
                                            {{ __("Delete") }}
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $coupons->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
