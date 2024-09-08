<?php $__env->startSection('main_content'); ?>

<style>
    .pac-container{ z-index: 9999; }
</style>

<?php
    $browser_country_code = $browser_address = '';

    $user_browser_data = get_browser_data();
    if( isset($user_browser_data) && !empty($user_browser_data) )
    {
        $browser_country_code = isset( $user_browser_data['location']->countryCode ) ? $user_browser_data['location']->countryCode : '';
        $browser_address = isset( $user_browser_data['address'] ) ? $user_browser_data['address'] : '';
    }
?>

<div class="page-wrapper doctor-signup-wrapper">
    <div class="container">
        <div class="doctor-signup-section">
            <div class="form-header">
                <h3>Create Account for Doctor</h3>
            </div>
            
            <form method="POST" name="doctor_signup_form" id="doctor_signup_form" autocomplete="off" action="<?php echo e(url('/')); ?>/doctor/signup/store">
                <?php echo e(csrf_field()); ?>

                
                <div class="doctor-signup-form">

                    <!-- Registration Status Starts -->
                    <div class="alert alert-success" id="doctor_signup_success" style="display: none;">
                        <strong>Success!</strong> <span id="doctor_signup_success_msg"></span>
                    </div>
                    
                    <div class="alert alert-danger" id="doctor_signup_error" style="display: none;">
                        <strong>Error!</strong> <span id="doctor_signup_error_msg"></span>
                    </div>
                    <!-- Registration Status Ends -->
                    
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="dfname_div" >
                                <input type="text" id="dfirst_name" name="first_name" placeholder="First Name" maxlength="50" />
                                <div class="info-popup">Enter Your First Name</div>
                                <div class="error" id="err_dfirst_name"></div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="dlname_div" >
                                <input type="text" id="dlast_name" name="last_name" placeholder="Last Name" maxlength="50" />
                                <div class="info-popup">Enter Your Last Name</div>
                                <div class="error" id="err_dlast_name"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" id="demail_div" ><!--invalid or valid or info-msg-->
                        <input type="text" placeholder="Email ID" name="email" id="demail" maxlength="80" />
                        <div class="info-popup">Enter Your Email ID</div>
                        <div class="error" id="err_demail"></div>
                    </div>

                    <div class="phone-code-block" id="dphone_div">
                        <div class="row">
                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 pad-r-0">
                                <div class="form-group">
                                    <select name="phone_code" id="dphone_code">
                                        <option value="">Code</option>
                                        <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                            <?php foreach($mobcode_data as $mobcode): ?>
                                                <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if( $browser_country_code == $mobcode['iso'] ): ?> selected <?php endif; ?> >+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="error" id="err_dphone_code"></div>
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile Number" name="mobile_no" id="dmobile_no" maxlength="15" />
                                    <div class="info-popup" >We strongly recommend adding a phone number. This will help verify your account and keep it safe.</div>
                                    <div class="error info-note" id="err_dmobile_no"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group password-block" id="dpassword_div"><!--invalid or valid-->
                        <input type="password" placeholder="Password" name="password" id="dpassword" maxlength="20" />
                        <div class="error" id="err_dpassword"></div>
                        <div class="info-popup">Create password you have never used before.this will help to keep your account safe</div>
                        <div class="password-error-list" id="pass_error" style="display: none;">
                            <ul>
                                <li id="dpass_length"><span>&nbsp;</span>Use 8 or more characters</li>
                                <li id="dpass_upper"><span>&nbsp;</span>Use upper case letters (e.g. ABC)</li>
                                <li id="dpass_lower"><span>&nbsp;</span>Use lower case letters (e.g. abc)</li>
                                <li id="dpass_number"><span>&nbsp;</span>Use a number (e.g. 1234)</li>
                                <li id="dpass_symbol"><span>&nbsp;</span>Use a symbol (e.g. !@#$) </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group" id="dconfirm_password_div">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" id="dconfirm_password" maxlength="20" />
                        <div class="error" id="err_dconfirm_password"></div>
                    </div>

                    <div class="form-group country-block">
                        <input type="text" class="daddress" placeholder="Address" name="address" id="autocomplete" value="<?php echo e(isset($browser_address) ? $browser_address : ''); ?>" maxlength="300" />
                        <div class="error" id="err_daddress"></div>
                    </div>

                    <div class="form-group radio-btns">
                        <label>Gender </label>
                        <div class="radio-btn">
                            <input class="gender" type="radio" name="gender" id="male" value="Male" />
                            <label for="male">Male</label>
                            <div class="check"></div>
                        </div>
                        <div class="radio-btn">
                            <input class="gender" type="radio" name="gender" id="female" value="Female" />
                            <label for="female">Female</label>
                            <div class="check"></div>
                        </div>
                        <div class="error" id="err_dgender"></div>
                    </div>

                    <div class="remember-block text-left">
                        <div class="check-box">
                            <input class="filled-in" id="dterms_condition" name="terms_condition" type="checkbox" required />
                            <label for="dterms_condition">Agree Terms &amp; Conditions</label>
                            <div class="error" id="err_dterms_condition"></div>
                        </div>
                    </div>

                    <input type="hidden" name="virgil_private_key" id="dvirgil_private_key">

                    <button type="button" class="green-btn full-width" id="btn_submit_doctor_signup">Create Account</button>
                    <div class="note">By clicking Create Account, you agree to our <a href="javascript:void(0)">License Agreement</a> and have read and acknowledge our <a href="javascript:void(0)">Privacy Statement.</a></div>
                </div>

            </form>

            <div class="form-footer">Already have an Account? <a data-backdrop="static" data-keyboard="false" href="#login_modal" data-toggle="modal">Sign In</a></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#dfirst_name').on('keyup blur',function()
        {
            $('#err_dfirst_name').show();
            $('#err_dfirst_name').html('');

            $("#dfname_div").addClass("valid");
            $("#dfname_div").removeClass("invalid");

            var dfirst_name = $(this).val();
            var alpha       = /^[a-zA-Z]*$/;
          
            if($.trim(dfirst_name) != '')
            {
                if(!alpha.test(dfirst_name))
                {
                    $('#err_dfirst_name').html('Please enter valid first name.');
                    
                    $("#dfname_div").addClass("invalid");
                    $("#dfname_div").removeClass("valid");
                    return false;
                }
                else
                {
                    $('#err_dfirst_name').html('');

                    $("#dfname_div").addClass("valid");
                    $("#dfname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#dlast_name').on('keyup blur',function()
        {
            $('#err_dlast_name').show();
            $('#err_dlast_name').html('');
            
            $("#dlname_div").addClass("valid");
            $("#dlname_div").removeClass("invalid");
            
            var dlast_name = $(this).val();
            var alpha       = /^[a-zA-Z]*$/;
          
            if($.trim(dlast_name) != '')
            {
                if(!alpha.test(dlast_name))
                {
                    $('#err_dlast_name').html('Please enter valid last name.');
                    
                    $("#dlname_div").addClass("invalid");
                    $("#dlname_div").removeClass("valid");
                    return false;
                }
                else
                {
                    $('#err_dlast_name').html('');

                    $("#dlname_div").addClass("valid");
                    $("#dlname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#demail').on('blur keyup',function()
        {
            $('#err_demail').show();
            $('#err_demail').html('');
            var demail = $(this).val();
            var demail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          
            if($.trim(demail) != '')
            {
                if(!demail_filter.test(demail))
                {
                    $('#err_demail').html('Please enter valid email id.');
                    
                    $("#demail_div").addClass("invalid");
                    $("#demail_div").removeClass("valid");
                    $("#demail_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();
                
                $.ajax({
                    url      : "<?php echo e(url('/')); ?>/check_duplicate_email",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token,email_id:demail},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_demail').html('Account with this email already exists');
                            $('#btn_submit_doctor_signup').attr('disabled',true);

                            $("#demail_div").addClass("info-msg");
                            $("#demail_div").removeClass("valid");
                            $("#demail_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#btn_submit_doctor_signup').attr('disabled',false);

                            $("#demail_div").addClass("valid");
                            $("#demail_div").removeClass("invalid");
                            $("#demail_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_demail').html('Something has get wrong please try again later.');

                            $("#demail_div").addClass("info-msg");
                            $("#demail_div").removeClass("valid");
                            $("#demail_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#dmobile_no').on('blur keyup',function()
        {
            $('#err_dmobile_no').show();
            $('#err_dmobile_no').html('');
            var dmobile_no = $(this).val();
            var dnumeric   = /^[0-9]*$/;

            if($.trim(dmobile_no) != '')
            {
                if(!dnumeric.test(dmobile_no))
                {
                    $('#err_dmobile_no').html('Please enter valid mobile no.');
                    
                    $("#dphone_div").addClass("invalid");
                    $("#dphone_div").removeClass("valid");
                    $("#dphone_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();

                $.ajax({
                    url      : "<?php echo e(url('/')); ?>/check_duplicate_mobile",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token, mobile_no:dmobile_no},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_dmobile_no').html('Mobile number already exists.');
                            $('#btn_submit_doctor_signup').attr('disabled',true);

                            $("#dphone_div").addClass("info-msg");
                            $("#dphone_div").removeClass("valid");
                            $("#dphone_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#btn_submit_doctor_signup').attr('disabled',false);

                            $("#dphone_div").addClass("valid");
                            $("#dphone_div").removeClass("invalid");
                            $("#dphone_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_dmobile_no').html('Something went to wrong please try again later.');

                            $("#dphone_div").addClass("info-msg");
                            $("#dphone_div").removeClass("valid");
                            $("#dphone_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#dpassword').on('keyup blur click',function()
        {
            $("#pass_error").css('display','block');

            $("#dpassword_div").removeClass("valid");
            $("#dpassword_div").removeClass("invalid");

            $("#dpass_length").addClass("invalid");
            $("#dpass_length").removeClass("valid");

            $("#dpass_upper").addClass("invalid");
            $("#dpass_upper").removeClass("valid");

            $("#dpass_lower").addClass("invalid");
            $("#dpass_lower").removeClass("valid");

            $("#dpass_number").addClass("invalid");
            $("#dpass_number").removeClass("valid");

            $("#dpass_symbol").addClass("invalid");
            $("#dpass_symbol").removeClass("valid");

            var dpassword = $(this).val();
            var dupper    = /[A-Z]/g;
            var dlower    = /[a-z]/g;
            var dnumeric  = /[0-9]/g;
            var dsymbol   = /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/g;
          
            if($.trim(dpassword) != '')
            {
                if(dpassword.length >= 8)
                {
                    $("#dpass_length").addClass("valid");
                    $("#dpass_length").removeClass("invalid");
                }
                else
                {
                    $("#dpass_length").addClass("invalid");
                    $("#dpass_length").removeClass("valid");
                }

                if(dpassword.match(dupper))
                {
                    $("#dpass_upper").addClass("valid");
                    $("#dpass_upper").removeClass("invalid");
                }
                else
                {
                    $("#dpass_upper").addClass("invalid");
                    $("#dpass_upper").removeClass("valid");
                }

                if(dpassword.match(dlower))
                {
                    $("#dpass_lower").addClass("valid");
                    $("#dpass_lower").removeClass("invalid");
                }
                else
                {
                    $("#dpass_lower").addClass("invalid");
                    $("#dpass_lower").removeClass("valid");
                }

                if(dpassword.match(dnumeric))
                {
                    $("#dpass_number").addClass("valid");
                    $("#dpass_number").removeClass("invalid");
                }
                else
                {
                    $("#dpass_number").addClass("invalid");
                    $("#dpass_number").removeClass("valid");
                }

                if(dpassword.match(dsymbol))
                {
                    $("#dpass_symbol").addClass("valid");
                    $("#dpass_symbol").removeClass("invalid");
                }
                else
                {
                    $("#dpass_symbol").addClass("invalid");
                    $("#dpass_symbol").removeClass("valid");
                }

                if( dpassword.length >= 8 && dpassword.match(dupper) && dpassword.match(dlower) && dpassword.match(dnumeric) && dpassword.match(dsymbol) )
                {
                    $("#dpassword_div").addClass("valid");
                    $("#dpassword_div").removeClass("invalid");
                }
                else
                {
                    $("#dpassword_div").addClass("invalid");
                    $("#dpassword_div").removeClass("valid");
                }
            }
        });

        $('#dconfirm_password').on('keyup blur',function()
        {
            $('#err_dconfirm_password').show();
            $('#err_dconfirm_password').html('');

            $("#dconfirm_password_div").removeClass("valid");
            $("#dconfirm_password_div").removeClass("invalid");

            var dpassword         = $("#dpassword").val();
            var dconfirm_password = $("#dconfirm_password").val();
          
            if($.trim(dconfirm_password) != '')
            {
                if( $.trim(dpassword) != $.trim(dconfirm_password) )
                {
                    $('#err_dconfirm_password').html('Password & Confirm Password does not match.');

                    $("#dconfirm_password_div").addClass("invalid");
                    $("#dconfirm_password_div").removeClass("valid");
                }
                else
                {
                    $('#err_dconfirm_password').html('');

                    $("#dconfirm_password_div").addClass("valid");
                    $("#dconfirm_password_div").removeClass("invalid");
                }
            }
        });

        $("#btn_submit_doctor_signup").click(function()
        {
            DoctorSignupValidationCheck();
        });

        $("#dfirst_name, #dlast_name, #demail, #dmobile_no, #dphone_code, #dpassword, #dconfirm_password, .daddress, .gender").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                DoctorSignupValidationCheck();
            }
        });

        function DoctorSignupValidationCheck()
        {
            var dfirst_name       = $('#dfirst_name').val();
            var dlast_name        = $('#dlast_name').val();
            var demail            = $('#demail').val();
            var dmobile_no        = $('#dmobile_no').val();
            var dphone_code       = $('#dphone_code').val();
            var daddress          = $('.daddress').val();
            var dpassword         = $('#dpassword').val();
            var dconfirm_password = $('#dconfirm_password').val();
            var dgender           = $('.gender').is(':checked');
            var dgender_value     = $("input[name='gender']:checked").val();
            var dterms_condition  = $("#dterms_condition").is(":checked");
            var demail_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var alpha             = /^[a-zA-Z]*$/;
            var numeric           = /^[0-9]*$/;

            if($.trim(dfirst_name) == '')
            {
                $('#dfirst_name').focus();
                $('#err_dfirst_name').show();
                $('#err_dfirst_name').html('Please enter first name.');
                $('#err_dfirst_name').fadeOut(4000);
                return false;
            }  
            else if(!alpha.test(dfirst_name))
            {
                $('#dfirst_name').focus();
                $('#err_dfirst_name').show();
                $('#err_dfirst_name').html('Please enter valid first name.');
                $('#err_dfirst_name').fadeOut(4000);
                return false;
            }   
            else if($.trim(dlast_name) == '')
            {
                $('#dlast_name').focus();
                $('#err_dlast_name').show();
                $('#err_dlast_name').html('Please enter last name.');
                $('#err_dlast_name').fadeOut(4000);
                return false;
            }
            else if(!alpha.test(dlast_name))
            {
                $('#dlast_name').focus();
                $('#err_dlast_name').show();
                $('#err_dlast_name').html('Please enter valid last name.');
                $('#err_dlast_name').fadeOut(4000);
                return false;
            }
            else if($.trim(demail) == '')
            {
                $('#demail').focus();
                $('#err_demail').show();
                $('#err_demail').html('Please enter email id.');
                $('#err_demail').fadeOut(4000);
              return false;  
            }
            else if(!demail_filter.test(demail))
            {
                $('#demail').focus();
                $('#err_demail').show();
                $('#err_demail').html('Please enter valid email id.');
                $('#err_demail').fadeOut(4000);
                return false;  
            }
            else if($.trim(dphone_code) == '')
            {
               $('#dphone_code').focus();
               $('#err_dphone_code').show();
               $('#err_dphone_code').html('Please select mobile code.');
               $('#err_dphone_code').fadeOut(4000);
               return false;  
            }
            else if($.trim(dmobile_no) == '')
            {
                $('#dmobile_no').focus();
                $('#err_dmobile_no').show();
                $('#err_dmobile_no').html('Please enter mobile number.');
                $('#err_dmobile_no').fadeOut(4000);
                return false;
            }
            else if(!numeric.test(dmobile_no))
            {
                $('#dmobile_no').focus();
                $('#err_dmobile_no').show();
                $('#err_dmobile_no').html('Please enter valid mobile.');
                $('#err_dmobile_no').fadeOut(4000);
                return false;
            }
            else if($.trim(dpassword) == '')
            {
                $('#dpassword').focus();
                $('#err_dpassword').show();
                $('#err_dpassword').html('Please enter Password.');
                $('#err_dpassword').fadeOut(4000);
                return false;
            }
            else if($.trim(dpassword).length < 8)
            {
                $('#dpassword').focus();
                $('#err_dpassword').show();
                $('#err_dpassword').html('For better security, use a password 8 characters long.');
                $('#err_dpassword').fadeOut(4000);
                return false;
            }
            else if($.trim(dconfirm_password) == '')
            {
                $('#dconfirm_password').focus();
                $('#err_dconfirm_password').show();
                $('#err_dconfirm_password').html('Please enter Confirm Password.');
                $('#err_dconfirm_password').fadeOut(4000);
                return false;
            }
            else if($.trim(dpassword) != $.trim(dconfirm_password))
            {
                $('#dconfirm_password').focus();
                $('#err_dconfirm_password').show();
                $('#err_dconfirm_password').html('Password & Confirm Password does not match.');
                $('#err_dconfirm_password').fadeOut(4000);
                return false;
            }
            else if($.trim(daddress) == '')
            {
                $('#daddress').focus();
                $('#err_daddress').show();
                $('#err_daddress').html('Please enter address.');
                $('#err_daddress').fadeOut(4000);
                return false;
            }
            else if($.trim(dgender) == 'false')
            {
                $('#dgender').focus();
                $('#err_dgender').show();
                $('#err_dgender').html('Please select gender.');
                $('#err_dgender').fadeOut(4000);
                return false;
            }
            else if(dterms_condition == '' && dterms_condition == false)
            {
                $('#dterms_condition').focus();
                $('#err_dterms_condition').show();
                $('#err_dterms_condition').html('Please check terms & condition.');
                $('#err_dterms_condition').fadeOut(4000);
                return false;
            }
            else
            {
                var card_data = create_card(demail);

                if($.trim(card_data[1]) == 'success')
                {
                    $("#dvirgil_private_key").val(card_data[0]);

                    var form = $('#doctor_signup_form')[0];
                    var formData = new FormData(form);

                    $.ajax({
                        url         : '<?php echo e(url("/")); ?>/doctor/signup/store',
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
                                // reset signup form
                                $('#doctor_signup_form')[0].reset();

                                $("#pass_error").css('display','none');

                                $("#doctor_signup_success_msg").html(res.message);
                                $("#doctor_signup_success").css('display','block').delay(4000).fadeOut();
                                $('#user_id_otp').val(res.user_id);

                                setTimeout(function() {
                                    $('#otp_verify_modal').modal('show');
                                }, 4000);
                            }
                            else
                            {
                                $("#doctor_signup_error_msg").html(res.message);
                                $("#doctor_signup_error").css('display','block').delay(4000).fadeOut();
                            }
                        }
                    });
                }
                else
                {
                    hideProcessingOverlay();
                    $("#doctor_signup_error_msg").html('Something went wrong while registration, Please try again.');
                    $("#doctor_signup_error").css('display','block').delay(4000).fadeOut();
                    return false;
                }
            }
        }

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>