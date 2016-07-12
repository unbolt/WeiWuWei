@extends('frontend.emails.master')

@section('content')

    <h1><em>Password, Password! Wherefore art thou Password?</em> - Juliet, Act 2, Scene 2</h1>

    <p>
        It's probably under the cat.
    </p>
    <p>
        Failing that, press the button below to
        just make up a new one. Maybe put it on a postit or something this time, yeah?
    </p>

    <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
          <a href="{{ url('password/reset/'.$token) }}">Reset me!</a>
        </td>
      </tr>
    </table>

    <p>
        If you have any major issues then just <a href="http://twitter.com/_ritual">tweet me</a>.
    </p>

    <p><em>I am well aware that the quote is actually asking why Romeo is Romeo. You don't marry an English teacher and get away with things like that.</em></p>
@stop
