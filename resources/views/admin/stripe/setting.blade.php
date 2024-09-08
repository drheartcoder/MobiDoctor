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
            <li>
                <i class="fa fa-cc-stripe"></i>
                <a href="javascript:void(0);">Stripe</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span> 
            <li class="active">{{ isset($page_title) ? $page_title : "" }}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i>{{ isset($page_title) ? $page_title : "" }} </h3>
                    <div class="box-tool">
                    </div>
                </div>

                <div class="box-content">
                    
                    @include('admin.layout._operation_status')

                    <form method="post" action="{{ url($module_url_path.'/update' )}}" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
                    {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">OAuth Link <font color="red">*</font></label>
                            <div class="col-sm-9 col-lg-4 controls">                              
                                <textarea class="form-control" name="oauth" id="oauth" rows="4" required>{{ isset($arr_data['oauth']) ? $arr_data['oauth'] : '' }}</textarea>
                                <span class='help-block' id="err_oauth">{{ $errors->first('oauth') }}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                              <input type="submit" name="btn_update" id="btn_update_status" class="btn btn-success" value="Update">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    
    <!-- END Main Content --> 
@endsection