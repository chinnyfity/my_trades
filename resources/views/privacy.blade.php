@include('header')

    <div class="midd-container">
        <div class="page-header">
            <div class="page-header-overlay">
                <div class="container">
                    <div class="entry-header text-center mt-30">
                        <h1 class="entry-title">
                            Privacy
                        </h1>
                        <p class="white font-17">Read Our Privacy And Policy</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section p-tb mt--20">
            <div class="container" style="color:#333; font-size:15px;">
                <div class="offset-lg-1 col-lg-10 pl-xs-0 pr-xs-0">
                    @include('privacy_content')
                </div>
            </div>
        </div>
    </div>

@include('footer')