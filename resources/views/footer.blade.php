<div class="clear"></div>

<footer class="platinum-footer">
    <div class="footer-widget-area text-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8">
                    <div class="widget-area mt-xs-0">
                        <div class="widget widget-html">
                            <div class="footer-logo">
                                <a href="#" title=""><img src="{{ url('/') }}/{{$folder}}images/logo.png" alt="Cp Platinum"></a>
                            </div>
                            <!-- <div class="text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="widget-area">
                        <div class="widget">
                            <ul class="footer-menu horizontal-menu onepage">
                                <li><a href="#about">About Us</a></li>
                                <li><a href="#convertor">Currency Converter</a></li>
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('signin') }}">Sign In</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-area">
                        <div class="widget widget-html text-center">
                            <div class="socials">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copy-text">© 2022 Microfinance Trade</div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="{{ url('/') }}/{{$folder}}js/jquery.min.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/circle-progress.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/onpagescroll.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/wow.min.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/jquery.countdown.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/owl.carousel.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/slick.min.js"></script>
<!-- <script src="{{ url('/') }}/js/Chart.js"></script> -->
<!-- <script src="{{ url('/') }}/js/chart-function.js"></script> -->
<script src="{{ url('/') }}/{{$folder}}js/jquery.fancybox.min.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/script.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/particles.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/gold-app.js"></script>
<script src="{{ url('/') }}/{{$folder}}js/jscripts.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
    setTimeout(function(){
        jQuery('.platinum-animation').addClass('start-animation');
    }, 1000);
    setTimeout(function(){
        jQuery('.platinum-animation .lines').addClass('active');
    }, 2000);
});
</script>
</body>

</html>