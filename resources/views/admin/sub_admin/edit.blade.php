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
                <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-list"></i>
                <a href="{{ $module_url_path }}">Manage {{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-plus-square-o"></i>
            </span>
            <li class="active">{{ $page_title or ''}}</li>
        </ul>
      </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

          <div class="box box-blue">
            <div class="box-title">
              <h3>
                <i class="fa fa-plus-square-o"></i>
                {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
            </div>
        </div>
        <div class="box-content">

            @include('admin.layout._operation_status') 
            <form method="post" action="{{url($module_url_path.'/update')}}/{{$enc_id}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
            {{ csrf_field() }}
            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">First Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="first_name" value="{{isset($arr_sub_admin['first_name'])?decrypt_value($arr_sub_admin['first_name']):''}}" data-rule-required="true" data-rule-maxlength="255" data-rule-lettersonly ='true' placeholder="First Name" />
                      <span class="help-block">{{ $errors->first('first_name') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Last Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="last_name" value="{{isset($arr_sub_admin['last_name'])?decrypt_value($arr_sub_admin['last_name']):''}}"  data-rule-required="true" data-rule-maxlength="255"  placeholder="Last Name"  data-rule-lettersonly ='true' />
                      <span class="help-block">{{ $errors->first('last_name') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="email" class="form-control" name="email" value="{{isset($arr_sub_admin['email'])?$arr_sub_admin['email']:''}}"  data-rule-required="true" data-rule-email="true" data-rule-maxlength="255" placeholder="Email" />
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Password<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="password" class="form-control" name="password" value="{{ old('password') }}" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="255" id="password" placeholder="Password" />
                      <span class="help-block">{{ $errors->first('password') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Confirm Password<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" data-rule-required="true" data-rule-equalto="#password" data-rule-minlength="6" data-rule-maxlength="255" placeholder="Confirm Password"/>
                      <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                  </div>
            </div>  

            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <input type="submit"  class="btn btn-primary" value="Update">
            </div>
        </div>
    </form>
</div>
</div>
</div>

<!-- END Main Content -->
 
@stop                    