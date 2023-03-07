<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaraPicture</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap');

        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Titillium Web', sans-serif;
            font-weight: 100;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 50px;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .design1 {
            width: 600px;
            height: 600px;
            margin-left: 30px;
        }

        .reference {
            top: 40rem;
            right: 20%;
            width: 140px;
            height: auto;
            position: absolute
        }

        @media screen and (min-width: 400px) and (max-width: 640px) {
            .title {
                font-size: 40px;
                padding-top: 100px;
            }

            .subtitle{
                font-size: 10px;
            }   

            .m-b-md {
                margin-bottom: 30px;
            }

            .design1 {
            width: 400px;
            height: 400px;
            margin-left: 0;
            }

            .reference {
            top: 42rem;
            right: 20%;
            width: 140px;
            height: auto;
            position: absolute
            }
        }

        @media screen and (min-width: 640px) and (max-width: 1200px) {
            .reference {
            top: 52rem;
            right: 20%;
            width: 140px;
            height: auto;
            position: absolute
            }
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Ingresar</a>
            <a href="{{ route('register') }}">Registrarse</a>
            @endauth
        </div>
        @endif
        <div class="content">
            <div class="title m-b-md">
                LaraPictures
            </div>

            <div class="subtitle">
                <h1>Ejemplo de aplicación hecha con Laravel</h1>
            </div>
        </div>
        <div>
            <img class="design1" src="{{asset('img/design1.jpg')}}">
            <a href="http://www.freepik.com" target="blank">
                <img class="reference" src="{{asset('img/reference.jpg')}}">
            </a>
        </div>
    </div>
</body>

</html>