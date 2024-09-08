<!--forgot password modal start-->
<div class="modal fade login-modal" id="forget_password_modal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" data-replace="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/></button>
            <div class="modal-body">
                <h2>Forget Password</h2>
                <p>Please enter registered email id.</p>

                <!-- Forget Password Status Starts -->
                <div class="alert alert-success" id="forget_password_success" style="display: none;">
                    <strong>Success!</strong> <span id="forget_password_success_msg"></span>
                </div>
                
                <div class="alert alert-danger" id="forget_password_error" style="display: none;">
                    <strong>Error!</strong> <span id="forget_password_error_msg"></span>
                </div>
                <!-- Forget Password Status Ends -->
                
                <form method="POST" name="forget_password_form" id="forget_password_form" action="<?php echo e(url('/')); ?>/forget_password">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="email" id="forget_password_email" maxlength="80" />
                        <div class="error" id="err_forget_password_email"></div>
                    </div>

                    <button type="button" class="green-btn" id="btn_forget_password">Recover</button>
                    <h6>Remember Password? <a class="login_modal" href="#login_modal" data-toggle="modal" data-dismiss="modal">Sign in</a></h6>

                </form>

            </div>
        </div>
    </div>
</div>
<!--forgot password modal end-->

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#forget_password_email").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                ForgotPasswordValidationCheck();
            }
        });

        function ForgotPasswordValidationCheck()
        {
            var forget_password_email = $("#forget_password_email").val();
            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(forget_password_email) == '')
            {
                $('#forget_password_email').focus();
                $('#err_forget_password_email').show();
                $('#err_forget_password_email').html('Please enter email id.');
                $('#err_forget_password_email').fadeOut(4000);
                return false;  
            }
            else if(!email_filter.test(forget_password_email))
            {
                $('#forget_password_email').focus();
                $('#err_forget_password_email').show();
                $('#err_forget_password_email').html('Please enter valid email id.');
                $('#err_forget_password_email').fadeOut(4000);
                return false;  
            }
            else
            {
                showProcessingOverlay();
                var form     = $('#forget_password_form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url         : '<?php echo e(url("/")); ?>/forget_password',
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
                            $('#forget_password_form')[0].reset();

                            $("#forget_password_success_msg").html(res.message).delay(4000).fadeOut();
                            $("#forget_password_success").css('display','block').delay(4000).fadeOut();
                            // Auto hide signup form popup
                           /* setTimeout(function() {
                                $('#patient_signup_modal').modal('hide');
                                $('#patient_otp_verify_modal').modal('show');
                            }, 4000);*/
                        }
                        else
                        {
                            $("#forget_password_error_msg").html(res.message).delay(4000).fadeOut();
                            $("#forget_password_error").css('display','block').delay(4000).fadeOut();
                        }
                    }
                });
            }
        }


        $("#btn_forget_password").click(function(){
            ForgotPasswordValidationCheck();
        });
    });
</script>