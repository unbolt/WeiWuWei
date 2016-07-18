@extends('frontend.layouts.master')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.auth.login_box_title') }}</div>

                <div class="col-md-12">
                <h3>Important! Read this!</h3>

                <p>
                    If you had an account on the old forums, then it still exists - you just need to reset your password using the link below.
                    Do not make a new account! Contact me on <a href="http://twitter.com/_ritual">Twitter</a> or in-game and I can sort it out for you if you
                    get stuck! Note that hotmail email addresses seem to take their sweet time receiving mail.
                </p>
                <p>
                    I will be monitoring things for a couple of days and upgrading accounts to have members access as they are activated by resetting your passwords.
                    There is also a thread in the General forums you can post in to request access.
                </p>
            </div>

                <div class="panel-body">

                    {!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            {!! Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} {{ trans('labels.frontend.auth.remember_me') }}
                                    </label>
                                </div>
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) !!}

                                {!! link_to('password/reset', trans('labels.frontend.passwords.forgot_password')) !!}
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                    {!! Form::close() !!}

                    <div class="row text-center">
                        {!! $socialite_links !!}
                    </div>
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->

@endsection
