@extends('admin.layouts.master')

@section('title', __('Index comments'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">
                {{ __('Index comments') }}
                <sup class="badge badge-success">{{ $comments->total() }}</sup>
            </h5>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <table class="table table-responsive-lg table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Users') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Text') }}</th>
                        <th>{{ __('Is active') }}</th>
                        <th>{{ __('created_at') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($comments as $key => $comment)
                        <tr>
                            <td>{{ $comments->firstItem() + $key }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td> <a href="{{ route('admin-panel.products.show',['product' => $comment->product->slug ]) }}">{{ $comment->product->name }}</a></td>
                            <td>{{ Str::limit($comment->text, 40, '...') }}</td>
                            <td>
                                <p class="{{ $comment->getRawOriginal('approved') ? "text-success" : "text-danger" }}">
                                    {{ $comment->approved }}
                                </p>
                            </td>
                            <td>{{ Verta($comment->created_at) }}</td>
                            <td>
                                <!-- Example single danger button -->
                                <div class="btn-group" dir="ltr">
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin-panel.comments.edit', ['comment' => $comment->id]) }}">
                                        {{ __('Edit') }}
                                        <i class="fa fa-fw fa-pen"></i>
                                    </a>
                                    <a class="btn btn-sm btn-info" href="{{ route('admin-panel.comments.show',['comment' => $comment->id]) }}">
                                        {{ __('Show Content') }}
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div dir="ltr" class="col-md-12 d-flex justify-content-center">
                {{ $comments->links('pagination::bootstrap-4') }}
            </div>
        </div>


    </div>


@endsection

@section('javascript')

@endsection
