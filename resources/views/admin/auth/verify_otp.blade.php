<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $site_settings['site_name'] or '' }} Admin Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/assets/chosen-bootstrap/chosen.min.css">
        
        <!--flaty css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/css/admin/flaty.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/css/admin/flaty-responsive.css">

        <link rel="shortcut icon" href="{{ url('/') }}/img/favicon.png">

        <style>
        .error
        {
            color: red;
        }
        </style>

    </head>
    <body class="login-page">
        <!-- BEGIN Main Content -->
        <div class="login-wrapper">
            <!-- BEGIN Login Form --> 

            <form id="form-otp">
                <div class="alert-box alert_error alert-dismissible" id="admin_error_msg" style="display: none;color:red">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>

                <div class="alert-box alert_success alert-dismissible" id="admin_success_msg" style="display: none;color:green">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="font-size: 20px;">×</span></button>    
                </div>
              
                <h3 style="margin-left:70px;">Verify OTP</h3>
                <hr/>
                  
                @include('admin.layout._operation_status')

                <div class="form-group ">
                    <div class="controls">
                    <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" data-rule-required="true" data-rule-email="true" maxlength="6">
                        <span class="err" style="color: red"></span>
                    </div>
                </div>
                    
                <div class="form-group">
                    <div class="controls">

                    <input type="hidden" id="otp_id" name="otp_id" value="{{isset($otp_id) ? $otp_id : ''}}">
                    <input type="hidden" id="password" name="password" value="{{isset($password) ? $password : ''}}">
                    <input type="hidden" id="email" name="email" value="{{isset($email) ? $email : ''}}">

                    <button type="button" name="btn_signin" class="btn btn-success form-control" id="btn_verify_otp">Verify OTP</button> 
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <span style="float: left;">Didn't get OTP? </span> <a href="javascript:void(0)" class="goto-forgot pull-left" id="btn_resend_otp"> &nbsp; Resend</a>
                </p>
            </form>
            <!-- END Login Form -->

        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
    </body>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ url('/') }}/public/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
    <script src="{{ url('/') }}/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/public/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url('/') }}/public/assets/jquery-cookie/jquery.cookie.js"></script>


    <script src="{{ url('/') }}/public/assets/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{{ url('/') }}/public/assets/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="{{ url('/') }}/public/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
    

    <!--flaty scripts-->
    <script src="{{ url('/') }}/public/js/admin/flaty.js"></script>
    <script src="{{ url('/') }}/public/js/admin/flaty-demo-codes.js"></script>
    <script src="{{ url('/') }}/public/js/admin/validation.js"></script>

<script>
    var url = "<?php echo url(''); ?>";
    $(document).ready(function(){

        $('#btn_verify_otp').click(function(){
            
            var otp    = $('#otp').val();
            otp_id     = $('#otp_id').val();
            password   = $('#password').val();
            email      = $('#email').val();
            
            if($('#otp').val()== '' || $('#otp').val() == null)
            {
                $('.err').show();
                $('.err').html("Please enter OTP that is sent on your registered mobile no.");
                $('.err').fadeOut(6000);
                return false;
            }
            else if($('#otp').val().length != 6)
            {
                $('.err').show();
                $('.err').html("Invalid OTP, Must have 6 digits");
                $('.err').fadeOut(4000);
                return false;
            }

            $.ajax({
                url:url+'/admin/verify_otp',
                type:'get',
                data:{
                        otp:otp,
                        otp_id:otp_id,
                        email:email,
                        password:password
                     },
                success:function(res){              
                    if(res.status=="success")
                    { 
                        if(res.msg=='')
                        {
                            window.location.href = "{{ url('/') }}/admin/dashboard";
                        }
                        else
                        {
                            $('#admin_error_msg').fadeIn(0, function()
                            {
                                $('#admin_error_msg').html(res.msg);
                            }).delay(6000).fadeOut('slow');
                        }
                    }
                    else if(res.status=="error" && res.msg!='')
                    {
                        $('#admin_error_msg').fadeIn(0, function()
                        {
                          $('#admin_error_msg').html(res.msg);
                        }).delay(6000).fadeOut('slow');
                    }
                }
            });
        });

        $('#btn_resend_otp').click(function(){
            var otp =$('#otp').val();
            var email = $('#email').val();
            $.ajax({
                url:url+'/admin/resend_otp',
                type:'get',
                data:{otp:otp,email:email},
                success:function(data){
                    $('#otp_id').val(data.otp_id);
                    $('#admin_success_msg').fadeIn(0, function()
                    {
                        $('#admin_success_msg').html(data.msg);
                    }).delay(6000).fadeOut('slow');
                }
            });
        });

        $('#otp').keypress(function(e){
            
            if(e.keyCode == '13')
            {
                e.preventDefault();
                $('#btn_verify_otp').click();
            }
        });
    });
</script>
</html>

