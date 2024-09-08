<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8 />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <meta http-equiv=X-UA-Compatible content="IE=edge" />
    <meta name=description content="" />
    <meta name=keywords content="" />
    <meta name=author content="" />
    <title>{{ isset($page_title) ? $page_title : '' }}</title>
    <link rel=icon type="image/png" sizes=16x16 href="{{ url('/') }}/favicon.ico">

    <!--css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/mobi-doctor.css" /> 

    <!--main js start-->
    <script type="text/javascript" src="{{ url('/') }}/public/front/js/jquery-1.11.3.min.js" ></script>
    <script type="text/javascript" src="{{ url('/') }}/public/front/js/bootstrap.min.js" ></script>

    <!--loader js start-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/front/css/loading.css" />
    <script type="text/javascript" async src="{{ url('/') }}/public/front/js/loader.js" ></script>

    <!--basic scripts-->
    <script src="{{ url('/public/front/js/sweetalert.min.js') }}"></script>    

    <!-- This is custom js for sweetalert messages -->
    <script type="text/javascript" src="{{ url('/public/front/js/sweetalert_msg.js') }}"></script>
    <!-- Ends -->
    
    <link rel="stylesheet" type="text/css" href="{{ url('/public/front/css/sweetalert.css') }}" />

</head>

<body>

    <div id="header" class="inner-header">
        <header>
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-xs-5 col-sm-3 col-md-4 col-lg-4">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{ url('/') }}/public/front/images/logo-black.png" class="img-responsive logo-black" alt="MobiDoctor"/>
                        </a>
                    </div>
                  
                    <div class="col-xs-7 col-sm-9 col-md-8 col-lg-8 pad-l-0">
                        <div class="after-login-menu">
                            <ul>
                                <li>
                                    <div class="noti-block relative-block">
                                        <a class="noti-icon bg-img" href="{{ url('/') }}/patient/notification"></a>
                                        <span class="badge">{{$unread_notification_count or ''}}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile-drop-block relative-block">
                                        <div class="profile-name">
                                            <?php
                                                /*$user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
                                                $user_lastname  = isset($user_data['last_name']) && !empty($user_data['last_name']) ? decrypt_value($user_data['last_name']) : '';
                                                $profile_image  = isset($user_data['profile_image']) ? $user_data['profile_image'] : '';*/
                                                $social_login   = isset($user_data['social_login']) ? $user_data['social_login'] : '';
                                            ?>
                                            <b>{{ $user_firstname.' '.$user_lastname }}</b>
                                            <span>
                                            @if(isset($profile_image) && $profile_image!='')
                                                @if(file_exists($patient_profile_image_base_path.'/'.$profile_image))
                                                    <?php $profile_img_src = $patient_profile_image_public_path.'/'.$profile_image;  ?>
                                                @else
                                                    <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                                @endif
                                            @else
                                                <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                            @endif

                                            @if( $social_login == 'yes' )
                                                <?php $profile_img_src = $profile_image; ?>
                                            @endif

                                                <img src="{{$profile_img_src}}" class="img-responsive" alt="MobiDoctor"/>
                                            </span>
                                        </div>
                                        <ul>
                                            <li><a href="{{ url('/') }}/patient/dashboard">Dashboard <i class="fa fa-tachometer"></i></a></li>
                                            <li><a href="{{ url('/') }}/patient/my_account/about_me">My account <i class="fa fa-user"></i></a></li>
                                            <li><a href="{{ url('/') }}/logout">Log out <i class="fa fa-sign-out"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </header>
    </div>
    <div id="main"></div>

    <div class="blank-div"></div>

    <div class="breadcrum-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4>{{ isset($page_title) ? $page_title : '' }}</h4>
                </div>
                
                @if( isset($breadcrum_level_1) && !empty($breadcrum_level_1) && isset($breadcrum_level_2) && !empty($breadcrum_level_2) )
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <ul>
                            <li><a href="{{ isset($breadcrum_level_1_url) && !empty($breadcrum_level_1_url) ? $breadcrum_level_1_url : 'javascript:void(0)' }}">{{ isset($breadcrum_level_1) && !empty($breadcrum_level_1) ? $breadcrum_level_1 : '' }}</a></li>

                            @if( isset($breadcrum_level_2) && !empty($breadcrum_level_2) )
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="{{ isset($breadcrum_level_2_url) && !empty($breadcrum_level_2_url) ? $breadcrum_level_2_url : 'javascript:void(0)' }}">{{ isset($breadcrum_level_2) && !empty($breadcrum_level_2) ? $breadcrum_level_2 : '' }}</a></li>
                            @endif

                            @if( isset($breadcrum_level_3) && !empty($breadcrum_level_3) )
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="{{ isset($breadcrum_level_3_url) && !empty($breadcrum_level_3_url) ? $breadcrum_level_3_url : 'javascript:void(0)' }}">{{ isset($breadcrum_level_3) && !empty($breadcrum_level_3) ? $breadcrum_level_3 : '' }}</a></li>
                            @endif

                            @if( isset($breadcrum_level_4) && !empty($breadcrum_level_4) )
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="{{ isset($breadcrum_level_4_url) && !empty($breadcrum_level_4_url) ? $breadcrum_level_4_url : 'javascript:void(0)' }}">{{ isset($breadcrum_level_4) && !empty($breadcrum_level_4) ? $breadcrum_level_4 : '' }}</a></li>
                            @endif

                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
<script type="text/javascript">
    //var is_popup_show = false;
    
    $(document).ready(function()
    {
        check_new_call_coming();
        
        setInterval(function()
        {
            check_new_call_coming();
        },5000);
    });

    function check_new_call_coming()
    {
        $.ajax({
            url      : "{{ url('/')}}/patient/my_consultation/upcoming/is_patient_get_call",
            type     : 'GET',
            data     : 'flag=true',
            dataType : 'json',
            success  : function(response)
            {
                //if( ( response.status == 'success' && response.url != '') && is_popup_show == false )
                if( response.status == 'success' && response.url != '')
                {
                    //is_popup_show = true;

                    swal({
                        title              : 'Incoming Call',
                        text               : 'Doctor is calling for '+response.consult_id+' consultation.',
                        type               : 'warning',
                        showCancelButton   : true,
                        confirmButtonColor : '#63c2de',
                        confirmButtonText  : 'Accept',
                        cancelButtonText   : 'Reject',
                        closeOnConfirm     : false,
                        closeOnCancel      : true
                    },
                    function(isConfirm)
                    {
                        if(isConfirm == true)
                        {
                            /*ajax call to update the status*/
                            /*after update the status need to redirect to below url*/
                            window.location.assign(response.url);
                        }
                        else
                        {
                            var token = "{{ csrf_token() }}";
                            $.ajax({
                                url     : "{{ url('/')}}/patient/my_consultation/upcoming/patient_call_reject",
                                type    : "GET",
                                data    : { _token:token, consult_id:response.consult_id },
                                success : function(res)
                                {  }
                            });
                        }
                    });
                }
                else
                {
                }
            }     
        });
    }
</script>