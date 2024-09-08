    @extends('admin.layout.master')                


    @section('main_content')
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url('/'.$admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span>
            
            <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class=" box-title">
                    <h3><i class="fa fa-file"></i> Change Password</h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status') 
                    <form method="post" id="validation-form" class="form-horizontal" action="{{ url($admin_panel_slug.'/update_password') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Current password</label>
                            <div class="col-sm-9 col-lg-4 controls">
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" data-rule-required="true" >
                            <span class='help-block'>{{ $errors->first('current_password') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">New password</label>
                            <div class="col-sm-9 col-lg-4 controls">
                              <input type="password" name="new_password" id="new_password" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="New Password">   
                             <span class='help-block'>{{ $errors->first('new_password') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Re-type New password</label>
                            <div class="col-sm-9 col-lg-4 controls">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" data-rule-required="true" data-rule-equalto="#new_password" placeholder="Re-type New password">
                               <span class='help-block'>{{ $errors->first('new_password_confirmation') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                             <input type="submit" name="btn_save" class="btn btn-success" value="Save"> 
                            </div>
                       </div>
                  </form>
                </div>
            </div>
        </div>
    </div>


    <!-- END Main Content -->


@stop