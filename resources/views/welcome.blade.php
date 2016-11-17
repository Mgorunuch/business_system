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

        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:100,300,400,400i,500,500i,700,900&amp;subset=cyrillic-ext" rel="stylesheet">
        <script src="https://use.fontawesome.com/141b753a67.js"></script>

        <style>
            h1,h2,h3 {
                font-family: 'Roboto Slab', sans-serif;
            }
            .margin-bottom-small {
                margin-bottom: 7px;
            }
            .margin-bottom-medium {
                margin-bottom: 14px;
            }
            .margin-bottom-large {
                margin-bottom: 20px;
            }
            .margin-right-small {
                margin-right: 7px;
            }
            .margin-right-medium {
                margin-right: 14px;
            }
            .margin-right-large {
                margin-right: 20px;
            }
            .btn {
                border-radius: 2px;
                transition: 500ms;
            }
            .btn.btn-login, .btn.btn-register {
                width: 100px;
                text-align: center;
            }
            .btn.btn-login {
                font-size: 110%;
                background-color: transparent;
                border: solid 2px #fff;
                color: #fff;
                font-weight: bold;
                padding: .5em 1.3em;
            }
            .btn.btn-login:hover {
                background: #fff;
                color: #282828;
            }
            .btn.btn-register {
                font-size: 110%;
                background-color: #7cb5dd;
                border: solid 2px #7cb5dd;
                color: #fff;
                font-weight: bold;
                padding: .5em 1.3em;
            }
            .btn.btn-register:hover {
                background: #fff;
                color: #fff;
                border-color: #fff;
            }
            .navbar.top-navbar {
                background: transparent;
                border-color: transparent;
                color: #fff;
            }
            .navbar.top-navbar ul li a {
                color: #fff;
                font-weight: bold;
            }
            .logo-first-slide {
                position: relative;
                height: 120px;
                min-width: 320px;
                text-align: center;
            }
            .logo-first-slide > img {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
            }
            .logo-first-slide .logo-text {
                color: #fff;
                font-size: 300%;
                font-weight: bold;
                line-height: 120px;
                z-index: 2;
                position: absolute;
                left: 0;
                right: 0;
            }
            #first_block {
                overflow: hidden;
                transition: 500ms;
                position: relative;
                min-height: 70vh;
                background-color: rgba(0,0,0,.6);
            }
            #first_block #head-image {
                z-index: -1;
                background: url('http://st-gdefon.gallery.world/wallpapers_original/417493_gallery.world.jpg?9b30f88865a6ee068aa988b568d8492f') #0f0f0f bottom center;
                background-size: cover;
            }
            #first_block .text-container {
                padding-top: 50px;
            }
            #first_block .logo {
                font-size: 300%;
            }
            #first_block .slogan {
                display: inline-block;
                color: #fff;
                margin-bottom: 30px;
            }
            #counter {
                padding: 20px 0;
                font-size: 150%;
                background-color: #fff;
                font-family: 'Roboto', sans-serif;
            }
            #counter .counter {
            }
            #marketing {
                background-color: rgba(0,0,0,0.6);
                padding: 30px 0;
                position: relative;
            }
            #marketing .bg-image {
                background: url(https://www.walldevil.com/wallpapers/w04/042888-galaxy-space-stars.jpg) center fixed;
                background-size: cover;
                z-index: -1;
            }
            #marketing .head {
                margin-bottom: 30px;
            }
            #marke
            #advantages {
                background-size: cover;
                padding: 30px 0;
            }
            #advantages .head {
                margin-bottom: 30px;
            }
            #advantages .advantage {
                margin: 15px;
                background: #fff;
                padding: 25px;
            }
            #steps {
                background: #fff;
                padding: 30px 0;
            }
            #steps .head {
                margin-bottom: 30px;
            }
            #steps .advantage {
                margin: 15px;
                background: #fff;
                padding: 25px;
            }
            #contactus {
                background: url(https://www.walldevil.com/wallpapers/w04/042888-galaxy-space-stars.jpg) center fixed;
                background-size: cover;
                padding: 30px 0;
            }
            #contactus .head {
                margin-bottom: 30px;
            }
            #contactus .main-text {
                padding: 25px;
                background: #fff;
            }
            #contactus .form-group {
                width: 100%;
            }
        </style>
    </head>
    <body>
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
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Linkes -->
                        <li><a href="#first_block">Home</a></li>
                        <li><a href="#marketing">Marketing</a></li>
                        <li><a href="#advantages">Advantages</a></li>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#partners">Partners</a></li>
                        <li><a href="#contactus">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="first_block">
            <div id="head-image" class="abs-full-sizes"></div>
            <div class="absolute-center" id="paralax-particles">
                <div id="particles"></div>
            </div>
            <div class="flex-abs-center abs-full-sizes text-container">
                <div class="text-center">
                    <div class="logo-first-slide margin-bottom-large"><img src="/images/logo.png" height="100%" alt=""><span class="logo-text">{{ config('app.name', 'Laravel') }}</span></div>
                    <div class="clearfix"></div>
                    <span class="slogan">Meet, Learn, Make money</span>
                    <div class="clearfix"></div>
                    <div class="buttons text-center">
                        <button class="btn btn-login margin-right-medium">Sign In</button>
                        <button class="btn btn-register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="counter" class="flex-abs-center">
            <strong class="counter margin-right-small">{{\App\User::all()->count()}}</strong><span> users already registered</span>
        </div>
        <div id="marketing" class="flex-abs-center">
            <div class="bg-image abs-full-sizes"></div>
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Marketing</strong></h2>
                </div>
                <div class="main-text">
                    <div class="row">
                        <div class="col-md-6 video">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/RWn6AjDc_hI" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-6 main-text">
                            <h3 class="reset-margin"><strong>Some title</strong></h3>
                            <div class="clearfix"></div><br>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <div class="text-left"><button class="btn btn-primary">Sign Up</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="advantages" class="flex-abs-center">
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Our Advantages</strong></h2>
                </div>
                <div class="main-text">
                    <div class="row inner-inline-block text-center advantages-container">
                        <div class="col-md-3 advantage">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        <div class="col-md-3 advantage">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        <div class="col-md-3 advantage">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="steps" class="flex-abs-center">
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>3 easy steps</strong></h2>
                </div>
                <div class="main-text">
                    <div class="row inner-inline-block text-center steps-container">
                        <div class="col-md-3 step">A galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        <div class="col-md-3 step">A galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        <div class="col-md-3 step">A galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="contactus" class="flex-abs-center">
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Contact Us</strong></h2>
                </div>
                <div class="main-text col-md-6 col-md-offset-3">
                    <form action="">
                        <label for="email" class="form-group">
                            Email:
                            <input type="text" class="form-control" placeholder="email">
                        </label>
                        <label for="name" class="form-group">
                            Name:
                            <input type="text" class="form-control" placeholder="name">
                        </label>
                        <label for="email" class="form-group">
                            Email:
                            <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                        </label>
                        <div class="text-left">
                            <button class="btn btn-primary">
                                Send message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="/js/modernizr/modernizr.js"></script>
        <script src="/js/particles/particles.min.js"></script>
        <script src="/js/plugins-scroll/plugins-scroll.js"></script>
        <script src="/js/waypoints/waypoints.min.js"></script>
        <script src="/js/mg-paralax/mg-paralax.js"></script>

        <script src="/js/welcome.js"></script>
    </body>
</html>
