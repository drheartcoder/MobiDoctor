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

<?php
    $profile_data = calculate_profile( $arr_doctor_detials['id'], 'doctor');
    
    $disabled = 'disabled';
    if($profile_data > '81'):
        $disabled = '';
    endif;
?>

<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-title">
        <h3>
          <i class="fa fa-text-width"></i>
          {{ isset($page_title) ? $page_title : "" }}
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
                          <label class="col-xs-3 col-lg-5 control-label">Profile Completed</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{ $profile_data }} %
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Name</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{ isset($arr_doctor_detials['first_name']) ? decrypt_value($arr_doctor_detials['first_name']) : '' }} {{ isset($arr_doctor_detials['last_name']) ? decrypt_value($arr_doctor_detials['last_name']) : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Email</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_doctor_detials['email']) ? $arr_doctor_detials['email'] : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_doctor_detials['phone_code']) ? '+'.$arr_doctor_detials['phone_code'] : '' }}{{ isset($arr_doctor_detials['mobile_no']) ? $arr_doctor_detials['mobile_no'] : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Gender</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_doctor_detials['gender']) ? $arr_doctor_detials['gender'] : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Address</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                             {{ isset($arr_doctor_detials['address']) ? decrypt_value($arr_doctor_detials['address']) : '' }}
                          </div>
                       </div>
                      <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Status</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($arr_doctor_detials['status']) && $arr_doctor_detials['status'] != '' && $arr_doctor_detials['status'] == '1')
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
                            @if(isset($arr_doctor_detials['is_mobile_verified']) && $arr_doctor_detials['is_mobile_verified'] != '' && $arr_doctor_detials['is_mobile_verified'] == '1')
                                Verified
                            @else
                                Unverified
                            @endif
                          </div>
                       </div>
                        <div class="clearfix"></div>
                       <br>

                       <?php
                          $mobile_otp = isset($arr_doctor_detials['mobile_otp']) ? $arr_doctor_detials['mobile_otp'] : '';

                          if( $mobile_otp != '' )
                          {
                        ?>

                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Mobile OTP</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_doctor_detials['mobile_otp']) ? $arr_doctor_detials['mobile_otp'] : '' }}
                          </div>
                       </div>
                        <div class="clearfix"></div>
                       <br>

                       <?php } ?>

                        <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Email Verification</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($arr_doctor_detials['is_email_verified']) && $arr_doctor_detials['is_email_verified'] != '' && $arr_doctor_detials['is_email_verified'] == '1')
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
                            {{ isset($arr_doctor_detials['last_login']) ? date('d M Y h:i A', strtotime($arr_doctor_detials['last_login'])) : '-' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br>
                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Registered on</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            {{ isset($arr_doctor_detials['created_at']) ? date('d M Y' , strtotime($arr_doctor_detials['created_at'])) : '' }}
                          </div>
                       </div>
                       <div class="clearfix"></div>
                       <br/>

                       <div class="form-group">
                          <label class="col-xs-3 col-lg-5 control-label">Verification</label>
                          <div class="col-sm-3 col-lg-2">:</div>
                          <div class="col-sm-9 col-lg-5 controls">
                            @if( isset($arr_doctor_detials['doctor_data']['admin_verified']) && $arr_doctor_detials['doctor_data']['admin_verified'] != '' && $arr_doctor_detials['doctor_data']['admin_verified'] == '1' )
                            <a onclick="confirm_action(this,event,'Do you really want to unverified this doctor ?')" href="{{ $module_url_path.'/admin_unverified/'.base64_encode($arr_doctor_detials['id']) }}" class="btn btn-success">Verified</a>
                          @else
                            <a onclick="confirm_action(this,event,'Do you really want to verified this doctor ?')" href="{{ $module_url_path.'/admin_verified/'.base64_encode($arr_doctor_detials['id']) }}" class="btn btn-danger" {{ $disabled }} >Unverified</a>
                          @endif
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
