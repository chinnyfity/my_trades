<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    <title>{{ $page_title }} </title>
    <!-- Favicon icon -->


    <link rel="shortcut icon" href="{{ url('/') }}/{{$folder}}images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="{{ url('/') }}/{{$folder}}dashboard_files/vendor/chartist/css/chartist.min.css">

	<link href="{{ url('/') }}/{{$folder}}dashboard_files/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ url('/') }}/{{$folder}}dashboard_files/css/style.css" rel="stylesheet">

	<link href="{{ url('/') }}/{{$folder}}css/responsive.bootstrap.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/bootstrap.min.css"/>
	<link href="{{ url('/') }}/{{$folder}}css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="{{ url('/') }}/{{$folder}}css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('/') }}/{{$folder}}css/custom-bootstrap-margin-padding.css" type="text/css"/>

	<!-- <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
</head>
<body>

	

	@php 
	$name = Route::currentRouteName();
	$lastPage = Cookie::get('lastPage');
	@endphp

    <input type="hidden" value="{{$name}}" id="routeName">
    <input type="text" value="{{ url('/') }}" id="url" style="display:none">
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token1">
	<input type="hidden" value="{{ $page_name }}" id="page_name">
	<!-- <input type="hidden" value="{{ $lastPage }}" id="url_cookies"> -->

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div class="alert alert-danger alertMsg">
        <i class="fa fa-times"></i>
    </div>
	

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="../" class="brand-logo">
				<img src="{{ url('/') }}/{{$folder}}images/fav-logo.png" class="for_mobile small-logo">
				<img src="{{ url('/') }}/{{$folder}}images/logo.png" class="for_desktop">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
		
		
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                {{$page_title}}
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link  ai-icon" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="flaticon-381-ring"></i>
                                    <div class="pulse-css"></div>
                                </a>

								
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
										<ul class="timeline">
											@if(count($notifications) > 0)
												@foreach($notifications as $notification)
													<li>
														<div class="timeline-panel pt-0 pb-5">
															<div class="media me-2">
																<img alt="image" width="50" src="{{ url('/') }}/{{$folder}}images/no_picture.jpg">
															</div>

															<div class="media-body">
																<h6 class="mb-1 fs-13">{{ ucfirst($notification->message) }}</h6>
																<small class="d-block fs-12">{{ date("D jS, M Y h:ia", strtotime($notification->created_at)); }}</small>
															</div>
														</div>
													</li>
												@endforeach
											@endif
										</ul>
									</div>
                                    <!-- <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a> -->
                                </div>
                            </li>
							
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ url('/') }}/{{$folder}}images/no_picture.jpg" width="20" alt=""/>
									<div class="header-info">
										<span>{{ ucfirst($firstname1) }}</span>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ms-2">Inbox </span>
                                    </a>
                                    <a href="{{route('signout')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
		

        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow_ ai-icon" style="{{$disabled}}" href="{{ route('dashboard') }}" aria-expanded="false">
							<i class="flaticon-381-home-2"></i>
							<span class="nav-text">Trade Session</span>
						</a>
                        <!-- <ul aria-expanded="false">
							<li><a href="index.html">Dashboard &nbsp; 1</a></li>
							<li><a href="index-2.html">Dashboard &nbsp; 2</a></li>
							<li><a href="index-3.html">Dashboard &nbsp; 3</a></li>
							<li><a href="index-4.html">Dashboard Dark</a></li>
							<li><a href="coin-details.html">Coin Details</a></li>
							<li><a href="my-wallets.html">My Wallets</a></li>
							<li><a href="transactions.html">Transactions</a></li>
							<li><a href="portofolio.html">Portofolio</a></li>
							<li><a href="market-capital.html">Market Capital</a></li>
						</ul> -->

                    </li>
					<?php /*
                    <li><a class="has-arrow_ ai-icon" style="{{$disabled}}" href="{{ route('trading') }}" aria-expanded="false">
							<i class="flaticon-381-repeat-1"></i>
							<span class="nav-text">Trading</span>
						</a>
                    </li>
					*/ ?>

                    <li><a class="has-arrow_ ai-icon" style="{{$disabled}}" href="{{ route('wallet') }}" aria-expanded="false">
							<i class="flaticon-381-folder"></i>
							<span class="nav-text">My Wallet</span>
						</a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="chart-flot.html">Flot</a></li>
                            <li><a href="chart-morris.html">Morris</a></li>
                            <li><a href="chart-chartjs.html">Chartjs</a></li>
                            <li><a href="chart-chartist.html">Chartist</a></li>
                            <li><a href="chart-sparkline.html">Sparkline</a></li>
                            <li><a href="chart-peity.html">Peity</a></li>
                        </ul> -->
                    </li>

                    <li><a class="has-arrow_ ai-icon" href="{{ route('kyc') }}" aria-expanded="false">
							<i class="flaticon-381-user-3"></i>
							<span class="nav-text">KYC</span>
						</a>
                        <!-- <ul aria-expanded="false">
							<li><a href="{{ route('kyc') }}">KYC</a></li>
                            <li><a href="open-account.php">Open Account</a></li>
                        </ul> -->
                    </li>

					<li><a href="{{ route('investment_plans') }}" class="ai-icon" style="{{$disabled}}" aria-expanded="false">
							<i class="flaticon-381-stopwatch"></i>
							<span class="nav-text">Plans</span>
						</a>
					</li>

                    <li><a href="{{ route('transactions') }}" class="ai-icon" style="{{$disabled}}" aria-expanded="false">
							<i class="flaticon-381-notepad"></i>
							<span class="nav-text">Transactions</span>
						</a>
					</li>

					<li><a href="{{route('signout')}}" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-turn-off"></i>
							<span class="nav-text">Logout</span>
						</a>
					</li>
                </ul>
			</div>
        </div>


		<div class="marquee1">
			<div class="marquee_">
				<div class="microsoft_ example1">
					<div class="live_rates">
					</div>
				</div>
			</div>
		</div>




		

		