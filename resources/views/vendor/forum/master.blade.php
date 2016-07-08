@extends('frontend.layouts.master')

@section('title')
    @if (isset($thread))
        {{ $thread->title }} -
    @endif
    @if (isset($category))
        {{ $category->title }} -
    @endif
    {{ app_name() }}
@endsection

@section('pre-content')
    @include ('forum::partials.breadcrumbs')
    @include ('forum::partials.alerts')
@endsection

@section('post-content')
    @yield('footer')
@endsection

@section('after-scripts-end')
@endsection
