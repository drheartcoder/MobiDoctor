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
                    <h2>Contact Us</h2>
                    <form name="frm_contact_us" id="frm_contact_us" method="post" action="<?php echo e($module_url_path); ?>/contact_us/store">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section contact-section">
                            <div class="form-group">
                                <label class="form-label">Patient Name<i class="red">*</i></label>
                                <input type="text" id="patient_name" name="patient_name" placeholder="Patient Name" maxlength="50"/>
                                <div class="error" id="err_patient_name"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email Id<i class="red">*</i></label>
                                        <input type="email" id="email" name="email" placeholder="Email Id" maxlength="80"/>
                                        <div class="error" id="err_email"></div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code<i class="red">*</i></label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                                <?php foreach($mobcode_data as $mobcode): ?>
                                                    <option value="<?php echo e($mobcode['phonecode']); ?>">+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Mobile no." id="mobile_no" name="mobile_no" maxlength="16" />
                                        <div class="error" id="err_mobile_no"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Message<i class="red">*</i></label>
                                <textarea name="message" id="message" placeholder="Leave a Message" rows="3"></textarea>
                                <div class="error" id="err_message"></div>
                            </div>
                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_contact_us">Send</button>
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
    $(document).ready(function(){
        $("#patient_name, #email, #phone_code, #mobile_no, #message").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                ContactUsValidationCheck();
            }
        });

        $('#btn_contact_us').click(function()
        {
            ContactUsValidationCheck();
        });
    });

    function ContactUsValidationCheck()
    {
        var patient_name = $('#patient_name').val();
        var email        = $('#email').val();
        var phone_code   = $('#phone_code').val();
        var mobile_no    = $('#mobile_no').val();
        var message      = $('#message').val();
        var alpha        = /^[a-zA-Z ]*$/;
        var numeric      = /^[0-9]*$/;
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(patient_name) == '')
        {
            $('#patient_name').focus();
            $('#err_patient_name').show();
            $('#err_patient_name').html('Please enter first name.');
            $('#err_patient_name').fadeOut(4000);
            return false;
        }  
        else if(!alpha.test(patient_name))
        {
            $('#patient_name').focus();
            $('#err_patient_name').show();
            $('#err_patient_name').html('Please enter valid first name.');
            $('#err_patient_name').fadeOut(4000);
            return false;
        }   
        else if($.trim(email) == '')
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter email id.');
            $('#err_email').fadeOut(4000);
          return false;  
        }
        else if(!email_filter.test(email))
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            return false;  
        }
        else if($.trim(phone_code) == '')
        {
           $('#phone_code').focus();
           $('#err_phone_code').show();
           $('#err_phone_code').html('Please select country code.');
           $('#err_phone_code').fadeOut(4000);
           return false;  
        }
        else if($.trim(mobile_no) == '')
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter mobile number.');
            $('#err_mobile_no').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(mobile_no))
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter valid mobile.');
            $('#err_mobile_no').fadeOut(4000);
            return false;
        }
        else if($.trim(message) == '')
        {
            $('#message').focus();
            $('#err_message').show();
            $('#err_message').html('Please enter message.');
            $('#err_message').fadeOut(4000);
            return false;
        }
        else
        {
            var form = $('#frm_contact_us')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '<?php echo e($module_url_path); ?>/contact_us/store',
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
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>