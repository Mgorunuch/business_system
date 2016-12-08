<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1200">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="XpNIlquyGRnuSOLQP3ORcDh8qcjxmr1a2Acq8Lzy">

        <title>Piligrim Group</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:100,300,400,400i,500,500i,700,900&amp;subset=cyrillic-ext" rel="stylesheet">
        <script src="https://use.fontawesome.com/141b753a67.js"></script><script src="https://cdn.fontawesome.com:443/js/stats.js"></script><link href="https://use.fontawesome.com/141b753a67.css" media="all" rel="stylesheet">

        <link rel="stylesheet" href="/css/welcome.css">
        <link rel="stylesheet" href="/css/libs/animate.css">


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
    <body style="">
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
                        <li><a href="#home">Home</a></li>
                        <li><a href="#marketing">About Us</a></li>
                        <li><a href="#advantages">Advantages</a></li>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#partners" data-toggle="modal" data-target="#partners">Partners</a></li>
                        <li><a href="#contactus">Contact Us</a></li>
                        <li><a href="#">
                                <div id="google_translate_element"></div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                    }
                                </script>
                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="header_waypoint"></div>
        <div id="home">
            <div id="head-image" class="abs-full-sizes"></div>
            <div class="absolute-center" id="paralax-particles">
                <div id="particles"><canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;" width="1910" height="955"></canvas></div>
            </div>
            <div class="flex-abs-center abs-full-sizes text-container fake-head-container">
                <div class="text-center fake-head">
                    <div class="logo-first-slide"><img src="/images/logo.png" alt="" height="100%"><span class="logo-text">Piligrim Group</span></div>
                    <div class="clearfix"></div>
                    <span class="slogan">Business community of new generation</span>
                    <div class="clearfix"></div>
                    <div class="buttons text-center">
                        <button class="btn btn-login margin-right-medium" onclick="window.location = '/login';">Login</button>
                        <button class="btn btn-register" onclick="window.location = '/register';">Sign Up</button>
                    </div>
                </div>
            </div>
            <div id="counter" class="flex-abs-center">
                <span style="display: inline-block; margin-right: 10px;">REGISTRATIONS: </span><strong class="counter margin-right-small" id="counter-changer">{{\App\User::all()->count() + 1692}}</strong>
            </div>
        </div>
        <div id="marketing" class="flex-abs-center">
            <div class="bg-image abs-full-sizes"></div>
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>About Us</strong></h2>
                </div>
                <div>
                    <div class="row flex-full-sizes">
                        <div class="col-md-6 video">
                            <!-- <iframe src="https://www.youtube.com/embed/RWn6AjDc_hI" allowfullscreen="" width="100%" height="315" frameborder="0"></iframe> -->
                            <img src="/images/landing/image.png" width="100%" alt="" style="border: solid 2px #000;">
                        </div>
                        <div class="col-md-6 main-text">
                            <p>
                            <ul style="padding-left: 20px;">
                              <li>A community of people who want to help in creating your own business</li>
                              <li>We will teach you how to properly start and expand your</li>
                              <li>We created a platform to help you communicate with other members of the community and share experience.</li>
                              <li>Besides studies we also regularly post articles in our blog that will help you speed up your business development.</li>
                              <li>We created a unique system and thanks to it you can earn money for the start of your own business in a short period of time.</li>
                            </ul>
                            <br>
                            </p>
                            <div class="text-left" style="margin-top: 24px;"><button class="btn btn-signUP" onclick="window.location = '/register';">Sign Up</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="advantages" class="flex-abs-center black-style">
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Our Advantages</strong></h2>
                </div>
                <div class="main-text">
                    <div class="row inner-inline-block text-center advantages-container">
                        <div class="col-md-3 advantage"  data-toggle="modal" data-target="#advantage1">
                          <div class="front flex-abs-center">
                            <div>
                              <div class="image">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                              </div>
                                <h4><strong>Fast growth</strong></h4>
                                <p>It is an option you get during the first week after activating your personal account...</p><br><br>
                                <p><strong>Click for more details</strong></p>
                            </div>
                          </div>
                          <div class="back flex-abs-center text-left">
                            <p>
                            It is an option you get during the first week after activating your personal account. It lets you get an extra 0.5  to 1 PGC for every partner you directly invite into your structure.<br><br>
                              It is divided into 3 steps: <br>
1)  Step 1/3. 2 days, extra profit per person 1 PGC <br>
2)  Step 2/3. 2 days, extra profit per person 0.75 PGC <br>
3)  Step 3/3. 3 days, extra profit per person 0.5 PGC
                            </p>
                          </div>
                      </div>
                        <div class="col-md-3 advantage" data-toggle="modal" data-target="#advantage2">
                          <div class="front flex-abs-center">
                            <div>
                              <div class="image">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                              </div><h4><strong>Learning</strong></h4>
                              <p>We will teach you how to properly start building your business and become successful in it...</p><br><br>
                                <p><strong>Click for more details</strong></p>
                            </div>
                          </div>
                          <div class="back flex-abs-center text-left">
                            <p>
                              We will teach you how to properly start building your business and become successful in it. Within the first 2 months after activating your account you will get one lesson every week focusing on how to start a profitable business of your own.
                            </p>
                          </div>
                      </div>
                      <div class="col-md-3 advantage"  data-toggle="modal" data-target="#advantage3">
                        <div class="front flex-abs-center">
                          <div>
                            <div class="image">
                              <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <h4><strong>Meet new people</strong></h4>
                            <p>
                             In our business community you can get in touch with others like you, with those who want to be their own boss...
                            </p><br><br>
                                <p><strong>Click for more details</strong></p>
                          </div>
                        </div>
                        <div class="back flex-abs-center">
                          <p>
                            In our business community you can get in touch with others like you, with those who want to be their own boss. You can find partners and create your team that will lead you to your business goals.
                          </p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div id="steps" class="flex-abs-center">
          <div class="bg-image abs-full-sizes"></div>
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>3 easy steps</strong></h2>
                </div>
                <div class="main-text">
                    <div class="row inner-inline-block vertical-center text-center steps-container margin-bottom-large">
                      <div class="col-md-2 step">
                        <div class="flex-abs-center abs-full-sizes">
                          <div>
                            <div class="image margin-bottom-large">
                              <i class="fa fa-user-circle" aria-hidden="true" style="color: #7cb5dd;"></i>
                            </div>
                            <p class="">
                              Register account
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1 font-size-300">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                      </div>
                      <div class="col-md-2 step">
                        <div class="flex-abs-center abs-full-sizes">
                          <div>
                            <div class="image margin-bottom-large">
                              <i class="fa fa-usd" aria-hidden="true" style="color:green"></i>
                            </div>
                            <p class="">
                              Activate account
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1 font-size-300">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                      </div>
                      <div class="col-md-2 step">
                          <div class="flex-abs-center abs-full-sizes">
                            <div>
                              <div class="image margin-bottom-large">
                                <i class="fa fa-handshake-o" aria-hidden="true" style="color: #282828;"></i>
                              </div>
                              <p class="">
                                Start to <strong>Meet</strong>, <strong>Learn</strong>, <strong>Make Money</strong>
                              </p>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="button" name="button" class="btn btn-signUP" onclick="window.location = '/register';">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
      <div id="calculator" class="black-style">
        <div class="container">
          <div class="head text-center">
            <h2 class="reset-margin"><strong>Profit Calculator</strong></h2>
          </div>
          <div class="calculator-container">
            <div class="row">
              <label for="Direct_inv" class="col-md-4">Directly invited:
                <div class="input-group">
                  <input type="text" name="Direct_inv" id="direct_inv" class="form-control" value="3" onkeydown="calculate()" onkeyup="calculate()" onpaste="calculate()" oncut="calculate()">
                  <div class="input-group-addon">users</div>
                </div>
                <span class="help-block">You can invite infinite count of users.</span>
              </label>
              <label for="Levels_full" class="col-md-8">Levels Full:
                <div class="full-width flex flex-grow-content-1 input-group">
                  <button class="btn btn-calculator level_1 active clicked min-level" onclick="setCalculatorLevel(1);">1</button>
                  <button class="btn btn-calculator level_2" onclick="setCalculatorLevel(2);">2</button>
                  <button class="btn btn-calculator level_3" onclick="setCalculatorLevel(3);">3</button>
                  <button class="btn btn-calculator level_4" onclick="setCalculatorLevel(4);">4</button>
                  <button class="btn btn-calculator level_5" onclick="setCalculatorLevel(5);">5</button>
                  <button class="btn btn-calculator level_6" onclick="setCalculatorLevel(6);">6</button>
                  <button class="btn btn-calculator level_7" onclick="setCalculatorLevel(7);">7</button>
                  <button class="btn btn-calculator level_8" onclick="setCalculatorLevel(8);">8</button>
                  <button class="btn btn-calculator level_9" onclick="setCalculatorLevel(9);">9</button>
                </div>
                <span class="help-block">All users fill levels.</span>
              </label>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 calulator-result flex-abs-center text-center">
              <div>
                <h5 class="reset-margin" style="margin-bottom: 5px;">You gain:</h5><h2 class="reset-margin" style="margin-right: 10px;"><strong id="calculator_result">15.75</strong> PGC <small> /per month</small></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div id="contactus" class="flex-abs-center">
          <div class="bg-image abs-full-sizes"></div>
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Contact Us</strong></h2>
                </div>
                <div class="main-text col-md-6 col-md-offset-3 text-center">
                  <h3 class="reset-margin form-head-text">Do you have any questions? We have answer on all.</h3>
                    <form action="" class="row text-left">
                        <label for="name" class=" col-md-6">
                            Name:
                            <input class="form-control" placeholder="name" type="text">
                        </label>
                        <label for="email" class=" col-md-6">
                            Email:
                            <input class="form-control" placeholder="email" type="text">
                        </label>
                        <label for="email" class=" col-xs-12">
                            Messages:
                            <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                        </label>
                        <div class="text-left col-xs-12">
                            <button class="btn btn-signUP contact-form">
                                Send message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="flex-full-center black-style">
          <span>All rights reserved Piligrim Group 2016</span>
        </footer>
        <script src="/js/app.js"></script>
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="/js/modernizr/modernizr.js"></script>
        <script src="/js/particles/particles.min.js"></script>
        <script src="/js/plugins-scroll/plugins-scroll.js"></script>
        <script src="/js/waypoints/waypoints.min.js"></script>
        <script src="/js/mg-paralax/mg-paralax.js"></script>


        <script src="/js/welcome.js"></script>


        <div class="modal fade" id="partners" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title" id="myModalLabel">Partners proposal <strong id="popup-edit-category-name"></strong></h4>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                  <p>Do you want to become a partner of Piligrim Group community? Fill out the form below and we will email you the special participation conditions.</p>
                </div>
                <div class="modal-body text-center">
                  <form action="" class="row text-left">
                        <label for="name" class=" col-md-6">
                            Name:
                            <input class="form-control" placeholder="name" type="text">
                        </label>
                        <label for="email" class=" col-md-6">
                            Email:
                            <input class="form-control" placeholder="email" type="text">
                        </label>
                        <label for="email" class=" col-xs-12">
                            Messages:
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </label>
                        <div class="text-left col-xs-12">
                            <button class="btn btn-signUP contact-form">
                                Send message
                            </button>
                        </div>
                    </form>
                </div>
              </div>
          </div>
        </div>
        <div class="modal fade" id="advantage1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content" style="background-color: #7cb5dd; color: #fff;">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Fast growth</strong></h4>
                </div>
                <div class="modal-body text-center">
                  <p>
                    It is an option you get during the first week after activating your personal account. It lets you get an extra 0.5  to 1 PGC for every partner you directly invite into your structure.<br><br>
                      It is divided into 3 steps: <br>
  1)  Step 1/3. 2 days, extra profit per person 1 PGC <br>
  2)  Step 2/3. 2 days, extra profit per person 0.75 PGC <br>
  3)  Step 3/3. 3 days, extra profit per person 0.5 PGC
                  </p>
                </div>
              </div>
          </div>
        </div>
        <div class="modal fade" id="advantage2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content" style="background-color: #7cb5dd; color: #fff;">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Learning</strong></h4>
                </div>
                <div class="modal-body text-center">
                  <p>
                    We will teach you how to properly start building your business and become successful in it. Within the first 2 months after activating your account you will get one lesson every week focusing on how to start a profitable business of your own.
                  </p>
                </div>
              </div>
          </div>
        </div>
        <div class="modal fade" id="advantage3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content" style="background-color: #7cb5dd; color: #fff;">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Meet new people</strong></h4>
                </div>
                <div class="modal-body text-center">
                  <p>
                    In our business community you can get in touch with others like you, with those who want to be their own boss. You can find partners and create your team that will lead you to your business goals.
                  </p>
                </div>
              </div>
          </div>
        </div>


    </body>
</html>
