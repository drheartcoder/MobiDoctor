<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="white-wrapper prescription-wrapper edit-card-form">
                    <h2>Edit a Member</h2>
                    <div class="prescription-section">
                        <form name="frm_update_family_member" id="frm_update_family_member" method="post" action="<?php echo e($module_url_path); ?>/family_member/update/<?php echo e(isset($arr_member_details['id'])?base64_encode($arr_member_details['id']):''); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name<i class="red">*</i></label>
                                        <input type="text" id="first_name" name="first_name" value="<?php echo e(isset($arr_member_details['first_name'])?decrypt_value($arr_member_details['first_name']):''); ?>" placeholder="Enter First Name" maxlength="50" />
                                        <div class="error" id="err_first_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name<i class="red">*</i></label>
                                        <input type="text" id="last_name" name="last_name" value="<?php echo e(isset($arr_member_details['last_name'])?decrypt_value($arr_member_details['last_name']):''); ?>" placeholder="Enter Last Name" maxlength="50"/>
                                        <div class="error" id="err_last_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="email" value="<?php echo e(isset($arr_member_details['email'])?$arr_member_details['email']:''); ?>" placeholder="Enter Email" maxlength="80"/>
                                        <div class="error" id="err_email"></div>
                                    </div>
                                </div>
                                <?php
                                    $gender = isset($arr_member_details['gender'])?decrypt_value($arr_member_details['gender']):'';
                                 ?>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Gender<i class="red">*</i></label>
                                        <select name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" <?php if($gender == 'Male'): ?> selected <?php endif; ?>>Male</option>
                                            <option value="Female" <?php if($gender == 'Female'): ?> selected <?php endif; ?>>Female</option>
                                        </select>
                                        <div class="error" id="err_gender"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Relationship<i class="red">*</i></label>
                                        <input type="text" id="relation" name="relation" value="<?php echo e(isset($arr_member_details['relation'])?decrypt_value($arr_member_details['relation']):''); ?>" placeholder="Enter Relationship" maxlength="50"/>
                                        <div class="error" id="err_relation"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth<i class="red">*</i></label>
                                        <div class="date-input relative-block">
                                            <input class="date-input" name="birth_date" value="<?php echo e(isset($arr_member_details['birth_date'])?date('m/d/Y',strtotime($arr_member_details['birth_date'])):''); ?>" id="datepicker" type="text" placeholder="Select Date of Birth"/>
                                            <div class="error" id="err_birth_date"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code</label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                                <?php foreach($mobcode_data as $mobcode): ?>
                                                    <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if(isset($arr_member_details['phone_code']) && $arr_member_details['phone_code']!='' && $arr_member_details['phone_code'] == $mobcode['phonecode']): ?> selected <?php endif; ?>>+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" placeholder="Enter Mobile no." id="mobile_no" name="mobile_no" value="<?php echo e(isset($arr_member_details['mobile_no'])?$arr_member_details['mobile_no']:''); ?>" />
                                        <div class="error" id="err_mobile_no" maxlength="16"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_update_member">Update</button>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.datepicker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
 $(document).ready(function () {
    var today = new Date();
    $('#datepicker').datepicker({
      //  format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    });
});

// $(document).ready(function(){

// });
$('#btn_update_member').click(function(){
    var first_name   = $('#first_name').val();
    var last_name    = $('#last_name').val();
    var gender       = $('#gender').val();
    var relation     = $('#relation').val();
    var datepicker   = $('#datepicker').val();
    var email        = $('#email').val();
    var mobile_no    = $('#mobile_no').val();
    var phone_code   = $('#phone_code').val();
    var alpha        = /^[a-zA-Z]*$/;
    var alpha_with_space = /^[a-zA-Z ]*$/;
    var numeric      = /^[0-9]*$/;
    var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if($.trim(first_name) == '')
    {
        $('#first_name').focus();
        $('#err_first_name').show();
        $('#err_first_name').html('Please enter first name.');
        $('#err_first_name').fadeOut(4000);
        return false;
    }  
    else if(!alpha.test(first_name))
    {
        $('#first_name').focus();
        $('#err_first_name').show();
        $('#err_first_name').html('Please enter valid first name.');
        $('#err_first_name').fadeOut(4000);
        return false;
    }   
    else if($.trim(last_name) == '')
    {
        $('#last_name').focus();
        $('#err_last_name').show();
        $('#err_last_name').html('Please enter last name.');
        $('#err_last_name').fadeOut(4000);
        return false;
    }
    else if(!alpha.test(last_name))
    {
        $('#last_name').focus();
        $('#err_last_name').show();
        $('#err_last_name').html('Please enter valid last name.');
        $('#err_last_name').fadeOut(4000);
        return false;
    }
    else if($.trim(email) != '' && !email_filter.test(email))
    {
        $('#email').focus();
        $('#err_email').show();
        $('#err_email').html('Please enter valid email id.');
        $('#err_email').fadeOut(4000);
        return false;
    }
    else if($.trim(gender) == '')
    {
       $('#gender').focus();
       $('#err_gender').show();
       $('#err_gender').html('Please select gender.');
       $('#err_gender').fadeOut(4000);
       return false;  
    }
    else if($.trim(relation) == '')
    {
       $('#relation').focus();
       $('#err_relation').show();
       $('#err_relation').html('Please enter relation.');
       $('#err_relation').fadeOut(4000);
       return false;  
    }
    else if(!alpha_with_space.test(relation))
    {
        $('#relation').focus();
        $('#err_relation').show();
        $('#err_relation').html('Please enter valid relation.');
        $('#err_relation').fadeOut(4000);
        return false;
    }
    else if($.trim(datepicker) == '')
    {
       $('#datepicker').focus();
       $('#err_datepicker').show();
       $('#err_datepicker').html('Please select date of birth.');
       $('#err_datepicker').fadeOut(4000);
       return false;  
    }
    else if($.trim(mobile_no) != '' && !numeric.test(mobile_no))
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Please enter valid mobile.');
        $('#err_mobile_no').fadeOut(4000);
        return false;
    }
    else if($.trim(mobile_no) != '' && $.trim(phone_code) == '')
    {
        $('#phone_code').focus();
        $('#err_phone_code').show();
        $('#err_phone_code').html('Please select country code.');
        $('#err_phone_code').fadeOut(4000);
        return false;  
    }
    else if($.trim(mobile_no) == '' && $.trim(phone_code) != '')
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Please enter mobile no.');
        $('#err_mobile_no').fadeOut(4000);
        return false;  
    }
    else
    {
        var form = $('#frm_update_family_member')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/family_member/update/<?php echo e(base64_encode($arr_member_details['id'])); ?>',
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