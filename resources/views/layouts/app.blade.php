<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Library -->
    @yield('css')

    <style>
        body {
            background-color: #dfe0e0;
            background-image: url("{{ asset('assets/images/pengayoman.png') }}");
            background-size: inherit;
            background-position: inherit; /* Center the image */
            background-repeat: no-repeat;
        }

        a:hover {
            text-decoration: none;
        }

        .bg-utama {
            background-color: #9f1723;
        }

        .bg-accent {
            background-color: #d81728;
        }

        .navbar .dropdown-menu {
            background-color: #9f1723;
        }

        /* and this styles the dropdwon trigger link, when open */
        .navbar .dropdown.show a {
            background-color: #9f1723;
            color: #fff;
        }

        .bg-gray {
            background-color: #696969;
        }

        @media screen and (max-width: 767px) {
            .table-responsive > .table > tbody > tr > td, .table-responsive > .table > tbody > tr > th, .table-responsive > .table > tfoot > tr > td, .table-responsive > .table > tfoot > tr > th, .table-responsive > .table > thead > tr > td, .table-responsive > .table > thead > tr > th {
                white-space: nowrap;
            }
        }
    </style>
    @yield('css')
</head>
<body style="background-color: #dfe0e0;">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-utama">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/icon.png') }}" width="30" height="30" alt="">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @guest
                @else
                    @if(Auth::user()->is_admin)
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    User
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php $auth = Auth::user(); ?>
                                    @if($auth->is_admin and $auth->lapas_id == 0)
                                        <a class="dropdown-item" href="{{ route('user.index', ['jenis' => 'root']) }}">Root</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('user.index', ['jenis' => 'admin']) }}">Admin</a>
                                    <a class="dropdown-item" href="{{ route('user.index', ['jenis' => 'sipir']) }}">Aplikator</a>
                                </div>
                            </li>
                            @if($auth->is_admin and $auth->lapas_id == 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('lapas.index') }}">{{ __('Lapas') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tahanan.index') }}">{{ __('Tahanan dan WBP') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('news.index') }}">{{ __('Berita') }}</a>
                            </li>
                        </ul>
                @endif
            @endguest


            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            {{--                                <li class="nav-item">--}}
                            {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                            {{--                                </li>--}}
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Hello, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('jumbotron')

    <main class="py-md-3">
        @yield('content')
    </main>

    <footer class="bg-secondary pt-4 mt-4">
        <div class="container mb-4">
            <div class="row text-white">
                <div class="col-md-4">
                    <h5 class="mb-3">Lembaga Pemasyarakatan</h5>
                    <?php $lapas = \App\Models\Lapas::where('id', '!=', 0)->inRandomOrder()->limit(5)->get() ?>
                    <table class="table table-sm text-white">
                        @foreach($lapas as $l)
                            <tr>
                                <td style="border-bottom: 1px solid white">{{ $l->nama }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-4 offset-md-4 mt-md-0 mt-3">
                    <h5 class="mb-3">Ikuti Media Social Signal Pas</h5>
                    <a href="#">
                        <img src="{{ asset('assets/images/facebook.png') }}" alt="facebook" class="rounded-circle"
                             height="30">
                    </a>
                    <a href="#">
                        <img src="{{ asset('assets/images/instagram.png') }}" alt="instagram" class="rounded-circle"
                             height="30">
                    </a>
                    <a href="#">
                        <img src="{{ asset('assets/images/whatsapp.png') }}" alt="whatsapp" class="rounded-circle"
                             height="30">
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-white bg-gray p-2 align-content-center">
            <p class="m-0">
                <small>
                    © 2020 Sistem Indentifikasi Gangguan Keamanan dan Laporan Pemasyarakatan. All Rights Reserved.
                </small>
            </p>
        </div>
    </footer>
</div>

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
