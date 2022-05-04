<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
    <title>{{ $page_title }} </title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ url('/') }}{{$folder}}/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="{{ url('/') }}{{$folder}}/dashboard_files/vendor/chartist/css/chartist.min.css">

	<link href="{{ url('/') }}{{$folder}}/dashboard_files/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ url('/') }}{{$folder}}/dashboard_files/css/style.css" rel="stylesheet">

	<link href="{{ url('/') }}{{$folder}}/css/responsive.bootstrap.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ url('/') }}{{$folder}}/css/bootstrap.min.css"/>
	<link href="{{ url('/') }}{{$folder}}/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="{{ url('/') }}{{$folder}}/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('/') }}{{$folder}}/css/custom-bootstrap-margin-padding.css" type="text/css"/>

</head>
<body>


	<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-body p-0">
					<div class="card_ border-0 p-sm-3 p-2 justify-content-center">
						<div class="card-header_ pb-0 bg-white border-0 ">
							<div class="row">
								<div class="col ml-auto">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
								</div>
							</div>

							<div class="container_">
								<div class="col-md-12 modal_info"> Are you sure you want to delete this?</div>

								<div class="col-md-12 modal_desc">This will remove every content associated with this, continue?</div>
							</div>
							<input type="hidden" id="txtall_id">
							<input type="hidden" id="txtTable1">
							<input type="hidden" id="txtstatus_1">
						</div>
						
						<div class="card-body px-sm-4 mb-2 pt-1 pb-0">
							<div class="row pl-0 pr-0">								
								<div class="offset-md-7 col-md-5 offset-5 col-7 pl-0 pr-0 text-right">
									<button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button>

									<button type="button" class="btn btn-danger cmd_remove_adm" data-dismiss="modal">Delete</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="edit_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-body p-0">
					<div class="card_ border-0 p-sm-3 p-2 justify-content-center">
						<div class="card-header_ pb-0 bg-white border-0 ">
							<div class="row">
								<div class="col ml-auto">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
								</div>
							</div>

							<div class="container_">
								<div class="col-md-12 modal_info"> Editing their wallet is not appropriate, continue with this?</div>

								<form class="form_edit_wallet" autocomplete="off">
									{{ csrf_field() }}
									<div class="settings-form mb-30">
										<div class="row mt-20">
											<div class="mb-3 col-6 pr-xs-5">
												<label class="form-label">BTC (USD)</label> 
												<input type="number" placeholder="Enter Amount" class="form-control" name="txtbtc" id="txtbtc">
											</div>

											<div class="mb-3 col-6 pl-xs-5">
												<label class="form-label">BTC Balance (USD)</label>
												<input type="number" placeholder="Enter Amount" class="form-control" name="txtbtc_bal" id="txtbtc_bal">
											</div>

											<div class="mb-3 col-6 pr-xs-5">
												<label class="form-label">ETH (USD)</label> 
												<input type="number" placeholder="Enter Amount" class="form-control" name="txteth" id="txteth">
											</div>

											<div class="mb-3 col-6 pl-xs-5">
												<label class="form-label">ETH Balance (USD)</label>
												<input type="number" placeholder="Enter Amount" class="form-control" name="txteth_bal" id="txteth_bal">
											</div>

											<div class="mb-3 col-6 pr-xs-5">
												<label class="form-label">USDT (USD)</label> 
												<input type="number" placeholder="Enter Amount" class="form-control" name="txtusdt" id="txtusdt">
											</div>

											<div class="mb-3 col-6 pl-xs-5">
												<label class="form-label">USDT Balance (USD)</label>
												<input type="number" placeholder="Enter Amount" class="form-control" name="txtusdt_bal" id="txtusdt_bal">
											</div>
										</div>											
									</div>

									<input type="hidden" id="txtall_id_1" name="txtall_id_1">
									<input type="hidden" id="txtTable1_1" name="txtTable1_1">
								</form>
							</div>

							
						</div>
						
						<div class="card-body px-sm-4 mb-2 pt-1 pb-0">
							<div class="row pl-0 pr-0">								
								<div class="offset-md-6 col-md-6 offset-3 col-9 pl-0 pr-0 text-right">
									<button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button>

									<button type="button" class="btn btn-danger update_wallet" data-dismiss="modal">Update Wallet</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="approval_reason" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-body p-0">
					<div class="card_ border-0 p-sm-3 p-2 justify-content-center">
						<div class="card-header_ pb-0 bg-white border-0 ">
							<div class="row">
								<div class="col ml-auto">
									<button type="button" class="close close_option" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
								</div>
							</div>

							<div class="text-center">
								<div class="col-md-12 modal_info pb-20" style="color:#090; font-size:17px;font-weight:600">Confirm This Transaction?</div>
							</div>

							<input type="hidden" id="txtall_id1">
							<input type="hidden" id="txtTable1i">
							<input type="hidden" id="txtTable2">
							<input type="hidden" id="txtcolums1">
							<input type="hidden" id="txtcolums2">
							<input type="hidden" id="txtcolums3">
							<input type="hidden" id="txtcaps">
						</div>
						
						<div class="card-body px-sm-4 mb-2 pt-1 pb-0">
							<div class="row pl-0 pr-0 text-center div_approve_btn">
								<div class="offset-md-7_ _col-md-5 _offset-5 _col-7 pl-0 pr-0 text-right">
									<button type="button" class="btn btn-lg btn-danger cmd_decline approve_it2">Decline</button>&nbsp;

									<button type="button" class="btn btn-lg btn-success cmd_approve1" id="approve_it2" status3="approve">Approve</button>
								</div>
							</div>

							<div class="row pl-0 pr-0 text-center div_approve_reason" style="display:none">
								<div class="pl-0 pr-0 text-right">
									<textarea class="form-control txtreason" rows="2" placeholder="Enter reason for decline (Optional)"></textarea>

									<div class="pl-0 pr-0 text-right mt-15">
										<button type="button" class="btn btn-lg text-muted cmd_goto_approve_btn">Back</button>&nbsp;

										<button type="button" class="btn btn-lg btn-danger" id="approve_it2" status3="decline">Decline</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="stop_earn" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content border-0">
				<div class="modal-body p-0">
					<div class="card_ border-0 p-sm-3 p-2 justify-content-center">
						<div class="card-header_ pb-0 bg-white border-0 ">
							<div class="row">
								<div class="col ml-auto">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
								</div>
							</div>

							<div class="container_">
								<div class="col-md-12 modal_info modal_info_earn mb-20"></div>

								<!-- <div class="col-md-12 modal_desc">This will remove every content associated with this, continue?</div> -->
							</div>
							<input type="hidden" id="txtall_id_earn">
							<input type="hidden" id="txtTable1_earn">
						</div>
						
						<div class="card-body px-sm-4 mb-2 pt-1 pb-0">
							<div class="row pl-0 pr-0">								
								<div class="offset-md-6 col-md-6 offset-4 col-8 pl-0 pr-0 text-right">
									<button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button>

									<button type="button" class="btn btn-danger cmd_stop_earn" data-dismiss="modal">Stop Earning</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	@php $name = Route::currentRouteName(); @endphp
    <input type="hidden" value="{{$name}}" id="routeName">
    <input type="text" value="{{ url('/') }}" id="url" style="display:none">
    <input type="hidden" value="{{ csrf_token() }}" id="txt_token">
	<input type="hidden" value="{{ $page_name }}" id="page_name">

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div class="alert alert-danger alertMsg">
        <i class="fa fa-times"></i> this is an error message
    </div>
	

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="../" class="brand-logo">
				<img src="{{ url('/') }}{{$folder}}/images/fav-logo.png" class="for_mobile small-logo">
				<img src="{{ url('/') }}{{$folder}}/images/logo.png" class="for_desktop">
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
                            <!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link ai-icon" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="flaticon-381-ring"></i>
                                    <div class="pulse-css"></div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
										<ul class="timeline">
											<li>
												<div class="timeline-panel">
													<div class="media me-2">
														<img alt="image" width="50" src="{{ url('/') }}/dashboard_files/images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-info">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-success">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											 <li>
												<div class="timeline-panel">
													<div class="media me-2">
														<img alt="image" width="50" src="{{ url('/') }}/dashboard_files/images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-danger">
														KG
													</div>
													<div class="media-body">
														<h6 class="mb-1">Resport created successfully</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
											<li>
												<div class="timeline-panel">
													<div class="media me-2 media-primary">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
                                    <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li> -->
							
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ url('/') }}{{$folder}}/images/no_picture.jpg" width="20" alt=""/>
									<div class="header-info">
										<span>Administrator</span>
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
                    <li><a class="has-arrow_ ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
							<i class="flaticon-381-home-2"></i>
							<span class="nav-text">Dashboard</span>
						</a>

                    </li>
                    <li><a class="has-arrow_ ai-icon" href="{{ route('users') }}" aria-expanded="false">
							<i class="flaticon-381-view-2"></i>
							<span class="nav-text">View Users</span>
						</a>
                    </li>

                    <li><a class="has-arrow_ ai-icon" href="{{ route('shield.wallets') }}" aria-expanded="false">
							<i class="flaticon-381-folder"></i>
							<span class="nav-text">Users Wallet</span>
						</a>
                    </li>

                    <li><a href="{{ route('shield.transactions') }}" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-notepad"></i>
							<span class="nav-text">Transactions</span>
						</a>
					</li>

					<li><a class="has-arrow_ ai-icon" href="{{ route('settings') }}" aria-expanded="false">
							<i class="flaticon-381-user-3"></i>
							<span class="nav-text">Settings</span>
						</a>
                    </li>

					<li><a href="{{route('shield.signout')}}" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-turn-off"></i>
							<span class="nav-text">Logout</span>
						</a>
					</li>
                </ul>
			</div>
        </div>