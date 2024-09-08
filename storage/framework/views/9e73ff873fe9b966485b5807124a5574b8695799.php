<!--signup modal start-->
<div class="modal fade login-modal" id="otp_verify_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/></button>
            <div class="modal-body">

                <form method="POST" name="otp_verify_form" id="otp_verify_form" autocomplete="off" action="<?php echo e(url('/')); ?>/otp/verify">
                    <?php echo e(csrf_field()); ?>

                    
                    <h3>Mobile Verification</h3>
                    <p>OTP is send to the registered mobile number</p>

                    <!-- Mobile Verification Status Starts -->
                    <div class="alert alert-success" id="otp_verify_success" style="display: none;">
                        <strong>Success!</strong> <span id="otp_verify_success_msg"></span>
                    </div>
                    
                    <div class="alert alert-danger" id="otp_verify_error" style="display: none;">
                        <strong>Error!</strong> <span id="otp_verify_error_msg"></span>
                    </div>
                    <!-- Mobile Verification Status Ends -->
                                        
                    <div class="signup-step-wrapper">
                        <div class="signup-step active">

                            <div class="form-group">
                                <input type="text" placeholder="Verify OTP" name="otp" id="otp" maxlength="4" />
                                <div class="error" id="err_potp"></div>
                            </div>

                            <input type="hidden" name="user_id_otp" id="user_id_otp" value="" />

                            <button class="green-btn" type="button" id="btn_submit_otp_verify">Verify</button>
                            <button class="green-btn" type="button" id="btn_resend_otp">Resend OTP</button>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!--signup modal end-->

<script type="text/javascript">

    $(document).ready(function()
    {
        // number validation for mobile no
        $('#otp').keydown(function () {
            $(this).val($(this).val().replace(/[^\d]/, ''));
            $(this).keyup(function () {
                $(this).val($(this).val().replace(/[^\d]/, ''));
            });
        });

        $("#otp").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                submit_potp_form();
            }
        });

        $("#btn_submit_otp_verify").click(function()
        {
            submit_otp_form();
        });

        function submit_otp_form()
        {
            $("#otp_verify_error_msg").html('');
            $("#otp_verify_success_msg").html('');

            var numeric = /^[0-9]*$/;
            var otp    = $('#otp').val();
            var user_id = $('#user_id_otp').val();

            if($.trim(otp) == '')
            {
                $('#otp').focus();
                $('#err_otp').show();
                $('#err_otp').html('Please enter otp number.');
                $('#err_otp').fadeOut(4000);
                return false;
            }
            else if(!numeric.test(otp))
            {
                $('#otp').focus();
                $('#err_otp').show();
                $('#err_otp').html('Please enter valid otp.');
                $('#err_otp').fadeOut(4000);
                return false;
            }
            else
            {
                showProcessingOverlay();

                var form = $('#otp_verify_form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url         : '<?php echo e(url("/")); ?>/otp/verify',
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
                            // reset otp form
                            $('#otp_verify_form')[0].reset();

                            $("#otp_verify_success_msg").html('Mobile verification successfully completed.');
                            $("#otp_verify_success").css('display','block');

                            // Auto hide otp form popup
                            setTimeout(function() {
                                $('#otp_verify_modal').modal('hide');

                                if(res.social_login == 'yes')
                                {
                                    window.location.href = "<?php echo e(url('/')); ?>/"+res.user_type+"/dashboard";
                                }
                                else
                                {
                                    window.location.href = "<?php echo e(url('/')); ?>";
                                }
                            }, 4000);
                        }
                        else
                        {
                            $("#otp_verify_error_msg").html('Something went wrong while verification.');
                            $("#otp_verify_error").css('display','block').delay(4000).fadeOut();
                        }
                    }
                });
            }
        }

        $("#btn_resend_otp").click(function()
        {
            showProcessingOverlay();

            var user_id = $('#user_id_otp').val();
            var _token  = "<?php echo e(csrf_token()); ?>";

            $.ajax({
                url      : '<?php echo e(url("/")); ?>/otp/resend',
                type     : 'post',
                data     : { _token:_token, user_id:user_id },
                dataType : 'json',
                success  : function (res)
                {
                    hideProcessingOverlay();
                    if(res.status == 'success')
                    {
                        $('#otp').val('');

                        $("#otp_verify_success_msg").html('OTP is resend to the registered mobile number.');
                        $("#otp_verify_success").css('display','block').delay(4000).fadeOut();
                    }
                    else
                    {
                        $("#otp_verify_error_msg").html('Something went wrong while sending OTP.');
                        $("#otp_verify_error").css('display','block').delay(4000).fadeOut();
                    }
                }
            });
        });

    });

</script>