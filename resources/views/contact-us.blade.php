@include('header')

    <div class="midd-container">
        <div class="page-header">
            <div class="page-header-overlay">
                <div class="container">
                    <div class="entry-header text-center mt-30">
                        <h1 class="entry-title">
                            Contact Us
                        </h1>
                        <p class="white font-17">We are always online 24/7, reach us anytime for more enquiries.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section p-tb mt--20">
            <div class="container">
                <div class="row">
                    <div class="sec-title text-center">
                        <h3>Do you have any questions?</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="icon-box contact-details text-center">
                                    <div class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="contact-item">
                                        <span>Email Address</span>
                                        <p><a href="mailto:info@microfinancetrades.com">info@microfinancetrades.com</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-xs--20">
                                <div class="icon-box contact-details text-center">
                                    <div class="icon">
                                        <i class="fa fa-map"></i>
                                    </div>
                                    <div class="contact-item">
                                        <span>Location:</span>
                                        <p>www.microfinancetrades.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section pb-60 mt--40">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <div class="sec-title text-center">
                            <h3>Drop us a message now!</h3>
                        </div>
                        <form action="#" id="form_contact" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control btn-round-left" placeholder="First name" name="fname">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control btn-round-right" placeholder="Last name" name="lname">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control btn-round-left" placeholder="Email address*" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" class="form-control btn-round-right" placeholder="Phone Number" name="phone">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <textarea class="form-control btn-round" rows="6" placeholder="Your Message" style="padding-top: 20px !important" name="txtmsg"></textarea>
                            </div>
                            <div class="form-group mt-30">
                                <button type="button" class="btn btn-width100-mobile btn-round cmd_contact">Send Message</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>

@include('footer')