@extends('admin.layouts.master')

@section('title', __('orders'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Orders') }}
                <sup class="badge badge-success">{{ $orders->total() }}</sup>
            </h5>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Paying status') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Paying type') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $orders->firstItem() + $key }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td class="{{ $order->getRawOriginal('status') ? 'text-success' : 'text-danger' }}">{{ $order->status }}</td>
                            <td>{{ number_format($order->paying_amount) }}</td>
                            <td>{{ $order->payment_type }}</td>
                            <td>{{ Verta($order->created_at) }}</td>

                            <td>
                                <a href="{{ route('admin-panel.orders.edit',['order' => $order->id]) }}" class="btn btn-md btn-success">
                                    <i class="fa fa-fw fa-pen-nib"></i>
                                </a>
                                <a href="{{ route('admin-panel.orders.show',['order' => $order->id]) }}" class="btn btn-md btn-primary">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
