@extends('admin.layout.master')                
@section('main_content')
<?php $admin_path = config('app.project.admin_panel_slug'); ?>

<?php
    $admin_type = '';
    $user = Sentinel::check();
    if($user->inRole(config('app.project.admin_panel_slug')))
    {
        $admin_type = 'ADMIN';
    }
    
    if ($user->inRole('sub-admin')) 
    {
        $admin_type = 'SUB-ADMIN';
    }
?>

    @if($admin_type == 'ADMIN')
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-file-o"></i> Dashboard</h1> 
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active"><i class="fa fa-home"></i> Home</li>

        </ul>
    </div>
    <!-- END Breadcrumb -->


    <!-- BEGIN Tiles -->
    <div class="row">

        <a href="{{ url($admin_panel_slug.'/patient')}}">
          <div class="col-md-3">
            <div class="tile tile-light-blue">
              <div class="img">
                <i class="fa fa-user"></i>
              </div>
              <div class="content">
                <p class="big">{{$patient_count or 0}}</p>
                <p class="title">Total Patient</p>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ url($admin_panel_slug.'/doctor')}}">
          <div class="col-md-3">
            <div class="tile tile-blue">
              <div class="img">
                <i class="fa fa-user-md"></i>
              </div>
              <div class="content">
                <p class="big">{{$doctor_count or 0}}</p>
                <p class="title">Total Doctor</p>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ url($admin_panel_slug.'/sub_admin')}}">
          <div class="col-md-3">
            <div class="tile tile-magenta">
              <div class="img">
                <i class="fa fa-users"></i>
              </div>
              <div class="content">
                <p class="big">{{$sub_admin_count or 0}}</p>
                <p class="title">Total Sub Admin</p>
              </div>
            </div>
          </div>
        </a>

        <a href="{{ url($admin_panel_slug.'/static_pages')}}">
          <div class="col-md-3">
            <div class="tile tile-pink">
              <div class="img">
                <i class="fa  fa-sitemap"></i>
              </div>
              <div class="content">
                <p class="big">{{$static_page_count or 0}}</p>
                <p class="title">Total Front Pages</p>
              </div>
            </div>
          </div>
        </a>

        

       
    </div>

    <!-- END Tiles -->
    @endif

    @if($admin_type == 'SUB-ADMIN')
         <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-file-o"></i> Dashboard</h1>
            <h4>Overview, stats, chat and more</h4>
             
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active"><i class="fa fa-home"></i> Home</li>

        </ul>
    </div>
    <!-- END Breadcrumb -->


    <!-- BEGIN Tiles -->
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6 tile-active">
                            <a class="tile tile-blue" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/account_settings'}}">
                                <div class="img img-center">
                                    <i class="fa fa-server"></i>
                                </div>
                                <p class="title text-center">Account Settings</p>
                            </a>

                            <a class="tile tile-green" href="{{ url('/').'/'.$admin_path.'/account_settings'}}">
                                <p>Manage your account Settings.</p>
                            </a>
                        </div>

                       <div class="col-md-6 tile-active">
                            <a class="tile tile-green" data-stop="3000" href="{{ url('/').'/'.$admin_path.'/static_pages'}}">
                                <div class="img img-center">
                                    <i class="fa  fa-sitemap"></i>
                                </div>
                                <p class="title text-center">Front Pages</p>
                            </a>

                            <a class="tile tile-pink" href="{{ url('/').'/'.$admin_path.'/static_pages'}}">
                                <p>Manage front pages, you can add,edit,delete by front pages also...</p>
                            </a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END Tiles -->
    @endif
               
@stop