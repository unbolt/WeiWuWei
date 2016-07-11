@extends('frontend.layouts.master')

@section('title')
    Roster - {{ app_name() }}
@endsection

@section('content')

    <section class="roster">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Tanks</h2>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            @foreach ($tanks->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $tank)
                        <div class="col-md-4">
                            @include ('frontend.user.partials.small', array('user' => $tank))
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Healers</h2>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            @foreach ($healers->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $healer)
                        <div class="col-md-4">
                            @include ('frontend.user.partials.small', array('user' => $healer))
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-md-12 text-center">
                <h2>DPS</h2>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            @foreach ($dps->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $dead)
                        <div class="col-md-4">
                            @include ('frontend.user.partials.small', array('user' => $dead))
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    </section>

@endsection

@section('after-scripts-end')

@stop
