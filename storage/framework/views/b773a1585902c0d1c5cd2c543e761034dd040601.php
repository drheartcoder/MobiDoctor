<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">

                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                <div class="white-wrapper prescription-wrapper">
                    <h2>Lifestyle</h2>

                    <form name="frm_lifestyle" id="frm_lifestyle" method="post" action="<?php echo e($module_url_path); ?>/update_lifestyle">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                           <div class="row">
                               <div class="col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">
                                        <label class="form-label">Smoking<i class="red">*</i></label>
                                        <select id="smoking" name="smoking">
                                            <option value="">-- Select --</option>
                                            <option value="1" <?php if(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='1'): ?> selected <?php endif; ?>>Yes</option>
                                            <option value="0" <?php if(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='0'): ?> selected <?php endif; ?>>No</option>
                                        </select>
                                        <div class="error" id="err_smoking"></div>
                                   </div>
                               </div>
                               <div class="col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">
                                        <label class="form-label">Exercise<i class="red">*</i></label>
                                        <select id="exercise" name="exercise">
                                            <option value="">-- Select --</option>
                                            <option value="1" <?php if(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='1'): ?> selected <?php endif; ?>>Yes</option>
                                            <option value="0" <?php if(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='0'): ?> selected <?php endif; ?>>No</option>
                                        </select>
                                        <div class="error" id="err_exercise"></div>
                                   </div>
                               </div>
                               <div class="col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">
                                        <label class="form-label">Alcohol<i class="red">*</i></label>
                                        <select id="alcohol" name="alcohol">
                                            <option value="">-- Select --</option>
                                            <option value="1" <?php if(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='1'): ?> selected <?php endif; ?>>Yes</option>
                                            <option value="0" <?php if(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='0'): ?> selected <?php endif; ?>>No</option>
                                        </select>
                                        <div class="error" id="err_alcohol"></div>
                                   </div>
                               </div>
                               <div class="col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">
                                        <label class="form-label">Stress Level<i class="red">*</i></label>
                                        <select id="stress_level" name="stress_level">
                                            <option value="">-- Select --</option>
                                            <option value="1" <?php if(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='1'): ?> selected <?php endif; ?>>High</option>
                                            <option value="0" <?php if(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='0'): ?> selected <?php endif; ?>>Low</option>
                                        </select>
                                        <div class="error" id="err_stress_level"></div>
                                   </div>
                               </div>
                               <div class="col-sm-6 col-md-6 col-lg-6">
                                   <div class="form-group">
                                        <label class="form-label">Marital Status<i class="red">*</i></label>
                                        <select id="marital_status" name="marital_status">
                                            <option value="">-- Select --</option>
                                            <option value="1" <?php if(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='1'): ?> selected <?php endif; ?>>Married</option>
                                            <option value="0" <?php if(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='0'): ?> selected <?php endif; ?>>Single</option>
                                        </select>
                                        <div class="error" id="err_marital_status"></div>
                                   </div>
                               </div>
                           </div>
                            
                            <div class="save-btn">
                                <button id="btn_lifestyle" type="button" class="green-trans-btn">Update</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#btn_lifestyle").click(function(){

    var smoking = $("#smoking").val();
    var exercise = $("#exercise").val();
    var alcohol = $("#alcohol").val();
    var stress_level = $("#stress_level").val();
    var marital_status = $("#marital_status").val();

    if($.trim(smoking) == '')
    {
        $('#smoking').focus();
        $('#err_smoking').show();
        $('#err_smoking').html('Please select Smoking.');
        $('#err_smoking').fadeOut(4000);
        return false;
    }
    else if($.trim(exercise) == '')
    {
        $('#exercise').focus();
        $('#err_exercise').show();
        $('#err_exercise').html('Please select Exercise.');
        $('#err_exercise').fadeOut(4000);
        return false;
    }
    else if($.trim(alcohol) == '')
    {
        $('#alcohol').focus();
        $('#err_alcohol').show();
        $('#err_alcohol').html('Please select Alcohol.');
        $('#err_alcohol').fadeOut(4000);
        return false;
    }
    else if($.trim(stress_level) == '')
    {
        $('#stress_level').focus();
        $('#err_stress_level').show();
        $('#err_stress_level').html('Please select Stress level.');
        $('#err_stress_level').fadeOut(4000);
        return false;
    }
    else if($.trim(marital_status) == '')
    {
        $('#marital_status').focus();
        $('#err_marital_status').show();
        $('#err_marital_status').html('Please select Marital status.');
        $('#err_marital_status').fadeOut(4000);
        return false;
    }
    else
    {
        var form = $('#frm_lifestyle')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/update_lifestyle',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            beforeSend  : showProcessingOverlay(),
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
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>