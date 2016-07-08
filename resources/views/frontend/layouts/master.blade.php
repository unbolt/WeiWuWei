<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @yield('before-styles-end')
        {!! Html::style(elixir('css/frontend.css')) !!}
        @yield('after-styles-end')

        <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    </head>
    <body id="app-layout">

        @include('frontend.includes.nav')

        <section class="main-content">
            <div class="container">
                @include('includes.partials.messages')
                @yield('pre-content')
                @yield('content')
                @yield('post-content')
            </div>
        </section>

        @include('frontend.includes.footer')

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
        {!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}

        @yield('before-scripts-end')
        {!! Html::script(elixir('js/frontend.js')) !!}
        @yield('after-scripts-end')

        @include('includes.partials.ga')
    </body>
</html>
