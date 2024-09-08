 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8 />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <meta http-equiv=X-UA-Compatible content="IE=edge" />

    <meta name=author content="<?php echo e(isset($author) ? $author : config('app.project.name')); ?>"/>
    <meta name=description content="<?php echo e(isset($meta_desc) ? $meta_desc : ''); ?>"/>
    <meta name=keywords content="<?php echo e(isset($meta_keyword) ? $meta_keyword : ''); ?>" />
    
    <title><?php echo e(isset($page_title) ? $page_title : ''); ?></title>

    <meta property="og:description" content="<?php echo e(isset($meta_desc) ? $meta_desc : ''); ?>">
    <meta property="og:title" content="<?php echo e(isset($meta_title) ? $meta_title : ''); ?>">
    <meta name="twitter:description" content="<?php echo e(isset($meta_desc) ? $meta_desc : ''); ?>">
    <meta name="twitter:title" content="<?php echo e(isset($meta_title) ? $meta_title : ''); ?>">


    <link rel=icon type="image/png" sizes=16x16 href="<?php echo e(url('/')); ?>/favicon.ico">
    <!--css-->
    <link href="<?php echo e(url('/')); ?>/public/front/css/bootstrap.min.css" rel=stylesheet type="text/css" />
    <link href="<?php echo e(url('/')); ?>/public/front/css/font-awesome.min.css" rel=stylesheet type="text/css" />
    <link href="<?php echo e(url('/')); ?>/public/front/css/mobi-doctor.css" rel=stylesheet type="text/css" /> 

    <!--main js start-->
    <script src="<?php echo e(url('/')); ?>/public/front/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/front/js/bootstrap.min.js"></script>
    <!--main js end-->

    <link href="<?php echo e(url('/')); ?>/public/front/css/loading.css" rel="stylesheet"/>
    <script async src="<?php echo e(url('/')); ?>/public/front/js/loader.js"></script>

</head>

<?php 
        $is_valid_user_login = false;

        $obj_user = Sentinel::check(); 
        if(isset($obj_user->user_type) && ($obj_user->user_type == 'patient' || $obj_user->user_type == 'doctor')){
            $is_valid_user_login = true;
        }

        $user = Sentinel::check(); 

?>
<?php if(!$is_valid_user_login): ?>
<header class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo e(url('/')); ?>" class="logo">
                    <img src="<?php echo e(url('/')); ?>/public/front/images/logo.png" class="img-responsive logo-white" alt="MobiDoctor" />
                    <img src="<?php echo e(url('/')); ?>/public/front/images/logo-black.png" class="img-responsive logo-black" alt="MobiDoctor" />
                </a>
            </div>
             <a class="see-doctor-sticky" href="#login_modal" data-toggle="modal">See a Doctor</a>
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <div class="col-xs-7 col-sm-9 col-md-9 col-lg-9">
                <div class="top-menu">
                   
                    <div class="sidenav" id="mySidenav">
                        <a class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="banner-img-block">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/logo.png" class="img-responsive" alt="MobiDoctor" />
                        </div>
                        <div class="main-menu">
                            <ul>
                                
                                <li><a href="<?php echo e(url('/')); ?>/what-we-treat">What We Treat</a></li>
                                <li><a href="<?php echo e(url('/')); ?>/membership">Membership</a></li>
                                <?php if(Request::segment(1) == 'for_doctor'): ?>
                                    <li><a href="<?php echo e(url('/')); ?>/doctor/signup">Doctor Sign Up</a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo e(url('/')); ?>/patient/signup">Patient Sign Up</a></li>
                                <?php endif; ?>
                                <li class="normal-login-mobile"><a href="#login_modal" data-toggle="modal">Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <a class="login-btn" data-backdrop="static" data-keyboard="false" href="#login_modal" data-toggle="modal">Login</a>
                </div>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>

<?php if(isset($user->user_type) && $user->user_type == 'patient'): ?>
    <div id="header" class="inner-header">
        <header>
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-xs-5 col-sm-3 col-md-4 col-lg-4">
                        <a href="<?php echo e(url('/')); ?>" class="logo">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/logo-black.png" class="img-responsive logo-black" alt="MobiDoctor"/>
                        </a>
                    </div>
                  
                    <div class="col-xs-7 col-sm-9 col-md-8 col-lg-8 pad-l-0">
                        <div class="after-login-menu">
                            <ul>
                                <li>
                                    <div class="noti-block relative-block">
                                        <div class="noti-icon bg-img">&nbsp;</div>
                                        <span class="badge">10</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile-drop-block relative-block">
                                        <div class="profile-name">
                                            <?php
                                                /*$user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
                                                $user_lastname  = isset($user_data['last_name']) && !empty($user_data['last_name']) ? decrypt_value($user_data['last_name']) : '';
                                                $profile_image  = isset($user_data['profile_image']) ? $user_data['profile_image'] : '';*/
                                                $social_login   = isset($user_data['social_login']) ? $user_data['social_login'] : '';
                                            ?>
                                            <b><?php echo e($user_firstname.' '.$user_lastname); ?></b>
                                            <span>
                                            <?php if(isset($profile_image) && $profile_image!=''): ?>
                                                <?php if(file_exists($patient_profile_image_base_path.'/'.$profile_image)): ?>
                                                    <?php $profile_img_src = $patient_profile_image_public_path.'/'.$profile_image;  ?>
                                                <?php else: ?>
                                                    <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                            <?php endif; ?>

                                            <?php if( $social_login == 'yes' ): ?>
                                                <?php $profile_img_src = $profile_image; ?>
                                            <?php endif; ?>

                                                <img src="<?php echo e($profile_img_src); ?>" class="img-responsive" alt="MobiDoctor"/>
                                            </span>
                                        </div>
                                        <ul>
                                            <li><a href="<?php echo e(url('/')); ?>/patient/dashboard">Dashboard <i class="fa fa-tachometer"></i></a></li>
                                            <li><a href="<?php echo e(url('/')); ?>/patient/my_account/about_me">My account <i class="fa fa-user"></i></a></li>
                                            <li><a href="<?php echo e(url('/')); ?>/logout">Log out <i class="fa fa-sign-out"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </header>
    </div>
<?php endif; ?>

<?php if(isset($user->user_type) && $user->user_type == 'doctor'): ?>
    <div id="header" class="inner-header">
        <header>
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-xs-5 col-sm-3 col-md-4 col-lg-4">
                        <a href="<?php echo e(url('/')); ?>" class="logo">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/logo-black.png" class="img-responsive logo-black" alt="MobiDoctor"/>
                        </a>
                    </div>
                  
                    <div class="col-xs-7 col-sm-9 col-md-8 col-lg-8 pad-l-0">
                        <div class="after-login-menu">
                            <ul>
                                <li>
                                    <div class="noti-block relative-block">
                                        <div class="noti-icon bg-img">&nbsp;</div>
                                        <span class="badge">10</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile-drop-block relative-block">
                                        <div class="profile-name">
                                            <?php
                                                /*$user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
                                                $user_lastname  = isset($user_data['last_name']) && !empty($user_data['last_name']) ? decrypt_value($user_data['last_name']) : '';
                                                $profile_image  = isset($user_data['profile_image']) ? $user_data['profile_image'] : '';*/
                                            ?>
                                            <b><?php echo e($user_firstname.' '.$user_lastname); ?></b>
                                            <span>
                                            <?php if(isset($profile_image) && $profile_image!=''): ?>
                                                <?php if(file_exists($doctor_profile_image_base_path.'/'.$profile_image)): ?>
                                                    <?php $profile_img_src = $doctor_profile_image_public_path.'/'.$profile_image;  ?>
                                                <?php else: ?>
                                                    <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                            <?php endif; ?>

                                                <img src="<?php echo e($profile_img_src); ?>" class="img-responsive" alt="MobiDoctor"/>
                                            </span>
                                        </div>
                                        <ul>
                                            <li><a href="<?php echo e(url('/')); ?>/doctor/dashboard">Dashboard <i class="fa fa-tachometer"></i></a></li>
                                            <li><a href="<?php echo e(url('/')); ?>/doctor/my_account/about_me">My account <i class="fa fa-user"></i></a></li>
                                            <li><a href="<?php echo e(url('/')); ?>/logout">Log out <i class="fa fa-sign-out"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </header>
    </div>
<?php endif; ?>

<script type="text/javascript">

    var SITE_URL = "<?php echo e(url('/')); ?>";

    /*header script start*/
    function openNav() {
        // document.getElementById("mySidenav").style.width = "250px";
        $(".sidenav").addClass("act-menu");
        $("body").css({
            //"margin-left": "250px",
            "overflow-x": "hidden",
            "transition": "margin-left .5s",
        });
        // $("#main").addClass("overlay");
    }

    function closeNav() {
        // document.getElementById("mySidenav").style.width = "0";
        $(".sidenav").removeClass("act-menu");
        $("body").css({
            //"margin-left": "0px",
            "transition": "margin-left .5s",
//            "position": "relative"
        });
        // $("#main").removeClass("overlay");
    }


        $(window).scroll(function() {
        var actmenu = $('.sidenav'),
            scroll = $(window).scrollTop();

        if (scroll >= 50) actmenu.addClass('');
        else actmenu.removeClass('act-menu');
        

    });
    /*header script end*/

    /*sticky header*/
    $(window).scroll(function() {
        var sticky = $('header'),
            scroll = $(window).scrollTop();

        if (scroll >= 50) sticky.addClass('sticky');
        else sticky.removeClass('sticky');
 

    });
</script>