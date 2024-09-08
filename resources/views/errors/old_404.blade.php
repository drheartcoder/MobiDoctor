<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <title>{{ isset($title)?$title:'Online Doctor | Book Doctors Online Australia | '.config('app.project.name') }}</title>
      <meta name="description" content="{{ isset($description)?$description:'Book doctor online in Australia in just a click away! doctoroo.com.au providing quality health related information and advice online and over the phone.' }}"/>
      <meta name="keywords" content="{{ isset($keywords)?$keywords:'Doctoroo' }}"/>
      <meta name="author" content="" />
      <meta property="og:title" content="Online Doctor | Book Doctors Online Australia | {{ config('app.project.name')}}" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.doctoroo.com.au" />
      <meta property="og:image" content="{{ url('/') }}/public/images/Doctroo.jpg" />
      <meta property="og:description" content="Doctroo" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
     
      <!-- ======================================================================== -->
       <link rel="icon" href="{{ url('/') }}/public/images/favicon.png" type="image/x-icon" />

      <!-- Bootstrap Core CSS -->
      <link href="{{ url('/') }}/public/404/css/bootstrap.min.css" rel="stylesheet" />
      <link href="{{ url('/') }}/public/404/css/doctroo.css" rel="stylesheet" />
      <!--font-awesome-css-start-here-->
      <link href="{{ url('/') }}/public/404/css/font-awesome.min.css" rel="stylesheet" />
      <!--model popup css-->
      <link href="{{ url('/') }}/public/404/css/bootstrap-modal.css" rel="stylesheet" />
      <style>
         .modal.container {max-width: none;}
         .modal-backdrop {position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;}
      </style>
      <link href="{{ url('/') }}/public/404/css/animate.css" rel="stylesheet"/>
      <script  src="{{ url('/') }}/public/404/js/jquery-1.11.3.min.js"></script>
   </head>
   <body>
     <div class="banner-404">
     <div class="container">
         <div class="man-404"><img src="{{ url('/') }}/public/404/images/man-404.png" class="img-responsive" alt="404-page" /></div>
          <div class="wrapper">
             <div class="img2-404page"><img src="{{ url('/') }}/public/404/images/404-small-img.png" class="img-responsive" alt="404-page" /></div>
              <h1>404</h1>
              <h4>Something is wrong</h4>
              <h5>The page you are looking for was moved, removed or might never existed</h5>
              <a href="{{ url('/') }}" class="back-btn"><span><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>Go Back To Homepage</a>
          </div>
          
      </div>
      
       </div> 
    
       <script>
           $(document).ready(function() { 
            $('.home_btn').click( function(){
                //window.location.href = ;
                alert();
            });
           })
       </script>
       </body>
</html>