<?php
    $browser_country_code = $browser_address = '';

    $user_browser_data = get_browser_data();
    if( isset($user_browser_data) && !empty($user_browser_data) )
    {
        $browser_country_code = isset( $user_browser_data['location']->countryCode ) ? $user_browser_data['location']->countryCode : '';
        $browser_address = isset( $user_browser_data['address'] ) ? $user_browser_data['address'] : '';
    }
?>

<!--forgot password modal start-->
<div class="modal fade login-modal" id="enter_mobile_modal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" data-replace="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/></button>
            <div class="modal-body">
                <h2>Enter Mobile No.</h2>
                <p>Please enter mobile no. and an OTP will be send for verification.</p>

                <!-- Enter Mobile Status Starts -->
                <div class="alert alert-success" id="enter_mobile_success" style="display: none;">
                    <strong>Success!</strong> <span id="enter_mobile_success_msg"></span>
                </div>
                
                <div class="alert alert-danger" id="enter_mobile_error" style="display: none;">
                    <strong>Error!</strong> <span id="enter_mobile_error_msg"></span>
                </div>
                <!-- Enter Mobile Status Ends -->
                
                <form method="POST" name="enter_mobile_form" id="enter_mobile_form" action="<?php echo e(url('/')); ?>/otp/enter_mobile">
                    <?php echo e(csrf_field()); ?>


                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pad-r-0">
                            <div class="form-group">
                                <select name="phone_code" id="enter_phone_code">
                                    <option value="">Code</option>
                                    <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                        <?php foreach($mobcode_data as $mobcode): ?>
                                            <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if( $browser_country_code == $mobcode['iso'] ): ?> selected <?php endif; ?> >+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="error" id="err_enter_phone_code"></div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="form-group">
                                <input type="text" placeholder="Mobile No." name="mobile" id="enter_mobile" maxlength="15" />
                                <div class="error" id="err_enter_mobile"></div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" id="enter_user_id" >

                    <button type="button" class="green-btn" id="btn_enter_mobile">Request OTP</button>
                    <!-- <h6>Already Verified? <a class="login_modal" href="#login_modal" data-toggle="modal" data-dismiss="modal">Sign in</a></h6> -->

                </form>

            </div>
        </div>
    </div>
</div>
<!--forgot password modal end-->

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#enter_mobile").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                EnterMobileValidationCheck();
            }
        });

        function EnterMobileValidationCheck()
        {
            var enter_phone_code = $("#enter_phone_code").val();
            var enter_mobile     = $("#enter_mobile").val();
            var enter_numeric    = /^[0-9]*$/;

            if($.trim(enter_phone_code) == '')
            {
                $('#enter_phone_code').focus();
                $('#err_enter_phone_code').show();
                $('#err_enter_phone_code').html('Please select country code.');
                $('#err_enter_phone_code').fadeOut(4000);
                return false;  
            }
            else if($.trim(enter_mobile) == '')
            {
                $('#enter_mobile').focus();
                $('#err_enter_mobile').show();
                $('#err_enter_mobile').html('Please enter mobile no.');
                $('#err_enter_mobile').fadeOut(4000);
                return false;  
            }
            else if(!enter_numeric.test(enter_mobile))
            {
                $('#enter_mobile').focus();
                $('#err_enter_mobile').show();
                $('#err_enter_mobile').html('Please enter valid mobile no.');
                $('#err_enter_mobile').fadeOut(4000);
                return false;  
            }
            else
            {
                showProcessingOverlay();
                var form     = $('#enter_mobile_form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url         : '<?php echo e(url("/")); ?>/otp/enter_mobile',
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
                            $('#enter_mobile_form')[0].reset();

                            $("#enter_mobile_success_msg").html(res.message);
                            $("#enter_mobile_success").css('display','block').delay(4000).fadeOut();

                            $("#user_id_otp").val(res.user_id_otp);

                            // Auto hide otp form popup
                            setTimeout(function() {
                                $('#enter_mobile_modal').modal('hide');
                                $('#otp_verify_modal').modal('show');
                            }, 4000);
                        }
                        else
                        {
                            $("#enter_mobile_error_msg").html(res.message);
                            $("#enter_mobile_error").css('display','block').delay(4000).fadeOut();
                        }
                    }
                });
            }
        }

        $("#btn_enter_mobile").click(function(){
            EnterMobileValidationCheck();
        });
    });
</script>