<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8 />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <meta http-equiv=X-UA-Compatible content="IE=edge" />
    <meta name=description content="" />
    <meta name=keywords content="" />
    <meta name=author content="" />
    <title>404</title>
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico" />
    <!--main css start-->
    <link href="<?php echo e(url('/')); ?>/public/front/css/bootstrap.css" rel=stylesheet type="text/css" />
    <link href="<?php echo e(url('/')); ?>/public/front/css/font-awesome.min.css" rel=stylesheet type="text/css" />
    <!--main css end-->
    <!--project css end-->
    <!--main js start-->
    <script src="<?php echo e(url('/')); ?>/public/front/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/front/js/bootstrap.min.js"></script>
    <!--main js end-->
    <!--project css start-->
    <link href="<?php echo e(url('/')); ?>/public/front/css/mobi-doctor.css" rel=stylesheet type="text/css" />
    


<style>
  <?php $url = url('/').'/public/front/images/404-banner.jpg'; ?>
    body{background-image:url(<?php echo e($url); ?>);background-repeat:no-repeat;background-size:cover;background-attachment: fixed;background-position: center center;}
    body:before{position: fixed;content: "";width: 100%;height: 100%;top: 0;left: 0;background-image: url(public/front/images/404-banner-bitted.png);
    display: block;}
</style>

</head>
  
  
   <body>
      <div class="container">
          <div class="wrapper-404">
             <div class="direction"></div>
              <h1>404</h1>
              <h4>Oops...Page Not Found !</h4>
              <h5>We're sorry, but page you were looking for doesnt exist.</h5>
              <div class="index-fore-btn-main">
              <a href="<?php echo e(url('/')); ?>" class="back-btn-foure">Go Back To Homepage</a>
              </div>
          </div>
      </div>
       
  
   
   </body>
   </html>