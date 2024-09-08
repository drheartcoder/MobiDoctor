<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8 />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <meta http-equiv=X-UA-Compatible content="IE=edge" />

    <meta name=author content="{{$author or config('app.project.name')}}"/>
    <meta name=description content="{{$meta_desc or ''}}"/>
    <meta name=keywords content="{{$meta_keyword or ''}}" />
    
    <title>{{$page_title or ''}}</title>

    <meta property="og:description" content="{{$meta_desc or ''}}">
    <meta property="og:title" content="{{$meta_title or ''}}">
    <meta name="twitter:description" content="{{$meta_desc or ''}}">
    <meta name="twitter:title" content="{{$meta_title or ''}}">

    <link rel=icon type="image/png" sizes=16x16 href="{{ url('/') }}/favicon.ico">
    <!--css-->
    <link href="{{ url('/') }}/public/front/css/bootstrap.min.css" rel=stylesheet type="text/css" />
    <link href="{{ url('/') }}/public/front/css/font-awesome.min.css" rel=stylesheet type="text/css" />
    <link href="{{ url('/') }}/public/front/css/mobi-doctor.css" rel=stylesheet type="text/css" /> 

    <!--main js start-->
    <script src="{{ url('/') }}/public/front/js/jquery-1.11.3.min.js"></script>
    <script src="{{ url('/') }}/public/front/js/bootstrap.min.js"></script>
    <!--main js end-->

    <link href="{{ url('/') }}/public/front/css/loading.css" rel="stylesheet"/>
    <script async src="{{ url('/') }}/public/front/js/loader.js"></script>

</head>
<header>

    <?php $user = Sentinel::check(); ?>


    <div class="container-fluid">
       <div class="row">
           <div class="col-xs-5 col-sm-3 col-md-4 col-lg-4">
                <a href="{{url('/')}}" class="logo">
                    <img src="{{ url('/') }}/public/front/images/logo.png" class="img-responsive logo-white" alt="MobiDoctor"/>
                    <img src="{{ url('/') }}/public/front/images/logo-black.png" class="img-responsive logo-black" alt="MobiDoctor"/>
                </a>
           </div>
           <span class="menu-icon" onclick="openNav()">&#9776;</span>
           <div class="col-xs-7 col-sm-9 col-md-8 col-lg-8">
               <div class="top-menu">
                <div class="sidenav" id="mySidenav">
                    <a class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="banner-img-block">
                        <img src="{{ url('/') }}/public/front/images/logo.png" class="img-responsive" alt="MobiDoctor"/>
                    </div>

                    <?php
                        if(!$user)
                        {
                            ?>
                                <div class="main-menu">
                                    <ul>
                                        <li><a href="javascript:void(0);">Membership</a></li>
                                        <li><a href="{{ url('/') }}/patient/signup">Patient Sign Up</a></li>
                                        <li><a href="{{ url('/') }}/doctor/signup">Doctor Sign Up</a></li>
                                    </ul>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <?php
                    if(!$user)
                    {
                        ?><a class="login-btn" href="#login_modal" data-toggle="modal">Login</a><?php
                    }
                    else
                    {
                        ?><a class="login-btn" href="{{ url('/') }}/logout" data-toggle="modal">Logout</a><?php
                    }
                ?>
                </div>
           </div>
       </div>
    </div>




</header>

<script type="text/javascript">

    var SITE_URL = "{{ url('/') }}";

    /*header script start*/
    function openNav()
    {
        document.getElementById("mySidenav").style.width = "250px";
        $("body").css({
        	//"margin-left": "250px",
        	"overflow-x": "hidden",
        	"transition": "margin-left .5s",
        	"position": "fixed"
        });
        $("#main").addClass("overlay");
    }

    function closeNav()
    {
        document.getElementById("mySidenav").style.width = "0";
        $("body").css({
            "transition": "margin-left .5s",
            "position": "relative"
        });
        $("#main").removeClass("overlay");
    }
    /*header script end*/
        
    /*sticky header*/    
    $(window).scroll(function()
    {
        var sticky = $('header'),
        scroll = $(window).scrollTop();

        if (scroll >= 50)
            sticky.addClass('sticky');
        else
            sticky.removeClass('sticky');
    });    
</script>