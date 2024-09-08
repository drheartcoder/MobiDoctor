<!-- login modal start-->
<div class="modal fade login-modal" id="login_modal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" data-replace="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/></button>
            <div class="modal-body">
                <h2>Log in</h2>
                <p>Please login to your account.</p>

                <!-- Login Status Starts -->
                <div class="alert alert-success" id="login_success" style="display: none;">
                    <strong>Success!</strong> <span id="login_success_msg"></span>
                </div>
                
                <div class="alert alert-danger" id="login_error" style="display: none;">
                    <strong>Error!</strong> <span id="login_error_msg"></span>
                </div>
                <!-- Login Status Ends -->
                
                <form method="POST" name="login_form" id="login_form" action="<?php echo e(url('/')); ?>/login">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="email" id="email" maxlength="80" value="<?php echo e(isset($_COOKIE['remember_me_email']) && !empty($_COOKIE['remember_me_email']) ? $_COOKIE['remember_me_email'] : ''); ?>" />
                        <div class="error" id="err_email"></div>
                    </div>

                    <div class="form-group">
                        <input type="password" class="pwd-field" placeholder="Password" name="password" id="password" maxlength="20" value="<?php echo e(isset($_COOKIE['remember_me_password']) && !empty($_COOKIE['remember_me_password']) ? $_COOKIE['remember_me_password'] : ''); ?>" />
                        <div class="hide-pwd" id="hide_password" style="display: none;"><i class="fa fa-eye"></i></div>
                        <div class="hide-pwd" id="show_password"><i class="fa fa-eye-slash"></i></div>
                        <div class="error" id="err_password"></div>
                    </div>

                    <div class="remember-block text-left">
                        <div class="check-box">
                            <input class="filled-in" type="checkbox" id="remember_me" name="remember_me" />
                            <label for="remember_me">Remember me</label>
                        </div>
                        <div class="forget-pass">
                            <a href="#forget_password_modal" data-toggle="modal" data-dismiss="modal">Forgot Password?</a>
                            <br/>
                            <a href="#verify_mobile_modal" data-toggle="modal" data-dismiss="modal">Verify Mobile No.</a>
                        </div>
                    </div>

                    <button type="button" class="green-btn" id="btn_login">Login</button>
                    <div class="or-block"><span>Or</span></div>

                    <a onclick="FBLogin()" type="submit" class="facebook-btn" style="cursor: pointer;"><span><i class="fa fa-facebook"></i></span> Facebook</a>
                    <!-- <h6>Don't have an account? <a href="#patient_signup_modal" data-toggle="modal">Sign Up</a></h6> -->

                </form>

            </div>
        </div>
    </div>
</div>
<!--login modal end-->

<script type="text/javascript">

    $(document).ready(function()
    {
        /*--- Hide / Show Password Start ---*/
        $("#hide_password").click(function()
        {
            $("#password").attr('type','password');

            $("#hide_password").css('display', 'none');
            $("#show_password").css('display', 'block');
        });

        $("#show_password").click(function()
        {
            $("#password").attr('type','text');

            $("#hide_password").css('display', 'block');
            $("#show_password").css('display', 'none');
        });
        /*--- Hide / Show Password End ---*/


        $("#btn_login, #email, #password").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                UserLoginValidationCheck();
            }
        });

        function UserLoginValidationCheck()
        {
            var email        = $('#email').val();
            var password     = $('#password').val();
            var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if($.trim(email) == '')
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
            else if($.trim(password) == '')
            {
                $('#password').focus();
                $('#err_password').show();
                $('#err_password').html('Please enter Password.');
                $('#err_password').fadeOut(4000);
                return false;
            }
            else if($.trim(password).length < 6)
            {
                $('#password').focus();
                $('#err_password').show();
                $('#err_password').html('Please enter valid password');
                $('#err_password').fadeOut(4000);
                return false;
            }
            else
            {
                showProcessingOverlay();

                var form = $('#login_form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url         : '<?php echo e(url("/")); ?>/login',
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
                            // reset login form
                            $('#login_form')[0].reset();

                            $("#login_success_msg").html(res.msg);
                            $("#login_success").css('display','block').delay(4000).fadeOut();

                            // Auto hide login form popup
                            setTimeout(function() {
                                showProcessingOverlay();
                                $('#login_modal').modal('hide');
                                window.location.href = "<?php echo e(url('/')); ?>/"+res.usertype+"/dashboard";
                            }, 500);
                        }
                        else
                        {
                            $("#login_error_msg").html(res.msg);
                            $("#login_error").css('display','block').delay(4000).fadeOut();
                        }
                    }
                });
            }
        }

        $("#btn_login").click(function()
        {
            UserLoginValidationCheck();
        });
    });
    
    
    // For Facebook
    window.fbAsyncInit = function()
    {
        FB.init({
            appId: '<?php echo e(env("FACEBOOK_APP_ID")); ?>',
            status: true,
            cookie: true,
            xfbml: true,
            version: 'v2.4'
        });
    };

    function FBLogin(redirect_url)
    {
        showProcessingOverlay();

        redirect_url = redirect_url ? redirect_url : false;
        FB.login(function(fb_response)
        {
            if (fb_response.authResponse)
            {
                FB.api('/me', 'get',
                {
                    fields: 'id, email, first_name, last_name, picture'
                },
                function(profile_response)
                {
                    var email      = profile_response.email;
                    var fb_user_id = profile_response.id;
                    var first_name = profile_response.first_name;
                    var last_name  = profile_response.last_name;
                    var address    = profile_response.address;
                    var birthday   = profile_response.birthday;
                    var gender     = profile_response.gender;
                    var fb_token   = FB.getAuthResponse()['accessToken'];

                    var card_data  = create_card(email);

                    if($.trim(card_data[1]) == 'success')
                    {
                        var pprivate_key = card_data[0];

                        var dataObj =
                        {
                            "fb_user_id"   : fb_user_id,
                            "email"        : email,
                            "first_name"   : first_name,
                            "last_name"    : last_name,
                            "fb_token"     : fb_token,
                            "_token"       : "<?php echo e(csrf_token()); ?>",
                            "pprivate_key" : pprivate_key,
                        };

                        jQuery.ajax({
                            headers  :
                                {
                                    'X-CSRF-Token' : "<?php echo e(csrf_token()); ?>"
                                },
                            url      : '<?php echo e(url("/")); ?>/fblogin',
                            type     : 'POST',
                            data     : dataObj,
                            dataType : 'json',
                            success  : function(res)
                            {
                                hideProcessingOverlay();
                                if(res.status == 'success')
                                {
                                    // reset login form
                                    $('#login_form')[0].reset();

                                    $("#login_success_msg").html(res.msg);
                                    $("#login_success").css('display','block').delay(4000).fadeOut();

                                    // Auto hide login form popup
                                    setTimeout(function()
                                    {
                                        $('#login_modal').modal('hide');
                                        
                                        if(res.mobile_required == 'yes')
                                        {
                                            $('#enter_mobile_modal').modal('show');
                                            $("#enter_user_id").val(res.enc_user_id);
                                        }
                                        else
                                        {
                                            window.location.href = "<?php echo e(url('/')); ?>/"+res.usertype+"/dashboard";
                                        }
                                    }, 2000);
                                }
                                else
                                {
                                    $("#login_error_msg").html(res.msg);
                                    $("#login_error").css('display','block').delay(4000).fadeOut();
                                }
                            },
                        });
                    }
                    return false;
                });
            }
        },
        {
            scope: 'public_profile, email'
        });
    }

    function FBLogout()
    {
        FB.logout(function(response)
        {
            window.location.href = '<?php echo e(url("/")); ?>/patient/logout';
        });
    }(function(d, s, id) 
    {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) 
        {
            return;
        }
        
        js = d.createElement(s);
        js.id = id;
        js.src = SITE_URL + "/public/front/js/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>