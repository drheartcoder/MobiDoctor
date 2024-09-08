<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="white-wrapper prescription-wrapper history-wrapper">
                    <h2>General</h2>
                    <div class="prescription-section">
                        <form name="frm_add_general" id="frm_add_general" method="post" action="<?php echo e($module_url_path); ?>/store_general">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                               <div class="col-sm-8 col-md-9 col-lg-9">
                                   <div class="form-group">
                                       <select name="medical_general[]" id="medical_general" class="js-example-basic-multiple" multiple="multiple">
                                            <?php if(isset($arr_general) && sizeof($arr_general)>0): ?>
                                                <?php foreach($arr_general as $key => $general): ?>
                                                    <?php if(!in_array($general['id'],$selected_general_ids)): ?>
                                                    <option value="<?php echo e($general['id']); ?>"><?php echo e(isset($general['name'])?decrypt_value($general['name']):''); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                         </select>
                                         <div class="error" id="err_medical_general"></div>
                                   </div>
                               </div>
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                   <div class="form-group">
                                       <button id="btn_add_general" type="button" class="green-btn full-width">+ Add</button>
                                   </div>
                               </div>
                            </div>
                       </form>

                        <?php if(isset($arr_selected_general) && sizeof($arr_selected_general)>0): ?>
                        <div class="issues-list">
                            <ul>
                                <?php foreach($arr_selected_general as $selected_general): ?>
                                    <li>
                                        <span class="issue-name"><?php echo e(isset($selected_general['general_details']['name'])?decrypt_value($selected_general['general_details']['name']):''); ?>

                                        </span>
                                        <span class="close-issue">
                                            <a onclick="confirm_action(this,event,'Do you really want to remove medical general?')" href="<?php echo e($module_url_path.'/delete_general/'.base64_encode($selected_general['id'])); ?>"><img src="<?php echo e(url('/')); ?>/public/front/images/close-list.png"/></a>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                
                <div class="white-wrapper prescription-wrapper history-wrapper">
                    <h2>Medications <a class="add-medi" href="<?php echo e($module_url_path); ?>/medication">+ Add Medication</a></h2>
                    <div class="prescription-section medi-list">
                        <div class="row">
                            <?php if(isset($arr_medication) && sizeof($arr_medication)>0): ?>
                            <?php foreach($arr_medication as $key => $medication): ?>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="medication-list-block">
                                    <b id="medication_<?php echo e($key); ?>"></b>
                                    <div class="consu-drop-wrapper view-medi-drop-w">
                                        <div class="ellipses-block"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>
                                        <div class="consu-drop">
                                            <ul>
                                                <li><a href="<?php echo e($module_url_path); ?>/medication/view/<?php echo e(base64_encode($medication['id'])); ?>">View Medication</a></li>
                                                <li><a href="<?php echo e($module_url_path); ?>/medication/edit/<?php echo e(base64_encode($medication['id'])); ?>">Edit Medication</a></li>
                                                <li><a onclick="confirm_action(this,event,'Do you really want to remove medication?')" href="<?php echo e($module_url_path); ?>/medication/delete/<?php echo e(base64_encode($medication['id'])); ?>">Delete Medication</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $("#medication_<?php echo e($key); ?>").html(decrypt("<?php echo e($medication['name']); ?>"));
                                });
                            </script>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found</div> 
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                

                <div class="white-wrapper prescription-wrapper history-wrapper">
                    <h2>Lifestyle <a class="edit-icon" href="<?php echo e($module_url_path); ?>/lifestyle"><i class="fa fa-pencil-square-o"></i></a></h2>
                    <div class="prescription-section">
                        <div class="lifestyle-details">
                            <ul>
                                <li>
                                    <span class="lifestyle-label">Smoking</span>
                                    <span class="lifestyle-desc">
                                        <?php if(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='1'): ?>
                                            Yes
                                        <?php elseif(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='0'): ?>
                                            No
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="lifestyle-label">Exercise</span>
                                    <span class="lifestyle-desc">
                                        <?php if(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='1'): ?>
                                            Yes
                                        <?php elseif(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='0'): ?>
                                            No
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="lifestyle-label">Alcohol</span>
                                    <span class="lifestyle-desc">
                                        <?php if(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='1'): ?>
                                            Yes
                                        <?php elseif(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='0'): ?>
                                            No
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="lifestyle-label">Stress Level</span>
                                    <span class="lifestyle-desc">
                                        <?php if(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='1'): ?>
                                            High
                                        <?php elseif(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='0'): ?>
                                            Low
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="lifestyle-label">Marital Status</span>
                                    <span class="lifestyle-desc">
                                        <?php if(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='1'): ?>
                                            Married
                                        <?php elseif(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='0'): ?>
                                            Single
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.multiselect', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="application/javascript">
$('.consu-drop-wrapper').click(function(){
    $(this).toggleClass('active');
    $(this).parent().parent().siblings().children('.medication-list-block').children('.consu-drop-wrapper').removeClass('active');
});
</script>

<script type="text/javascript">
$("#btn_add_general").click(function(){
    var medical_general = $("#medical_general").val();

    if($.trim(medical_general) == '')
    {
        $("#medical_general").focus();
        $('#err_medical_general').show();
        $('#err_medical_general').html('Please select general.');
        $('#err_medical_general').fadeOut(4000);
        return false;
    }
    else
    {
        var form = $('#frm_add_general')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/store_general',
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