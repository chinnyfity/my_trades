@include('auth.dashboard.header')

<div class="content-body mt--30 mt-sm-0 mt-xs--20">
<div class="container-fluid">
<div class="row">
    <div class="col-xl-12 pl-xs-5 pr-xs-5">
        <div class="card">
            <div class="card-body pl-xs-5 pr-xs-5">
                <div class="profile-tab">
                    <div class="custom-tab-1">

                        <div class="pb-40 first_div pl-10 pr-10" style="display:nones">
                            <h2 class="text-light_ mt-10 mb-30" style="color:#eee!important">Markets</h2>
                            <div style="margin:-24px 0 23px 0;font-size:14px;color:#ccc">Coin Rates</div>


                            <!-- <div class="col-lg-11 pl-xs-5 pr-xs-5 live_rates">
                                <p style="color:#ccc;font-size:15px">Loading live rates...</p>
                            </div> -->

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