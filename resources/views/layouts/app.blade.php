<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('common/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common/csss/licknav.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common/css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" href="{{ asset('common/css/animate.css') }}"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('style')

</head>
<body>
    <div id="my-blog">
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Header section -->
        <header class="header-section">
            <div class="header-warp">
                <div class="header-social d-flex justify-content-end">
                    <p>Follow us:</p>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <div class="header-bar-warp d-flex">
                    <!-- site logo -->
                    <a href="{{ url('/') }}" class="site-logo">
                        <img src="{{ url('/images/logo.png') }}" alt="">
                    </a>
                    <nav class="top-nav-area w-100">
                        <div class="user-panel">
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <div class="user-panel">
                                        <a href="{{ route('login') }}">Login</a> / <a href="{{ route('register') }}">Register</a>
                                    </div>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle dropdown-logout" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item logout" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                        <!-- Menu -->
                        <ul class="main-menu primary-menu">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Games</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Game Singel</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Reviews</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Header section end -->

        <main class="content">
            @yield('content')
        </main>

        <!-- Footer section -->
        <footer class="footer-section" style="z-index: 10000">
            <div class="container">
                <div class="footer-left-pic">
                    <img src="{{ url('/images/footer-left-pic.png') }}" alt="">
                </div>
                <div class="footer-right-pic">
                    <img src="{{ '/images/footer-right-pic.png' }}" alt="">
                </div>
                <a href="{{ url('/') }}" class="footer-logo">
                    <img src="{{ url('/images/logo.png') }}" alt="">
                </a>
                <ul class="main-menu footer-menu">
                    <li><a href="">Home</a></li>
                    <li><a href="">Games</a></li>
                    <li><a href="">Reviews</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
                <div class="footer-social d-flex justify-content-center">
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <div class="copyright"><a href="">Colorlib</a> 2018 @ All rights reserved</div>
            </div>
        </footer>
        <!-- Footer section end -->

        <!--====== Javascripts & Jquery ======-->
        @extends('layouts.script')
        @yield('script')
    </div>
</body>
</html>
