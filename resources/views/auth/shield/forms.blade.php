@include('auth.shield.header')

<div class="content-body mt--30 mt-sm-0 mt-xs--20">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 pl-xs-5 pr-xs-5">
				<div class="card">
					<div class="card-body pl-xs-10 pr-xs-10">
						<div class="profile-tab">
							<div class="custom-tab-1">
								<ul class="nav nav-tabs">

									<li class="nav-item"><a href="#settings" data-bs-toggle="tab" class="nav-link active show">Settings</a>
									</li>
									
									<li class="nav-item"><a href="#statistics" data-bs-toggle="tab" class="nav-link">Statistics</a>
									</li>

									<li class="nav-item"><a href="#change-pass" data-bs-toggle="tab" class="nav-link">Change Password</a>
									</li>
								</ul>

								<div class="tab-content mb-30">
									<div id="statistics" class="tab-pane fade">
										<div class="my-post-content mt-30">
											<form class="form_settings1" autocomplete="off">
												{{ csrf_field() }}
												<div class="settings-form mb-30">
													<h3 class="text-light">Statistics</h3>
													<p style="color:#ccc; font-size:14px;">Leave the default or enter a faker statistics. This figures will show on the home page</p>

													<div class="row mt-20">
														<div class="mb-3 col-md-6">
															<label class="form-label">Currency Exchange <span class="star">*</span></label> 
															<input type="number" placeholder="Enter Currecy Exchange" class="form-control txtcurex" name="txtcurex" value="{{$settings->currency_exchange}}">
														</div>

														<div class="mb-3 col-md-6">
															<label class="form-label">Active Traders</label>
															<input type="number" placeholder="Enter Active Traders" class="form-control txttraders" name="txttraders" value="{{$settings->active_traders}}">
														</div>
													</div>

													<div class="row mt-20">
														<div class="mb-3 col-md-6">
															<label class="form-label">Our Customers <span class="star">*</span></label> 
															<input type="number" placeholder="Enter Customers Counts" class="form-control txtcus" name="txtcus" value="{{$settings->customers}}">
														</div>

														<div class="mb-3 col-md-6">
															<label class="form-label">Countries Supported</label>
															<input type="number" placeholder="Enter Countries Counts" class="form-control txtccounts" name="txtccounts" value="{{$settings->countries_supported}}">
														</div>
													</div>
													
													<button class="mt-10 btn-pad btn btn-md btn-primary update_settings3" type="button">Update Settings</button>
												</div>
											</form>
										</div>
									</div>


									<div id="change-pass" class="tab-pane fade">
										<h3 class="text-light mt-30 mb-30">Update Your Password</h3>
										<form class="form_password" autocomplete="off">
											{{ csrf_field() }}
											<div class="row">
												<div class="mb-3 col-md-9">
													<label class="form-label">Current Password</label>
													<input type="password" name="txtpass1" placeholder="Type Current Password" class="form-control">
												</div>
												
												<div class="mb-3 col-md-9">
													<label class="form-label">New Password</label>
													<input type="password" name="txtpass2" placeholder="Type New Password" class="form-control">
												</div>

												<div class="mb-3 col-md-9">
													<label class="form-label">Confirm Password</label>
													<input type="password" name="txtpass3" placeholder="Confirm Your Password" class="form-control">
												</div>
											</div>
											
											<button class="mt-15 btn-pad btn btn-round btn-md btn-primary cmd_update_pass_adm" type="button">Update Password</button>
										</form>
									</div>


									<div id="settings" class="tab-pane fade active show">
										<div class="mt-30">
											<form class="form_settings" autocomplete="off">
												{{ csrf_field() }}
												<div class="settings-form mb-30">
													<h3 class="text-light mt-20 mb-20">Settings</h3>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Withdrawal Charges</label> 
															<input type="number" placeholder="Enter Your Firstname" class="form-control fname" name="txtcharges" value="{{$settings->withdraw_charges}}">
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Pause Earning</label>
															<select name="txtstop_earn" class="form-control form-control-md txtstop_earn">
																<option value="0" {{$settings->stop_earning == 0 ? 'selected' : ''}}>NO</option>

																<option value="1" {{$settings->stop_earning == 1 ? 'selected' : ''}}>YES</option>
															</select>
														</div>
													</div>

													@php
														$btc_min_max = explode(",", $settings->btc_min_max);
														$btc_min = $btc_min_max[0];
														$btc_max = @$btc_min_max[1];

														$eth_min_max = explode(",", $settings->eth_min_max);
														$eth_min = $eth_min_max[0];
														$eth_max = @$eth_min_max[1];

														$usdt_min_max = explode(",", $settings->usdt_min_max);
														$usdt_min = $usdt_min_max[0];
														$usdt_max = @$usdt_min_max[1];
													@endphp

													<div class="row">
														<div class="mb-3 col-md-4 col-12 pr-xs-5_">
															<label class="form-label">BTC Min-Max to Deposit</label>
															<input type="number" placeholder="Enter BTC Minimum" class="form-control txtbtc_min mb-5" name="txtbtc_min" value="{{$btc_min}}">

															<input type="number" placeholder="Enter BTC Maximum" class="form-control txtbtc_max" name="txtbtc_max" value="{{$btc_max}}">
														</div>

														<div class="mb-3 col-md-4 col-6 pr-xs-5">
															<label class="form-label">ETH Min-Max to Deposit</label>
															<input type="number" placeholder="Enter ETH Minimum" class="form-control txteth_min mb-5" name="txteth_min" value="{{$eth_min}}">

															<input type="number" placeholder="Enter ETH Maximum" class="form-control txteth_max" name="txteth_max" value="{{$eth_max}}">
														</div>

														<div class="mb-3 col-md-4 col-6 pl-xs-5">
															<label class="form-label">USDT Min-Max to Deposit</label>
															<input type="number" placeholder="Enter USDT Minimum" class="form-control txtusdt_min mb-5" name="txtusdt_min" value="{{$usdt_min}}">

															<input type="number" placeholder="Enter USDT Maximum" class="form-control txtusdt_max" name="txtusdt_max" value="{{$usdt_max}}">
														</div>
													</div>
													
													<button class="mt-10 btn-pad btn btn-md btn-primary update_settings1" type="button">Update Settings</button>
												</div>
											</form>

											<hr>
											<form class="form_others_adm" autocomplete="off">
												{{ csrf_field() }}
												<div class="settings-form mt-40">
													<h4 class="text-primary mt-20 mb-20">Plans Settings</h4>

													@php
														$starter = $other_settings[0]['percents'];
														$silver = $other_settings[1]['percents'];
														$gold = $other_settings[2]['percents'];
														$plat = $other_settings[3]['percents'];
														$voltage = $other_settings[4]['percents'];
														$super = $other_settings[5]['percents'];
														$rexcoins = $other_settings[6]['percents'];
													@endphp

													
													
													<div class="row">
														<div class="mb-3 col-md-4 col-6 pr-xs-5">
															<label class="form-label">Starter Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$starter}}" name="plan['starter']">
														</div>

														<div class="mb-3 col-md-4 col-6 pl-xs-5">
															<label class="form-label">Silver Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$silver}}" name="plan['silver']">
														</div>

														<div class="mb-3 col-md-4 col-6 pr-xs-5">
															<label class="form-label">Gold Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$gold}}" name="plan['gold']">
														</div>

														<div class="mb-3 col-md-4 col-6 pl-xs-5">
															<label class="form-label">Platinum Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$plat}}" name="plan['platinum']">
														</div>

														<div class="mb-3 col-md-4 col-6 pr-xs-5">
															<label class="form-label">Voltage Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$voltage}}" name="plan['voltage']">
														</div>

														<div class="mb-3 col-md-4 col-6 pl-xs-5">
															<label class="form-label">Super Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$super}}" name="plan['super']">
														</div>

														<div class="mb-3 col-md-4">
															<label class="form-label">RexCoins Plan</label>
															<input type="number" placeholder="Enter Percentage" class="form-control" value="{{$rexcoins}}" name="plan['rexcoins']">
														</div>
													</div>
													
													<button class="mt-10 btn-pad btn btn-md btn-primary update_settings2" type="button">Save & Submit</button>
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
		</div>
	</div>
</div>

@include('auth.shield.footer')