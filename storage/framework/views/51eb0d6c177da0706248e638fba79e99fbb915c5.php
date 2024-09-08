<?php $__env->startSection('main_content'); ?>

<?php
    $user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
    $user_lastname  = isset($user_data['last_name'])  && !empty($user_data['last_name'])  ? decrypt_value($user_data['last_name'])  : '';
    $user_address   = isset($user_data['address'])    && !empty($user_data['address'])    ? decrypt_value($user_data['address'])    : '';
    
    $profile_image   = isset($user_data['profile_image'])   ? $user_data['profile_image']   : '';
    $verified_doctor = isset($user_data['admin_verified']) ? $user_data['admin_verified'] : '';

    if( $verified_doctor == '0' ):
        $div_status = ' disabled';

        $upcoming = $completed = $my_patients = $transactions = 'javascript:void(0)';
    else:
        $div_status  = '';

        $upcoming     = url('/doctor/my_consultation/upcoming');
        $completed    = url('/doctor/my_consultation/completed');
        $my_patients  = url('/doctor/my_patients');
        $transactions = url('/doctor/transactions');
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="row">
                    
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="profile-detail-block doctor-profile">
                            <div class="profile-top-block">
                                <a class="edit" href="<?php echo e($parent_url_path); ?>/my_account/about_me"><i class="fa fa-pencil"></i></a>

                                <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                <?php if(isset($profile_image) && $profile_image!=''): ?>
                                    <?php if(file_exists($doctor_profile_image_base_path.'/'.$profile_image)): ?>
                                        <?php $profile_img_src = $doctor_profile_image_public_path.'/'.$profile_image;  ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <img src="<?php echo e($profile_img_src); ?>" class="img-responsive" alt="MobiDoctor"/>
                            </div>

                            <div class="profile-content">
                                <h5><?php echo e($user_firstname.' '.$user_lastname); ?></h5>
                                <p><?php echo e($user_address); ?></p>
                                <div class="clearfix"></div>
                                <span class="profile-complete"><?php echo e(calculate_profile()); ?>% Completed</span>
                                <div class="doctor-rating">
                                    <span class="total-rating"><?php echo e(number_format($rating,1)); ?></span>
                                    <input class="star required" type="radio" name="rating" value="<?php echo e($rating); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>

                           <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="dash-noti-block">
                            <h4><i class="fa fa-bell-o"></i> Notification <a class="view" href="<?php echo e(url('/')); ?>/doctor/notification">View All</a></h4>
                            <div class="dash-noti-list-wrapper content-d">
                                
                                <?php if(isset($arr_notification) && sizeof($arr_notification)>0): ?>
                                <?php foreach($arr_notification as $notification): ?>
                                    <div class="dash-noti-list">
                                        <?php if(isset($notification['user_details']['profile_image']) && $notification['user_details']['profile_image']!=''): ?>
                                            <?php if(file_exists($profile_image_base_path.'/'.$notification['user_details']['profile_image'])): ?>
                                                <?php $profile_img_src = $profile_image_public_path.'/'.$notification['user_details']['profile_image']; ?>
                                            <?php else: ?>
                                                <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?> 
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?>
                                        <?php endif; ?>
                                        <img class="dash-noti-user img-responsive" src="<?php echo e($profile_img_src); ?>" alt="MobiDoctor"/>
                                        <div class="dash-noti-details">
                                            <h5><?php echo e(isset($notification['user_details']['first_name'])?decrypt_value($notification['user_details']['first_name']):''); ?> <?php echo e(isset($notification['user_details']['last_name'])?decrypt_value($notification['user_details']['last_name']):''); ?></h5>
                                            <p><?php echo e(isset($notification['message'])?decrypt_value($notification['message']):''); ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                    
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 <?php echo e($div_status); ?>">
                        <div class="consultation-section">
                            <h4>Upcoming Consultation</h4>
                            <ul class="content-d">
                                <?php if( isset( $arr_upcoming ) && !empty( $arr_upcoming ) ): ?>
                                    <?php foreach( $arr_upcoming as $upcoming_data ): ?>
                                        <?php
                                            $id = isset( $upcoming_data['id'] ) && !empty( $upcoming_data['id'] ) ? base64_encode( $upcoming_data['id'] ) : '';

                                            $pat_first = isset( $upcoming_data['user_details']['first_name'] ) && !empty( $upcoming_data['user_details']['first_name'] ) ? decrypt_value( $upcoming_data['user_details']['first_name'] ) : '';
                                            $pat_last = isset( $upcoming_data['user_details']['last_name'] ) && !empty( $upcoming_data['user_details']['last_name'] ) ? decrypt_value( $upcoming_data['user_details']['last_name'] ) : '';

                                            $pat_name = $pat_first.' '.$pat_last;

                                            $date = isset( $upcoming_data['date'] ) && !empty( $upcoming_data['date'] ) ? $upcoming_data['date'] : '';
                                            $time = isset( $upcoming_data['time'] ) && !empty( $upcoming_data['time'] ) ? $upcoming_data['time'] : '';

                                            $booking_datetime = convert_datetime($date.' '.$time, 'user', 'datetime');
                                            $consult_datetime = date( "d-m-Y, h:i A", strtotime($booking_datetime) );
                                        ?>
                                        <li>
                                            <span class="cons-details"><?php echo e($pat_name.', '.$consult_datetime); ?></span>
                                            <a class="link" href="<?php echo e(url('/')); ?>/doctor/my_consultation/upcoming/<?php echo e($id); ?>/details">Details</a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found</div> 
                                    </div>
                                <?php endif; ?>
                            </ul>
                            <a class="details-btn" href="<?php echo e($upcoming); ?>"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 <?php echo e($div_status); ?>">
                        <div class="consultation-section">
                            <h4>Completed Consultation</h4>
                            <ul class="content-d">
                                <?php if( isset( $arr_completed ) && !empty( $arr_completed ) ): ?>
                                    <?php foreach( $arr_completed as $completed_data ): ?>
                                        <?php
                                            $id = isset( $completed_data['id'] ) && !empty( $completed_data['id'] ) ? base64_encode( $completed_data['id'] ) : '';

                                            $pat_first = isset( $completed_data['user_details']['first_name'] ) && !empty( $completed_data['user_details']['first_name'] ) ? decrypt_value( $completed_data['user_details']['first_name'] ) : '';
                                            $pat_last = isset( $completed_data['user_details']['last_name'] ) && !empty( $completed_data['user_details']['last_name'] ) ? decrypt_value( $completed_data['user_details']['last_name'] ) : '';

                                            $pat_name = $pat_first.' '.$pat_last;

                                            $date = isset( $completed_data['date'] ) && !empty( $completed_data['date'] ) ? $completed_data['date'] : '';
                                            $time = isset( $completed_data['time'] ) && !empty( $completed_data['time'] ) ? $upcoming_data['time'] : '';

                                            $booking_datetime = convert_datetime($date.' '.$time, 'user', 'datetime');
                                            $consult_datetime = date( "d-m-Y, h:i A", strtotime($booking_datetime) );
                                        ?>
                                        <li>
                                            <span class="cons-details"><?php echo e($pat_name.', '.$consult_datetime); ?></span>
                                            <a class="link" href="<?php echo e(url('/')); ?>/doctor/my_consultation/completed/<?php echo e($id); ?>/details">Details</a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found</div> 
                                    </div>
                                <?php endif; ?>
                            </ul>
                            <a class="details-btn" href="<?php echo e($completed); ?>"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 <?php echo e($div_status); ?>">
                        <div class="consultation-section">
                            <h4>My Patients</h4>
                            <ul class="content-d">
                                <?php if( isset( $arr_patients ) && !empty( $arr_patients ) ): ?>
                                    <?php foreach( $arr_patients as $patients_data ): ?>
                                        <?php
                                            $id = isset( $patients_data['user_details']['id'] ) && !empty( $patients_data['user_details']['id'] ) ? base64_encode( $patients_data['user_details']['id'] ) : '';

                                            $pat_first = isset( $patients_data['user_details']['first_name'] ) && !empty( $patients_data['user_details']['first_name'] ) ? decrypt_value( $patients_data['user_details']['first_name'] ) : '';
                                            $pat_last = isset( $patients_data['user_details']['last_name'] ) && !empty( $patients_data['user_details']['last_name'] ) ? decrypt_value( $patients_data['user_details']['last_name'] ) : '';

                                            $pat_name = $pat_first.' '.$pat_last;
                                        ?>
                                        <li>
                                            <span class="cons-details"><?php echo e($pat_name); ?></span>
                                            <a class="link" href="<?php echo e(url('/')); ?>/doctor/my_patients/patient_history/<?php echo e($id); ?>">Details</a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found</div> 
                                    </div>
                                <?php endif; ?>
                            </ul>
                            <a class="details-btn" href="<?php echo e($my_patients); ?>"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 <?php echo e($div_status); ?>">
                        <div class="consultation-section">
                            <h4>My Transactions</h4>
                            <ul class="content-d">
                                <?php if( isset( $arr_transaction ) && !empty( $arr_transaction ) ): ?>
                                    <?php foreach( $arr_transaction as $transaction ): ?>
                                        <?php
                                            $id         = isset( $transaction['id'] ) && !empty( $transaction['id'] ) ? base64_encode( $transaction['id'] ) : '';
                                            $consult_id = isset( $transaction['consultation_id'] ) && !empty( $transaction['consultation_id'] ) ? $transaction['consultation_id'] : '';
                                            $invoice_no = isset( $transaction['invoice_no'] ) && !empty( $transaction['invoice_no'] ) ? $transaction['invoice_no'] : '';
                                            $amount     = isset( $transaction['amount'] ) && !empty( $transaction['amount'] ) ? $transaction['amount'] : '';
                                        ?>
                                        <li>
                                            <span class="cons-details"><?php echo e($consult_id); ?></span>
                                            <span class="price-div2"><i class="fa fa-eur"></i> <?php echo e($amount); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found</div> 
                                    </div>
                                <?php endif; ?>
                            </ul>
                            <a class="details-btn" href="<?php echo e($transactions); ?>"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>