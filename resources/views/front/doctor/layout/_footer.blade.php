@include('google.googleapi')

<footer id="footer">
    <div class="footer-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-4">
                    <p>&copy; 2019 <a href="{{url('/')}}">MobiDoctor</a>. All rights reserved.</p>
                </div>
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/')}}/about_us">About Us</a></li>
                        <li><a href="{{url('/')}}/blog">Blog</a></li>
                        <li><a href="{{url('/')}}/for_doctor">For Doctor</a></li>
                        <li><a href="{{url('/')}}/for_business">For Business</a></li>
                        <li><a href="{{url('/')}}/pregnancy">Pregnancy</a></li>
                        <li><a href="{{url('/')}}/how_it_work">How it Works</a></li>
                        <li><a href="{{url('/')}}/contact_us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- custom scrollbar plugin -->
<script type="text/javascript" src="{{ url('/') }}/public/front/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel=stylesheet type="text/css" href="{{ url('/') }}/public/front/css/jquery.mCustomScrollbar.css" />

<!--rating start-->  
<link rel=stylesheet type="text/css" href="{{ url('/') }}/public/front/css/star-rating.css" />
<script type="text/javascript" src="{{ url('/') }}/public/front/js/jquery.rating.js" ></script>   
<script type="text/javascript" src="{{ url('/') }}/public/front/js/star-rating.js" ></script> 
<!--rating end-->    

<script type="text/javascript">
    /*scrollbar start*/
    (function($){
        $(window).on("load",function(){
            $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
            $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
            $(".content-d").mCustomScrollbar({theme:"dark"});
        });
    })(jQuery);

    $(document).ready(function() {
    });
</script>
