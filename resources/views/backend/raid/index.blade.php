@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>Raids</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">Raids</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            This is where the details on the next raid will be.

            <div>
                <br /><br />
                <a href="{{ route('admin.raid.create') }}" class="btn btn-primary">Add Raid</a>
            </div>
        </div>
    </div>
@endsection
