<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <meta name="viewport" content="width=1200">

    <!-- Scripts -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:100,300,400,400i,500,500i,700,900&amp;subset=cyrillic-ext" rel="stylesheet">
    <script src="https://use.fontawesome.com/141b753a67.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <div id="app" class="beautyimg">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
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
                            <li><a href="#"><div id="google_translate_element"></div><script type="text/javascript">
                                        function googleTranslateElementInit() {
                                            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                        }
                                    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></a></li>
                            <li><a href="{{ url('/lessons') }}">Lessons</a></li>
                            <li>
                                <a href="{{ url('/referal') }}">
                                    Referral Program
                                </a>
                            </li>
                            @if(Auth::user()->id == 1)
                                <li class="">
                                    <a href="{{action('ArticleController@moderate')}}" class="">Moderate</a>
                                </li>
                            @endif
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
                                        <a href="#contact_us" data-toggle="modal" data-target="#contact-us-popup">
                                            Contact Us
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
        All rights reserved <i class="fa fa-copyright" aria-hidden="true"></i> Piligrim Group
    </footer>

    <!-- Scripts -->
    @yield('scripts')
    
    @if (Auth::guest())

    @else
    <div class="modal fade" id="contact-us-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="background-image: url(/images/logo.png);background-size: 200px;background-repeat: no-repeat;background-position: 200px 60px;background-color: #fff;border: solid 2px #74c5dd;border-radius: 10px;overflow: hidden;">
            <div class="modal-content" style="background: rgba(255,255,255,.8); padding-bottom: 20px;">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;top: 4px;right: 10px;color: #282828;opacity: 0.4;">&times;</button>
                <div class="text-center col-md-12" style="margin-top: 25px; margin-bottom: 25px;"><h3 class="reset-margin"><strong>Contact form</strong></h3></div>
                <form action="" class="form">
                    <div class="form-group  col-md-6">
                        <label for="contact-email">Email</label>
                        <input type="text" name="email" id="contact-email" class="form-control" value="{{Auth::user()->email}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact-name">Your name</label>
                        <input type="text" name="name" id="contact-name" class="form-control" @if(!is_null(Auth::user()->full_name)) value="{{Auth::user()->full_name}}" @endif>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="contact-message">Message</label>
                        <textarea name="message" class="form-control" id="contact-message" cols="30" rows="5"></textarea>
                    </div>
                    <div class="buttons col-md-12 text-left">
                        <button class="btn btn-default">Send</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @endif

    <script src="/js/app.js"></script>
</body>
</html>
