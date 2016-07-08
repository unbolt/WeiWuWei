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

            <div class="box-tools pull-right">
                @include('backend.news.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            News init.
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection