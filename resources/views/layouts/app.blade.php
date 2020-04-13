<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="babysitter, nanny, help, housekeeper">
    <meta name="description" content="Reliable and Efficient Sitter Services in Abuja">
    <meta name="author" content=" ">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>iCare - Parents' Helping Hand</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="<?php echo asset("https://fonts.googleapis.com/css?family=Asap&display=swap") ?>" rel="stylesheet">
    <!-- Styles -->
    <link rel="icon" type="image/png" sizes="32x32" href="image/infant.png">
    <link rel="stylesheet" type="text/css" href="<?php echo asset("icarestyle.css") ?>">
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('font/css/all.css') ?>">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style type="text/css">
        body{
            font-family: 'Asap', sans-serif;
        }
        .beginbtn{
        
            color: #fdfffc;
            border-color:#CA054D;
            background-color: #CA054D;
            border-radius: 25px;
            box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.8);
            /*border-bottom-right-radius: 25%;*/
        }
        .beginbtn:hover{
            background-color: #fdfffc;
            color: /*#131515*/ #CA054D;
            border-width: 2px;
            border-color:#CA054D;
        }
        @media (max-width:768px){
            
            #intro p{
                color: #fdfffc;
            }
            #childintro{
                width: 100%;
                left: 5%;
            }
            #parentschoice{
                height: 
            }
        }
        .mybuttons{
            margin-left: 0%;
        }
        .filediv {
          position: relative;
          overflow: hidden;
        }
        .fileinput {
          position: absolute;
          font-size: 50px;
          opacity: 0;
          right: 0;
          top: 0;
        }

    </style>
</head>
<body>
    <header>
    
    </header>
    <div id="app">
        

        <nav class="navbar navbar-expand-lg sticky-top  ">
            <div class="container">
                <a class="navbar-brand" href="#"><span id="logo">iCare</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        
                        <!-- <li class="nav-item" id="signupbtn">
                            <a class="nav-link"  data-toggle="modal" href="#loginModal">Log In</a>
                            
                        </li> -->
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                                <li class="nav-item active" id="home-link">
                                    <a class="nav-link" href="{{ route('home')}}">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link" href="{{ route('about')}}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pregister')}}">Find a Sitter</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Become a Sitter') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span>Hello, </span>{{ Auth::user()->user_fname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    @if (Auth::user()->usertype == 'sitter')
                                        <a class="dropdown-item" href="{{ route('sitter.dashboard') }}"
                                       >
                                        {{ __('Dashboard') }}
                                    </a>
                                    @elseif (Auth::user()->usertype == 'parent')
                                    <a class="dropdown-item" href="{{ route('parent.index') }}"
                                       >
                                        {{ __('Dashboard') }}
                                    </a>
                                    @else
                                    
                                    @endif
                                    @if (Auth::user()->usertype == 'sitter')
                                        <a class="dropdown-item" href="{{ route('sitter.create') }}"
                                       >
                                        {{ __('Edit Profile') }}
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       >
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
            </div>
        </nav>
        <main class="">
            <div class="container-fluid" id="container-body">
        @yield('content')

            </div>
        @section('footer')
            <div class="row" >
                <div class="col  myfooter">
                    <div class="row pt-4">
                        <div class="col-md-2 ml-5">
                            <span id="ftheading">iCare</span>
                            <p><i>...Helping Parents</i></p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <ul class="foot-links" id="ftlinks1">
                                        <li class="ftheadings">EXPLORE</li>
                                        <li><a href="{{ route('pregister') }}" class="ftlinks">Find a Sitter</a></li>
                                        <li><a href="{{ route('register') }}" class="ftlinks">Become a Sitter</a></li>
                                        <li><a href="" class="ftlinks">FAQ</a></li>
                                        <li><a href="" class="ftlinks">Terms of Service</a></li>
                                        <li><a href="" class="ftlinks">Privacy Policy</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="foot-links" id="ftlinks2">
                                        <li class="ftheadings">SITTERS AROUND ME</li>
                                        <li><a href="" >Garki</a></li>
                                        <li><a href="" >Gwarinpa</a></li>
                                        <li><a href="" >Kubwa</a></li>
                                        <li><a href="" >Maitama</a></li>
                                        <li><a href="" >Asokoro</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul class="foot-links" id="ftlinks3">
                                        <li class="ftheadings">CONTACT US</li>
                                        <li><a href=""><i class="fab fa-facebook" style="color: #3B579D"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram" style="color: #D62576"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter" style="color: #28AAE1 "></i></a></li>
                                        <li><a href=""><i class="fab fa-youtube" style="color: #FE0000; "></i></a></li>
                                        <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pt-5">
                                    <p align="center">Copyright&copy; iCare 2019</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        @show
        
    
        </main>
    </div>
</body>
</html>
