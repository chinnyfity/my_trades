@include('header')

<div class="midd-container">
    <div class="hero-main platinum-layout white-sec" style="background-image:url({{ url('/') }}/{{$folder}}images/banner-5.jpg);">
        <div class="container">
            <div class="row row-reverse align-items-center_">
                <div class="col-sm-12 col-md-4 col-4" data-wow-delay="0.5s">
                    <div class="platinum-animation">
                        <div class="platinum-move-1"></div>
                        <div class="platinum-move-2"></div>
                        <div class="platinum-move-3"></div>
                        <div class="platinum-move-4"></div>
                        <div class="platinum-move-5"></div>
                        <div class="top-part">
                            <div class="coin-icon"></div>
                        </div>
                        <div class="millde-part">
                            
                        </div>
                        <div class="base">
                                <div class="lines">
                                <span class="l-1"></span>
                                <span class="l-2"></span>
                                <span class="l-3"></span>
                                <span class="l-4"></span>
                                <span class="l-5"></span>
                            </div>   
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-8 mobile-center_ mt-90 mt-xs--20 mt-xs-50">
                    <h1>Trade with us, boost your <span>finances!</span></h1>
                    <p class="lead mt-xs-15">The easiest, seamless and secure platform to trade and invest your Cryptocurrencies</p>
                    <div class="hero-btns mt-40 mt-xs-20">
                        <a href="{{ route('signup') }}" class="btn btn-round">SIGN UP TO JOIN <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->  
    <!-- Exchange Section Start -->  
    <div class="exchange-list-section light-gray-bg pt-40 pb-40" id="rates">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="heading">
                        <h2>Current market rates for 1 in USD</h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="exchange-list">
                        <div class="item">
                            <div class="exchange-rate">
                                <span class="btc_usd"></span>
                                <p style="color:#666;font-size:14px;font-weight:500">Current Bitcoin value</p>
                            </div>
                            <div class="ex-company-icon mt--10"><img src="{{ url('/') }}/{{$folder}}images/earth-icon-3.png" alt="bitcoin" style="width:25px; height:25px" /></div>
                        </div>

                        <div class="item">
                            <div class="exchange-rate">
                                <span class="ngn_usd"></span>
                                <p style="color:#666;font-size:14px;font-weight:500">Current LTC value</p>
                            </div>
                            <div class="ex-company-icon mt--10"><img src="{{ url('/') }}/{{$folder}}images/lte.png" alt="ltc" style="width:25px; height:25px" /></div>
                        </div>

                        <div class="item">
                            <div class="exchange-rate">
                                <span class="eth_usd"></span>
                                <p style="color:#666;font-size:14px;font-weight:500">Current Etherum value</p>
                            </div>
                            <div class="ex-company-icon mt--10"><img src="{{ url('/') }}/{{$folder}}images/eth.png" alt="etherum" style="width:25px; height:25px" /></div>
                        </div>
                        
                        <div class="item">
                            <div class="exchange-rate">
                                <span class="usdt_usd"></span>
                                <p style="color:#666;font-size:14px;font-weight:500">Current Tether USDT value</p>
                            </div>
                            <div class="ex-company-icon mt--10"><img src="{{ url('/') }}/{{$folder}}images/earth-icon-2.png" alt="usdt" style="width:22px; height:25px" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-section pt-0 pb-0 pb-sm-60 white-bg" id="about">
        <div class="container">
            <div class="row row-reverse align-items-center">
                <div class="col-lg-6 col-md-5">
                    <div class="platinum-img-box mt-40">
                        <img src="{{ url('/') }}/{{$folder}}images/about-img-2.jpg" alt="About MFT">
                    </div>
                </div>

                <div class="col-lg-6 col-md-7 mt--20 mt-sm-70 mt-xs-20 mb-0">
                    <h2 class="section-heading">About MFT</h2>
                    <h4>Why choose Microfinance Trade?</h4>

                    <p class="font-15 line-height-24">Microfinancetrade sought to bridge the gap between retail and institutional clients offering a trading solution previously only available to Investment banks and high net worth individuals. Microfinancetrade is dedicated to innovation, constant improvement and utilising cutting edge technology.

                    Microfinancetrade has earned an enviable reputation for our commitment to high ethical standards and the quality of the trading we provide since 2007.</p>

                    <p class="font-15 line-height-24">The activity of microfinancetrade Group meets unified requirements set by international legislation for providing brokerage and financial services. All client money is managed in accordance with the Client Money Handling rules.</p>

                    <div class="button-wrapper">
                        <a class="btn btn-round btn-pad20" href="{{ route('signup') }}">Get Started <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <div class="video-section stats">
        <img src="{{ url('/') }}/{{$folder}}images/video-bg.jpg" alt="" />
        <div class="container">
            <h2>Our worldwide statistics</h2>
            <div class="row mt-30">
                <div class="col-md-3 col-6">
                    <i class="fab fa-bitcoin"></i>
                    <span class="stat_counts">{{ number_format($settings->currency_exchange) }}</span>
                    <span class="line"></span>
                    <span class="stat_caption">Currency <font>Exchanged</font></span>
                </div>

                <div class="col-md-3 col-6">
                    <i class="fa fa-exchange-alt"></i>
                    <span class="stat_counts">{{ number_format($settings->active_traders) }}</span>
                    <span class="line"></span>
                    <span class="stat_caption">Active <font>Traders</font></span>
                </div>

                <div class="col-md-3 col-6 mt-xs-20">
                    <i class="fa fa-users"></i>
                    <span class="stat_counts">{{ number_format($settings->customers) }}</span>
                    <span class="line"></span>
                    <span class="stat_caption">Our <font>Customers</font></span>
                </div>

                <div class="col-md-3 col-6 mt-xs-20">
                    <i class="fa fa-home"></i>
                    <span class="stat_counts">{{ number_format($settings->countries_supported) }}</span>
                    <span class="line"></span>
                    <span class="stat_caption">Countries <font>Supported</font></span>
                </div>
            </div>
            <!-- <div class="play-button">
                <a class="fancybox-media play-btn" href="https://youtu.be/Zjr7fKhqriU?autoplay=1"></a>
            </div> -->
        </div>
    </div>
    
    <div class="benefit-section platinum-layout white-bg pt-60">
        <div class="container pl-xs-15 pr-xs-15">
            <div class="text-center"><h2 class="section-heading">Benefits of Using Our Solution</h2></div>
            <div class="sub-txt mw-850 text-center mt--20">
                <p>The reason why MTF still remains the best globally</p>
            </div>
            <div class="banafits-list-items mt-xs--30">
                <div class="banafits-item">
                    <div class="benefit-box text-center">
                        <div class="benefit-icon">
                            <img src="{{ url('/') }}/{{$folder}}images/benefit-icon-1.png" alt="User Friendly">
                        </div>
                        <div class="text">
                            <h4>User Friendly</h4>
                            <p>Experience the best user friendliness, simple and easy to use with MTF</p>
                        </div>
                    </div>
                </div>

                <div class="banafits-item">
                    <div class="benefit-box text-center">
                        <div class="benefit-icon">
                            <!-- <img src="images/benefit-icon-2.png" alt="Instant Payout"> -->
                            <img src="{{ url('/') }}/{{$folder}}images/benefit-icon-4.png" alt="Instant Payout">
                        </div>
                        <div class="text">
                            <h4>Instant Payout</h4>
                            <p>Our payment system is instant and you will be credited immediately once processing is confirmed</p>
                        </div>
                    </div>
                </div>

                <div class="banafits-item">
                    <div class="benefit-box text-center">
                        <div class="benefit-icon">
                            <img src="{{ url('/') }}/{{$folder}}images/benefit-icon-5.png" alt="Strong Network">
                        </div>
                        <div class="text">
                            <h4>Strong Network</h4>
                            <p>Our platform is as fast as possible and can accomodate large number of transactions.</p>
                        </div>
                    </div>
                </div>
                
                <div class="banafits-item">
                    <div class="benefit-box text-center">
                        <div class="benefit-icon">
                            <img src="{{ url('/') }}/{{$folder}}images/benefit-icon-1.png" alt="Mobile Apps">
                        </div>
                        <div class="text">
                            <h4>Safety & Security</h4>
                            <p>Trusted by millions of people globally for its secure platform, we are confident to say that your crypto is in the right hands</p>
                        </div>
                    </div>
                </div>
                
                <div class="banafits-item">
                    <div class="benefit-box text-center">
                        <div class="benefit-icon">
                            <img src="{{ url('/') }}/{{$folder}}images/benefit-icon-6.png" alt="Margin Trading">
                        </div>
                        <div class="text">
                            <h4>MTF is Developed for you</h4>
                            <p>We develop this platform to serve you with the best functionalities and features.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banafits-circle">
                <div class="icon">
                    <img src="{{ url('/') }}/{{$folder}}images/large-c-icon.png" alt="">
                </div>
            </div>
        </div>
    </div>
    
    
    <div id="convertor" class="currency-calculator pt-50 pb-40 pt-xs-40 pb-xs-40 mt-xs--50 white-sec1 white-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h2 class="section-heading">Currency Converter</h2>
                    <div class="sub-txt sub-txt1">
                        <p>Check live foreign currency exchange rates. To get started enter the amount below and calculate today's exchange rates for any two currencies.</p>
                    </div>

                    <div class="currency-form mt-xs--20">
                        <form method="" action="#" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control btn-round txtamts1" name="" id="" placeholder="Enter Amount">
                                
                            </div>
                            <div class="input-group col-md-12 p-xs-0 text-center coinOptions">
                                <div class="col-6 pr-0">
                                    <select name="" class="form-control postpend amtFrom btn-round-left">
                                        <option value="USD" selected>US Dollar USD</option>
                                        <option value="BTC">Bitcoin BTC</option>
                                        <option value="BCH">Bitcoin Cash BCH</option>
                                        <option value="ETH">Ethereum ETH</option>
                                        <option value="LTC">Litecoin LTC</option>
                                    </select>
                                </div>

                                <div class="col-6 pl-0">
                                    <select name="" class="form-control postpend amtTo  btn-round-right">
                                        <option value="USD">US Dollar USD</option>
                                        <option value="BTC" selected>Bitcoin BTC</option>
                                        <option value="BCH">Bitcoin Cash BCH</option>
                                        <option value="ETH">Ethereum ETH</option>
                                        <option value="LTC">Litecoin LTC</option>
                                    </select>
                                </div>
                            </div>

                            <div class="output_display">
                                <!-- <p class="large">1 USD =</p> <p class="conValue">0.000038843 LTC</p>
                                <p class="small">1 LTC = 10.34 USD</p> -->
                            </div>
                            
                            <div class="input-group_ text-center mt-30">
                                <button class="btn btn-transparent cmd_convert btn-round pl-50 pr-50" type="button">Convert Now</button>                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Currency Convertor End -->


    <div class="token-sale pt-60 pb-40 pt-xs-30 pb-xs-20 light-gray-bg" id="token">
        <div class="container">
            <div class="text-center"><h3 class="section-heading fs-12" style="color:#8f611b; font-weight: 500">Choose the Broker Traders Trust</h3></div>
            <div class="row mt-30">
                <div class="offset-lg-1 col-lg-10 col-md-12">
                    <div class="token-allocation-box pt-30 pb-30 style-4 broker_imgs">
                        <div class="col-md-6 lines mb-xs-20">
                            <a href="https://www.trustpilot.com/review/venusfinancetrade.com" target="_blank">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{ url('/') }}/{{$folder}}images/home_row7_logo015e1f.png" alt="bitcoin" />
                                    </div>

                                    <div class="col-6 broker_info mt-10">
                                        <p class="big">4.95/5</p>
                                        <p>Excellent</p>
                                        <p><img src="{{ url('/') }}/{{$folder}}images/star.png" alt="bitcoin" /></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="javascript:;">
                                <img src="{{ url('/') }}/{{$folder}}images/home_row7_logo03.png" alt="bitcoin" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="token-sale pt-30 pb-40 pt-xs-30 pb-xs-30 dark-gray-bg-tone-2" id="token">
        <div class="container">
            <div class="text-center"><h4 class="section-heading fs-12" style="color:#e2ab57; font-weight: 500; font-size:28px">Our Partners</h4></div>
            <div class="row mt-10 text-center">
                <div class="col-md-3 col-6">
                    <img src="{{ url('/') }}/{{$folder}}images/partners/partner1.png" />
                </div>

                <div class="col-md-3 col-6">
                    <img src="{{ url('/') }}/{{$folder}}images/partners/partner2.png" />
                </div>

                <div class="col-md-3 col-6 mt-md-0 mt-15">
                    <img src="{{ url('/') }}/{{$folder}}images/partners/partner3.png" />
                </div>

                <div class="col-md-3 col-6 mt-md-0 mt-15">
                    <img src="{{ url('/') }}/{{$folder}}images/partners/partner4.png" />
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="token-sale pt-60 pb-70 pt-xs-70 pb-xs-40 light-gray-bg" id="token">
        <div class="container">
            <div class="text-center"><h3 class="section-heading fs-12" style="color:#8f611b; font-weight: 500">Our Range of Platform</h3></div>
            <div class="row mt-60 mt-xs-50">
                <div class="offset-lg-1 col-lg-10 text-center">
                    <div class="row">
                        <div class="col-md-6 lines mb-xs-20">
                            <a href="javascript:;" class="shadowed_box">
                                WebTrader
                            </a>
                        </div>

                        <div class="col-md-6 box2 mt--20 mt-xs-10">
                            Start trading global markets using our next-generation <b>WebTrader</b> platform for Windows and MacOS with no downloads required.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <div id="convertor_" class="currency-calculator_ pt-70 pb-40 pt-xs-40 pb-xs-40 mt-xs--50 mt-xs-20 white-sec1 white-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-heading text-center" style="font-weight:500;color:#333;font-size:30px">Trade With MFT</h3>

                    <div class="teamslider owl-carousel">
                        <div class="team-box">
                            <div class="team-img_ trust_img text-center">
                                <div class="mb-15"><img src="{{ url('/') }}/{{$folder}}images/awards1.jpg" style="width:180px;"></div>
                            </div>
                            <div class="text text1">
                                <h4 style="font-size:17px" class="mb-10">Regulated By BVI  FSC & LFSA</h4>
                                <p>Microfinancetrade is licensed by the BVI financial services commission</p>
                                <p>-Microfinancetrade is licensed by LFSA in the federal state of labuan (Malaysia)</p>
                            </div>
                        </div>

                        <div class="team-box">
                            <div class="team-img_ trust_img text-center">
                                <div class="mb-15"><img src="{{ url('/') }}/{{$folder}}images/awards2.jpg" style="width:90px;"></div>
                            </div>
                            <div class="text text1">
                                <h4 style="font-size:17px" class="mb-10">Insured by AIG</h4>
                                <p>Insured by AIG Professional Indemnity Insurance for Financial Institutions.</p>
                            </div>
                        </div>

                        <div class="team-box">
                            <div class="team-img_ trust_img text-center">
                                <div class="mb-15"><img src="{{ url('/') }}/{{$folder}}images/awards3.jpg" style="width:240px;"></div>
                            </div>
                            <div class="text text1">
                                <h4 style="font-size:17px" class="mb-10">13 International awards in 2020-2022</h4>
                                <p>- "Best Multi-asset CFD Broker 2022", South East Asia by "World Business Outlook" International magazine</p>

                                <p> - "Most Recommended Forex Broker 2022", South East Asia by "World Business Outlook" International magazine</p>

                                <p> - "Best Forex Education Provider 2022", South East Asia by "World Business Outlook" International magazine</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FAQ Section start-->
    <div class="faq-section p-tb light-gray-bg" id="faq">
        <div class="container pl-xs-10 pr-xs-10">
            <div class="text-center"><h2 class="section-heading">FAQs</h2></div>
            <div class="sub-txt text-center mt--20">
                <p> Get answers and explore everything you need to know about your question on MFT</p>
            </div>
            <div class="row mt--20">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="tab-section">

                        <div class="tab-content">
                            <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <!--Accordion wrapper-->
                                <div class="accordion md-accordion style-3" id="accordionGeneral" role="tablist" aria-multiselectable="true">
                                    <div class="card pl-xs-0 pr-xs-0">
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingOne1">
                                            <a data-toggle="collapse" data-parent="#accordionGeneral" href="#faqOne1" aria-expanded="true" aria-controls="faqOne1">
                                                <h5 class="mb--10 ml-15">
                                                    What is Microfinance Trade? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <!-- Card body -->
                                        <div id="faqOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                Microfinance trade are  regulated CFD broker, providing traders access to the global market through top tier FX liquidity providers.<br>
                                                Commodity CFDs, Index CFDs, Stock CFDs, unique gold instruments and personal composite instruments (PCIs). <br>
                                                We give clients access to over 500+ tradable instruments through our custom WebTrader, all trades are carried out virtually by our specialized team
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card pl-xs-5 pr-xs-5">
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingTwo2">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionGeneral" href="#faqTwo2" aria-expanded="false" aria-controls="faqTwo2">
                                                <h5 class="mb--10 ml-15">
                                                    What type of broker is Microfinance Trade? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <!-- Card body -->
                                        <div id="faqTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                MFT is an STP broker (Straight-through processing - automatic realization of transactions with financial instruments).
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card pl-xs-5 pr-xs-5">
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="headingThree3">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionGeneral" href="#faqThree3" aria-expanded="false" aria-controls="faqThree3">
                                                <h5 class="mb--10 ml-15">
                                                    Is Microfinance trade regulated? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <div id="faqThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                MFT. CORP. is licensed by the British Virgin Islands Financial Services Commission (BVI FSC).
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card pl-xs-5 pr-xs-5">
                                        <div class="card-header" role="tab" id="headingFour4">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionGeneral" href="#faqFour4" aria-expanded="false" aria-controls="faqFour4">
                                                <h5 class="mb--10 ml-15">
                                                    Are my funds insured in your company? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <!-- Card body -->
                                        <div id="faqFour4" class="collapse" role="tabpanel" aria-labelledby="headingFour4" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                MICROFINANCETRADE. CORP. holds professional lndemnity for Financial Institutions Insurance in AIG Europe Limited.<br><br>

                                                Traders' funds are kept segregated from the company's funds on a separate bank account and cannot be used by the company for any other purpose except for providing trading in the financial markets

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card pl-xs-5 pr-xs-5">
                                        <div class="card-header" role="tab" id="headingFive5">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionGeneral" href="#faqFive5" aria-expanded="false" aria-controls="faqFive5">
                                                <h5 class="mb--10 ml-15">
                                                    Is there a KYC involved? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="faqFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                Yes, You need to provide us with: Passport, or Driving License or any other Identity document and proof of address/Photo ID. It could be clear photo or a color scan.
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="card pl-xs-5 pr-xs-5">
                                        <div class="card-header" role="tab" id="headingFive5">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionGeneral" href="#faqFive5" aria-expanded="false" aria-controls="faqFive5">
                                                <h5 class="mb--10 ml-15">
                                                    How to start trading? <i class="fas fa-caret-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="faqFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5" data-parent="#accordionGeneral">
                                            <div class="card-body card-body-lh pl-30 mt--10">
                                                <b>1.Register a Profile</b><br>
                                                During the registration you will need to fill out the fields with your personal information. After filling out and sending the form you will be asked to confirm your email.<br>

                                                <b>2.Authorize your profile</b><br>
                                                If you are going to make a deposit or withdraw funds to your Wallet or bank account, you need to authorize your profile, send the scan of your Identity Document.<br>

                                                <b>3.Open a trading account</b><br>
                                                For opening a trading account from your Profile you need to go to “Accounts” tab and choose “Open a new account” function. Next, fill out the form of opening an account.<br>

                                                <b>4.Deposit the trading account.</b><br>
                                                For depositing into the trading account in the Profile you need to enter to the “Accounts” tab, choose “My accounts” option and click on “Deposit” button in the section of the necessary account.<br><br>
                                                Choose the deposit method from the drop-down list and follow the steps in the corresponding dialog.<br>
                                                As soon as your trading account is funded, your trading start.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
</div>

@include('footer')
 