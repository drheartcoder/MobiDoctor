<!--forgot password modal start-->
<div class="modal fade login-modal" id="verify_mobile_modal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" data-replace="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/></button>
            <div class="modal-body">
                <h2>Verify Mobile No.</h2>
                <p>Please enter registered email id and OTP will be send to the registered mobile no.</p>

                <!-- Verify Mobile Status Starts -->
                <div class="alert alert-success" id="verify_mobile_success" style="display: none;">
                    <strong>Success!</strong> <span id="verify_mobile_success_msg"></span>
                </div>
                
                <div class="alert alert-danger" id="verify_mobile_error" style="display: none;">
                    <strong>Error!</strong> <span id="verify_mobile_error_msg"></span>
                </div>
                <!-- Verify Mobile Status Ends -->
                
                <form method="POST" name="verify_mobile_form" id="verify_mobile_form" action="<?php echo e(url('/')); ?>/otp/verify_mobile">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="email" id="verify_mobile_email" maxlength="80" />
                        <div class="error" id="err_verify_mobile_email"></div>
                    </div>

                    <button type="button" class="green-btn" id="btn_verify_mobile">Request OTP</button>
                    <h6>Already Verified? <a class="login_modal" href="#login_modal" data-toggle="modal" data-dismiss="modal">Sign in</a></h6>

                </form>

            </div>
        </div>
    </div>
</div>
<!--forgot password modal end-->

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#verify_mobile_email").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                VerifyMobileValidationCheck();
            }
        });

        function VerifyMobileValidationCheck()
        {
            var verify_mobile_email = $("#verify_mobile_email").val();
            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(verify_mobile_email) == '')
            {
                $('#verify_mobile_email').focus();
                $('#err_verify_mobile_email').show();
                $('#err_verify_mobile_email').html('Please enter email id.');
                $('#err_verify_mobile_email').fadeOut(4000);
                return false;  
            }
            else if(!email_filter.test(verify_mobile_email))
            {
                $('#verify_mobile_email').focus();
                $('#err_verify_mobile_email').show();
                $('#err_verify_mobile_email').html('Please enter valid email id.');
                $('#err_verify_mobile_email').fadeOut(4000);
                return false;  
            }
            else
            {
                showProcessingOverlay();
                var form     = $('#verify_mobile_form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url         : '<?php echo e(url("/")); ?>/otp/verify_mobile',
                    type        : 'post',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    cache       : false,
                    success     : function (res)
                    {
                        hideProcessingOverlay();
                        if(res.status == 'success')
                        {
                            $('#verify_mobile_form')[0].reset();

                            $("#verify_mobile_success_msg").html(res.message);
                            $("#verify_mobile_success").css('display','block').delay(4000).fadeOut();

                            $("#user_id_otp").val(res.user_id_otp);

                            // Auto hide otp form popup
                            setTimeout(function() {
                                $('#verify_mobile_modal').modal('hide');
                                $('#otp_verify_modal').modal('show');
                            }, 4000);
                        }
                        else
                        {
                            $("#verify_mobile_error_msg").html(res.message);
                            $("#verify_mobile_error").css('display','block').delay(4000).fadeOut();
                        }
                    }
                });
            }
        }

        $("#btn_verify_mobile").click(function(){
            VerifyMobileValidationCheck();
        });
    });
</script>