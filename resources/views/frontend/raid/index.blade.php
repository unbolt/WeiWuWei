@extends('frontend.layouts.master')

@section('title')
    Raids - {{ app_name() }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Upcoming Raids</h2>

            @foreach ($upcoming_raids as $raid)
                <div class="row">
                    <div class="col-sm-12">
                        <a href="/raids/{{ $raid->id}}-{{ str_slug($raid->title, '-') }}">
                            <h3>
                                @if( $raid->hasResponded )
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                @endif
                                {{ $raid->title }} @ {{ $raid->location }}
                            </h3>
                            <h4 class="text-muted">
                                {{ $raid->date->format('l jS F') }}
                            </h4>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @include('frontend.raid.partials.bar', ['signPercent' => $raid->signPercent, 'tanks' => $raid->tankCount, 'healers' => $raid->healerCount, 'dps' => $raid->dpsCount])
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr />
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-md-4">
            <h2 class="text-muted">Past Raids</h2>

            @foreach ($past_raids as $raid)
                {{ $raid->title }}
            @endforeach
        </div>
    </div>
@endsection

@section('after-scripts-end')

@stop
