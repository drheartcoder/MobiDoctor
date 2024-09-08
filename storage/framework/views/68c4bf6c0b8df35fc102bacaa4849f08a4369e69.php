<?php echo $__env->make('virgil.virgil', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('google.googleapi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<footer id="footer">
   <div class="footer-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-4">
                    <p>&copy; 2019 <a href="<?php echo e(url('/')); ?>">MobiDoctor</a>. All rights reserved.</p>
                </div>
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <ul>
                        <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/about_us">About Us</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/blog">Blog</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/for_doctor">For Doctor</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/for_business">For Business</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/pregnancy">Pregnancy</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/how_it_work">How it Works</a></li>
                        <li><a href="<?php echo e(url('/')); ?>/contact_us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- custom scrollbar plugin -->
<script type="text/javascript" src="<?php echo e(url('/')); ?>/public/front/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel=stylesheet type="text/css" href="<?php echo e(url('/')); ?>/public/front/css/jquery.mCustomScrollbar.css" />

<script type="text/javascript" src="<?php echo e(url('/')); ?>/public/onesignal/OneSignalSDK.js"></script>

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
