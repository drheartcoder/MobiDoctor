<?php $__env->startSection('main_content'); ?>

<div class="home-banner-section about-banner-section">
    <div class="container">
        <div class="breadcrumb-section">
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                <li><a href="<?php echo e(url('/')); ?>/what-we-treat">What We Treat <i class="fa fa-angle-right"></i></a> </li>
                <li><a href="<?php echo e(url('/')); ?>/what-we-treat/<?php echo e($arr_subcategory_details[0]['category_details']['slug']); ?>"><?php echo e(isset($arr_subcategory_details[0]['category_details']['name'])?decrypt_value($arr_subcategory_details[0]['category_details']['name']):''); ?> <i class="fa fa-angle-right"></i></a> </li>

                <li><a class="active" href="#"><?php echo e(isset($arr_subcategory_details[0]['sub_category_details']['name'])?decrypt_value($arr_subcategory_details[0]['sub_category_details']['name']):''); ?></a> </li>
            </ul>

        </div>
        <div class="about-banner-title"><?php echo e(isset($arr_subcategory_details[0]['sub_category_details']['name'])?decrypt_value($arr_subcategory_details[0]['sub_category_details']['name']):''); ?></div>

    </div>
</div>

<div class="skin-grey-bck">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="left-see-dr-btn">
                    <a href="#login_modal" data-toggle="modal">See A Doctor Now</a>
                </div>
            </div>
            <?php
                    $is_investigation_details = '';
                    $record_count = 0;
                    $record_count = sizeof($arr_subcategory_details);
                    if($record_count == '1')
                    {
                        $is_investigation_details = isset($arr_subcategory_details[0]['is_investigation_details'])?$arr_subcategory_details[0]['is_investigation_details']:'';
                    }
                    else
                    {
                        $is_investigation_details = isset($arr_subcategory_details[0]['is_investigation_details'])?$arr_subcategory_details[0]['is_investigation_details']:'';
                    }
             ?>
            <?php if(isset($arr_tab_details) && count($arr_tab_details)>0): ?>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    
                    <div class="overview-section">
                        <div class="mobile-over-view-menu">Menu<span><i class="fa fa-angle-down"></i></span></div>
                        <ul class="services-nav">
                            <?php foreach($arr_tab_details as $tab_key => $tab_value): ?>
                                <?php if($tab_key == '0'): ?>
                                    <li class="responsive-service-open"> <a  <?php if($tab_slug == false): ?> class="active" <?php endif; ?> href="<?php echo e($module_url_path); ?>/<?php echo e($category_slug); ?>/<?php echo e($sub_category_slug); ?>"><?php echo e(isset($tab_value['tab_slug'])?$tab_value['tab_slug']:''); ?></a></li>
                                <?php else: ?>
                                    <li class="responsive-service-open"> <a  <?php if($tab_slug == $tab_value['tab_slug']): ?> class="active" <?php endif; ?> href="<?php echo e($module_url_path); ?>/<?php echo e($category_slug); ?>/<?php echo e($sub_category_slug); ?>/<?php echo e(isset($tab_value['tab_slug'])?$tab_value['tab_slug']:''); ?>"><?php echo e(isset($tab_value['tab_name'])?$tab_value['tab_name']:''); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="main-tab-box">

            <?php if(isset($is_investigation_details) && $is_investigation_details =='No'): ?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="menu-section-block">
                        <div class="skin-left-bar-section">
                            <ul id="menu">
                                <?php if(isset($arr_subcategory_details[0]['get_question_answer']) && sizeof($arr_subcategory_details[0]['get_question_answer'])>0): ?>
                                    <?php foreach($arr_subcategory_details[0]['get_question_answer'] as $question_key => $question_value): ?>
                                        <li><a href="#tab-<?php echo e($question_key+1); ?>" <?php if($question_key == '0'): ?> class="active" <?php endif; ?>><i class="fa fa-angle-double-right"></i><?php echo e(isset($question_value['question'])?$question_value['question']:''); ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="right-bar-skin overview-detail">
                        <?php foreach($arr_subcategory_details[0]['get_question_answer'] as $ans_key => $ans_value): ?>
                        <div class="section" id="tab-<?php echo e($ans_key+1); ?>">
                            <div class="what-acne-bx">
                                <div class="symptom-que-title"><?php echo e(isset($ans_value['question'])?$ans_value['question']:''); ?></div>
                                <div class="common-skin-points"><?php echo isset($ans_value['answer'])?$ans_value['answer']:''; ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif(isset($is_investigation_details) && $is_investigation_details =='Yes'): ?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="menu-section-block">
                        <div class="skin-left-bar-section">
                            <ul id="menu">
                                <?php if(isset($arr_subcategory_details[0]['get_question_answer']) && sizeof($arr_subcategory_details[0]['get_question_answer'])>0): ?>
                                    <?php foreach($arr_subcategory_details[0]['get_question_answer'] as $question_key => $question_value): ?>
                                        <li><a href="#tab-<?php echo e($question_key+1); ?>" <?php if($question_key == '0'): ?> class="active" <?php endif; ?>><i class="fa fa-angle-double-right"></i><?php echo e(isset($question_value['question'])?$question_value['question']:''); ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="right-bar-skin overview-detail">
                        <?php foreach($arr_subcategory_details[0]['get_question_answer'] as $ans_key => $ans_value): ?>
                        <div class="section" id="tab-<?php echo e($ans_key+1); ?>">
                            <div class="what-acne-bx">
                                <div class="symptom-que-title"><?php echo e(isset($ans_value['question'])?$ans_value['question']:''); ?></div>
                                <div class="common-skin-points"><?php echo isset($ans_value['answer'])?$ans_value['answer']:''; ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("scroll", onScroll);
        //smoothscroll
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            $(document).off("scroll");
            $('a').each(function() {
                $(this).removeClass('active');
            })
            $(this).addClass('active');
            var target = this.hash,
                menu = target;
            $target = $(target);
            var offset = $target.offset().top;
            $('html, body').stop().animate({
                'scrollTop': offset - 150
            }, 500, 'swing', function() {
                //            window.location.hash = target;
                $(document).on("scroll", onScroll);
            });
        });
    });

    function onScroll(event) {
        var scrollPos = $(document).scrollTop() + 600;
        //    alert(scrollPos);
        $('#menu a').each(function() {
            var currLink = $(this);
            var refElement = $(currLink.attr("href"));
            //console.log(refElement.position().top + '+' + refElement.height() + '==' + scrollPos);
            if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                $('#menu ul li a').removeClass("active");
                currLink.addClass("active");
            } else {
                currLink.removeClass("active");
            }
        });
    }
</script>
<!--Sticky Menu-->
<script type="text/javascript">
    $(document).ready(function() {
        var stickyNavTop = $('.menu-section-block').offset().top - 150;

        var stickyNav = function() {
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                $('.menu-section-block').addClass('sticky');
            } else {
                $('.menu-section-block').removeClass('sticky');
            }
        };

        stickyNav();

        $(window).scroll(function() {
            stickyNav();
        });
    })
</script>
<!--Sticky Menu-->

<script>
    var doc_width = $(document).width();
    if (doc_width < 768) {
        $(".mobile-over-view-menu").on("click", function() {
            $(this).siblings(".services-nav").slideToggle("slow");
        });

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout_blog.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>