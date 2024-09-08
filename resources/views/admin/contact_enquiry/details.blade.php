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
      <i class="fa fa-user"></i>
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
              <div class="col-md-12">
                 <div class="box box-gray">

                    <div class="box-content">
                       <br>
                       <div class="form-group">
                          <label class="col-xs-2 col-lg-1 control-label">Name</label>
                          <div class="col-sm-2 col-lg-1">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{isset($arr_enquiry_details['name']) ? decrypt_value($arr_enquiry_details['name']) : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-2 col-lg-1 control-label">Email</label>
                          <div class="col-sm-2 col-lg-1">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{isset($arr_enquiry_details['email']) ? $arr_enquiry_details['email'] : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-2 col-lg-1 control-label">Mobile No</label>
                          <div class="col-sm-2 col-lg-1">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            +{{isset($arr_enquiry_details['phone_code']) ? $arr_enquiry_details['phone_code'] : ''}} {{isset($arr_enquiry_details['mobile_no']) ? $arr_enquiry_details['mobile_no'] : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                         <div class="form-group">
                          <label class="col-xs-2 col-lg-1 control-label">Message</label>
                          <div class="col-sm-2 col-lg-1">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{isset($arr_enquiry_details['message']) ? decrypt_value($arr_enquiry_details['message']) : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-2 col-lg-1 control-label">Added on</label>
                          <div class="col-sm-2 col-lg-1">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                              {{isset($arr_enquiry_details['created_at']) ? date('d M Y' , strtotime($arr_enquiry_details['created_at'])) : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br/>
                    </div>
                    
                 </div>
              </div>
          </div>
      </div>

    </div>
  </div>
 
<!-- END Main Content -->
@stop
