<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo e(isset($site_settings['site_name']) ? $site_settings['site_name'] : ''); ?> Admin Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/chosen-bootstrap/chosen.min.css">
        
        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/css/flaty.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/css/flaty-responsive.css">

        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/favicon.ico">

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
                

            <form method="post" id="form-login" action="<?php echo e(url($admin_panel_slug.'/process_login')); ?>">
               
                 
                 <?php echo e(csrf_field()); ?>

                 
              
          
                 <h3>Login to your account</h3>
                 <hr/>
              
                 
                 <input type="hidden" value="<?php echo e(Session::get('mobile_no_err')); ?>" id="mobile_no_status">
                
                <?php if(Session::has('mobile_no_err')): ?>
                    
                <?php else: ?>
                    <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                <?php endif; ?>

                <div class="form-group ">
                    <div class="controls">
                    <input type="text" name="email" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email="true">
                        <span class="error"><?php echo e($errors->first('email')); ?> </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="controls">
                        <input type="password" name="password" class="form-control" placeholder="Password" data-rule-required="true">
                        <span class="error"><?php echo e($errors->first('password')); ?> </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="controls">
                    <button type="submit" name="btn_signin" class="btn btn-success form-control">Login</button> 
                    </div>
                </div>

                <hr/>

                <p class="clearfix">
                    <a href="#" class="goto-forgot pull-left">Forgot Password?</a>
                </p>
            </form>
            <!-- END Login Form -->

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="<?php echo e(url($admin_panel_slug.'/forgot_password')); ?>" method="post" style="display:none">
                <?php echo e(csrf_field()); ?>


                <?php if(Session::has('mobile_no_err')): ?>
                    <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php 
                        Session::forget('mobile_no_err');
                     ?>
                <?php endif; ?>

                <h3>Get back your password</h3>
                <hr/>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" placeholder="Email ID" class="form-control" data-rule-required="true" id="mobile_no" name="mobile_no"/>
                        <span class="error"><?php echo e($errors->first('mobile_no')); ?> </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary form-control">Recover</button>
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <a href="#" class="goto-login pull-left">← Back to login form</a>
                </p>
            </form>
            <!-- END Forgot Password Form -->

        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
       
    </body>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- <script>window.jQuery || document.write('<script src="<?php echo e(url('/')); ?>/public/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script> -->
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/jquery/jquery-2.1.4.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/jquery-cookie/jquery.cookie.js"></script>


    <script src="<?php echo e(url('/')); ?>/public/admin/assets/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
    

    <!--flaty scripts-->
    <script src="<?php echo e(url('/')); ?>/public/admin/js/flaty.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/js/flaty-demo-codes.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/admin/js/validation.js"></script>

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

        if($('#mobile_no_status').val() != '' || $('$mobile_no_status').val() != null && $('#mobile_no_status').val() =='not_registered' || $('#mobile_no_status').val() =='invalid_no')
        {
            form = 'forgot';
            $('.login-wrapper > form:visible').fadeOut(500, function(){
                $('#form-' + form).fadeIn(500);
            });
        }
    </script>
</html>

