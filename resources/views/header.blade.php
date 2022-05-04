<!DOCTYPE html>
<html lang="en" xml:lang="en">


<head>       
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ url('/') }}/{{$folder}}images/favicon.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <title>Microfinance Trade</title>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/slick.css" type="text/css"/>

    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/style.css" type="text/css"/>

    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/responsive.css" type="text/css"/>

    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/custom-bootstrap-margin-padding.css" type="text/css"/>

    
    <link rel="manifest" href="path-to_file/manifest.json">
    
     <!-- Stylesheets End -->
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
    
</head>
<body>
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
    <input type="text" value="{{ url('/') }}" id="url" style="display:none">

    @php $name = Route::currentRouteName(); @endphp
    <input type="hidden" value="{{$name}}" id="routeName">

    <div class="wrapper" id="top">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 logo">
                        <a href="#" title="Microfinance Trade">
                            <img class="light" src="{{ url('/') }}/{{$folder}}images/logo.png" alt="Microfinance Trade">
                            <img class="dark" src="{{ url('/') }}/{{$folder}}images/logo.png" alt="Microfinance Trade">
                        </a>
                    </div>



                    
                    <div class="topnav" id="myTopnav">
                        <a href="{{ url('/') }}#home" class="active">Home</a>
                        <a href="{{ url('/') }}#about">About</a>
                        <div class="dropdown1">
                            <button class="dropbtn1">Trading 
                            <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content1">
                            <a href="{{ url('trading/forex-widgets') }}">MFT Forex Widgets</a>
                            <a href="{{ url('trading/continuous-cfds') }}">Continuous CFDs</a>
                            <a href="{{ url('trading/economic-calendar') }}">MFT Economic Calendar</a>
                            <a href="{{ url('trading/bitcoin') }}">Bitcoin</a>
                            </div>
                        </div> 

                        <div class="dropdown1">
                            <button class="dropbtn1 dropbtn2">Our Innovations 
                            <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content1">
                            <a href="{{ url('trading/money-management') }}">Money Management Limits to Trade</a>
                            <a href="{{ url('trading/asset-equity') }}">Available Assets Equity</a>
                            </div>
                        </div> 

                        <a href="{{ url('/') }}#home">Analytics</a>
                        <a href="{{ url('/') }}#faq">FAQ</a>
                        <a href="{{ route('contact') }}">Contact Us</a>

                        @php
                        $fullname = @$users->fullname;
                        $fname = ucfirst(explode(" ", $fullname)[0]);
                        @endphp

                        @auth('user')
                            <a href="{{ route('dashboard') }}" style="color:#f0931e;">{{$fname}}</a>
                        @endauth

                        @guest('user')
                            <a class="nav-btn" href="{{ route('signin') }}">Sign In</a>
                        @endguest
                        
                        <a href="javascript:void(0);" style="font-size:15px;" class="icon myFunction" >&#9776;</a>
                    </div>


                    
                    
                </div>
            </div>
        </header>