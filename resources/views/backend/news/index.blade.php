@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>News</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">News</h3>
        </div>

        <div class="box-body">
            <div>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Add News</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach($news as $article)
                        <tr>
                            <td> {{ $article->created_at }}</td>
                            <td> {{ $article->title }}</td>
                            <td>
                                <a href="{{ route('admin.news.edit', $article->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                                <a href="{{ route('admin.news.destroy', $article->id) }}"
                                     data-method="delete"
                                     data-trans-button-cancel="Cancel"
                                     data-trans-button-confirm="Delete News"
                                     data-trans-title="Are you sure?"
                                     class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
