@extends('admin.layouts.master')

@section('title', __('Index comments'))

@section('content')
    <div class="col-md-12">
        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Users') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Rate') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('created_at') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td> <a href="{{ route('admin-panel.products.show',['product' => $comment->product->slug ]) }}">{{ $comment->product->name }}</a></td>
                        <td>{{ $rate->rate }}</td>
                        <td>
                            <p class="{{ $comment->getRawOriginal('approved') ? "text-success" : "text-danger" }}">
                                {{ $comment->approved }}
                            </p>
                        </td>
                        <td>{{ Verta($comment->created_at) }}</td>
                    </tr>
                </tbody>
                <tfoot class='text-right'>
                    <tr>
                        <td colspan="6"> {{ __('Comments') }} :  {{ $comment->text }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
