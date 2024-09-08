<?php $__env->startSection('main_content'); ?>

<?php $user = Sentinel::check(); ?>

    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a href="<?php echo e(url('/')); ?>/blog">Blogs <i class="fa fa-angle-right"></i></a> </li>
                    <li><a class="active" href="#"><?php echo e(isset($arr_blogs_details['title'])?decrypt_value($arr_blogs_details['title']):''); ?></a> </li>
                </ul>

            </div>
            <div class="about-banner-title">Blog</div>
        </div>
    </div>

    <div class="blog-section main-blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-9">

                    <?php echo $__env->make('front.layout_blog._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="blog-left-section detail-blog-section">
                        <div class="blog-details-img">
                            <?php
                                $image = get_resized_image($arr_blogs_details['image'], $blog_image_base_img_path, 355, 848 );
                            ?>

                            <img src="<?php echo e($image); ?>" alt="blog-1" />
                        </div>
                        <?php Session::put('blog',$arr_blogs_details['slug']); ?>
                        <div class="detail-description-bx">
                            <div class="blog-title"><a href="<?php echo e(url('/')); ?>/blog/<?php echo e($arr_blogs_details['slug']); ?>"><?php echo e(isset($arr_blogs_details['title'])?decrypt_value($arr_blogs_details['title']):''); ?></a></div>
                            <div class="title-line"></div>
                            <div class="blog-tag">
                                <?php $count = 0;
                                      $count = count($arr_blogs_details['category_details']); 
                                ?>
                                <?php foreach($arr_blogs_details['category_details'] as $category_key => $category): ?>
                                    <a href="<?php echo e(url('/')); ?>/blog/topic/<?php echo e(isset($category['blog_category_details']['slug'])?$category['blog_category_details']['slug']:''); ?>"><?php echo e(isset($category['blog_category_details']['name'])?decrypt_value($category['blog_category_details']['name']):''); ?>

                                        <?php if($category_key < ($count-1) ): ?>
                                        /
                                        <?php endif; ?>
                                                       
                                    </a> 
                                <?php endforeach; ?>
                            </div>

                            <div class="description-point-bx">
                                <div class="des-point-txt">
                                    <?php echo isset($arr_blogs_details['description'])?decrypt_value($arr_blogs_details['description']):''; ?>

                                </div>
                            </div>
                        </div>

                        <div class="comments">
                            <h2>Comments</h2>
                            <?php if(isset($arr_blogs_details['blog_comment']) && sizeof($arr_blogs_details['blog_comment'])): ?>
                            <?php foreach($arr_blogs_details['blog_comment'] as $comment_key => $comment): ?>
                            <div class="comment-box">
                                <div class="comment-profile-img">

                                    <?php if($comment['user_details']['user_type'] == 'doctor'): ?>
                                        <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?>
                                        <?php if(isset($comment['user_details']['profile_image']) && $comment['user_details']['profile_image'] != ''): ?>
                                            <?php if(file_exists($doctor_image_base_path.'/'.$comment['user_details']['profile_image'])): ?>
                                                <?php $profile_img_src = $doctor_image_public_path.'/'.$comment['user_details']['profile_image']; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($comment['user_details']['user_type'] == 'patient'): ?>
                                        <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?>
                                        <?php if(isset($comment['user_details']['profile_image']) && $comment['user_details']['profile_image'] != ''): ?>
                                            <?php if(file_exists($patient_image_base_path.'/'.$comment['user_details']['profile_image'])): ?>
                                                <?php $profile_img_src = $patient_image_public_path.'/'.$comment['user_details']['profile_image']; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <img src="<?php echo e($profile_img_src); ?>" alt="profile image">
                                </div>
                                <div class="comment-text">
                                    <h3><?php echo e(isset($comment['user_details']['first_name'])?decrypt_value($comment['user_details']['first_name']):''); ?> <?php echo e(isset($comment['user_details']['last_name'])?decrypt_value($comment['user_details']['last_name']):''); ?></h3>
                                    <time datetime="3.33">
                                        <p><?php echo e(isset($comment['created_at']) ? date('M d ,Y h:i A',strtotime($comment['created_at'])) : ''); ?></p>
                                    </time>
                                    <p class="profile-comment"><?php echo e(isset($comment['comment'])?decrypt_value($comment['comment']):''); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="comments write-comment-section">
                            <h2>Write a Comment</h2>
                            <form name="frm_blog_comment" id="frm_blog_comment" method="post" action="<?php echo e($module_url_path); ?>/comment">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="blog_id" value="<?php echo e(isset($arr_blogs_details['id'])?base64_encode($arr_blogs_details['id']):''); ?>">
                                <input type="hidden" name="user_id" value="<?php echo e(isset($user->id)?base64_encode($user->id):''); ?>">
                                <div class="write-comment-bx-blog">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Name" name="name" id="name"  value="<?php echo e(isset($user->first_name)?decrypt_value($user->first_name):''); ?> <?php echo e(isset($user->last_name)?decrypt_value($user->last_name):''); ?>" readonly />
                                                <div class="error" id="err_first_name"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <input type="type" placeholder="Email" id="email" name="email" value="<?php echo e(isset($user->email)?$user->email:''); ?>" readonly />
                                                <div class="error" id="err_email"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group coment-height">
                                                <textarea placeholder="Comments" id="comment" name="comment" rows="3"></textarea>
                                                <div class="error" id="err_comment"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="coment-send-btn">
                                            <?php if(!$user): ?>
                                            <a class="green-btn" href="#login_modal" data-toggle="modal">Send</a>
                                            <?php else: ?>
                                                <button type="button" class="green-btn" id="btn_blog_comment">Send</button>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="blog-right-bar">
                        <div class="best-mobile-doc">
                            <div class="best-app-down">
                                <a href="#">
                                    <img src="<?php echo e(url('/')); ?>/public/front/images/best-app-2.png" alt="new" />
                                </a>
                            </div>

                            <div class="best-app-down iphone-new-app">
                                <a href="#">
                                    <img src="<?php echo e(url('/')); ?>/public/front/images/bes-app.png" alt="new" />
                                </a>
                            </div>

                        </div>

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
                            <img src="<?php echo e(url('/')); ?>/public/front/images/find-out.png" alt="find" />
                            <div class="from-sub-btn find-learn-more">
                                <a href="javascript:void(0)" class="green-btn">Learn More</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$("#btn_blog_comment").click(function(){
    var comment = $("#comment").val();

    if($.trim(comment) == '')
    {
        $('#comment').focus();
        $('#err_comment').show();
        $('#err_comment').html('Please enter comment.');
        $('#err_comment').fadeOut(4000);
        return false;
    }
    else
    {
        var form = $('#frm_blog_comment')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/comment',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            beforeSend : showProcessingOverlay(),
            success     : function (res)
            {
                hideProcessingOverlay();
                location.reload();
            }
        });
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout_blog.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>