<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <div id="header_waypoint"></div>
        <div id="first_block">
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
                <span style="display: inline-block; margin-right: 10px;">REGISTRATIONS: </span><strong class="counter margin-right-small" id="counter-changer">{{\App\User::all()->count() + 5000}}</strong>
            </div>
        </div>
        <div id="marketing" class="flex-abs-center">
            <div class="bg-image abs-full-sizes"></div>
            <div class="container">
                <div class="head text-center">
                    <h2 class="reset-margin"><strong>Marketing</strong></h2>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-6 video">
                            <iframe src="https://www.youtube.com/embed/RWn6AjDc_hI" allowfullscreen="" width="100%" height="315" frameborder="0"></iframe>
                        </div>
                        <div class="col-md-6 main-text">
                            <h3 class="reset-margin"><strong>Some title</strong></h3>
                            <div class="clearfix"></div><br>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <div class="text-left"><button class="btn btn-signUP" onclick="window.location = '/register';">Sign Up</button></div>
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
                        <div class="col-md-3 advantage">
                          <div class="front flex-abs-center">
                            <div>
                              <div class="image">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                              </div>
                                <h4><strong>Fast grow</strong></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam</p>
                            </div>
                          </div>
                          <div class="back flex-abs-center">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam deleniti dolor ducimus harum adipisci dolore quam mollitia!
                            </p>
                          </div>
                      </div>
                        <div class="col-md-3 advantage">
                          <div class="front flex-abs-center">
                            <div>
                              <div class="image">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                              </div><h4><strong>Graduate</strong></h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam</p>
                            </div>
                          </div>
                          <div class="back flex-abs-center">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam deleniti dolor ducimus harum adipisci dolore quam mollitia!
                            </p>
                          </div>
                      </div>
                      <div class="col-md-3 advantage">
                        <div class="front flex-abs-center">
                          <div>
                            <div class="image">
                              <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <h4><strong>Meet new people</strong></h4>
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam
                            </p>
                          </div>
                        </div>
                        <div class="back flex-abs-center">
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere reiciendis non placeat culpa odit voluptates, voluptas, in omnis nam sapiente incidunt, ipsam deleniti dolor ducimus harum adipisci dolore quam mollitia!
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
                                Start <strong>Meet</strong>, <strong>Learn</strong>, <strong>Make Money</strong>
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
            <h2 class="reset-margin"><strong>Calculator</strong></h2>
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
                  <h3 class="reset-margin form-head-text">Do you have any questions? We have answer on it.</h3>
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
                            Email:
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
  </body>
</html>
