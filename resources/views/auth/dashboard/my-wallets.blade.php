@include('auth.dashboard.header')
		
<div class="content-body mt--10 mt-sm-10 mt-xs-30">
	<div class="container-fluid">
		
		<h3 class="for_mobile text-light">My Wallet</h3>

		<div class="text-right mt-10 mt-xs-20 mb-4 btns_2">
			<a href="{{ route('deposit') }}" class="btn btn-primary btn-rounded pl-30 pr-30">+ Deposit</a>

			<a href="javascript:;" class="btn btn-primary btn-rounded pl-30 pr-30 withdraw"> Withdraw <i class="fa fa-hdd"></i></a>
		</div>

		<div class="cards-slider owl-carousel mb--20 ml-xs--10">
			<div class="col-md-4_ pl-sm-10 pr-sm-10">
				@php $paths = url('/')."/".$folder."dashboard_files/images/"; @endphp
				<div class="wallet-card bg-secondary" style="background-image:url('{{$paths}}pattern/pattern1.png');">

					<div class="head">
						<p class="fs-16 text-white mb-0 op6 font-w100">BTC Wallet</p>
						<span><i class="fab fa-bitcoin"></i> <span class="btc_bal_ btc_usd"></span></span>
						
						<input type="hidden" value="{{ $users->usd_btc_bal ? $users->usd_btc_bal : '0' }}" class="txtusd_btc" autocomplete="off">
						<input type="hidden" class="btc_usd1" autocomplete="off"> <!--btc coins-->
					</div>
					@php
						$usd_btc = $users->usd_btc;
						$usd_btc_bal = $users->usd_btc_bal;
						$usd_btc_profit = $usd_btc_bal - $usd_btc;
					@endphp
					<div class="wallet-footer">
						<div class="row profit_info mt--10 mt-md-5 mt-xs-20">
							<div class="col-4 pl-5 pr-5">
								<p>Invested</p>
								<span class="fs-14">${{number_format($usd_btc, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Profit</p>
								<span class="fs-14">${{number_format($usd_btc_profit, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Balance</p>
								<span class="fs-14 usd_btc_bal">${{number_format($usd_btc_bal, 2)}}</span>
							</div>
						</div>
						<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
					</div>
				</div>
			</div>

			<div class="col-md-4_ pl-sm-10 pr-sm-10">
				<div class="wallet-card bg-primary" style="background-image:url('{{$paths}}pattern/pattern3.png');">
					<div class="head">
						<p class="fs-16 text-white mb-0 op6 font-w100">ETH Wallet</p>
						<span><i class="fab fa-ethereum"></i> <span class="eth_bal_ eth_usd"></span></span>
						
						<input type="hidden" value="{{ $users->usd_eth_bal ? $users->usd_eth_bal : '0' }}" class="txtusd_eth" autocomplete="off">

						<input type="hidden" class="eth_usd1" autocomplete="off">
					</div>

					@php
						$usd_eth = $users->usd_eth;
						$usd_eth_bal = $users->usd_eth_bal;
						$usd_eth_profit = $usd_eth_bal - $usd_eth;
					@endphp
					<div class="wallet-footer">
						<div class="row profit_info mt--10 mt-md-5 mt-xs-20">
							<div class="col-4 pl-5 pr-5">
								<p>Invested</p>
								<span class="fs-14">${{number_format($usd_eth, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Profit</p>
								<span class="fs-14">${{number_format($usd_eth_profit, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Balance</p>
								<span class="fs-14 usd_eth_bal">${{number_format($usd_eth_bal, 2)}}</span>
							</div>
						</div>
						<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
					</div>
				</div>
			</div>

			<div class="col-md-4_ pl-sm-10 pr-sm-10">
				<div class="wallet-card bg-info" style="background-image:url('{{$paths}}pattern/pattern4.png');">
					<div class="head">
						<p class="fs-16 text-white mb-0 op6 font-w100">USDT Wallet</p>
						<span><img src="{{ url('/') }}/{{$folder}}images/usdt.png" style="width:22px!important"> <span class="usdt_bal_ usdt_usd"></span></span>
						
						<input type="hidden" value="{{ $users->usd_usdt_bal ? $users->usd_usdt_bal : '0' }}" class="txtusd_usdt" autocomplete="off">

						<input type="hidden" class="usdt_usd1" autocomplete="off">
					</div>

					@php
						$usd_usdt = $users->usd_usdt;
						$usd_usdt_bal = $users->usd_usdt_bal;
						$usd_usdt_profit = $usd_usdt_bal - $usd_usdt;
					@endphp
					<div class="wallet-footer">
						<!-- <span class="fs-14 usdt_usd"></span> -->
						<div class="row profit_info mt--10 mt-md-5 mt-xs-20">
							<div class="col-4 pl-5 pr-5">
								<p>Invested</p>
								<span class="fs-14">${{number_format($usd_usdt, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Profit</p>
								<span class="fs-14">${{number_format($usd_usdt_profit, 2)}}</span>
							</div>

							<div class="col-4 pl-5 pr-5">
								<p>Balance</p>
								<span class="fs-14 usd_usdt_bal">${{number_format($usd_usdt_bal, 2)}}</span>
							</div>
						</div>
						<img src="{{ url('/') }}/{{$folder}}dashboard_files/images/card-logo.png" alt="">
					</div>
				</div>
			</div>

			@php
			$pendings_btc = App\Models\Transaction::select('amt_usd', 'date_created')->whereUser($users->id)->whereCoins('btc')->whereStatus('pending')->orderBy('id', 'desc')->take(1)->first();

			$pendings_eth = App\Models\Transaction::select('amt_usd', 'date_created')->whereUser($users->id)->whereCoins('eth')->whereStatus('pending')->orderBy('id', 'desc')->first();

			$pendings_usdt = App\Models\Transaction::select('amt_usd', 'date_created')->whereUser($users->id)->whereCoins('usdt')->whereStatus('pending')->orderBy('id', 'desc')->first();
			@endphp

			<div class="col-md-4_ pl-sm-10 pr-sm-10">
				<div class="wallet-card bg-success" style="background-image:url('{{$paths}}pattern/pattern4.png');">
					<div class="head">
						<p class="fs-16 text-white mb-0 op6 font-w100">Pending Transaction</p>
						<span style="font-size:20px;"><i class="fab fa-bitcoin"></i> 
							<span class="pend_btc" style="font-size:20px;"> ${{ $pendings_btc['amt_usd'] ? $pendings_btc['amt_usd'] : 0 }}  <span style="font-size:11.5px;opacity:0.6">{{ $pendings_btc['amt_usd'] ? date("D jS, M Y h:ia", strtotime($pendings_btc['date_created'])) : '' }}</span></span>

						</span><br>
						
						<span style="font-size:20px;"><i class="fab fa-ethereum"></i>
							<span class="pend_eth" style="font-size:20px;">${{ $pendings_eth['amt_usd'] ? $pendings_eth['amt_usd'] : 0 }} <span style="font-size:11.5px;opacity:0.6">{{ $pendings_eth['amt_usd'] ? date("D jS, M Y h:ia", strtotime($pendings_eth['date_created'])) : '' }}</span></span>
						</span><br>

						<span style="font-size:20px;"><img src="{{ url('/') }}/{{$folder}}images/usdt.png" style="width:20px!important">
							<span class="pend_usdt" style="font-size:20px;">${{ $pendings_usdt['amt_usd'] ? $pendings_usdt['amt_usd'] : 0 }} <span style="font-size:11.5px;opacity:0.6">{{ $pendings_usdt['amt_usd'] ? date("D jS, M Y h:ia", strtotime($pendings_usdt['date_created'])) : '' }}</span></span>
						</span>
					</div>
				</div>
			</div>
		</div>



		<div class="col-xl-12 pl-xs-5 mt-50">
			<hr>
			<form autocomplete="off" class="form_withdraw pt-20">
				<div class="settings-form withdraw_div mb-30">
					<h3 class="text-light">Withdraw Funds</h3>
					
					<div class="col-md-10">
						<div class="row mt-20">
							<div class="mb-3 col-md-12">
								<label class="form-label">Select Coin</label>
								<select class="form-controls dropdnCoins" id="" style="background:#fff">
									<option selected value="btc">Bitcoin BTC</option>
									<option value="eth">Ether ETH</option>
									<option value="usdt">Tether USDT</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="mb-3 col-md-12">
								<label class="form-label">Enter Amount</label>
								<input type="number" placeholder="Enter Withdraw Amount" class="form-control withdrawAmt">

								<input type="hidden" class="txtWCharges" value="{{$settings->withdraw_charges}}">

								<div class="smallErr errMsg"></div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label class="form-label-tiny chargesInfo"></label>
								<input type="hidden" class="txtRealAmt" name="txtRealAmt">
							</div>
						</div>
					</div>
					
					<button class="mt-0 btn-pad btn btn-md btn-primary cmd_withdraw" type="button" data-bs-toggle="modal" data-bs-target=".isWithdraw">Withdraw Funds</button>
				</div>
			</form>
		</div>
		<br><br>
	</div>
</div>

	
<div class="modal fade isWithdraw" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proceed to Withdraw?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

			<!-- <input type="text" value="{{ $users->usd_btc_bal ? $users->usd_btc_bal : '0' }}" class="txtusd_btc1" autocomplete="off">

			<input type="text" value="{{ $users->usd_eth_bal ? $users->usd_eth_bal : '0' }}" class="txtusd_eth1" autocomplete="off">

			<input type="text" value="{{ $users->usd_usdt_bal ? $users->usd_usdt_bal : '0' }}" class="txtusd_usdt1" autocomplete="off"> -->
			

            <div class="modal-body" style="color:#333;">Clicking the <b>"continue" button</b> will place a <b class="modal_coins"></b> withdrawal for the amount <b><span class="withdraw_captn"></span> USD</b> continue?</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger light closeModal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary cmd_payment_withdraw">Continue</button>
            </div>
        </div>
    </div>
</div>

@include('auth.dashboard.footer')