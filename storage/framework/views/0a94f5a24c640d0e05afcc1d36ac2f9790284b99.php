<?php $__env->startSection('main_content'); ?>
<style type="text/css">
    .two-btns .half-btns { float: right; }
</style>
<?php
    //dd( $arr_consultation );
    $arr_prescription = [];
    
    $id           = isset( $arr_consultation['id'] ) && !empty( $arr_consultation['id'] ) ? base64_encode( $arr_consultation['id'] ) : '';
    $consult_id   = isset( $arr_consultation['consultation_id'] ) && !empty( $arr_consultation['consultation_id'] ) ? $arr_consultation['consultation_id'] : '';

    $consult_date = isset( $arr_consultation['date'] ) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '00-00-0000';
    $consult_time = isset( $arr_consultation['time'] ) && !empty( $arr_consultation['time'] ) ? $arr_consultation['time'] : '';

    $booking_datetime = convert_datetime($consult_date.' '.$consult_time, 'user', 'datetime');
    $consult_time     = date( "h:i A", strtotime($booking_datetime) );
    $consult_date     = date( "d F Y", strtotime($booking_datetime) );

    $payment_status = isset( $arr_consultation['payment'] ) && !empty( $arr_consultation['payment'] ) ? ucwords($arr_consultation['payment']) : '';
    $patient_name   = isset( $arr_consultation['patient_name'] ) && !empty( $arr_consultation['patient_name'] ) ? $arr_consultation['patient_name'] : '';

    $doc_prefix     = isset( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) && !empty( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) ? $arr_consultation['doctor_details']['doctor_prefix']['name'] : 'Dr';
    $doc_first_name = isset( $arr_consultation['doctor_details']['first_name'] ) && !empty( $arr_consultation['doctor_details']['first_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['first_name'] ) : '';
    $doc_last_name  = isset( $arr_consultation['doctor_details']['last_name'] ) && !empty( $arr_consultation['doctor_details']['last_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['last_name'] ) : '';
    $doc_name       = $doc_prefix.'. '.$doc_first_name.' '.$doc_last_name;

    $illness        = isset( $arr_consultation['category_name']['name'] ) && !empty( $arr_consultation['category_name']['name'] ) ? decrypt_value( $arr_consultation['category_name']['name'] ) : '';
    $description    = isset( $arr_consultation['description'] ) && !empty( $arr_consultation['description'] ) ? $arr_consultation['description'] : '';
    $image          = isset( $arr_consultation['image'] ) && !empty( $arr_consultation['image'] ) ? $arr_consultation['image'] : '';
    $notes          = isset( $arr_consultation['notes'] ) && !empty( $arr_consultation['notes'] ) ? $arr_consultation['notes'] : '';

    $arr_prescription = isset($arr_consultation['prescription_details'])?$arr_consultation['prescription_details']:[];

    $total_amount = get_total_amount($consult_id);
?>
	<div class="page-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-md-3 col-lg-3">
                    <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="booking-completed-section consu-details-section">
                        <div class="sticky-badge">Consultation ID : <?php echo e($consult_id); ?></div>
                        <div class="booking-req-header">
                           <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="doctor-section">
                                        <div class="doctor-icon bg-img">&nbsp;</div>
                                        <div class="doctor-details">
                                            <p><?php echo e($doc_name); ?></p>
                                            <span>Doctor</span>
                                        </div>
                                    </div>
                                    <div class="doctor-section">
                                        <div class="doctor-icon patient-icon bg-img">&nbsp;</div>
                                        <div class="doctor-details">
                                            <p><?php echo e($patient_name); ?></p>
                                            <span>Patient</span>
                                        </div>
                                    </div>
                                    <div class="doctor-section">
                                        <div class="doctor-icon cal-icon bg-img">&nbsp;</div>
                                        <div class="doctor-details">
                                            <p><?php echo e($consult_date); ?></p>
                                            <span>Consultation Date</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden-xs hidden-sm col-md-4 col-lg-6">&nbsp;</div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                   <div class="price-div">
                                       <h3> <?php echo e($total_amount); ?> <i class="fa fa-eur"></i></h3>
                                       <p>Total</p>
                                   </div>
                                   <div class="doctor-section card-details">
                                        <div class="doctor-details">
                                            <p><?php echo e($payment_status); ?></p>
                                            <span>Payment Status</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="patient-details">
                            <div class="doctor-section timing-section">
                                <div class="doctor-icon bg-img">&nbsp;</div>
                                <div class="doctor-details">
                                    <p><?php echo e($consult_time); ?></p>
                                    <span>Consultation Time</span>
                                </div>
                            </div>
                        </div>
                        <div class="consu-purpose">
                            <h5>Illness</h5>
                            <div class="doctor-note-txt" id="dec_illness"></div>
                            <h5>Description</h5>
                            <div class="doctor-note-txt" id="dec_description"></div>
                            
                            <h5>Photos</h5>
                            <div class="disease-block">
                                <div class="row">
                                <div class="presciption-name"><?php echo e($image); ?></div>
                                <?php
                                    if(isset($image) && !empty($image) && File::exists($illness_img_base_path.'/'.$image)):
                                        $image_file = $illness_img_public_path.'/'.$image;
                                        ?>
                                            <div class="presciption-view-icon">
                                                <a  id="dec_image" data-name="image" data-file="<?php echo e($image); ?>" data-path="<?php echo e($image_file); ?>" href="" download><i class="fa fa-download"></i></a>
                                            </div>
                                        <?php
                                    endif;
                                ?>
                               </div>
                            </div>
                            <div class="two-btns feedback-btns">
                                <div class="half-btns"><a href="<?php echo e($breadcrum_level_3_url); ?>" class="black-btn close-btn"><span class="bg-img">&nbsp;</span> Close</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="white-wrapper prescription-wrapper consu-purpose">
                        <h2>Consultation Details</h2>
                        <div class="prescription-section">
                            <h5>Doctor Consultation Notes</h5>
                            <div class="doctor-note-txt" id="dec_view_notes"></div>
                            <div class="presc-table">
                                <h5>Presciption </h5>
                                <div class="presc-table-list">
                                    <ul id="list-wrapper">
                                        <?php if(isset($arr_prescription) && sizeof($arr_prescription)>0): ?> 
                                            <?php foreach($arr_prescription as $key => $data): ?>
                                                <li>
                                                    <?php
                                                        $file = isset($data['name']) && !empty($data['name']) ? $data['name'] : '';
                                                        
                                                        if(isset($file) && !empty($file) && File::exists($prescription_file_base_path.'/'.$file)):
                                                         
                                                            $file_path = $prescription_file_public_path.'/'.$file;
                                                            $repeats   = isset($data['repeats']) && !empty($data['repeats']) ? $data['repeats'] : '';
                                                            $direction = isset($data['direction']) && !empty($data['direction']) ? $data['direction'] : '';
                                                    ?>
                                                    <input type="hidden" id="repeats<?php echo e($key); ?>" value="<?php echo e($repeats); ?>">
                                                    <input type="hidden" id="direction<?php echo e($key); ?>" value="<?php echo e($direction); ?>">
                                                    <div class="presc-name"><?php echo e($file); ?></div>
                                                    
                                                    <div class="presc-name" id="dec_repeats<?php echo e($key); ?>"></div>

                                                    <div class="presc-name" id="dec_direction<?php echo e($key); ?>"></div>

                                                    <div class="presc-btns">
                                                        <a id="dec_image<?php echo e($key); ?>" data-name="image<?php echo e($key); ?>" data-file="<?php echo e($file); ?>" data-path="<?php echo e($file_path); ?>" href="" download><i class="fa fa-download"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <?php
                                                        endif;
                                                    ?>
                                                </li>
                                            <?php endforeach; ?>    
                                        <?php else: ?>
                                            No Prescription
                                        <?php endif; ?>    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function()
    {
        /*--------------------------Decrypt Data and files Starts--------------------------*/
        
            $("#dec_illness").html( "<?php echo e(isset($illness) ? $illness : ''); ?>" );
            $("#dec_description").html( decrypt( "<?php echo e(isset($description) ? $description : ''); ?>" ) );
            $("#dec_view_notes").html( decrypt( "<?php echo e(isset($notes) ? $notes : ''); ?>" ) );

            if( $("#dec_image").length )
            {
                var name = $("#dec_image").data('name');
                var file = $("#dec_image").data('file');
                var path = $("#dec_image").data('path');
                decrypt_file(name, file, path);
            }
            
        /*--------------------------Decrypt Data and files Ends--------------------------*/    

        /*--------------------------Decrypt Data Presciption Starts----------------*/
            
            for( i = 0; i<$('#list-wrapper').children('li').length; i++)
            {
                var direction = $('#direction'+i).val();
                var repeats   = $('#repeats'+i).val();
                    
                $("#dec_repeats"+i).html( decrypt(repeats) );
                $("#dec_direction"+i).html( decrypt(direction) );
                
                if( $("#dec_image"+i).length )
                {
                    var name = $("#dec_image"+i).data('name');
                    var file = $("#dec_image"+i).data('file');
                    var path = $("#dec_image"+i).data('path');
                    decrypt_file(name, file, path);
                }
            }
            
        /*--------------------------Decrypt Data Presciption End----------------*/
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>