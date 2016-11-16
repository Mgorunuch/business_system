<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:100,300,400,400i,500,500i,700,900&amp;subset=cyrillic-ext" rel="stylesheet">
    <script src="https://use.fontawesome.com/141b753a67.js"></script>
</head>
<body>
    <div id="app">
        <div class="fake_navbar"></div>
        <nav class="navbar top-navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <div class="logo"><img src="/images/logo.png" height="100%" alt=""> {{ config('app.name', 'Laravel') }}</div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{Auth::user()->profile_image}}" class="img-circle" height="25px" style="margin-right: 10px;margin-top: -3px;" alt="">{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/settings') }}">
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/achievements') }}">
                                            Achievements
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/referal') }}">
                                            Referal Program
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('page_info')

        @extends('components.messages')

        @yield('content')
        <div class="clearfix"></div>
    </div>

    <footer class="text-center">
        All right reserved <i class="fa fa-copyright" aria-hidden="true"></i> Piligrim Group
    </footer>

    <!-- Scripts -->
    @yield('scripts')
    <script src="/js/app.js"></script>
</body>
</html>
