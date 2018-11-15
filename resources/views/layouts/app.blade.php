<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>novelschool</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core-style.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/poppins.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/shadow-into-light.css') }}" rel="stylesheet">
</head>
    <body>
        <!-- Preloader Start--> 
        <!--<div id="preloader">
            <div class="classy-load"></div>
        </div>-->
            
        <!-- ***** Header Area Start ***** -->
        <header class="header_area">
            <div class="main_header_area animated">
                <div class="container">
                    <nav id="navigation1" class="navigation">
                        <!-- Logo Area -->
                        <div class="nav-header">
                            <a class="nav-brand" href="{{ url('/') }}">Novel School.</a>
                            <div class="nav-toggle"></div>
                        </div>
                        <!-- Main Menus Wrapper -->
                        <div class="nav-menus-wrapper">
                            
                            <ul class="nav-menu align-to-right" id="nav">
                                @guest
                                    <a class="nav-button btn-pill bg-mat-green align-to-right" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                    @if (Route::has('register'))
                                        <a class="nav-button btn-pill bg-mat-green align-to-right" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                    @endif
                                    <li class="active"><a href="#home">Inicio</a></li>
                                    <li><a href="#feature">Nosotros</a></li>
                                    <li><a href="#screenshot">Galeria</a></li>
                                    <li><a href="#price">Pago Online</a></li>
                                    <li><a href="#contact">Contactanos</a></li>
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->email }} <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ url('home') }}">
                                                    {{ __('home') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Cerrar') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        <li>
                                @endguest
                            </ul>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </header>
            <!-- ***** Header Area End ***** -->

        <main class="py-4">
        @yield('content')
        </main>
    </body>
</html>
