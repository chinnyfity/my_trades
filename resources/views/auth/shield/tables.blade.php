@include('auth.shield.header')

<div class="content-body mt--30 mt-sm-0 mt-xs--20">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 pl-xs-5 pr-xs-5">
				<div class="card_" style="background:#fff!important; border-radius:10px">
					<div class="card-body_ pl-0 pr-0 pt-xs-20 pl-xs-10 pr-xs-10" >
						@if($page_name == "transactions_adm")
							<div class="col-lg-12_ containerx house_tbl_">
								<div class="card-body all_tables p-xs-0">
									<div class="table-responsive">
										<table id="transactions" class="table table-striped table-bordereds display responsive nowrap all_tables1_" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th>Users</th>
													<th>Status</th>
													<th>Amount</th>
													<th>Type</th>
													<th class="none">Sender</th>
													<th class="none">Recipient</th>
													<th class="none">Decline Reason</th>
													<th class="none">Notes</th>
													<th>Date Created</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Users</th>
													<th>Status</th>
													<th>Amount</th>
													<th>Type</th>
													<th class="none">Sender</th>
													<th class="none">Recipient</th>
													<th class="none">Decline Reason</th>
													<th class="none">Notes</th>
													<th>Date Created</th>
													<th>Action</th>
												</tr>
											</tfoot>

										</table>
									</div>
								</div>
							</div>
						@endif


						@if($page_name == "users")
							<div class="col-lg-12_ containerx house_tbl_">
								<div class="card-body all_tables p-xs-0">
									<div class="table-responsive">
										<table id="users" class="table table-striped table-bordereds display responsive nowrap all_tables1_" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th>Names</th>
													<th>Status</th>
													<th>Email</th>
													<th>Password</th>
													<th class="none">MFT Account</th>
													<th class="none">KYC</th>
													<th class="none">Address</th>
													<th class="none">Location</th>
													<th>Date Created</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Names</th>
													<th>Status</th>
													<th>Email</th>
													<th>Password</th>
													<th class="none">MFT Account</th>
													<th class="none">KYC</th>
													<th class="none">Address</th>
													<th class="none">Location</th>
													<th>Date Created</th>
													<th>Action</th>
												</tr>
											</tfoot>

										</table>
									</div>
								</div>
							</div>
						@endif

						
						@if($page_name == "wallets")
							<div class="col-lg-12_ containerx house_tbl_">
								<div class="card-body all_tables p-xs-0">
									<div class="table-responsive">
										<table id="wallets" class="table table-striped table-bordereds display responsive nowrap all_tables1_" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th>Names</th>
													<th>BTC</th>
													<th>BTC Balance</th>
													<th>ETH</th>
													<th>ETH Balance</th>
													<th>USDT</th>
													<th>USDT Balance</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											</tbody>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Names</th>
													<th>BTC</th>
													<th>BTC Balance</th>
													<th>ETH</th>
													<th>ETH Balance</th>
													<th>USDT</th>
													<th>USDT Balance</th>
													<th>Action</th>
												</tr>
											</tfoot>

										</table>
									</div>
								</div>
							</div>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('auth.shield.footer')