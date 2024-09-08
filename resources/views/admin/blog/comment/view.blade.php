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
      <i class="fa fa-sitemap"></i>
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-comment"></i>
      <a href="{{ $module_url_path }}/comment/{{base64_encode($arr_comments_details['blog_id'])}}">{{ $sub_module_title or ''}}</a>
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
                            <div class="panel-heading font-bold">Comment Details</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Comment :</label>
                                        <div class="col-lg-8">
                                           {{isset($arr_comments_details['comment']) ? decrypt_value($arr_comments_details['comment']) : ''}} 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">From :</label>
                                        <div class="col-lg-8">
                                           {{isset($arr_comments_details['comment']) ? decrypt_value($arr_comments_details['comment']) : ''}} 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Comment On :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_comments_details['created_at']) ? date('d M Y' , strtotime($arr_comments_details['created_at'])) : ''}}
                                        </div>
                                    </div>    

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <a href="{{$module_url_path}}/comment/{{base64_encode($arr_comments_details['blog_id'])}}" class="btn btn-cancel">Back</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    </div>
 
<!-- END Main Content -->
@stop
