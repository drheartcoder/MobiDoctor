<?php $__env->startSection('main_content'); ?>

    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="#">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#">Blog</a> </li>
                </ul>

            </div>
            <div class="about-banner-title">Blog</div>

        </div>
    </div>

    <div class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="blog-left-section">
                        <div class="row">
                            <?php if(isset($arr_blogs['data']) && sizeof($arr_blogs['data'])>0): ?>
                            <?php foreach($arr_blogs['data'] as $blogs): ?>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="blog-new-box">
                                        <div class="blog-img">
                                            <?php
                                             $image = get_resized_image($blogs['image'], $blog_image_base_img_path, 243, 409 );
                                            ?>
                                            <img src="<?php echo e($image); ?>" alt="blog-1" />
                                        </div>
                                        <div class="blog-txt-new-bx">

                                            <div class="blog-title"><a href="<?php echo e(url('/')); ?>/blog/<?php echo e($blogs['slug']); ?>"><?php echo e(isset($blogs['title'])?decrypt_value($blogs['title']):''); ?></a></div>
                                            <div class="title-line"></div>
                                            <div class="blog-tag">
                                                <?php $count = 0;
                                                      $count = count($blogs['category_details']); 
                                                ?>
                                                <?php foreach($blogs['category_details'] as $category_key => $category): ?>
                                                    <a href="<?php echo e(url('/')); ?>/blog/topic/<?php echo e(isset($category['blog_category_details']['slug'])?$category['blog_category_details']['slug']:''); ?>"><?php echo e(isset($category['blog_category_details']['name'])?decrypt_value($category['blog_category_details']['name']):''); ?>

                                                        <?php if($category_key < ($count-1) ): ?>
                                                        /
                                                        <?php endif; ?>
                                                       
                                                    </a>  
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <div class="no-data-found">
                                    No Data found
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="pagination-block">
                        <?php echo e((isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''); ?>

                    </div>
                    
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="blog-right-bar">
                        <div class="best-mobile-doc">
                            <div class="best-app-down">
                                <a href="#">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/best-app-2.png" alt="new"/>
                                    </a>
                            </div>
                            
                            <div class="best-app-down iphone-new-app">
                                <a href="#">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/bes-app.png" alt="new"/>
                                    </a>
                            </div>
                        
                        </div>
                        
                        <?php if(isset($arr_blogs_category) && sizeof($arr_blogs_category)>0): ?>
                        <div class="most-popular-blog-bx">
                            <div class="most-popular-title">View By Topic</div>
                            <div class="topic-category-section">
                                <ul>
                                    <?php foreach($arr_blogs_category as $blogs_category): ?>
                                    <li><a href="<?php echo e($module_url_path); ?>/topic/<?php echo e($blogs_category['slug']); ?>"><?php echo e(isset($blogs_category['name'])?decrypt_value($blogs_category['name']):''); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        
                        <div class="most-popular-blog-bx">
                            <div class="most-popular-title">Most Popular Post</div>
                           
                            <?php if(isset($arr_popular_blog) && sizeof($arr_popular_blog)>0): ?>
                            <?php foreach($arr_popular_blog as $popular_blog): ?>
                            <a href="<?php echo e($module_url_path); ?>/<?php echo e($popular_blog['slug']); ?>">
                                <div class="post-popular-ad-bx">
                                    <div class="popular-ad-img">
                                        <?php
                                            $popular_image = get_resized_image($popular_blog['image'], $blog_image_base_img_path, 70, 65 );
                                        ?>
                                        <img src="<?php echo e($popular_image); ?>" alt="blog-1" />
                                    </div>

                                    <div class="popular-ad-txt-bx">
                                        <div class="pop-ad-title"><?php echo e(isset($popular_blog['title'])?decrypt_value($popular_blog['title']):''); ?></div>
                                        <div class="pop-by">by <?php echo e(isset($popular_blog['posted_by'])?decrypt_value($popular_blog['posted_by']):''); ?></div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        
                        <div class="find-out-more">
                            <img src="<?php echo e(url('/')); ?>/public/front/images/find-out.png" alt="find"/>
                            <div class="from-sub-btn find-learn-more">
                                <a href="javascript:void(0)" class="green-btn">Learn More</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout_blog.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>