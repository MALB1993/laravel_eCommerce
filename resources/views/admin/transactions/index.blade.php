@extends('admin.layouts.master')

@section('title', __('transactions'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('transactions') }}
                <sup class="badge badge-success">{{ $transactions->total() }}</sup>
            </h5>
        </div>

        <div class="my-2 bg-white btransaction shadow rounded p-4">
            <table class="table table-responsive-lg table-btransactioned table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام کاربری</th>
                        <th>شماره سفارش</th>
                        <th>مبلغ</th>
                        <th>ref_id</th>
                        <th>درگاه پرداخت</th>
                        <th>وضعیت</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $transactions->firstItem() + $key }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->order_id }}</td>
                            <td>{{ number_format($transaction->amount) }}</td>
                            <td>{{ $transaction->ref_id }}</td>
                            <td>{{ $transaction->gateway_name }}</td>
                            <td class="{{ $transaction->getRawOriginal('status') ? 'text-success' : 'text-danger' }}">{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $transactions->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
