<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <form name="frm_change_password" id="frm_change_password" method="post" action="<?php echo e($module_url_path); ?>/change_password/update" autocomplete="off">
                    <?php echo e(csrf_field()); ?>

                    <div class="white-wrapper">
                       <div class="row">
                             <div class="col-sm-6 col-md-6 col-lg-6">
                                 <div class="form-group">
                                     <label class="form-label">Old Password<i class="red">*</i></label>
                                     <input type="password" name="old_password" id="old_password" placeholder="Old Password" maxlength="16" />
                                     <div class="error" id="err_old_password"></div>
                                 </div>
                             </div>
                             <div class="col-sm-6 col-md-6 col-lg-6">
                                 <div class="form-group">
                                     <label class="form-label">New Password<i class="red">*</i></label>
                                     <input type="password" name="new_password" id="new_password" placeholder="New Password" maxlength="16"/>
                                     <div class="error" id="err_new_password"></div>
                                 </div>
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="form-label">Confirm Password<i class="red">*</i></label>
                             <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" maxlength="16"/>
                             <div class="error" id="err_confirm_password"></div>
                        </div>
                        <div class="save-btn">
                            <button type="button" id="btn_change_password" class="green-trans-btn">Update</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btn_change_password').click(function(){
        var old_password     = $('#old_password').val();
        var new_password     = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if($.trim(old_password) == '')
        {
            $('#old_password').focus();
            $('#err_old_password').show();
            $('#err_old_password').html('Please enter old password.');
            $('#err_old_password').fadeOut(4000);
            return false;
        }  
        else if($.trim(new_password) == '')
        {
            $('#new_password').focus();
            $('#err_new_password').show();
            $('#err_new_password').html('Please enter new password.');
            $('#err_new_password').fadeOut(4000);
            return false;
        } 
        else if($.trim(new_password).length < 6)
        {
            $('#new_password').focus();
            $('#err_new_password').show();
            $('#err_new_password').html('For better security, use a password 6 characters long.');
            $('#err_new_password').fadeOut(4000);
            return false;
        }
        else if(old_password == new_password)
        {
            $('#new_password').focus();
            $('#err_new_password').show();
            $('#err_new_password').html('Old and new Password should not be same.');
            $('#err_new_password').fadeOut(4000);
            return false;
        }
        else if($.trim(confirm_password) == '')
        {
            $('#confirm_password').focus();
            $('#err_confirm_password').show();
            $('#err_confirm_password').html('Please enter confirm password.');
            $('#err_confirm_password').fadeOut(4000);
            return false;
        } 
        else if(new_password!=confirm_password)
        {
            $('#confirm_password').focus();
            $('#err_confirm_password').show();
            $('#err_confirm_password').html('Please enter confirm password same as new password.');
            $('#err_confirm_password').fadeOut(4000);
            return false;
        } 
        else
        {
            var form = $('#frm_change_password')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '<?php echo e($module_url_path); ?>/change_password/update',
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
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>