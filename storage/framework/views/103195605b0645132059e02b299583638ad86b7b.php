<?php $__env->startSection('main_content'); ?>

<?php
    $view_type = isset( $user_view_type ) && !empty( $user_view_type ) ? $user_view_type : '';
?>

	<div class="page-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-md-3 col-lg-3">
                    <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                
                <div class="col-sm-8 col-md-9 col-lg-9">
                    
                    <div class="grid-box-section">
                        <div class="list-grid-view view_type" id="grid_view" data-view_type="grid">
                            <a href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
                        </div>
                        <div class="list-grid-view view_type" id="list_view" data-view_type="list">
                            <a href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
                        </div>
                    </div>

                    <div class="my-consultation-wrapper row">
                        
                        <?php if( isset( $arr_consultation['data'] ) && !empty( $arr_consultation['data'] ) ): ?>

                            <?php foreach( $arr_consultation['data'] as $consult ): ?>
                                
                                <?php
                                    $id = isset( $consult['id'] ) && !empty( $consult['id'] ) ? base64_encode( $consult['id'] ) : '';
                                    $consult_id   = isset( $consult['consultation_id'] ) && !empty( $consult['consultation_id'] ) ? base64_encode( $consult['consultation_id'] ) : '';
                                    $consult_date = isset( $consult['date'] ) && !empty( $consult['date'] ) ? $consult['date'] : '';
                                    $consult_time = isset( $consult['time'] ) && !empty( $consult['time'] ) ? $consult['time'] : '';

                                    $booking_datetime = convert_datetime($consult_date.' '.$consult_time, 'user', 'datetime');
                                    $consult_datetime = date( "h:i A, l d F, Y", strtotime($booking_datetime) );

                                    $pat_first_name = isset( $consult['user_details']['first_name'] ) && !empty( $consult['user_details']['first_name'] ) ? decrypt_value( $consult['user_details']['first_name'] ) : '';
                                    $pat_last_name = isset( $consult['user_details']['last_name'] ) && !empty( $consult['user_details']['last_name'] ) ? decrypt_value( $consult['user_details']['last_name'] ) : '';

                                    $pat_name = $pat_first_name.' '.$pat_last_name;

                                    $pat_profile_img = isset( $consult['user_details']['profile_image'] ) && !empty( $consult['user_details']['profile_image'] ) ? $consult['user_details']['profile_image'] : '';

                                    $pat_img_src = $default_img_path .'/profile.jpeg';
                                    if(isset($pat_profile_img) && $pat_profile_img != '' && file_exists($patient_image_base_path.'/'.$pat_profile_img)):
                                        $pat_img_src = $patient_image_public_path.'/'.$pat_profile_img;
                                    endif;
                                ?>

                                <div class="col-sm-6 col-md-6 col-lg-6 list_view" style="display: none;">
                                    <div class="doctoe-consultation-section">
                                        <a href="<?php echo e($module_url_path.'/upcoming/'.$id); ?>/details">
                                            <div class="consultation-img">
                                                <img src="<?php echo e($pat_img_src); ?>" alt="dr" />
                                            </div>
                                            <div class="consultation-tct-box">
                                                <div class="consultation-name"><?php echo e($pat_name); ?></div>
                                                <div class="consultation-date"><?php echo e($consult_datetime); ?></div>
                                                <div class="confirmed-msg">Pending</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-4 grid_view" style="display: none;">
                                    <div class="patient-photo-bx">
                                        <a href="<?php echo e($module_url_path.'/upcoming/'.$id); ?>/details">
                                            <div class="patient-image-new">
                                                <img src="<?php echo e($pat_img_src); ?>" alt="" />
                                            </div>
                                            <div class="patient-status-name"><?php echo e($pat_name); ?></div>
                                            <div class="patient-birth-date"><?php echo e($consult_datetime); ?></div>
                                            <div class="confirmed-msg">Pending</div>
                                        </a>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        <?php endif; ?>

                    </div>

                    <?php if( isset( $paginate ) && !empty( $paginate ) ): ?>
                        <?php echo e($paginate); ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            var selected_view = "<?php echo e($view_type); ?>";
            view_type(selected_view);

            $(".view_type").click(function() {
                var selected_view = ($(this).data("view_type") == "list") ? "list" : "grid";
                
                view_type(selected_view);
                change_view(selected_view);
            });
        });

        function view_type(selected_view)
        {
            var active_type = (selected_view == "list") ? "list" : "grid";
            var deactive_type = (active_type != "list") ? "list" : "grid";

            $("."+active_type+"_view").show();
            $("."+deactive_type+"_view").hide();

            $("#"+active_type+"_view").addClass("active");
            $("#"+deactive_type+"_view").removeClass("active");
        }

        function change_view(view)
        {
            $.ajax({
                url      : "<?php echo e(url('/')); ?>/change_view",
                type     : "GET",
                dataType : 'json',
                data     : {view:view},
                success  : function(res) {  }
            });
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>