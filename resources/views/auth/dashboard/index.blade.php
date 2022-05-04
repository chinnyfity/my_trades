@include('auth.dashboard.header')
@php
	use App\Models\User;
@endphp

	<div class="content-body mt--20 mt-sm-50 mt-xs-30">
		<div class="container-fluid">
			
			<h3 style="color:#ddd;">Hello {{$firstname1}}</h3>
			<div class="mt--5" style="color:#999;">Welcome to your dashboard</div>

			<div class="text-right mt--40 mt-xs-15 mb-xs--10 btns_2" style="float:right">
				<a href="{{ route('deposit') }}" class="btn btn-primary btn-rounded pl-30 pr-30">+ Deposit</a>

				<a href="{{ route('wallet') }}" class="btn btn-primary btn-rounded pl-30 pr-30"> Withdraw <i class="fa fa-hdd"></i></a>
			</div>

			<div style="clear: both"></div>

			<div class="row mt-30">
				<div class="col-md-4 pl-sm-10 pr-sm-10">
					@php $paths = url('/')."/".$folder."dashboard_files/images/"; @endphp
					<div class="wallet-card bg-secondary" style="background-image:url('{{$paths}}pattern/pattern1.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">BTC Wallet</p>
								<span><i class="fab fa-bitcoin"></i> <span class="btc_usd"></span></span>
								
								<!-- <input type="hidden" value="{{ $users->btc_wallet_addr ? $users->btc_wallet_addr : '0' }}" class="txtbtc"> -->

								<input type="hidden" value="{{ $users->usd_btc_bal ? $users->usd_btc_bal : '0' }}" class="txtusd_btc" autocomplete="off">
							</div>
							@php
								$usd_btc_bal = $users->usd_btc_bal;
							@endphp
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Balance</p>
										<span class="fs-14 usd_btc_bal">${{number_format($usd_btc_bal, 2)}}</span>
									</div>
								</div>
								<!-- <p>Balance</p>
								<span class="fs-14 btc_usd_">${{number_format($usd_btc_bal, 2)}}</span> -->
								<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-primary" style="background-image:url('{{$paths}}pattern/pattern3.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">ETH Wallet</p>
								<span><i class="fab fa-ethereum"></i> <span class="eth_usd"></span></span>
								
								<!-- <input type="hidden" value="{{ $users->eth_wallet_addr ? $users->eth_wallet_addr : '0' }}" class="txteth"> -->

								<input type="hidden" value="{{ $users->usd_eth_bal ? $users->usd_eth_bal : '0' }}" class="txtusd_eth" autocomplete="off">

							</div>
							<!-- <div class="wallet-footer">
								<span class="fs-14 eth_usd"></span>
								<img src="{{ url('/') }}/dashboard_files/images/card-logo.png" alt="">
							</div> -->

							@php
								$usd_eth_bal = $users->usd_eth_bal;
							@endphp
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Balance</p>
										<span class="fs-14 usd_eth_bal">${{number_format($usd_eth_bal, 2)}}</span>
									</div>
								</div>
								<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>

				<!-- <div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-info" style="background-image:url('{{$paths}}pattern/pattern4.png'); width:100%; height:85%">
						<div class="head">
							<p class="fs-16 text-white mb-0 op6 font-w100">Pending Withdrawal</p>
							<span style="font-size:20px;"><i class="fab fa-bitcoin"></i> 0.00057993</span><br>
							
							<span style="font-size:20px;"><i class="fab fa-ethereum"></i> 0.00057993</span>
						</div>

						<div class="wallet-footer wallet-footer1 mt--20_">
							<span class="fs-14">$64.56</span>
							<img src="{{ url('/') }}/dashboard_files/images/card-logo2.png" alt="">
						</div>
					</div>
				</div> -->


				<div class="col-md-4 pl-sm-10 pr-sm-10">
					<div class="wallet-card bg-info" style="background-image:url('{{$paths}}pattern/pattern4.png'); width:100%; height:90%">
						<a href="{{ route('wallet') }}">
							<div class="head">
								<p class="fs-16 text-white mb-0 op6 font-w100">USDT Wallet</p>
								<span><img src="{{ url('/') }}/{{$folder}}images/usdt.png" style="width:27px"> <span class="usdt_usd"></span></span>

								<input type="hidden" value="{{ $users->usd_usdt_bal ? $users->usd_usdt_bal : '0' }}" class="txtusd_usdt" autocomplete="off">

								<!-- <input type="hidden" value="{{ $users->usd_eth_bal ? $users->usd_eth_bal : '0' }}" class="txtusd_eth" autocomplete="off"> -->
							</div>

							@php
								$usd_usdt_bal = $users->usd_usdt_bal;
							@endphp
							<div class="wallet-footer">
								<div class="row profit_info profit_info1 mt--20 mt-md-5 mt-xs-20">
									<div class="col-12 pl-5 pr-5">
										<p>Balance</p>
										<span class="fs-14 usd_usdt_bal">${{number_format($usd_usdt_bal, 2)}}</span>
									</div>
								</div>
								<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
							</div>
						</a>
					</div>
				</div>
			</div>



			<div class="col-xl-12 mt-30 mb-60">
				<h4 class="text-light">Recent Transactions</h4>
				<div class="table-responsive table-hover fs-14 mt-15">
					<table id="transactions_" class="table table-striped dataTablesCard card-table display responsive nowrap all_tables1_ index" cellspacing="0">
						<thead>
							<tr>
								<th>Transaction</th>
								<th>Status</th>
								<th>Amount</th>
								<th>Receiver</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@if(count($transactions) > 0)
								@foreach($transactions as $transaction)
									@php $users = User::whereId($transaction->user)->first(); @endphp
									<tr>
										<td>{{$transaction->transId ? $transaction->transId : "Null"}}</td>
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
							@else
								<tr>
									<td colspan="5" class="text-center" style="padding:20px!important;font-size:15px;font-weight:normal!important;color:#ccc">No transactions found yet</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>	
			</div>
		
		</div>
	</div>

@include('auth.dashboard.footer')