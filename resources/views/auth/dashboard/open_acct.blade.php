
@if($users->mft_acct == null)
    <div class="settings-form first_div" style="display: nones">
        <h4 class="text-primary mt-20 mb-30">Open An Account</h4>
        <p style="margin:-22px 0 23px 0; font-size:14px; color:#555; line-height:22px">Click the button below to generate your account number</p>
        <form autocomplete="off" id="form_open_acct">
            {{ csrf_field() }}
            <div class="row">
                <div class="mb-3 col-md-9">
                    <label class="form-label">Platform</label>
                    <input type="text" class="form-control" value="WebTrader" disabled style="cursor:not-allowed; background:#eee">
                </div>
                <div class="mb-3 col-md-9">
                    <label class="form-label">Leverage</label>
                    <input type="text" class="form-control" value="Auto" disabled style="cursor:not-allowed; background:#eee">
                </div>
            </div>
            
            <button class="mt-15 btn-pad btn btn-round btn-md btn-primary cmd_open_acct" type="button">Open Account</button>
        </form>
    </div>


    <div class="sec_div image_part" style="display: none; text-align: center">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
            <circle class="path circle" fill="none" stroke="#6ee9a3" stroke-width="5" stroke-miterlimit="10" cx="65" cy="65.1" r="62.1"/>
            <polyline class="path check" fill="none" stroke="#6ee9a3" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
        </svg>
        <h4>You have successfully opened an account with MFT</h4>
        <div class="offset-sm-2 col-md-8 mt--5">
            <p class="tiny_text1">Your account number is <span class="acctnos">000000-WT</span></p>

            <p class="tiny_text">Your account credentials have been sent to your email. Now click the button below to make your first deposit into your wallet.</p>
        </div>
        <button class="mt-15 btn-pad btn-round btn btn-md btn-primary cmd_deposit" type="button">Make Deposit</button>
    </div>
@else
    <div class="image_part" style="text-align: center">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
            <circle class="path circle" fill="none" stroke="#6ee9a3" stroke-width="5" stroke-miterlimit="10" cx="65" cy="65.1" r="62.1"/>
            <polyline class="path check" fill="none" stroke="#6ee9a3" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
        </svg>
        <h4>You have successfully opened an account with MFT</h4>
        <div class="offset-sm-2 col-md-8 mt--5">
            <p class="tiny_text1">Your account number is <span class="acctnos">{{ $users->mft_acct }}-WT</span></p>

            <p class="tiny_text">Your account credential is saved to your email. Click the button below to make deposit into your wallet.</p>
        </div>
        <button class="mt-15 btn-pad btn-round btn btn-md btn-primary cmd_deposit" type="button">Make Deposit</button>
    </div>
@endif