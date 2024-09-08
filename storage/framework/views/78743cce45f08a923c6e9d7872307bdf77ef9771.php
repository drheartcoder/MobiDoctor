<?php $__env->startSection('main_content'); ?>

<?php
    $selected_date = '';
    if( isset( $arr_consultation ) && !empty( $arr_consultation ) ):
        $selected_date = isset($arr_consultation['date']) ? $arr_consultation['date'] : '';
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper booking-step2">
            
            <div class="booking-title text-center">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a class="prev-arrow bg-img" href="<?php echo e($module_url_path.'/'.$session_consultation_id); ?>/patient">&nbsp;</a>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h4>Select a Day</h4></div>
                    <div class="col-xs-2 sm-2 col-md-2 col-lg-2">
                        <a class="next-arrow bg-img" href="javascript:void(0);" id="submit_page">&nbsp;</a>
                    </div>
                </div>
            </div>

            <div class="booking-content radio-btns">
                
                <form method="post" id="select_day_form" name="select_day_form" action="<?php echo e(url('/')); ?>/patient/consultation/<?php echo e($session_consultation_id); ?>/day/process">
                    <?php echo e(csrf_field()); ?>


                    <?php echo $__env->make('front.patient.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">

                        <?php if( isset( $arr_availability ) && !empty( $arr_availability ) ): ?>
                            
                            <?php foreach( $arr_availability as $date ): ?>

                                <?php
                                    $day = explode(",", $date['start_date']);
                                    $day_date = date("d-M-Y",strtotime($day[1]));
                                ?>

                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                    <div class="radio-btn patient-box">
                                        <input type="radio" id="<?php echo e($date['id']); ?>" name="select_day" value="<?php echo e($day[1]); ?>" <?php if( $selected_date == $day[1]): ?> checked <?php endif; ?> />
                                        <label for="<?php echo e($date['id']); ?>">
                                            <span class="patient-icon bg-img">&nbsp;</span>
                                            <span class="book">Book</span>
                                            <span class="name"><?php echo e($day_date); ?><br/><?php echo e($day[0]); ?></span>
                                        </label>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        
                        <?php else: ?>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="radio-btn patient-box">
                                    <label>
                                        <span>No Doctor Available</span>
                                    </label>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="error" id="err_select_day"></div>

                    <button type="button" class="green-btn submit-btn" id="btn_submit_select_day_form">Submit</button>

                </form>
            </div>

            <div class="step-indicator">
                <ul>
                    <li></li>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btn_submit_select_day_form").click(function(){
            form_validation();
        });

        $("#submit_page").click(function(){
            form_validation();
        });
    });

    function form_validation()
    {
        var select_day = $("input[name='select_day']").is(":checked");

        if( $.trim(select_day) == 'false' )
        {
            $('#err_select_day').show();
            $('#err_select_day').html('Please select day for the consultation.');
            $('#err_select_day').fadeOut(4000);
            return false;
        }
        else
        {
            $("#select_day_form").submit();
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>