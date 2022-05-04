
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>{{ $page_title }} AOE Market</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="AOE Market">
    <meta name="author" content="D-THEMES">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('/') }}/public/assets/images/favicon.png">
    

    <link rel="preload" href="{{ url('/') }}/public/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ url('/') }}/public/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ url('/') }}/public/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{ url('/') }}/public/assets/fonts/wolmart87d5.ttf?png09e" as="font" type="font/ttf" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/vendor/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/css/demo1.min.css">

    <link rel="stylesheet" href="{{ url('/') }}/public/css/custom-bootstrap-margin-padding.css">

</head>

<body class="home">
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
    <input type="text" value="{{ url('/') }}" id="txtsite_url" style="display:none">
    <input type="text" value="{{ $page_name }}" id="page_names" style="display:none">

    <div class="page-wrapper" style="background:#ccc;">
        <header class="header">
            <div class="header-middle header-middle1">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                        </a>
                        <a href="{{ url('/') }}/" class="logo ml-lg-0">
                            <img src="{{ url('/') }}/public/assets/images/logo.png" alt="logo" />
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="row mb-30 mb-xs-10">
            <div class="col-xl-4 col-sm-3 col-12"></div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="login-popup" style="max-width: 100rem !important;">
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        <ul class="nav nav-tabs nav-tabs1 text-uppercase" role="tablist">
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link active">Administrator Sign In</a>
                            </li>
                        </ul>
                        <div class="tab-content pl-15 pr-15">

                            @php $myRemember = Cookie::get('myRemember'); @endphp

                            <div class="tab-pane active" id="sign-in">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input type="email" class="form-control" name="txtemail" id="txtemail" required placeholder="Enter your email address">
                                    </div>

                                    <div class="form-group mt--10 mb-0">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="txtpass" id="txtpass" required placeholder="Enter your password">
                                    </div>
                                    
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember" name="remember" @if($myRemember == 1) checked @endif>
                                        <label for="remember">Remember me</label>
                                        <!-- <a href="#">Last your password?</a> -->
                                    </div>
                                    
                                    <div class="alert1 alert-danger errs mt--10 mb-10"></div>
                                    <a href="javascript:;" class="btn btn-primary cmd_signin_adm">Sign In</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-3 col-12"></div>
        </div>



        <footer class="footer">
            <div class="container">
                <div class="footer-bottom footer-bottom1">
                    <div class="footer-lefts text-center">
                        <p class="copyright">Copyright © 2021 AOE Market Store. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ url('/') }}/public/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/public/assets/js/main.min.js"></script>
    <script src="{{ url('/') }}/public/js/jscripts.js"></script>

</body>
</html>