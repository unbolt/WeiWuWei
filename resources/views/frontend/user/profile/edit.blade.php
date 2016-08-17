@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.user.profile.update_information') }}</div>

                <div class="panel-body">

                    {!! Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                        <div class="form-group">
                            {!! Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]) !!}
                            </div>
                        </div>

                        @if ($user->canChangeEmail())
                            <div class="form-group">
                                {!! Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                {!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::input('tag', 'tag', null, ['class' => 'form-control', 'placeholder' => 'Tag']) !!}
                                <div class="text-muted">Appears below your character name.</div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-4 text-right">
                                {!! Form::label('signature', 'Signature', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::input('signature', 'signature', null, ['class' => 'form-control', 'placeholder' => 'Signature']) !!}
                                <div class="text-muted">Markdown accepted.</div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('twitter', 'twitter', null, ['class' => 'form-control', 'placeholder' => 'Twitter']) !!}
                                <div class="text-muted">http://twitter.com/{{ $user->twitter }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('twitch', 'Twitch', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('twitch', 'twitch', null, ['class' => 'form-control', 'placeholder' => 'Twitch']) !!}
                                <div class="text-muted">http://twitch.tv/{{ $user->twitch }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('youtube', 'YouTube', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('youtube', 'youtube', null, ['class' => 'form-control', 'placeholder' => 'YouTube']) !!}
                                <div class="text-muted">http://youtube.com/{{ $user->youtube }}</div>
                            </div>
                        </div>



                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <hr />
                                    <h3>Character Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::input('character_name', 'character_name', null, ['class' => 'form-control', 'placeholder' => 'Character Name']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::selectServer('character_server', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="character_validation"></div>
                                </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('role', 'Role', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::selectRole('character_role', null, ['class' => 'form-control']) !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <hr />
                                <p>Press save, or forever hold your peace / do it all again.</p>
                                {!! Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection
