<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zeal API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Muli:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #1a1a1a;
                color: #fff;
                font-family: 'Muli', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            #logo {
                width: 150px;
            }

            .title {
                font-size: 80px;
                margin-bottom: 30px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <img id="logo" src="{{ asset('images/logo_color.png') }}" />
                <div class="title">API</div>
                <div class="links">
                    <a href="https://laravel.com/docs" target="_blank">Docs</a>
                    <a href="https://github.com/javi95z" target="_blank">GitHub</a>
                    <a href="https://linkedin.com/in/javier-monfort" target="_blank">LinkedIn</a>
                </div>
            </div>
        </div>
    </body>
</html>
