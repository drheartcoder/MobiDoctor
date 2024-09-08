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
            </span> 
            <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>{{ isset($page_title)?$page_title:"" }} </h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    @include('admin.layout._operation_status')

                      <form method="post" action="{{ url($module_url_path.'/update')}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">

                      {{ csrf_field() }}      
                       <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Facebook <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                              
                                <input type="text" class="form-control" name="facebook" id="facebook"  value="{{isset($arr_data['facebook_link'])?$arr_data['facebook_link']:''}}"/>
                                <span class='help-block' id="err_faecbook">{{ $errors->first('facebook') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Twitter <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="twitter" id="twitter"  value="{{isset($arr_data['twitter_link'])?$arr_data['twitter_link']:''}}"/>
                                <span class='help-block' id="err_twitter">{{ $errors->first('twitter') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Linkedin <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="linkedin" id="linkedin"  value="{{isset($arr_data['linkedin_link'])?$arr_data['linkedin_link']:''}}"/>
                                <span class='help-block' id="err_linkedin">{{ $errors->first('linkedin') }}</span>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Google plus <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="gplus" id="gplus"  value="{{isset($arr_data['google_link'])?$arr_data['google_link']:''}}"/>
                                <span class='help-block' id="err_google">{{ $errors->first('gplus') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Pinterest <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="pinterest" id="pinterest"  value="{{isset($arr_data['pinterest_link'])?$arr_data['pinterest_link']:''}}"/>
                                <span class='help-block' id="err_pinterest">{{ $errors->first('pinterest') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Instagram <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="instagram" id="instagram"  value="{{isset($arr_data['instagram_link'])?$arr_data['instagram_link']:''}}"/>
                                <span class='help-block' id="err_instagram">{{ $errors->first('instagram') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                              <input type="submit" name="btn_update" id="btn_update_link" class="btn btn-success" value="Update">
                            </div>
                       </div>
                    
                    </form>
                </div>
            </div>
        </div>
    
    <!-- END Main Content --> 
@endsection