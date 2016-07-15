<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ trans('http.503.title') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            * {
                line-height: 1.2;
                margin: 0;
            }

            html {
                color: #fff;
                display: table;
                font-family: sans-serif;
                height: 100%;
                text-align: center;
                width: 100%;
            }

            body {
                background-image: url('/images/zenaf.jpg');
                background-size: cover;
                background-position: 50% 50%;
                display: table-cell;
                vertical-align: middle;
                margin: 2em auto;
                font-family: 'Lato';
            }

            h1 {
                color: #fff;
                font-size: 2em;
                font-weight: 400;
                text-transform: uppercase;
            }

            p {
                margin: 0 auto;
                width: 280px;
                text-transform: uppercase;
            }

            @media only screen and (max-width: 280px) {

                body, p {
                    width: 95%;
                }

                h1 {
                    font-size: 1.5em;
                    margin: 0 0 0.3em;
                }

            }
        </style>
    </head>
    <body>
        <img src="/images/goblinaf.png" />
        <h1>{{ trans('http.503.title') }}</h1>
    </body>
</html>
<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->
