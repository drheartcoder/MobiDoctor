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
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-eye"></i>
    </span>
    <li class="active">{{ $page_title or ''}}</li>
  </ul>
</div>
<!-- END Breadcrumb -->


<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
    <div class="box">
        <div class="box-title">
            <h3>
              <i class="fa fa-text-width"></i>
              {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
              <a data-action="collapse" href="#"></a>
              <a data-action="close" href="#"></a>
            </div>
        </div>

        <div class="box-content">       
            <div class="row">
                 <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Review & Rating Details</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Doctor Name :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_rating_details['doctor_details']['first_name']) ? decrypt_value($arr_rating_details['doctor_details']['first_name']) : ''}} {{isset($arr_rating_details['doctor_details']['last_name']) ? decrypt_value($arr_rating_details['doctor_details']['last_name']) : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Patient Name :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_rating_details['patient_details']['first_name']) ? decrypt_value($arr_rating_details['patient_details']['first_name']) : ''}} {{isset($arr_rating_details['patient_details']['last_name']) ? decrypt_value($arr_rating_details['patient_details']['last_name']) : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Feedback :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_rating_details['feedback']) ? $arr_rating_details['feedback'] : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Rating :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_rating_details['rating']) ? $arr_rating_details['rating'] : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Added On :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_rating_details['created_at']) ? date('d M Y' , strtotime($arr_rating_details['created_at'])) : ''}}
                                        </div>
                                    </div>    

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <a href="{{$module_url_path}}" class="btn btn-cancel">Back</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    </div>
 
<!-- END Main Content -->
@stop
