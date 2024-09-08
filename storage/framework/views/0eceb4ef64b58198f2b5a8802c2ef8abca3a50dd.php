<?php $__env->startSection('main_content'); ?>

<?php
    $id         = isset( $arr_prescription['id'] ) && !empty( $arr_prescription['id'] ) ? $arr_prescription['id'] : '';
    $consult_id = isset( $arr_prescription['consult_id'] ) && !empty( $arr_prescription['consult_id'] ) ? $arr_prescription['consult_id'] : '';
    $name       = isset( $arr_prescription['name'] ) && !empty( $arr_prescription['name'] ) ? $arr_prescription['name'] : '';
    $repeats    = isset( $arr_prescription['repeats'] ) && !empty( $arr_prescription['repeats'] ) ? $arr_prescription['repeats'] : '';
    $direction  = isset( $arr_prescription['direction'] ) && !empty( $arr_prescription['direction'] ) ? $arr_prescription['direction'] : '';
    $date       = isset( $arr_prescription['created_at'] ) && !empty( $arr_prescription['created_at'] ) ? date('d-M-Y',strtotime($arr_prescription['created_at'])) : '00-00-0000';

    $doc_prefix     = isset( $arr_prescription['doctor_details']['doctor_prefix']['name'] ) && !empty( $arr_prescription['doctor_details']['doctor_prefix']['name'] ) ? $arr_prescription['doctor_details']['doctor_prefix']['name'] : 'Dr';
    $doc_first_name = isset( $arr_prescription['doctor_details']['first_name'] ) && !empty( $arr_prescription['doctor_details']['first_name'] ) ? decrypt_value ( $arr_prescription['doctor_details']['first_name'] ) : '';
    $doc_last_name  = isset( $arr_prescription['doctor_details']['last_name'] ) && !empty( $arr_prescription['doctor_details']['last_name'] ) ? decrypt_value( $arr_prescription['doctor_details']['last_name'] ) : '';

    $doc_name = $doc_prefix.' '.$doc_first_name.' '.$doc_last_name;

    $file_path = 'javascript:void(0)';
    if( isset( $file ) && !empty( $file ) && File::exists( $prescription_file_base_path.'/'.$file ) ):
        $file_path = $prescription_file_public_path.'/'.$file;
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="white-wrapper prescription-wrapper">
                    <h2>Prescription - <?php echo e($date); ?></h2>
                    <div class="prescription-section" id="list-wrapper">

                        <div class="prescri-block">
                            <div class="prescri-name"><span class="doc-name">Consultation ID</span>: <?php echo e($consult_id); ?></div>
                            <div class="prescri-name"><span class="doc-name">Doctor Name</span>: <?php echo e($doc_name); ?></div>
                            <div class="prescri-name"><span class="doc-name">Repeats</span>: <span id="dec_repeats"></span></div>
                            <div class="prescri-name"><span class="doc-name">Direction</span>: <span id="dec_direction"></span></div>
                            <?php
                                if(isset($name) && !empty($name) && File::exists($prescription_file_base_path.'/'.$name)):
                                    $name_file = $prescription_file_public_path.'/'.$name;
                                    ?>
                                        <div class="prescri-name">
                                            <div class="presciption-view-icon">
                                                <a id="dec_name" data-name="name" data-file="<?php echo e($name); ?>" data-path="<?php echo e($name_file); ?>" href="" download>Download<i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                endif;
                            ?>
                            <div class="clearfix"></div>
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
        /*--------------------------Decrypt Data Presciption Starts----------------*/

        $("#dec_repeats").html( decrypt( "<?php echo e(isset($repeats) ? $repeats : ''); ?>" ) );
        $("#dec_direction").html( decrypt( "<?php echo e(isset($direction) ? $direction : ''); ?>" ) );

        if( $("#dec_name").length )
            {
            var name = $("#dec_name").data('name');
            var file = $("#dec_name").data('file');
            var path = $("#dec_name").data('path');
            decrypt_file(name, file, path);
        }
        
        /*--------------------------Decrypt Data Presciption End----------------*/
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>