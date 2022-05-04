@include('auth.dashboard.header')

<div class="content-body mt-10 mt-sm-50 mt-xs-30">
<div class="container-fluid">
<div class="row">
    <div class="col-xl-12 pl-xs-5 pr-xs-5">
        <div class="card">
            <div class="card-body pl-xs-5 pr-xs-5">
                <div class="profile-tab">
                    <div class="custom-tab-1">

                        <div class="pb-40 first_div" style="display:nones">
                            <h2 class="text-light mt-10 mb-30">Deposit Funds</h2>
                            <div style="margin:-24px 0 23px 0;font-size:13.5px;color:#ccc">Make your first deposit with any of the following methods immediately your deposit has been confirmed.</div>
                            <form autocomplete="off" class="form_deposit">
                                <div class="col-md-10">
                                    <div class="row">
                                        @php
                                        if($users->plan == "starter")
                                            $plan1 = "200";
                                        elseif($users->plan == "silver")
                                            $plan1 = "200";
                                        elseif($users->plan == "gold")
                                            $plan1 = "250";
                                        elseif($users->plan == "platinum")
                                            $plan1 = "400";
                                        elseif($users->plan == "voltage")
                                            $plan1 = "300";
                                        elseif($users->plan == "super")
                                            $plan1 = "350";
                                        else
                                            $plan1 = "20"; // rexcoins
                                        @endphp

                                        <div class="mb-3 col-md-7">
                                            <label class="form-label">Plan Chosen</label>
                                            <label class="form-control chosenPlan" style="font-size:16px; font-weight:500; color:#888 !important;background:#eee; text-transform:capitalize;">{{ $users->plan }} ({{ $plan1.'%' }}) 
                                                <a href='investment-plans' class='change_plan'>Change Plan</a>
                                            </label>
                                        </div>

                                        <div class="mb-3 col-md-5 pl-10 pl-xs-15">
                                            <label class="form-label">Your Account</label>

                                            <input type="hidden" value="{{$users->mft_acct}}" class="mft_acct">

                                            <input type="hidden" value="Silver" class="chosenPlan txtplan">

                                            @if($users->mft_acct == null)
                                                <label class="form-control" style="font-size:16px; font-weight:500; color:#888;">----- <a href='{{ route("kyc")}}' class='change_plan'>Click to Open Account</a></label>
                                            @else
                                                <label class="form-control" style="font-size:16px; font-weight:500; color:#888; background:#eee;">{{ $users->mft_acct }}-WT</label>
                                            @endif
                                        </div>

                                        @php
                                            $coin1 = Request::segment(3);
                                            $btc_min = explode(",", $settings->btc_min_max)[0];
                                            $btc_max = @explode(",", $settings->btc_min_max)[1];

                                            $eth_min = explode(",", $settings->eth_min_max)[0];
                                            $eth_max = @explode(",", $settings->eth_min_max)[1];

                                            $usdt_min = explode(",", $settings->usdt_min_max)[0];
                                            $usdt_max = @explode(",", $settings->usdt_min_max)[1];

                                            $amts_min = $usdt_min;
                                            $amts_max = $usdt_max;
                                        @endphp

                                        @if($coin1 == "btc")
                                            @php $amts_min = $btc_min;
                                            $amts_max = $btc_max; @endphp
                                        @elseif($coin1 == "eth")
                                            @php $amts_min = $eth_min;
                                            $amts_max = $eth_max; @endphp
                                        @endif

                                        

                                        <div class="mb-3">
                                            <label class="form-label">Cryptocurrency</label>
                                            <select class="form-controls dropdnCoins" id="" style="background:#fff">
                                                <option data-minval="{{$btc_min}}" data-maxval="{{$btc_max}}" {{ ($coin1 == "btc") ? 'selected' : '' }} value="btc">Bitcoin BTC</option>

                                                <option data-minval="{{$eth_min}}" data-maxval="{{$eth_max}}" {{ ($coin1 == "eth") ? 'selected' : '' }}  value="eth">Ether ETH</option>

                                                <option data-minval="{{$usdt_min}}" data-maxval="{{$usdt_max}}" {{ ($coin1 == "usdt") ? 'selected' : '' }}  value="usdt">Tether USDT</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 col-lg-10 col-md-11 pl-20 col-sm-12 mt-10">
                                            <label class="form-label" style="font-size:16px;">Credit Amount USD</label>
                                            
                                            <div class="row chooseAmounts mt-5 pr-xs-5">
                                                <div class="col-md-4 col-6 pl-10 pr-10 selAmts active active1"><div class="lbl_minAmt">${{ $amts_min ? number_format($amts_min) : '0.00'}}</div></div>

                                                <div class="col-md-4 col-6 pl-10 pr-10 selAmts"><div>$200</div></div>

                                                <div class="col-md-4 col-6 pl-10 pr-10 selAmts"><div>$500</div></div>

                                                <div class="col-md-4 col-6 pl-10 pr-10 selAmts"><div>$1,000</div></div>

                                                <div class="col-md-4 col-6 pl-10 pr-10 selAmts"><div class="lbl_maxAmt">${{ $amts_min ? number_format($amts_max) : '0.00'}}</div></div>

                                                <div class="col-md-4 col-6 pl-10 pr-10">
                                                    <div class="mb-3 col-md-12">
                                                        <input type="number" placeholder="$0.00" class="form-control txtEnterAmt" style="font-size: 17px; color:#444;">

                                                        <label class="form-label" style="font-size: 13px; color:#ccc!important;">Select your preferred amount</label><br>

                                                        <p class="form-label dynamic_lbl" style="font-size: 13px; color:#c9970f!important;margin-top:-5px">Min: ${{number_format($amts_min)}} - Max: ${{number_format($amts_max)}}</p>

                                                        <input type="hidden" class="minAmt" value="{{$amts_min}}">
                                                        <input type="hidden" class="maxAmt" value="{{$amts_max}}">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- <div class=""> -->
                                        <div class="mb-3 col-lg-10 col-md-11 pl-20 pl-xs-30 pr-xs-30">
                                            <label class="form-label" style="font-size:18px; font-weight:500; margin-left:-10px;">Payment Details</label>
                                            <div class="row mt-5 depositDetails">
                                                <div class="col-6">Deposit Method</div>
                                                <div class="col-6 last coinType">Bitcoin BTC</div>
                                                <input type="hidden" class="txtcur" value="btc">

                                                <div class="col-6">Credit Amount</div>
                                                <div class="col-6 last selectedAmt">{{$amts_min}} USD</div>
                                                <input type="hidden" class="txtamts" value="{{$amts_min}}">

                                                <div class="col-6">Commission</div>
                                                <div class="col-6 last coms">0%</div>
                                            </div>
                                        </div>


                                        <div class="mb-3 pr-xs-10 mt-10 pl-xs-20 pr-xs-10" style="margin-left:-5px">
                                            <textarea class="form-control txtnotes" rows="2" placeholder="Enter notes (Optional)"></textarea>
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label class="form-label" style="font-weight:600">Your Wallet Address <span class="star" style="font-size:18px;">*</span></label>
                                            <input type="text" placeholder="Paste your wallet address here" class="form-control userWallAdd" style="font-size: 15px; color:#444;">
                                        </div>

                                        <div class="mt-10">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" class="form-check-input" id="agree" checked>
                                                <label class="form-check-label form-label" for="agree" style="font-size:14px; color:#ddd !important;"> I have acknowledge that i have read the terms and condition</label>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                
                                <div class="mt-20">
                                    <button class="btn-pad btn btn-md btn-primary pl-50 pr-50 cmd_continue" type="button">Continue</button>
                                </div>
                            </form>
                        </div>


                        <div class="pb-40 sec_div row" style="display:none">
                            <div class="mb-3 col-lg-9 col-md-11 mt-10 mb-30 pl-xs-20 pr-xs-20">
                                
                                <label class="form-label" style="font-size:18px; color:#444; font-weight:500; margin-left:-5px;">Payment Details</label>
                                <div class="row mt-5 depositDetails">
                                    <div class="col-6">Credit Amount</div>
                                    <div class="col-6 last selectedAmt">{{$amts_min}} USD</div>

                                    <div class="col-6">Transaction ID</div>
                                    <div class="col-6 last transID">000000000000000000</div>
                                    <input type="hidden" id="transID">

                                    <div class="col-6">Your Wallet Address</div>
                                    <div class="col-6 last walAddrInfo" style="color:#7be6b4 !important">0x0000000000000000000000000000000</div>

                                    <div class="col-6 coinCaption">BTC Amount</div>
                                    <div class="col-6 last coms btc_amts">0.00000000 BTC</div>

                                    <input type="hidden" id="btc_amts">

                                    <div class="col-6">Payment Expires in</div>
                                    <div class="col-6 last coms expires" id="expires">0:00</div>
                                </div>
                            </div>


                            <div class="col-lg-9 col-md-11 payment_instru">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="rec_address"></div>
                                    </div>

                                    <div class="col-md-8 pl-0 pl-md-30 pl-sm-40 mt-5 mt-xs-0">
                                        <h5 style="color:#eee">Payment Instruction</h5>
                                        <ul>
                                            <li>Send exact amount of 0.00288383 BTC to our wallet address</li>

                                            <p style="color: #ec9090" class="mt-5">IMPORTANT NOTICE: If the amount sent differs from the payment amount in your request, we may be unable to process the payment and your fund may be lost</p>

                                            <li>After the payment has been processed by the admin, your account with us will be funded automatically and we will notify you via email.</li>
                                        </ul>
                                            
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-11 mt-10 mt-xs-20">
                                <label class="form-label" style="color:#eee!important; font-weight:600;">Company BTC Wallet Address</label>

                                <label id="info_copied">Copied</label>
                                
                                <label class="form-control text-center walletAdd" id="copyTarget">0x646Ec0bc40d5C46CD648E26B61f1f1A73E8284A0<i class="fa fa-copy fa_copy"></i></label>
                            </div>


                            <div class="col-lg-9 col-md-11 mt-15">
                                <div class="col-6 last coms expires_round">0:00</div>

                                <p style="color: #ec9090; font-size:13px; line-height:19px; margin:0px 0 -20px 0" class="text-center">By clicking the button below, you have made payment to the given address</p>

                                <div class="row text-center mt-15 mt-xs-20">
                                    <div class="mt-15">
                                        <button class="btn-pad btn btn-md btn-secondary gotoFirst_div mb-xs-10" type="button">Cancel</button> &nbsp;

                                        <button class="btn-pad btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm" type="button">I have made payment</button>
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
</div>



<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payments made</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="color:#333;">Clicking the <b>"continue" button</b> will assume you have made payment or want to deposit now, continue?</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger light closeModal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary cmd_payment_made">Continue</button>
            </div>
        </div>
    </div>
</div>

@include('auth.dashboard.footer')