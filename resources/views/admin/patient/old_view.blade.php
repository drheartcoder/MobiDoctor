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
                          <label class="col-xs-3 col-lg-5 control-label">Name</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{isset($arr_patient_detials['first_name']) ? decrypt_value($arr_patient_detials['first_name']) : ''}} {{isset($arr_patient_detials['last_name']) ? decrypt_value($arr_patient_detials['last_name']): ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Email</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{isset($arr_patient_detials['email']) ? $arr_patient_detials['email'] : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_patient_detials['phone_code']) ? '+'.$arr_patient_detials['phone_code'] : '' }}{{ isset($arr_patient_detials['mobile_no']) ? $arr_patient_detials['mobile_no'] : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Gender</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{isset($arr_patient_detials['gender']) ? $arr_patient_detials['gender'] : ''}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Address</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{isset($arr_patient_detials['address']) ? decrypt_value($arr_patient_detials['address']) : ''}}
                          </div>
                       </div>
                      <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Status</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($arr_patient_detials['status']) && $arr_patient_detials['status']!='' && $arr_patient_detials['status']=='1')
                                Active
                            @else
                                Inactive
                            @endif
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Mobile Verification</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($arr_patient_detials['is_mobile_verified']) && $arr_patient_detials['is_mobile_verified']!='' && $arr_patient_detials['is_mobile_verified']=='1')
                                Verified
                            @else
                                Unverified
                            @endif
                          </div>
                       </div>
                        <div class="clearfix"></div>
                        <br>
                        <?php
                          $mobile_otp = isset($arr_patient_detials['mobile_otp']) ? $arr_patient_detials['mobile_otp'] : '';

                          if( $mobile_otp != '' )
                          {
                        ?>
                        <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Mobile OTP</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_patient_detials['mobile_otp']) ? $arr_patient_detials['mobile_otp'] : '' }}
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>

                      <?php } ?>

                        <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Email Verification</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($arr_patient_detials['is_email_verified']) && $arr_patient_detials['is_email_verified']!='' && $arr_patient_detials['is_email_verified']=='1')
                                Verified
                            @else
                                Unverified
                            @endif
                          </div>
                       </div>
                        <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Last Login</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{isset($arr_patient_detials['last_login']) ? date('d M Y h:i A' , strtotime($arr_patient_detials['last_login'])) : '-'}}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Added on</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                              {{isset($arr_patient_detials['created_at']) ? date('d M Y' , strtotime($arr_patient_detials['created_at'])) : ''}}
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
