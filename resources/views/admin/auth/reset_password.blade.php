<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $site_settings['site_name'] or '' }} Reset Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/chosen-bootstrap/chosen.min.css">
        
        <!--flaty css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/flaty.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/flaty-responsive.css">

        <link rel="shortcut icon" href="{{ url('/') }}/img/favicon.png">

        <style>
        .error
        {
            color: red;
        }
        .err
        {
            color:red;
        }
        </style>

    </head>
    <body class="login-page">

          
        <!-- BEGIN Main Content -->
        <div class="login-wrapper">

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="{{url($admin_panel_slug)}}/reset_password"  method="post">
            	 {{ csrf_field() }}

                @include('admin.layout._operation_status')

                <input type="hidden" class="form-control" name="enc_reminder_code" id="enc_reminder_code" value="{{ $enc_reminder_code }}" />
                <input type="hidden" class="form-control" name="enc_id" id="enc_id" value="{{ $enc_id }}" />

                <h3>Reset your password</h3>
                <hr/>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" class="form-control" name="password" id="new_password" data-rule-minlength="6" data-rule-required="true" placeholder="Password"/>
                        <span class='error'>{{ $errors->first('password') }}</span>
                    </div>
                <div class="err" id="err_password"></div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" data-rule-minlength="6" data-rule-required="true" data-rule-equalto="#new_password" placeholder="Confirm password"/>
                        <span class='error'>{{ $errors->first('confirm_password') }}</span>
                    </div>
                <div class="err" id="err_conpassword"></div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" id="reset_password" class="btn btn-primary form-control">Recover</button>
                    </div>
                </div>
                <hr/>
            </form>
            <!-- END Forgot Password Form -->
        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ url('/') }}/public/admin/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
        <script src="{{ url('/') }}/public/admin/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/jquery-cookie/jquery.cookie.js"></script>


        <script src="{{ url('/') }}/public/admin/assets/jquery-validation/dist/jquery.validate.min.js"></script>
		    <script src="{{ url('/') }}/public/admin/assets/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="{{ url('/') }}/public/admin/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
        

        <!--flaty scripts-->
        <script src="{{ url('/') }}/admin/admin/js/flaty.js"></script>
        <script src="{{ url('/') }}/admin/admin/js/flaty-demo-codes.js"></script>
        <script src="{{ url('/') }}/admin/admin/js/validation.js"></script>

        <script>
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() 
            {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });

                applyValidationToFrom($("#form-login"))
                applyValidationToFrom($("#form-forgot"))
            });

           
      $('#reset_password').click(function(event){ 
      
      var password  =  $('#new_password').val();
      var conpassword      =  $('#confirm_password').val();
     
      if($.trim(password)=='')
      {
         $('#err_password').show();
         $('#new_password').focus();
         $('#err_password').html('Please enter password.');
         $('#err_password').fadeOut(4000);
         return false;  
      }
      if($.trim(password).length<6)
      {
         $('#err_password').show();
         $('#new_password').focus();
         $('#err_password').html('Please enter password till 6 characters or more then 6 characters.');
         $('#err_password').fadeOut(4000);
         return false;  
      }
       if($.trim(conpassword)=='')
      {
         $('#err_conpassword').show();
         $('#confirm_password').focus();
         $('#err_conpassword').html('Please enter confirm password.');
         $('#err_conpassword').fadeOut(4000);
         return false;  
      }
      if($('#new_password').val() != $('#confirm_password').val()) {
                $('#err_conpassword').show();
         $('#conpassword').focus();
         $('#err_conpassword').html('Confirmed password does not match with password.');
         $('#err_conpassword').fadeOut(4000);
         return false;  
           }
   
      else
      {
         return true;
      }
            
       });
   
		
        </script>
    </body>
</html>

