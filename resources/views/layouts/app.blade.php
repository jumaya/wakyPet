<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href=" https://code.jquery.com/ui/1.11.0/themes/redmond/jquery-ui.css" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/css/AdminLTE.min.css">          
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <div id="app">

        <div class="navbar navbar-primary">
            <div class="container-fluid">
                <div class="nav navbar-nav navbar-left">

                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mascota') }}">
                            <i class="fa fa fa-paw"></i>
                            Registra tu mascota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plan') }}">
                            <i class="fa fa fa-list-alt"></i>
                            Planes </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programacion') }}">
                            <i class="fa fa fa-male"></i>
                            Programa tu paseo </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa fa-home"></i>
                            Inicio </a>
                    </li>
                    @else
                    <a class="navbar-brand" href="/">Wykipet</a>
                    @endauth
                </div>



                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa fa fa-sign-in"> </i>
                            Ingresar</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fa fa fa-user-plus"> </i>
                            Registrarse</a>
                    </li>
                    @endif
                    @else

                    <li class="nav-item">

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa fa-sign-out"> </i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>

            </div>
        </div>

        @yield('content')

        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script src='http://code.jquery.com/ui/1.11.0/jquery-ui.js'></script>

        <script src="{{asset('js/material.min.js')}}"></script>
        <script src="{{asset('js/ripples.js')}}"></script>

        <script>
            $(document).ready(function() {
                $(function() {
                    $.material.init();
                });
            });
        </script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>               
        
        @yield('js')

    </div>
</body>

</html>