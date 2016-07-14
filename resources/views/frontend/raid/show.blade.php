@extends('frontend.layouts.master')

@section('title')
    {{ $raid->title }} - Raids - {{ app_name() }}
@endsection

@section('content')

    <ol class="breadcrumb">
        <li><a href="/raids">Raids</a></li>
        <li>{{ $raid->date->format('l jS') }} - {{ $raid->title }}</a></li>
    </ol>


    <div class="row">
        <div class="col-md-8">
            <h2>{{ $raid->title }} <span class="text-muted">{{ $raid->date->format('l jS') }}</span></h2>
            <h2>{{ $raid->location }}</h2>

            {!! Markdown::parse($raid->description) !!}

            @if($raid->logId)
                <h3>Raid Results <small><a href="https://www.warcraftlogs.com/reports/{{ $raid->logId }}">Full Log</a></small></h3>

                @foreach($raid->log->fights as $fight)
                    @if($fight->boss != 0)
                        <h5 class="@if($fight->kill) boss-kill @else boss-wipe @endif">
                            <a href="https://www.warcraftlogs.com/reports/{{ $raid->logId }}#type=summary&fight={{ $fight->id }}">
                                {{ $fight->name }}
                                @if($fight->kill)
                                    <span class="text-muted">Kill</span>
                                @else
                                    <span class="text-muted">{{ round($fight->bossPercentage / 100) }}%</span>
                                @endif
                            </a>
                        </h5>
                    @endif
                @endforeach
            @endif

            <hr />

            <h3>Attendance <span class="text-muted">{{ $raid->totalSigns }}</span></h3>

            @include('frontend.raid.partials.bar', ['signPercent' => $raid->signPercent, 'tanks' => $raid->tankCount, 'healers' => $raid->healerCount, 'dps' => $raid->dpsCount])

            <h4>Signs</h4>

            @include('frontend.raid.partials.groups', ['groups' => $raid->usersAttending])

            <h4>Unavailable</h4>

            @include('frontend.raid.partials.groups', ['groups' => $raid->usersNotAttending])

            <h4 class="text-muted">Pending Response</h4>

            <div class="pending-response">
                @foreach ($raid->usersNotResponded as $user)
                    @include('frontend.user.partials.username', ['author' => $user])
                @endforeach
            </div>

            <hr />

            <h3>Comments</h3>

            @if( $raid->comments()->count() > 0)
                @foreach($raid->comments as $comment)
                    @include('frontend.comments.comment', ['comment' => $comment])
                @endforeach
            @endif

            <div id="quick-reply">
                <form method="POST" action="/raids/{{ $raid->id }}/comments">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <textarea name="body" class="form-control">{{ old('body') }}</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success pull-right">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">

            @if($raid->signsOpen)
                <h2 class="text-muted">Closing in {{ $raid->date->subHours(10)->diffForhumans(null, true) }}</h2>
                <a class="btn btn-block btn-success" href="/raids/sign/{{ $raid-> id }}/1">Sign</a>
            @else
                <h2 class="text-muted">Sign Ups Closed</h2>
            @endif
            @if($raid->raidStarted)
                <a class="btn btn-block btn-danger" href="/raids/sign/{{ $raid-> id }}/0">Not Available</a>
            @endif

            @role('Officer')
                <h3>Invite Macro</h3>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach ($raid->usersAttending as $role => $users)
                            @foreach ($users as $user)
                                {{ $user->inviteMacro }}<br />
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection

@section('after-scripts-end')

@stop
