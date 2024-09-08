<?php $__env->startSection('main_content'); ?>

<body>

    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#">Contact Us</a> </li>
                </ul>
            </div>
            <div class="about-banner-title">Contact Us</div>
        </div>
    </div>

    <div class="get-in-touch">
        <div class="container">
            <div class="row">
                <div class="get-in-touch-flex">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="contact-section-title">
                            <h2>how to <span>get in touch</span></h2>
                        </div>
                        <div class="contact-section-para">
                            <p>Our customer experience team is available to answer your questions every day, between
                                7am - 8pm.</p>
                        </div>
                        <div class="contact-us-btn">
                            <a href="<?php echo e(url('/')); ?>">go to homepage</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="get-in-touch-chat">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/contact-us-section-1-chat.png" alt="Get In Touch Through Our Chat">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="send-email">
        <div class="container">
            <div class="row">
                <div class="send-email-flex">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="contact-section-title">
                            <h2>send us an <span>email</span></h2>
                        </div>
                        <div class="contact-section-para send-email-para">
                            <p>Email the support team at <a href="mailto:support@mobidoctor.com">support@mobidoctor.com</a></p>
                            <p>and they'll get back to you as soon as possible.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="faq-flex">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="contact-section-title">
                            <h2>Frequently Asked <span>Questions</span></h2>
                        </div>
                        <div class="contact-section-para">
                            <p>We answer many of our customer's frequently answered questions in our help centre.</p>
                        </div>
                        <div class="contact-us-btn faq-btn">
                            <a href="javascript:void(0)">help center</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="medical-complaints">
        <div class="container">
            <div class="row">
                <div class="medical-flex">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="contact-section-title">
                            <h2>medical <span>complaints</span></h2>
                        </div>
                        <div class="contact-section-para medical-para">
                            <p>If you would like to make a complaint regarding the medical service you received during
                                your consultation, please log in here to do so. </p>
                        </div>
                        <div class="contact-us-btn faq-btn">
                            <a href="#login_modal" data-toggle="modal">login</a>
                        </div>
                    </div>
                    <div class="medical-bg-img">
                        <img src="<?php echo e(url('/')); ?>/public/front/images/contact-us-section-1-medical-complaints.png" alt="Doctor">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>