<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cryptocurrency</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div>

            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" align="ceneter">
                <div class="title m-b-md">
                    Cryptocurrency News
                </div>
                <div class="container">
                <h2>Crypto Markets (bx.in.th)</h2>
                    <p>Call get data by Rest API from https://bx.in.th/api</p>
                    <table class="table table-striped" align="ceneter">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Currency Exchange</th>
                            <th>Change</th>
                            <th>Last Price</th>
                            <th>Volume 24hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $index=1 ?>
                        @foreach($bx_markets as $row)
                        <tr>
                            <td>{{$index}}</td>
                            <td>{{$row['primary_currency']}} / {{$row['secondary_currency']}}</td>
                            <td>{{$row['change']}}</td>
                            <td>{{$row['last_price']}}</td>
                            <td>{{$row['volume_24hours']}}</td>
                        </tr>
                        <?php $index++; ?>
                        @endforeach
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </body>
</html>
