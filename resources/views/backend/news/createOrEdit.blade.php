@extends('backend.layouts.master')

@section('page-header')
    <h1>
        @if(isset($raid))
            Modify News
        @else
            Create News
        @endif
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header with-border"></div>

        <div class="box-body">
            @if(isset($news))
                {!! Form::model($news, ['route' => ['admin.news.update', $news->id], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => 'admin.news.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) !!}
            @endif
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('title', 'Title', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-4">
                        @if(isset($news))
                            {!! Form::date('created_at', $news->created_at->format('Y-m-d'), ['class' => 'form-control']) !!}
                        @else
                            {!! Form::date('created_at', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('image', 'Image', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>


                <div class="box box-info">
                    <div class="box-body">
                        <div class="pull-left">
                            <a href="{{route('admin.news.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
                        </div>

                        <div class="pull-right">
                            <input type="submit" class="btn btn-success btn-xs" value="Save" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
