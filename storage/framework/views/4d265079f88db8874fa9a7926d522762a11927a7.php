<?php $__env->startSection('main_content'); ?>

<?php
    $id = $consultation_id = $who_is_patient = $patient_id = $user_id = $date = $time = $consultation_datetime = $patient_fname = $patient_lname = $doctor_fname = $doctor_lname = $doctor_prefix = $reschedule_option = '';

    if( isset( $arr_consultation ) && !empty( $arr_consultation ) ):
        $id = isset($arr_consultation['id']) && !empty( $arr_consultation['id'] ) ? base64_encode( $arr_consultation['id'] ) : '';
        $consultation_id = isset($arr_consultation['consultation_id']) && !empty( $arr_consultation['consultation_id'] ) ? $arr_consultation['consultation_id'] : '';
        $who_is_patient = isset($arr_consultation['who_is_patient']) && !empty( $arr_consultation['who_is_patient'] ) ? $arr_consultation['who_is_patient'] : '';
        $patient_id = isset($arr_consultation['patient_id']) && !empty( $arr_consultation['patient_id'] ) ? $arr_consultation['patient_id'] : '';
        $user_id = isset($arr_consultation['user_id']) && !empty( $arr_consultation['user_id'] ) ? $arr_consultation['user_id'] : '';
        $date = isset($arr_consultation['date']) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '';
        $time = isset($arr_consultation['time']) && !empty( $arr_consultation['time'] ) ? $arr_consultation['time'] : '';

        if( $who_is_patient == 'family' && isset( $arr_family_member ) && !empty( $arr_family_member ) ):
            $patient_fname = isset( $arr_family_member['first_name'] ) && !empty( $arr_family_member['first_name'] ) ? decrypt_value( $arr_family_member['first_name'] ) : '';
            $patient_lname = isset( $arr_family_member['last_name'] ) && !empty( $arr_family_member['last_name'] ) ? decrypt_value( $arr_family_member['last_name'] ) : '';
        else:
            $patient_fname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value( $user_data['first_name'] ) : '';
            $patient_lname = isset($user_data['last_name']) && !empty($user_data['last_name']) ? decrypt_value( $user_data['last_name'] ) : '';
        endif;

        $booking_datetime = convert_datetime($date.' '.$time, 'user', 'datetime');
        $consultation_datetime = date( "h:i A, l d F, Y", strtotime($booking_datetime) );

        $doctor_prefix = isset($arr_prefix['name']) && !empty($arr_prefix['name']) ? $arr_prefix['name'] : 'Dr.';
        $doctor_fname = isset($arr_consultation['doctor_details']['first_name']) && !empty($arr_consultation['doctor_details']['first_name']) ? decrypt_value( $arr_consultation['doctor_details']['first_name'] ) : '';
        $doctor_lname = isset($arr_consultation['doctor_details']['last_name']) && !empty($arr_consultation['doctor_details']['last_name']) ? decrypt_value( $arr_consultation['doctor_details']['last_name'] ) : '';
        $doctor_name = $doctor_prefix.' '.$doctor_fname.' '.$doctor_lname;
    endif;

    if( isset( $arr_consultationsetting ) && !empty( $arr_consultationsetting ) ):
        $reschedule_option = isset( $arr_consultationsetting['reschedule'] ) && !empty( $arr_consultationsetting['reschedule'] ) ? $arr_consultationsetting['reschedule'] : 0;
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-completed-section">
            
            <div class="booking-req-header">
                <div class="booking-req">
                    <div class="complete-icon bg-img">&nbsp;</div>
                    <h4>Consultation Requested!</h4>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="doctor-section">
                            <div class="doctor-icon bg-img">&nbsp;</div>
                            <div class="doctor-details">
                                <p><?php echo e($doctor_name); ?></p>
                                <span>Doctor</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="doctor-section timing-details">
                            <div class="doctor-icon bg-img">&nbsp;</div>
                            <div class="doctor-details">
                                <p><?php echo e($consultation_datetime); ?></p>
                                <span>Requested Date & Time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="patient-details">
                <div class="doctor-section">
                    <div class="doctor-icon bg-img">&nbsp;</div>
                    <div class="doctor-details">
                        <p><?php echo e($patient_fname.' '.$patient_lname); ?></p>
                        <span>Patient</span>
                    </div>
                </div>
            </div>

            <div class="info-tabbing-section">
                <div class="info-tabbing-wrapper">
                    <div class="tabbing-title">Important Information <span class="arrow"><i class="fa fa-chevron-down"></i></span></div>
                    <div class="tabbing-details">
                        <p>Please login a few minutes before your booking time and await an SMS/Email from the doctor to confirm the consultation/video call start time.</p>
                        <p>Please account for any unexpected delays from the doctor's end, it may take up to an hour after the confirmed time for the doctor to begin the video call. If there is more than an hour's delay, you will be offered a full refund.</p>
                        <div class="instructions-list">
                            <label>Some Important Instructions</label>
                            <ul>
                                <li>Your consultation has been booked.</li>
                                <li><?php echo e($doctor_name); ?> will call you at <b><?php echo e($consultation_datetime); ?>.</b></li>
                                <li>You'll be reminded 10 minutes before the consultation via a notification on your mobidoctor</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="info-tabbing-wrapper">
                    <div class="tabbing-title">Payment <span class="arrow"><i class="fa fa-chevron-down"></i></span></div>
                    <div class="tabbing-details">
                        <p>You have yet been charged - payment will only be processed once <?php echo e($doctor_name); ?> confirms your booking.</p>
                        <p>Until then, you may reschedule your booking.</p>
                    </div>
                </div>

                <div class="two-btns">
                    
                    <?php if( $reschedule_option == 0 ): ?>
                        <div class="half-btns">
                            <a class="green-trans-btn reschedute-btn" href="<?php echo e(url('/')); ?>/patient/consultation/<?php echo e($session_consultation_id); ?>/reschedule">
                                <span class="bg-img">&nbsp;</span> Reschedule booking
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="half-btns">
                        <!-- <a class="green-btn completed-btn" href="<?php echo e(url('/')); ?>/patient/consultation/<?php echo e($session_consultation_id); ?>/online_waiting_room"> -->
                        <a class="green-btn completed-btn" href="<?php echo e(url('/')); ?>/patient/my_consultation/upcoming/<?php echo e($id); ?>/online_waiting_room">
                            <span class="bg-img">&nbsp;</span> Completed
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btn_submit_reason_form").click(function(){
            form_validation();
        });

        $("#submit_page").click(function(){
            form_validation();
        });

        $('#file_illness_image').on('change', function() {
            encrypt_file( $(this).data('name'), formData );
        });

        $('.tabbing-title').click(function(){
            $(this).next('.tabbing-details').slideToggle();
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>