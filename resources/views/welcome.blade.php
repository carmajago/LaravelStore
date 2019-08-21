<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/81846e935b.js"></script>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
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

    <div class="row" style="
    margin-right: 0px;
">

        <div class="col-2 sidebar">
            <img src="/images/logoHeader.png" class="img-fluid" style="padding: 20px">
            <ul>
                <li> <a href="{{ route('home') }}">Inicio </a></li>
                <li> <a href="{{ route('users.index') }}"> Usuarios</a></li>
                <li> <a href="{{ route('products.index') }}"> Productos</a></li>
                <li> <a href="{{ route('lowProducts.index') }}"> Productos de baja</a></li>
                <li> <a href="{{ route('providers.index') }}"> Provedores</a></li>
                <li> <a href="{{ route('clients.index') }}"> Clientes</a></li>
                <li> <a href="{{ route('sales.index') }}"> Ventas</a></li>
            </ul>
            <div class="dropdown" style="  position: absolute;
            bottom: 0;
            margin: 25px;
            left: 0;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    {{ auth()->user()->name }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        Cerrar sesión
                    </a>
                    <a class="dropdown-item" href="#">Perfil</a>
                </div>
            </div>

        </div>
        <div class="col-10 main-content">

            @if (auth()->check())




            @else

            <!-- <a class="btn btn-success" href="">Iniciar sesión</a> -->

            @endif

            <div class="main-box">

                @yield('content')
            </div>

        </div>

    </div>







</body>


</html>