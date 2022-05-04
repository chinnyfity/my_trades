@include('auth.shield.header')
@php
	use App\Models\User;
@endphp

	<div class="content-body mt--30 mt-sm-0 mt-xs--10">
		<div class="container-fluid">
			
			<h3 style="color:#ddd;">Hello Administrator</h3>
			<div class="mt--5" style="color:#999;">Welcome to your dashboard</div>

			<div class="row mt-30">
				<div class="col-md-4 pl-sm-10 pr-sm-10">
					@php $paths = url('/')."/".$folder."dashboard_files/images/"; @endphp
					<div class="wallet-card bg-secondary" style="background-image:url('{{$paths}}pattern/pattern1.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Total BTC</p>
								<span><i class="fab fa-bitcoin"></i> <span class="btc_usd"></span></span>								
							</div>
							
							<div class="wallet-footer pb-10">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Total USD</p>
										<span class="fs-14 usd_btc_bal">${{$total_btc}}</span>
									</div>
								</div>
								
								<img src="{{ url('/') }}{{$folder}}/dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-primary" style="background-image:url('{{$paths}}pattern/pattern3.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Total ETH</p>
								<span><i class="fab fa-ethereum"></i> <span class="eth_usd"></span></span>
							</div>

							<div class="wallet-footer pb-10">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Total USD</p>
										<span class="fs-14 usd_eth_bal">${{$total_eth}}</span>
									</div>
								</div>
								<img src="{{ url('/') }}{{$folder}}/dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>


				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-info" style="background-image:url('{{$paths}}pattern/pattern4.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Total USDT</p>
								<span><img src="{{ url('/') }}{{$folder}}/images/usdt.png" style="width:27px"> <span class="usdt_usd"></span></span>
							</div>

							<div class="wallet-footer pb-10">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Total USD</p>
										<span class="fs-14 usd_usdt_bal">${{$total_usdt}}</span>
									</div>
								</div>
								<img src="{{ url('/') }}{{$folder}}/dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>


				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-info" style="width:100%; height:90%">
						<a href="{{ route('users') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Total Users</p>
								<span><i class="flaticon-381-user-3"></i> {{ $user_count }}</span>
							</div>
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 pb-10 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<span class="fs-12">{{ $new_user_count > 0 ? $new_user_count : 'No' }} new users</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>


				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-secondary" style="width:100%; height:90%">
						<a href="{{ route('shield.transactions') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Pending Deposits</p>
								<span><i class="flaticon-381-notepad"></i> {{ $pending_deposit }}</span>
							</div>
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 pb-10 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<span class="fs-12">{{ $pending_deposit > 0 ? $pending_deposit : 'No' }} new pending deposits</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>


				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-danger" style="width:100%; height:90%">
						<a href="{{ route('shield.transactions') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">Pending Withdrawals</p>
								<span><i class="flaticon-381-notepad"></i> {{ $pending_withdrawal }}</span>
							</div>
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 pb-10 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<span class="fs-12">{{ $pending_withdrawal > 0 ? $pending_withdrawal : 'No' }} new pending withdrawals</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>



			<div class="col-xl-12 mt-30 mb-60">
				<h4 class="text-light">
					Recent Transactions
					<span><a href="{{ route('shield.transactions') }}" style="color:#f0cd5d; font-size:15px; margin-left:6px;">show all</a></span>
				</h4>
				<div class="table-responsive table-hover fs-14 mt-15">
					<table id="transactions_" class="table table-striped dataTablesCard card-table display responsive nowrap all_tables1_ index" cellspacing="0">
						<thead>
							<tr>
								<th>Users</th>
								<th>Status</th>
								<th>Amount</th>
								<th>Receiver</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transactions as $transaction)
								@php $users = User::whereId($transaction->user)->first(); @endphp
								<tr>
									<td>
										{{ucwords($users->fullname)}}
										<p style="margin:0;color:#be9d2e">{{$users->email}}</p>
									</td>
									<td>
										@php
											$colors="green";
											if($transaction->status == "failed"){
												$colors="red";
											}
										@endphp
										<span style='color:{{$colors}}'>{{ ucwords($transaction->status) }}</span>
									</td>
									<td>{{ @number_format($transaction->amt_usd, 2) }} USD </td>
									<td>
										<div style="font-size: 13px; color: #555;">{{ $transaction->receiver_addr }}</div>
									</td>
									<td>{{ date("D jS, M Y h:ia", strtotime($transaction->date_created)) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>
		
		</div>
	</div>

@include('auth.shield.footer')