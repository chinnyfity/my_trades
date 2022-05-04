@include('auth.dashboard.header')

<div class="content-body mt--10 mt-sm-10 mt-xs-20">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 pl-xs-5 pr-xs-5">
				<div class="card">
					<div class="card-body pl-xs-10 pr-xs-10">
						<div class="profile-tab">
							<div class="custom-tab-1">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link active show">Profile</a>
									</li>
									
									<li class="nav-item"><a href="#open-account" data-bs-toggle="tab" class="nav-link">Account</a>
									</li>

									<li class="nav-item"><a href="#change-pass" data-bs-toggle="tab" class="nav-link">Change Password</a>
									</li>
								</ul>

								<div class="tab-content mb-30">
									<div id="open-account" class="tab-pane fade">
										<div class="my-post-content mt-30">
											@include('auth.dashboard.open_acct')
										</div>
									</div>


									<div id="change-pass" class="tab-pane fade">
										<h4 class="text-light mt-30 mb-30">Update Your Password</h4>
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
											
											<button class="mt-15 btn-pad btn btn-round btn-md btn-primary cmd_update_pass" type="button">Update Password</button>
										</form>
									</div>


									<div id="profile-settings" class="tab-pane fade active show">
										<div class="mt-30">
											@php $isEmpty = false; @endphp
											@if($users->fullname == "" || $users->phone == "" || $users->kyc == "" || $users->addr_file == "" || $users->address == "")
												<div class="alert alert-danger danger-little">The following compulsory fields are required to get verified!</div>
												@php $isEmpty = true; @endphp
											@endif

											@if(!$isEmpty && $users->kyc_approved == 0)
												<div class="alert alert-danger danger-little">Please wait a while let the admins verify your documents. It may take up to 30 minutes</div>
											@endif

											@if(!$isEmpty && $users->mft_acct == null)
												<div class="alert alert-danger danger-little">Please click on this account link above to open an account.</div>
											@endif
											
											<form class="form_profile">
												{{ csrf_field() }}
												<div class="settings-form mb-30">
													<h3 class="text-light mt-20 mb-20">My Profile</h3>
													
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Firstname <span class="star">*</span></label> 
															<input type="text" placeholder="Enter Your Firstname" class="form-control fname" name="fname" value="{{$firstname1}}">
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Lastname <span class="star">*</span></label>
															<input type="text" placeholder="Enter Your Lastname" class="form-control lname" name="lname" value="{{$lastname1}}">
														</div>
													</div>

													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Email <span class="star">*</span></label>
															<input type="email" placeholder="Enter Your Email" class="form-control email" name="email" value="{{$users->email}}">
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Phone <span class="star">*</span></label>
															<input type="tel" placeholder="Enter Your Phone" class="form-control" name="phone" value="{{$users->phone}}">
														</div>
													</div>
													
													<button class="mt-10 btn-pad btn btn-md btn-primary update_profile" type="button">Update Profile</button>
												</div>
											</form>


											<hr>
											<form class="form_kyc" autocomplete="off">
												{{ csrf_field() }}

												@if($users->kyc == "" && ($users->kyc_approved == 0 || $users->kyc_approved == null))
													<div class="settings-form first_form1 mt-40 mb-30" style="display: nones;">
														<h4 class="text-light mb-20">Upload Your KYC <span class="star">*</span></h4>
														<div class="row">
															<div class="mb-3 col-md-12">
																<label class="form-label" style="font-size: 14px">Upload a colored scan or photo of your passport or driving license or international passport</label>

																<label class="form-label" style="font-size: 12px; margin-top:-2px; color:#ccc!important; display:block">Max size allowed is 5mb. Only JPG and PNG are allowed</label>

																<p><span class="viewSample">View Sample</span></p>

																<div class="doc_sample">
																	<h6 style="color:#999; font-size:14px">Your image file must be clearly scanned front and back</h6>

																	<img src="{{ url('/') }}/{{$folder}}images/idcard.jpg" style="width: 240px">
																</div>

																<input type="file" placeholder="" class="form-control" name="kyc" accept=".jpg, .jpeg, .png">
															</div>
														</div>
														
														<button class="mt-10 btn-pad btn btn-md btn-primary cmd_upload_kyc" type="submit">Upload</button>
													</div>
												
													<div class="sec_form1 image_part mb-40" style="display: none; text-align: center">
														<img src="{{ url('/') }}/{{$folder}}images/unverified.png" width="110px">

														<h4 style="color:#eeaeae; margin-top:0px!important; display:block">Your Documents are pending for approval</h4>

														<div class="offset-sm-2 col-md-8">
															<p class="tiny_text">Please wait a while let the admins verify your documents. It may take up to 30 minutes, thank you!</p>
														</div>
													</div>

												@elseif($users->kyc != "" && $users->kyc_approved == 1)
													<div class="image_part mt-40 mb-40" style="text-align: center">
														<img src="{{ url('/') }}/{{$folder}}images/verified.png" width="110px">

														<h4 style="color:#6ee9a3;font-size:25px!important;">Your Documents have been verified!</h4>

														<div class="offset-sm-2 col-md-8 mt--5">
															<p class="tiny_text">You can now trade on the platform with ease, thank you.</p>
														</div>
													</div>
													
												@else
													<div class="image_part mb-40" style="text-align: center">
														<img src="{{ url('/') }}/{{$folder}}images/unverified.png" width="110px">

														<h4 style="color:#eeaeae; margin-top:0px!important; display:block">Your Documents are pending for approval</h4>

														<div class="offset-sm-2 col-md-8">
															<p class="tiny_text">Please wait a while let the admins verify your documents. It may take up to 30 minutes, thank you!</p>
														</div>
													</div>
												@endif
											</form>


											<hr>
											<form class="form_others">
												{{ csrf_field() }}
												<div class="settings-form mt-40">
													<h4 class="text-light mt-20 mb-20">Other Details</h4>
													
													<div class="row">
														<div class="mb-3 col-md-12">
															<label class="form-label">Address <span class="star">*</span></label>
															<textarea rows="1" class="form-control" name="txtaddr" placeholder="Enter Your Address">{{$users->address}}</textarea>
														</div>
													</div>


													<div class="row">
														<div class="mb-3 col-md-4">
															<label class="form-label">Country</label>
															<select name="country" class="form-control form-control-md country">
																<option value="">-Select Country-</option>
																@if(count($countries) > 0)
																	@foreach($countries as $country)
																		<option value="{{ $country->id }}" @if($country->id == $users->countrys) selected @endif >{{ $country->name }}</option>
																	@endforeach
																@endif
															</select>
														</div>

														<div class="mb-3 col-md-4">
															<label class="form-label">State</label>
															<select name="state" class="form-control form-control-md txtstates1">
																<option value="">-Select State-</option>
																@if(count($states2) > 0)
																	@foreach($states2 as $state)
																		<option value="{{ $state->id }}" @if($state->id==$users->states) selected @endif >{{ $state->name }}</option>
																	@endforeach
																@endif
															</select>
														</div>

														<div class="mb-3 col-md-4">
															<label class="form-label">City</label>
															<input type="text" placeholder="Enter Your City" class="form-control" value="{{ ucfirst($users->citys) }}" name="city">
														</div>
													</div>

													<div class="mb-3 col-md-12">
														<label class="form-label" style="font-size: 14px">Proof of Address or Photo ID <span class="star">*</span></label>

														<label class="form-label" style="font-size:12.5px; margin:-2px 0 5px 0; color:#ccc!important; display:block">Address document uploaded must be the same as the address you have entered</label>

														<input type="file" placeholder="" class="form-control" name="txtaddr_file" id="txtaddr_file">
													</div>
													
													<button class="mt-10 btn-pad btn btn-md btn-primary cmd_save_submit" type="submit">Save & Submit</button>
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

@include('auth.dashboard.footer')