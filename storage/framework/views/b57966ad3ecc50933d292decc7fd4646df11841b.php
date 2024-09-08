<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="notification-wrapper">
                    
                    <?php if(isset($arr_notification['data']) && sizeof($arr_notification['data'])>0): ?>
                    <?php foreach($arr_notification['data'] as $value): ?>
                        <div class="notification-strip">
                            <div class="user-img">
                                <?php if(isset($value['user_details']['profile_image']) && $value['user_details']['profile_image']!=''): ?>
                                    <?php if(file_exists($profile_image_base_path.'/'.$value['user_details']['profile_image'])): ?>
                                        <?php $profile_img_src = $profile_image_public_path.'/'.$value['user_details']['profile_image']; ?>
                                    <?php else: ?>
                                        <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?> 
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?>
                                <?php endif; ?>
                                <img src="<?php echo e($profile_img_src); ?>" class="img-responsive" alt=""/>
                            </div>
                            <div class="noti-details">
                                <h5><a href="javascript:void(0)"><?php echo e(isset($value['user_details']['first_name'])?decrypt_value($value['user_details']['first_name']):''); ?> <?php echo e(isset($value['user_details']['last_name'])?decrypt_value($value['user_details']['last_name']):''); ?></a></h5>
                                <span><?php echo e(isset($value['created_at'])?date('d M Y h:i A',strtotime($value['created_at'])):''); ?></span>
                                <p><?php echo e(isset($value['message'])?decrypt_value($value['message']):''); ?></p>

                                <a class="close-icon bg-img" onclick="confirm_action(this,event,'Do you really want to remove this notification?')" href="<?php echo e($module_url_path); ?>/delete/<?php echo e(base64_encode($value['id'])); ?>"></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <div class="white-wrapper prescription-wrapper">
                            <h2>Notification</h2>
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="pagination-block">
                    <?php echo e((isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>