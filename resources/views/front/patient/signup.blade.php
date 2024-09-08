@extends('front.layout.master')
@section('main_content')

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
                <h3>Create Account for Patient</h3>
            </div>
            
            <form method="POST" name="patient_signup_form" id="patient_signup_form" autocomplete="off" action="{{ url('/') }}/patient/signup/store">
                {{ csrf_field() }}
                
                <div class="doctor-signup-form">

                    <!-- Registration Status Starts -->
                    <div class="alert alert-success" id="patient_signup_success" style="display: none;">
                        <strong>Success!</strong> <span id="patient_signup_success_msg"></span>
                    </div>
                    
                    <div class="alert alert-danger" id="patient_signup_error" style="display: none;">
                        <strong>Error!</strong> <span id="patient_signup_error_msg"></span>
                    </div>
                    <!-- Registration Status Ends -->
                    
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="pfname_div" >
                                <input type="text" id="pfirst_name" name="first_name" placeholder="First Name" maxlength="50" />
                                <div class="info-popup">Enter Your First Name</div>
                                <div class="error" id="err_pfirst_name"></div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group" id="plname_div" >
                                <input type="text" id="plast_name" name="last_name" placeholder="Last Name" maxlength="50" />
                                <div class="info-popup">Enter Your Last Name</div>
                                <div class="error" id="err_plast_name"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" id="pemail_div" ><!--invalid or valid or info-msg-->
                        <input type="text" placeholder="Email ID" name="email" id="pemail" maxlength="80" />
                        <div class="info-popup">Enter Your Email ID</div>
                        <div class="error" id="err_pemail"></div>
                    </div>

                    <div class="phone-code-block" id="pphone_div">
                        <div class="row">
                            <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 pad-r-0">
                                <div class="form-group">
                                    <select name="phone_code" id="pphone_code">
                                        <option value="">Code</option>
                                        @if(!empty($mobcode_data) && isset($mobcode_data))
                                            @foreach($mobcode_data as $mobcode)
                                                <option value="{{ $mobcode['phonecode'] }}" @if( $browser_country_code == $mobcode['iso'] ) selected @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="error" id="err_pphone_code"></div>
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile Number" name="mobile_no" id="pmobile_no" maxlength="15" />
                                    <div class="info-popup" >We strongly recommend adding a phone number. This will help verify your account and keep it safe.</div>
                                    <div class="error info-note" id="err_pmobile_no"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group password-block" id="ppassword_div"><!--invalid or valid-->
                        <input type="password" placeholder="Password" name="password" id="ppassword" maxlength="20" />
                        <div class="error" id="err_ppassword"></div>
                        <div class="info-popup">Create password you have never used before.this will help to keep your account safe</div>
                        <div class="password-error-list" id="pass_error" style="display: none;">
                            <ul>
                                <li id="ppass_length"><span>&nbsp;</span>Use 8 or more characters</li>
                                <li id="ppass_upper"><span>&nbsp;</span>Use upper case letters (e.g. ABC)</li>
                                <li id="ppass_lower"><span>&nbsp;</span>Use lower case letters (e.g. abc)</li>
                                <li id="ppass_number"><span>&nbsp;</span>Use a number (e.g. 1234)</li>
                                <li id="ppass_symbol"><span>&nbsp;</span>Use a symbol (e.g. !@#$) </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group" id="pconfirm_password_div">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" id="pconfirm_password" maxlength="20" />
                        <div class="error" id="err_pconfirm_password"></div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="paddress" placeholder="Address" name="address" id="autocomplete" value="{{ $browser_address or '' }}" maxlength="300" />
                        <div class="error" id="err_paddress"></div>
                    </div>

                    <div class="form-group" id="preferral_code_div" ><!--invalid or valid or info-msg-->
                        <input type="text" placeholder="Referral Code" name="referral_code" id="preferral_code" maxlength="10" />
                        <div class="info-popup">Enter Referral Code</div>
                        <div class="error" id="err_preferral_code"></div>
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
                        <div class="error" id="err_pgender"></div>
                    </div>

                    <div class="remember-block text-left">
                        <div class="check-box">
                            <input class="filled-in" id="pterms_condition" name="terms_condition" type="checkbox" required />
                            <label for="pterms_condition">Agree Terms &amp; Conditions</label>
                            <div class="error" id="err_pterms_condition"></div>
                        </div>
                    </div>

                    <input type="hidden" name="virgil_private_key" id="virgil_private_key">
                    <input type="hidden" name="refer_user_id" id="refer_user_id">

                    <button type="button" class="green-btn full-width" id="btn_submit_patient_signup">Create Account</button>
                    <div class="note">By clicking Create Account, you agree to our <a href="javascript:void(0)">License Agreement</a> and have read and acknowledge our <a href="javascript:void(0)">Privacy Statement.</a></div>
                </div>

            </form>

            <div class="form-footer">Already have an Account? <a data-backdrop="static" data-keyboard="false" href="#login_modal" data-toggle="modal">Sign In</a></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#pfirst_name').on('keyup blur',function()
        {
            $('#err_pfirst_name').show();
            $('#err_pfirst_name').html('');

            $("#pfname_div").addClass("valid");
            $("#pfname_div").removeClass("invalid");

            var pfirst_name = $(this).val();
            var alpha       = /^[a-zA-Z]*$/;
          
            if($.trim(pfirst_name) != '')
            {
                if(!alpha.test(pfirst_name))
                {
                    $('#err_pfirst_name').html('Please enter valid first name.');
                    
                    $("#pfname_div").addClass("invalid");
                    $("#pfname_div").removeClass("valid");
                    return false;
                }
                else
                {
                    $('#err_pfirst_name').html('');

                    $("#pfname_div").addClass("valid");
                    $("#pfname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#plast_name').on('keyup blur',function()
        {
            $('#err_plast_name').show();
            $('#err_plast_name').html('');
            
            $("#plname_div").addClass("valid");
            $("#plname_div").removeClass("invalid");
            
            var plast_name = $(this).val();
            var alpha       = /^[a-zA-Z]*$/;
          
            if($.trim(plast_name) != '')
            {
                if(!alpha.test(plast_name))
                {
                    $('#err_plast_name').html('Please enter valid last name.');
                    
                    $("#plname_div").addClass("invalid");
                    $("#plname_div").removeClass("valid");
                    return false;
                }
                else
                {
                    $('#err_plast_name').html('');

                    $("#plname_div").addClass("valid");
                    $("#plname_div").removeClass("invalid");
                    return true;
                }
            }
        });

        $('#pemail').on('blur keyup',function()
        {
            $('#err_pemail').show();
            $('#err_pemail').html('');
            var pemail = $(this).val();
            var pemail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          
            if($.trim(pemail) != '')
            {
                if(!pemail_filter.test(pemail))
                {
                    $('#err_pemail').html('Please enter valid email id.');
                    
                    $("#pemail_div").addClass("invalid");
                    $("#pemail_div").removeClass("valid");
                    $("#pemail_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();
                
                $.ajax({
                    url      : "{{ url('/') }}/check_duplicate_email",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token, email_id:pemail},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_pemail').html('Account with this email already exists');
                            $('#btn_submit_patient_signup').attr('disabled',true);

                            $("#pemail_div").addClass("info-msg");
                            $("#pemail_div").removeClass("valid");
                            $("#pemail_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#btn_submit_patient_signup').attr('disabled',false);

                            $("#pemail_div").addClass("valid");
                            $("#pemail_div").removeClass("invalid");
                            $("#pemail_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_pemail').html('Something has get wrong please try again later.');

                            $("#pemail_div").addClass("info-msg");
                            $("#pemail_div").removeClass("valid");
                            $("#pemail_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#preferral_code').on('blur keyup',function()
        {
            $('#err_preferral_code').show();
            $('#err_preferral_code').html('');
            var preferral_code = $(this).val();
           
            if($.trim(preferral_code) != '')
            {
            
                var token = $('input[name="_token"]').val();
                var refer_user_id = 0;
                
                $.ajax({
                    url      : "{{ url('/') }}/check_referral_code",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token, referral_code:preferral_code},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_preferral_code').html('Please enter valid referral code.');
                            $('#btn_submit_patient_signup').attr('disabled',true);

                            $("#preferral_code_div").addClass("info-msg");
                            $("#preferral_code_div").removeClass("valid");
                            $("#preferral_code_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#err_preferral_code').html('');
                            $('#btn_submit_patient_signup').attr('disabled',false);

                            $('#refer_user_id').val(res.refer_user_id);

                            $("#preferral_code_div").addClass("valid");
                            $("#preferral_code_div").removeClass("invalid");
                            $("#preferral_code_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_preferral_code').html('Something has get wrong please try again later.');

                            $("#preferral_code_div").addClass("info-msg");
                            $("#preferral_code_div").removeClass("valid");
                            $("#preferral_code_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#pmobile_no').on('blur keyup',function()
        {
            $('#err_pmobile_no').show();
            $('#err_pmobile_no').html('');
            var pmobile_no = $(this).val();
            var pnumeric   = /^[0-9]*$/;

            if($.trim(pmobile_no) != '')
            {
                if(!pnumeric.test(pmobile_no))
                {
                    $('#err_pmobile_no').html('Please enter valid mobile no.');
                    
                    $("#pphone_div").addClass("invalid");
                    $("#pphone_div").removeClass("valid");
                    $("#pphone_div").removeClass("info-msg");
                    return false;
                }

                var token = $('input[name="_token"]').val();

                $.ajax({
                    url      : "{{ url('/') }}/check_duplicate_mobile",
                    type     : "POST",
                    dataType : 'json',
                    data     : {_token:token, mobile_no:pmobile_no},
                    success  : function(res)
                    {
                        if($.trim(res.status) == 'error')
                        {
                            $('#err_pmobile_no').html('Mobile number already exists.');
                            $('#btn_submit_patient_signup').attr('disabled',true);

                            $("#pphone_div").addClass("info-msg");
                            $("#pphone_div").removeClass("valid");
                            $("#pphone_div").removeClass("invalid");
                            return false; 
                        }
                        else if($.trim(res.status) == 'success')
                        {
                            $('#btn_submit_patient_signup').attr('disabled',false);

                            $("#pphone_div").addClass("valid");
                            $("#pphone_div").removeClass("invalid");
                            $("#pphone_div").removeClass("info-msg");
                            return true;
                        }
                        else
                        {
                            $('#err_pmobile_no').html('Something went to wrong please try again later.');

                            $("#pphone_div").addClass("info-msg");
                            $("#pphone_div").removeClass("valid");
                            $("#pphone_div").removeClass("invalid");
                            return false;
                        }
                    }
                });
            }
        });

        $('#ppassword').on('keyup blur click',function()
        {
            $("#pass_error").css('display','block');

            $("#ppassword_div").removeClass("valid");
            $("#ppassword_div").removeClass("invalid");

            $("#ppass_length").addClass("invalid");
            $("#ppass_length").removeClass("valid");

            $("#ppass_upper").addClass("invalid");
            $("#ppass_upper").removeClass("valid");

            $("#ppass_lower").addClass("invalid");
            $("#ppass_lower").removeClass("valid");

            $("#ppass_number").addClass("invalid");
            $("#ppass_number").removeClass("valid");

            $("#ppass_symbol").addClass("invalid");
            $("#ppass_symbol").removeClass("valid");

            var ppassword = $(this).val();
            var pupper    = /[A-Z]/g;
            var plower    = /[a-z]/g;
            var pnumeric  = /[0-9]/g;
            var psymbol   = /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/g;
          
            if($.trim(ppassword) != '')
            {
                if(ppassword.length >= 8)
                {
                    $("#ppass_length").addClass("valid");
                    $("#ppass_length").removeClass("invalid");
                }
                else
                {
                    $("#ppass_length").addClass("invalid");
                    $("#ppass_length").removeClass("valid");
                }

                if(ppassword.match(pupper))
                {
                    $("#ppass_upper").addClass("valid");
                    $("#ppass_upper").removeClass("invalid");
                }
                else
                {
                    $("#ppass_upper").addClass("invalid");
                    $("#ppass_upper").removeClass("valid");
                }

                if(ppassword.match(plower))
                {
                    $("#ppass_lower").addClass("valid");
                    $("#ppass_lower").removeClass("invalid");
                }
                else
                {
                    $("#ppass_lower").addClass("invalid");
                    $("#ppass_lower").removeClass("valid");
                }

                if(ppassword.match(pnumeric))
                {
                    $("#ppass_number").addClass("valid");
                    $("#ppass_number").removeClass("invalid");
                }
                else
                {
                    $("#ppass_number").addClass("invalid");
                    $("#ppass_number").removeClass("valid");
                }

                if(ppassword.match(psymbol))
                {
                    $("#ppass_symbol").addClass("valid");
                    $("#ppass_symbol").removeClass("invalid");
                }
                else
                {
                    $("#ppass_symbol").addClass("invalid");
                    $("#ppass_symbol").removeClass("valid");
                }

                if( ppassword.length >= 8 && ppassword.match(pupper) && ppassword.match(plower) && ppassword.match(pnumeric) && ppassword.match(psymbol) )
                {
                    $("#ppassword_div").addClass("valid");
                    $("#ppassword_div").removeClass("invalid");
                }
                else
                {
                    $("#ppassword_div").addClass("invalid");
                    $("#ppassword_div").removeClass("valid");
                }
            }
        });

        $('#pconfirm_password').on('keyup blur',function()
        {
            $('#err_pconfirm_password').show();
            $('#err_pconfirm_password').html('');

            $("#pconfirm_password_div").removeClass("valid");
            $("#pconfirm_password_div").removeClass("invalid");

            var ppassword         = $("#ppassword").val();
            var pconfirm_password = $("#pconfirm_password").val();
          
            if($.trim(pconfirm_password) != '')
            {
                if( $.trim(ppassword) != $.trim(pconfirm_password) )
                {
                    $('#err_pconfirm_password').html('Password & Confirm Password does not match.');

                    $("#pconfirm_password_div").addClass("invalid");
                    $("#pconfirm_password_div").removeClass("valid");
                }
                else
                {
                    $('#err_pconfirm_password').html('');

                    $("#pconfirm_password_div").addClass("valid");
                    $("#pconfirm_password_div").removeClass("invalid");
                }
            }
        });

        $("#btn_submit_patient_signup").click(function()
        {
            PatientSignupValidationCheck();
        });

        $("#pfirst_name, #plast_name, #pemail, #pmobile_no, #pphone_code, #ppassword, #pconfirm_password, .paddress, .gender").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                PatientSignupValidationCheck();
            }
        });

        function PatientSignupValidationCheck()
        {
            var pfirst_name       = $('#pfirst_name').val();
            var plast_name        = $('#plast_name').val();
            var pemail            = $('#pemail').val();
            var pmobile_no        = $('#pmobile_no').val();
            var pphone_code       = $('#pphone_code').val();
            var paddress          = $('.paddress').val();
            var ppassword         = $('#ppassword').val();
            var pconfirm_password = $('#pconfirm_password').val();
            var pgender           = $('.gender').is(':checked');
            var pgender_value     = $("input[name='gender']:checked").val();
            var pterms_condition  = $("#pterms_condition").is(":checked");
            var pemail_filter     = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var alpha             = /^[a-zA-Z]*$/;
            var numeric           = /^[0-9]*$/;

            if($.trim(pfirst_name) == '')
            {
                $('#pfirst_name').focus();
                $('#err_pfirst_name').show();
                $('#err_pfirst_name').html('Please enter first name.');
                $('#err_pfirst_name').fadeOut(4000);
                return false;
            }  
            else if(!alpha.test(pfirst_name))
            {
                $('#pfirst_name').focus();
                $('#err_pfirst_name').show();
                $('#err_pfirst_name').html('Please enter valid first name.');
                $('#err_pfirst_name').fadeOut(4000);
                return false;
            }   
            else if($.trim(plast_name) == '')
            {
                $('#plast_name').focus();
                $('#err_plast_name').show();
                $('#err_plast_name').html('Please enter last name.');
                $('#err_plast_name').fadeOut(4000);
                return false;
            }
            else if(!alpha.test(plast_name))
            {
                $('#plast_name').focus();
                $('#err_plast_name').show();
                $('#err_plast_name').html('Please enter valid last name.');
                $('#err_plast_name').fadeOut(4000);
                return false;
            }
            else if($.trim(pemail) == '')
            {
                $('#pemail').focus();
                $('#err_pemail').show();
                $('#err_pemail').html('Please enter email id.');
                $('#err_pemail').fadeOut(4000);
              return false;  
            }
            else if(!pemail_filter.test(pemail))
            {
                $('#pemail').focus();
                $('#err_pemail').show();
                $('#err_pemail').html('Please enter valid email id.');
                $('#err_pemail').fadeOut(4000);
                return false;  
            }
            else if($.trim(pphone_code) == '')
            {
               $('#pphone_code').focus();
               $('#err_pphone_code').show();
               $('#err_pphone_code').html('Please select mobile code.');
               $('#err_pphone_code').fadeOut(4000);
               return false;  
            }
            else if($.trim(pmobile_no) == '')
            {
                $('#pmobile_no').focus();
                $('#err_pmobile_no').show();
                $('#err_pmobile_no').html('Please enter mobile number.');
                $('#err_pmobile_no').fadeOut(4000);
                return false;
            }
            else if(!numeric.test(pmobile_no))
            {
                $('#pmobile_no').focus();
                $('#err_pmobile_no').show();
                $('#err_pmobile_no').html('Please enter valid mobile.');
                $('#err_pmobile_no').fadeOut(4000);
                return false;
            }
            else if($.trim(ppassword) == '')
            {
                $('#ppassword').focus();
                $('#err_ppassword').show();
                $('#err_ppassword').html('Please enter Password.');
                $('#err_ppassword').fadeOut(4000);
                return false;
            }
            else if($.trim(ppassword).length < 8)
            {
                $('#ppassword').focus();
                $('#err_ppassword').show();
                $('#err_ppassword').html('For better security, use a password 8 characters long.');
                $('#err_ppassword').fadeOut(4000);
                return false;
            }
            else if($.trim(pconfirm_password) == '')
            {
                $('#pconfirm_password').focus();
                $('#err_pconfirm_password').show();
                $('#err_pconfirm_password').html('Please enter Confirm Password.');
                $('#err_pconfirm_password').fadeOut(4000);
                return false;
            }
            else if($.trim(ppassword) != $.trim(pconfirm_password))
            {
                $('#pconfirm_password').focus();
                $('#err_pconfirm_password').show();
                $('#err_pconfirm_password').html('Password & Confirm Password does not match.');
                $('#err_pconfirm_password').fadeOut(4000);
                return false;
            }
            else if($.trim(paddress) == '')
            {
                $('.paddress').focus();
                $('#err_paddress').show();
                $('#err_paddress').html('Please enter address.');
                $('#err_paddress').fadeOut(4000);
                return false;
            }
            else if($.trim(pgender) == 'false')
            {
                $('#pgender').focus();
                $('#err_pgender').show();
                $('#err_pgender').html('Please select gender.');
                $('#err_pgender').fadeOut(4000);
                return false;
            }
            else if(pterms_condition == '' && pterms_condition == false)
            {
                $('#pterms_condition').focus();
                $('#err_pterms_condition').show();
                $('#err_pterms_condition').html('Please check terms & condition.');
                $('#err_pterms_condition').fadeOut(4000);
                return false;
            }
            else
            {
                var card_data = create_card(pemail);

                if($.trim(card_data[1]) == 'success')
                {
                    $("#virgil_private_key").val(card_data[0]);

                    var form = $('#patient_signup_form')[0];
                    var formData = new FormData(form);

                    $.ajax({
                        url         : '{{ url("/") }}/patient/signup/store',
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
                                $('#patient_signup_form')[0].reset();

                                $("#pass_error").css('display','none');

                                $("#patient_signup_success_msg").html(res.message);
                                $("#patient_signup_success").css('display','block').delay(4000).fadeOut();
                                $('#user_id_otp').val(res.user_id);

                                setTimeout(function() {
                                    $('#otp_verify_modal').modal('show');
                                }, 4000);
                            }
                            else
                            {
                                $("#patient_signup_error_msg").html(res.message);
                                $("#patient_signup_error").css('display','block').delay(4000).fadeOut();
                            }
                        }
                    });
                }
                else
                {
                    hideProcessingOverlay();
                    $("#patient_signup_error_msg").html('Something went wrong while registration, Please try again.');
                    $("#patient_signup_error").css('display','block').delay(4000).fadeOut();
                    return false;
                }
            }
        }

    });
</script>

@endsection