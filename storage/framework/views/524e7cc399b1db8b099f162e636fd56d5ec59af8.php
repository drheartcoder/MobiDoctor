<?php $__env->startSection('main_content'); ?>
<body>
    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#"><?php echo e(isset($page_title) ? $page_title : ''); ?></a> </li>
                </ul>

            </div>
            <div class="about-banner-title"><?php echo e(isset($page_title) ? $page_title : ''); ?></div>

        </div>
    </div>


     <div class="Compare-benefit-section">
        <div class="container">
            <div class="Compare-benefit-title">Compare the Benefits of an All-inclusive Membership Package</div>
            <div class="row">
                <div class="member-ship-section-bx">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-lg-offset-2  ">
                        <div class="month-membership-bx">
                            <div class="your-member-bx">
                                <div class="your-member-title"><?php echo e(isset($arr_subscription_plan[0]['name'])?$arr_subscription_plan[0]['name']:''); ?></div>
                                <div class="clearfix"></div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[0]['consultation_price']) ? $arr_subscription_plan[0]['consultation_price'].'&#128;' : ''); ?>

                                    <h3>per consultation</h3>
                                </div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[0]['monthly_price']) ? $arr_subscription_plan[0]['monthly_price'].'&#128;' : ''); ?>

                                    <h3>per month</h3>
                                </div>
                            </div>
                            <div class="membership-description">
                                <ul>
                                    <li>Prescription fee <span><?php echo e(isset($arr_subscription_plan[0]['prescription_fee']) ? $arr_subscription_plan[0]['prescription_fee'].'&#128;' : ''); ?></span></li>
                                    <li>Sicknote <span><?php echo e(isset($arr_subscription_plan[0]['sick_note']) ? $arr_subscription_plan[0]['sick_note'].'&#128;' : ''); ?></span></li>
                                    <li>Referrals <span><?php echo e(isset($arr_subscription_plan[0]['referrals']) ? $arr_subscription_plan[0]['referrals'].'&#128;' : ''); ?></span></li>
                                    <li>Membership discounts <span><?php if(isset($arr_subscription_plan[0]['is_membership_discount']) && $arr_subscription_plan[0]['is_membership_discount'] == 'Yes'): ?> <i class="fa fa-check"></i> <?php else: ?> <i class="fa fa-times"></i><?php endif; ?></span></li>
                                </ul>
                            </div>
                            <div class="member-book-btn">
                                <a class="book-now-btn" href="#">Become a member</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="month-membership-bx member-block">
                            <div class="your-member-bx">
                                <div class="your-member-title"><?php echo e(isset($arr_subscription_plan[1]['name']) ? $arr_subscription_plan[1]['name'] : ''); ?></div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[1]['consultation_price']) ? $arr_subscription_plan[1]['consultation_price'].'&#128;' : ''); ?>

                                    <h3>per consultation</h3>
                                </div>
                                <div class="member-ship-price"><?php echo e(isset($arr_subscription_plan[1]['monthly_price']) ? $arr_subscription_plan[1]['monthly_price'].'&#128;' : ''); ?>

                                    <h3>per month</h3>
                                </div>
                            </div>

                            <div class="membership-description">
                                <ul>
                                    <li>Prescription fee <span><?php echo e(isset($arr_subscription_plan[1]['prescription_fee']) ? $arr_subscription_plan[1]['prescription_fee'].'&#128;' : ''); ?></span></li>
                                    <li>Sicknote <span><?php echo e(isset($arr_subscription_plan[1]['sick_note']) ? $arr_subscription_plan[1]['sick_note'].'&#128;' : ''); ?></span></li>
                                    <li>Referrals <span><?php echo e(isset($arr_subscription_plan[1]['referrals']) ? $arr_subscription_plan[1]['referrals'].'&#128;' : ''); ?></span></li>
                                    <li>Membership discounts <span><?php if(isset($arr_subscription_plan[0]['is_membership_discount']) && $arr_subscription_plan[0]['is_membership_discount'] == 'No'): ?> <i class="fa fa-times"></i> <?php else: ?> <i class="fa fa-times"></i><?php endif; ?></span></li>
                                </ul>
                            </div>
                            <div class="member-book-btn">
                                <a class="book-now-btn" href="#">Book an appointment</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  

</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>