<?php $__env->startSection('main_content'); ?>
<body>
    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#">About us</a> </li>
                </ul>

            </div>
            <div class="about-banner-title">About Us</div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="about-mobidoctor-section">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="about-mobidocto-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/about-mobi-img.png" alt="mobi-img" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-mobidocto-bx">
                        <h2>About MobiDoctor</h2>
                        <div class="about-arib-txt">" We provide best care.It is safe &amp; compassionate care at its
                            best
                            for everyone. "</div>
                        <div class="doctor-description">Occaecati cupiditate non provident, similique sunt in culpa qui
                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum
                            facilis est et expedita distinctio. Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Maecenas id est sed lacus volutpat lobortis. Lorem ipsum dolor sit amet.
                            Et harum quidem rerum facilis est
                            Et harum quidem rerum facilis est et expedita distinctio. Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Maecenas id est sed lacus volutpat lobortis. Lorem ipsum dolor
                            sit amet.</div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>



    <div class="subscribe-benifit">

    <div class="subscribe-benifits-bg">
            <img src="<?php echo e(url('/')); ?>/public/front/images/about-bg-logo.png" alt="Background Logo">
        </div>
        <div class="about-subscribe">
            <div class="subscribe-div">
                <h2>with all our subscribe we can</h2>
                <ul class="subscribe-list">
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                </ul>
                <a href="javascript:void(0)" class="subscribe-now">subscribe now</a>
            </div>
        </div>

        <div class="about-benifit">
            <div class="subscribe-div">
                <h2>the benifits of using MobiDoctor</h2>
                <ul class="subscribe-list">
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Lorem ipsum dolor sit amet.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="home-how-it-section home-section">
        <div class="container">
            <h2></h2>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>Book an appointment</h5>
                        <p>You can queue up to see a doctor in just minutes, or schedule an appointment for a pre-set
                            time that works for you and your busy schedule.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block see-doctor">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>See a doctor online</h5>
                        <p>Using our app or our website, you can talk face-to-face with a certified and licensed
                            UK-based GP. All video chats are fully encrypted,</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="how-it-block feeling-better">
                        <div class="how-it-img bg-img">&nbsp;</div>
                        <h5>Start feeling better</h5>
                        <p>Using our app or our website, you can talk face-to-face with a certified and licensed
                            UK-based GP. All video chats are fully encrypted,</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="we-proud-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="height-div">
                        <div class="proud-section-left">
                            <div class="proud-of-section">
                                <h2>changing lives for the better</h2>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum ea maiores magnam
                                    rem
                                    accusamus mollitia reprehenderit, ad libero dignissimos architecto. Reiciendis
                                    corrupti
                                    eveniet inventore maiores facere est quisquam dolor rem.</p>
                            </div>
                            <div class="customer-stories-btn">
                                <a href="javascript:void(0)">customer stories</a>
                                <a href="javascript:void(0)">work with MobiDoctor</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mobile-dr-none">
                        <div class="proud-img-section">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/doc-img.png" alt="doc" />
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>