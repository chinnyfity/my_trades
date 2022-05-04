<!DOCTYPE html>
<html lang="en" xml:lang="en">    

<head>       
    <meta charset="UTF-8">  
    <!-- Responsive Meta -->                    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- favicon & bookmark -->
    
    <link rel="shortcut icon" href="{{ url('/') }}/{{$folder}}images/favicon.png" type="image/x-icon">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <!-- Website Title -->
    <title>Register - Microfinance Trades</title>
    <!-- Stylesheets Start -->

    
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/style-other-pages.css" type="text/css"/>
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/responsive.css" type="text/css"/>
    
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/custom-bootstrap-margin-padding.css" type="text/css"/>
    
     <!-- Stylesheets End -->
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
    
</head>
<body>
    @php $name = Route::currentRouteName(); @endphp
    
    <input type="hidden" value="{{$name}}" id="routeName">
    <input type="text" value="{{ url('/') }}" id="url" style="display:none">
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">


    <div class="alert alert-danger alertMsg align-items-center">
        <i class="fa fa-times"></i>
    </div>

    <!--Main Wrapper Start-->
    <div class="wrapper login-page style-2" id="top">
        <div class="cp-container first_div" style="display: nones">

            @if (Auth::check())
                You are already logged in
            @else
                <div class="image-part">
                    <img src="{{ url('/') }}/{{$folder}}images/register.jpg" alt="">
                </div>
                <div class="form-part">
                    <div class="cp-header">
                        <a href="{{ url('/') }}#home">
                            <div class="homeLink">
                                <i class="fa fa-home"></i>
                            </div>
                        </a>

                        <div class="logo">
                            <a href="{{ url('/') }}"><img class="light" src="{{ url('/') }}/{{$folder}}images/dark-logo.png" alt="Microfinance Trade"></a>
                        </div>
                    </div>
                    

                    <div class="cp-heading">
                        <h5>Welcome to MFT</h5>
                    </div>
                    
                    <div class="cp-body">
                        <form action="#" id="reg_form" method="POST">
                            {{ csrf_field() }}
                            <div class="reg_form" style="display: none">
                                <div class="cp-heading mt--10">
                                    <p style="font-size:14.5px;color:#555!important;">To keep connected, please sign up to get started.</p>
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control btn-round fullNames" name="fullNames" type="text" placeholder="Full name" required="" style="text-transform: capitalize;">
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control btn-round emails" name="emails" type="email" placeholder="Email Address" required="">
                                </div>

                                <div class="form-row">
                                    <div class="col form-group">
                                        <input class="form-control btn-round-left pass1" name="pass1" type="password" placeholder="Password" required="">
                                    </div>
                                    <div class="col form-group">
                                        <input class="form-control btn-round-right pass2" name="pass2" type="password" placeholder="Confirm Password" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <p class=" text-center remember-me-checkbox"><label><input type="checkbox" name="agree" id="agree" value="0">I agree with the website's <a href="{{ route('terms') }}">Terms and conditions</a></label></p> 
                                </div>

                                <div class="form-group text-center mt--10">
                                    <button type="submit" class="btn btn-round btn-block cmd_register">Register Now</button>
                                </div>

                                <div class="form-group text-center">
                                    <p>Already a member? <a href="javascript:;" class="sign_in">Sign in</a></p>
                                </div>
                            </div>


                            <div class="login_form" style="display: nones">
                                <div class="cp-heading mt--10">
                                    <p style="font-size:14.5px;color:#555!important;">To keep connected with market values and exchange rates, please sign in and continue.</p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn-round" type="email" placeholder="Email Address" required="" id="txtemail" name="txtemail">
                                </div>

                                <div class="form-group">
                                    <input class="form-control btn-round" type="password" placeholder="Password" required="" id="txtpass" name="txtpass">
                                </div>

                                <div class="form-group">
                                    <p class="remember-me-checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" id="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }} value="0">Remember next login
                                        </label>
                                    </p> 
                                </div>

                                <div class="form-group text-center mt--10">
                                    <button type="button" class="btn btn-round btn-block cmd_signin">Login</button>
                                </div>
                                <div class="form-group text-center">
                                    <p>Don't have an account? <a href="javascript:;" class="sign_up">Sign up</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>



        <div class="cp-container sec_div text-center image_part" style="display: none">
            <div class="col-md-12">
                <img src="{{ url('/') }}/{{$folder}}images/register.jpg" alt="">
            </div>
            <div class="col-md-12 p-0">
                <div class="cp-body">
                    <h4>Registration was successful</h4>
                    <div>
                        <h5>Please go to your inbox and confirm your Email.</h5>
                        <p class="tiny_text">We sent a verification link to your email "<span class="lblEmailSent">xxx</span>"</p>

                        <form action="#" method="POST">
                            <div class="offset-md-3 col-md-6">
                                <div class="form-group">
                                    <input class="form-control txtcode" name="txtcode" type="number" placeholder="Type code from email" required="" style="font-size:17px">
                                </div>
                            </div>
                        </form>
                    </div>
                        
                    <div class="form-group text-center mt-0">
                        <button type="button" class="btn cmd_dashboard">Continue</button>
                        <p class="mt-10">
                            <a href="javascript:;" class="cmd_check_inbox">Go to Your Email</a> &nbsp;|&nbsp;
                            <a href="javascript:;" class="closeme">Close this message</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('/') }}/{{$folder}}js/jquery.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}js/jscripts.js"></script>

</body>

</html>