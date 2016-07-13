@extends('frontend.emails.master')

@section('content')

    <h1><em>Sanka, Ya Dead?</em></h1>

    <p>
        <em>Yeah mon!</em>
    </p>

    <p>
        Spam is pretty lame so people have to confirm their accounts. If you're receiving this, you probably need to do that.
    </p>


    <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
          <a href="{{ url('account/confirm/' . $token) }}">I solemnly swear that I am up to no good.</a>
        </td>
      </tr>
    </table>

    <p>
        If you have any major issues then just <a href="http://twitter.com/_ritual">tweet me</a> and I'll do it manually for you.
    </p>

    <p><em>Sanka is a Jamaican, not a troll. By confirming your account you hereby agree to go watch Cool Runnings before logging into Warcraft again.</em></p>
@stop
