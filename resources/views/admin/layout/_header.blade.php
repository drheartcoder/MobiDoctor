<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel=icon type="image/png" sizes=16x16 href="{{ url('/') }}/favicon.ico">

        <!--base css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.css" />

        <!--flaty css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/flaty.css">
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/flaty-responsive.css">


        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/admin/select2.min.css" />
       
       <!-- Auto load email address -->
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/chosen-bootstrap/chosen.min.css" />
       <script>window.jQuery || document.write('<script src="{{ url('/') }}/public/admin/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
       <script src="{{ url('/') }}/public/admin/js/select2.min.js"></script>
       <script src="{{ url('/') }}/public/admin/js/image_validation.js"></script>
       <script src="{{ url('/') }}/public/admin/js/admin_validations.js"></script>

        <!--basic scripts-->
        <script src="{{ url('/public/admin/js/sweetalert.min.js') }}"></script>    

        <!-- This is custom js for sweetalert messages -->
        <script type="text/javascript" src="{{ url('/public/admin/js/sweetalert_msg.js') }}"></script>
        <!-- Ends -->
        
        <link rel="stylesheet" type="text/css" href="{{ url('/public/admin/css/sweetalert.css') }}" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/jquery-tags-input/jquery.tagsinput.css" />
        
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-duallistbox/duallistbox/bootstrap-duallistbox.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/dropzone/downloads/css/dropzone.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/bootstrap-colorpicker/css/colorpicker.css" />

        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/chosen-bootstrap/chosen.min.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/admin/bootstrap-datepicker.css" />
        <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/admin/bootstrap-datepicker.min.css" />
        <!-- Virgil -->
        <script>
        var Module = {
            TOTAL_MEMORY: 1024 * 1024 * 256 // 768Mb
        };
        </script>
        {{-- <script crossorigin="anonymous" src="https://cdn.virgilsecurity.com/packages/javascript/sdk/4.5.1/virgil-sdk.min.js"></script> --}}

    </head>
    <body>
    <?php
            $admin_path = config('app.project.admin_panel_slug');
    ?>
        <!-- BEGIN Theme Setting -->
        <div id="theme-setting">
            <a href="#"><i class="fa fa-gears fa fa-2x"></i></a>
            <ul>
                <li>
                    <span>Skin</span>
                    <ul class="colors" data-target="body" data-prefix="skin-">
                        <li><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li class="active"><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Navbar</span>
                    <ul class="colors" data-target="#navbar" data-prefix="navbar-">
                        <li><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li class="active"><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Sidebar</span>
                    <ul class="colors" data-target="#main-container" data-prefix="sidebar-">
                        <li><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li class="active"><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span></span>
                    <a data-target="navbar" href="#"><i class="fa fa-square-o"></i> Fixed Navbar</a>
                    <a class="hidden-inline-xs" data-target="sidebar" href="#"><i class="fa fa-square-o"></i> Fixed Sidebar</a>
                </li>
            </ul>
        </div>
        <!-- END Theme Setting -->

        <?php 
            $admin_name = "Admin";
            $login_user_role = '';

            $user = Sentinel::check();
            if($user)
            {
                if($user->inRole('admin'))
                {
                    $login_user_role = 'admin';
                }
                else if($user->inRole('sub-admin'))
                {
                    $login_user_role = 'sub-admin';
                }
                $admin_name = decrypt_value($user->first_name).' '.decrypt_value($user->last_name);

            }
              
        ?>


        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">
                <small>
                    @if($login_user_role == 'admin')
                            Admin
                    @else
                        Sub Admin
                    @endif  
                </small>
            </a>

            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">

                <!-- BEGIN Button Notifications -->
                @if($login_user_role == 'admin')
                    <li class="hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell anim-swing"></i>
                            <span class="badge badge-important notifyCount">{{$notification_count}}</span>
                        </a>
                        <!-- BEGIN Notifications Dropdown -->
                        <ul class="dropdown-navbar dropdown-menu">
                            <li class="nav-header">
                                <i class="fa fa-warning"></i>
                                <span class="notifyCount">{{$notification_count}}</span> Notifications
                            </li>

                            <li class="notify">
                                <a href="{{ url('/').'/'.$admin_path }}/notification">
                                    <i class="fa fa-comment orange"></i>
                                    <p>New Notification</p>
                                    <span class="badge badge-warning notifyCount">{{$notification_count}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- END Button Notifications -->

                <!-- BEGIN Button User -->
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                         <!-- @if(isset($admin_profile_img) && $admin_profile_img!="") -->
                        <!-- <img class="nav-user-photo" src="{{$admin_profile_pic}}" alt="" /> -->
                        <!-- @endif -->
                        <span class="hhh" id="user_info">
                         <img class="nav-user-photo" src="{{$admin_profile_pic}}" alt="" /> {{$admin_name}}
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li>
                            <a href="{{ url('/').'/'.$admin_path }}/account_settings" >
                                <i class="fa fa-key"></i>
                                Account Settings
                            </a>    
                        </li>    
                        <li class="divider"></li>
                         <li>
                            <a href="{{ url('/').'/'.$admin_path }}/change_password" >
                                <i class="fa fa-key"></i>
                                Change Password
                            </a>    
                        </li>  
                        <li class="divider"></li>
                        <li>
                             <a href="{{ url('/').'/'.$admin_path }}/logout "> 
                                <i class="fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
        <!-- END Navbar -->
        
        <!-- BEGIN Container -->
        <div class="container" id="main-container">


<script type="text/javascript">

    var login_user_role = '{{ isset($login_user_role) ? $login_user_role :'' }}';

    if(login_user_role!='' && login_user_role=='admin')
    {
        check_notification_count();
    }
    
    function check_notification_count()
    {
        setInterval(function(){                
            
            var token = "<?php echo csrf_token(); ?>";
            if(token != '') {
                $.ajax(
                {
                    'url':'{{url("/")}}/admin/notification/get_count',                    
                    'type':'post',
                    'data':{_token:token},
                    success:function(res)   
                    {
                        if(res != '')
                        {
                            $('.notifyCount').html(res);
                        }
                        else if(res == '')
                        {
                            window.location.href = "{{url('/')}}";
                        }
                    }

                });
            }
        },10000);
    }
</script>
