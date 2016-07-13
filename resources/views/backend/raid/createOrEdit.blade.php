@extends('backend.layouts.master')

@section('page-header')
    <h1>
        @if(isset($raid))
            Modify Raid
        @else
            Create Raid
        @endif
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header with-border"></div>

        @if(isset($raid))
            {!! Form::model($raid, ['route' => ['admin.raid.update', $raid->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
        @else
            {!! Form::open(['route' => 'admin.raid.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
        @endif
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('title', 'Title', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('location', 'Location', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::selectLocation('location', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-4">
                    @if(isset($raid))
                        {!! Form::date('date', $raid->date->format('Y-m-d'), ['class' => 'form-control']) !!}
                    @else
                        {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>


            <div class="box box-info">
                <div class="box-body">
                    <div class="pull-left">
                        <a href="{{route('admin.access.users.index')}}" class="btn btn-danger btn-xs">{{ trans('buttons.general.cancel') }}</a>
                    </div>

                    <div class="pull-right">
                        <input type="submit" class="btn btn-success btn-xs" value="Save" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        {!! Form::close() !!}

    </div>
@endsection
