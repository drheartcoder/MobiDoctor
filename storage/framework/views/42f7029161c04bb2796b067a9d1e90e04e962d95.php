<?php $__env->startSection('main_content'); ?>
    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="<?php echo e(url('/')); ?>/what-we-treat">What We Treat</a> </li>
                </ul>
            </div>
            <div class="about-banner-title">What We Treat</div>
        </div>
    </div>

    <?php if(isset($arr_category) && sizeof($arr_category)>0): ?>
<div class="category-bck-color">
        <div class="container">
           
            <div class="what-we-treat-img-grid">             
                <?php foreach($arr_category as $category_key => $category): ?>
               
                     <div class="what-we-treat-1">   
                    <a href="<?php echo e($module_url_path); ?>/<?php echo e(isset($category['slug'])?$category['slug']:'javascript:void(0);'); ?>">
                        
                            <?php
                             $image = get_resized_image($category['image'], $category_img_base_path, 292, 380 );
                            ?>
                            <img src="<?php echo e($image); ?>" alt="<?php echo e(isset($category['name'])?decrypt_value($category['name']):'-'); ?>" />
                          
                            <p><?php echo e(isset($category['name'])?decrypt_value($category['name']):'-'); ?></p>
                             </a>
                        </div>
                <?php endforeach; ?>
                </div>
           </div>
        </div>
    <?php else: ?> 
        No data available.
    <?php endif; ?>
    
   <?php /*  <div class="container">
        <div class="what-we-treat-btn">
            <a href="javascript:void(0)">view more</a>
        </div>
    </div> */ ?>

    <div class="what-we-treat-section-2">
        <div class="container">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-2-png-1.png" alt="book appointment">
                <h2 class="treat-group-title">book an appointment</h2>
                <p class="treat-group-para">Be seen in minutes, or choose a time that suits you</p>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4">
                <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-2-png-2.png" alt="book appointment">
                <h2 class="treat-group-title">Speak To a Doctor Online</h2>
                <p class="treat-group-para">Based on location, schedule & reviews</p>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4">
                <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-2-png-1.png" alt="book appointment">
                <h2 class="treat-group-title">Start Feeling Better</h2>
                <p class="treat-group-para">Click to book most convenient time</p>
            </div>
        </div>
    </div>

    <div class="what-we-treat-section-3">
        <div class="container">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <h2 class="treat-section-3-title">safe, effective, efficient</h2>
                <p class="treat-section-3-para">Mobi Doctor is regulated by the Care Quality Commission (CQC),
                    the body responsible for regulating health and social care in the UK.</p>
                <p class="treat-message-box">All our GPs are registered with the General Medical Council (GMC), the
                    organisation which regulates medical practitioners in Britain. And when they're not on Mobi Doctor,
                    they practice in NHS and private surgeries around the country.</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="treat-section-3-right">
                    <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-3-right.png" alt="doctor and nurse">
                </div>
            </div>
        </div>
        <div class="container">

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="treat-section-3-right treat-left">
                    <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-3-left.png" alt="doctor and nurse">
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <h2 class="treat-section-3-title">other conditions</h2>
                <p class="treat-section-3-para">Mobi Doctor is regulated by the Care Quality Commission (CQC),
                    the body responsible for regulating health and social care in the UK.</p>
                <p class="treat-message-box">All our GPs are registered with the General Medical Council (GMC), the
                    organisation which regulates medical practitioners in Britain. And when they're not on Push Doctor,
                    they practice in NHS and private surgeries around the country.</p>
            </div>
        </div>
    </div>

    <div class="what-we-treat-section-4">
        <div class="container">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="membership-left">
                    <h2 class="membership-left-title">membership</h2>
                    <p class="membership-left-pars">Save on appointment costs, prescriptions,
                        health content and much more</p>
                    <a href="<?php echo e(url('/')); ?>/membership">find out more</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <img src="<?php echo e(url('/')); ?>/public/front/images/what-we-treat-section-4-right.png" alt="membership">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout_blog.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>