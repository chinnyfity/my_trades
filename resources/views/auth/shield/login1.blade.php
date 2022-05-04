<!DOCTYPE html>
<html lang="en" class="h-100">

@php
$folder = "";
if(url('/') == "https://microfinancetrades.com"){
    $folder = "/public/";
}

@endphp

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Microfinance Trade - The best global trading platform" />
	<meta property="og:title" content="Microfinance Trade - The best global trading platform" />
	<meta property="og:description" content="Microfinance Trade - The best global trading platform" />
	<meta property="og:image" content="{{ url('/') }}/{{$folder}}images/logo.png"/>
	<meta name="format-detection" content="telephone=no">
    <title>SignIn - Microfinance Trade</title>

    <link rel="shortcut icon" href="{{ url('/') }}/{{$folder}}images/favicon.png" type="image/x-icon">
	<!-- <link href="{{ url('/') }}/dashboard_files/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"> -->
    <link href="{{ url('/') }}/{{$folder}}dashboard_files/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/custom-bootstrap-margin-padding.css" type="text/css"/>

</head>

<body class="vh-100">

    @php $name = Route::currentRouteName(); @endphp
    <input type="hidden" value="{{$name}}" id="routeName">
    <input type="text" value="{{ url('/') }}" id="url" style="display:none">
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">

    <div class="alert alert-danger alertMsg align-items-center">
        <i class="fa fa-times"></i>
    </div>

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-lg-5 col-md-9 pl-xs-5 pr-xs-5">
                    <div class="authincation-content btn-round">
                        <div class="row no-gutters">
                            <div class="col-xl-12 pl-5 pr-5 pl-xs-0 pr-xs-0">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{ url('/') }}"><img src="{{ url('/') }}/{{$folder}}images/logo.png" style="width:180px" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4" style="color:#b87435">Login to your admin account</h4>
                                    <form action="#">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <!-- <label class="mb-1"><strong>Email</strong></label> -->
                                            <input type="email" class="form-control btn-round" placeholder="Enter your username" required="" id="txtemail_adm" style="font-size:16px">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control btn-round" placeholder="Enter your password" required="" id="txtpass_adm" style="font-size:16px">
                                        </div>

                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="form-check custom-checkbox ms-1">

													<input type="checkbox" class="form-check-input" name="remember_adm" id="remember_adm" {{ old('remember') ? 'checked' : '' }} value="0">

													<label class="form-check-label" for="remember_adm" style="font-size:14px; color:#333;position:relative;top:3px;">Remember my details</label>
												</div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div> -->
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary btn-block cmd_signin_adm">SIGN ME IN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('/') }}/{{$folder}}dashboard_files/vendor/global/global.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}dashboard_files/js/custom.min.js"></script>
    
	<script src="{{ url('/') }}/{{$folder}}js/jquery.min.js"></script>
    <script src="{{ url('/') }}/{{$folder}}js/jscripts.js"></script>
</body>

</html>