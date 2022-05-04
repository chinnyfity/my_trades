@include('auth.dashboard.header')

<div class="content-body mt-15 mt-sm-50 mt-xs-30">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 pl-xs-5 pr-xs-5">
				<div class="card_" style="background:#fff!important; border-radius:10px">
					<div class="card-body_ pl-0 pr-0 pt-xs-20 pl-xs-10 pr-xs-10" >
						@if($page_name == "transactions")
							<div class="col-lg-12_ containerx house_tbl_">
								<div class="card-body all_tables p-xs-0">
									<div class="table-responsive">
										<table id="transactions" class="table table-striped table-bordereds display responsive nowrap all_tables1_" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th>Status</th>
													<th>Type</th>
													<th>Recipient</th>
													<th>USD</th>
													<th class="none">Decline Reason</th>
													<th class="none">Notes</th>
													<th>Date Created</th>
												</tr>
											</thead>
											<tbody>

											</tbody>

											<tfoot>
												<tr>
													<th>#</th>
													<th>Status</th>
													<th>Type</th>
													<th>Recipient</th>
													<th>USD</th>
													<th class="none">Decline Reason</th>
													<th class="none">Notes</th>
													<th>Date Created</th>
												</tr>
											</tfoot>

										</table>
									</div>
								</div>
							</div>
						@endif

					</div>
				</div>
				<br><br>
			</div>
		</div>
	</div>
</div>

@include('auth.dashboard.footer')