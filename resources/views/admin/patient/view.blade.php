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
                 <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Patient Details</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Profile Image :</label>
                                        <div class="col-lg-8">
                                            <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?>
                                            @if(isset($arr_doctor_details['profile_image']) && $arr_doctor_details['profile_image'] != '')
                                                @if(file_exists($profile_image_base_path.'/'.$arr_doctor_details['profile_image']))
                                                    <?php $profile_img_src = $profile_image_public_path.'/'.$arr_doctor_details['profile_image']; ?>
                                                @endif
                                            @endif
                                    
                                           <img src="{{ $profile_img_src }}" class="img-responsive img-preview" style="width: 100px;height: 100px" />
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Name :</label>
                                        <div class="col-lg-8">
                                           {{isset($arr_patient_detials['first_name']) ? decrypt_value($arr_patient_detials['first_name']) : ''}} {{isset($arr_patient_detials['last_name']) ? decrypt_value($arr_patient_detials['last_name']): ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_patient_detials['email']) ? $arr_patient_detials['email'] : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile No :</label>
                                        <div class="col-lg-8">
                                           {{ isset($arr_patient_detials['phone_code']) ? '+'.$arr_patient_detials['phone_code'] : '' }}{{ isset($arr_patient_detials['mobile_no']) ? $arr_patient_detials['mobile_no'] : '' }}
                                        </div>
                                    </div>


                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Gender :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_patient_detials['gender']) ? $arr_patient_detials['gender'] : ''}}
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Address :</label>
                                        <div class="col-lg-8">
                                             {{isset($arr_patient_detials['address']) ? decrypt_value($arr_patient_detials['address']) : ''}}
                                        </div>
                                    </div>   

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Country :</label>
                                        <div class="col-lg-8">
                                             {{isset($arr_patient_detials['country']) ? decrypt_value($arr_patient_detials['country']) : ''}}
                                        </div>
                                    </div>   

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">City :</label>
                                        <div class="col-lg-8">
                                             {{isset($arr_patient_detials['city']) ? decrypt_value($arr_patient_detials['city']) : ''}}
                                        </div>
                                    </div>  

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Fax No. :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_patient_detials['fax_no']) ? decrypt_value($arr_patient_detials['fax_no'])  : ''}}
                                        </div>
                                    </div>  

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Status :</label>
                                        <div class="col-lg-8">
                                            @if(isset($arr_patient_detials['status']) && $arr_patient_detials['status']!='' && $arr_patient_detials['status']=='1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </div>
                                    </div>  

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile Verification :</label>
                                        <div class="col-lg-8">
                                            @if(isset($arr_patient_detials['is_mobile_verified']) && $arr_patient_detials['is_mobile_verified']!='' && $arr_patient_detials['is_mobile_verified']=='1')
                                                Verified
                                            @else
                                                Unverified
                                            @endif
                                        </div>
                                    </div>  

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email Verification :</label>
                                        <div class="col-lg-8">
                                            @if(isset($arr_patient_detials['is_email_verified']) && $arr_patient_detials['is_email_verified']!='' && $arr_patient_detials['is_email_verified']=='1')
                                                Verified
                                            @else
                                                Unverified
                                            @endif
                                        </div>
                                    </div>   


                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email Verification :</label>
                                        <div class="col-lg-8">
                                            @if(isset($arr_patient_detials['is_email_verified']) && $arr_patient_detials['is_email_verified']!='' && $arr_patient_detials['is_email_verified']=='1')
                                                Verified
                                            @else
                                                Unverified
                                            @endif
                                        </div>
                                    </div>   

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Login Count:</label>
                                        <div class="col-lg-8">
                                            {{ isset($arr_patient_detials['login_count']) ? $arr_patient_detials['login_count'] : '0' }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Last Login :</label>
                                        <div class="col-lg-8">
                                            {{ isset($arr_patient_detials['last_login']) ? date('d M Y h:i A', strtotime($arr_patient_detials['last_login'])) : '-' }}
                                        </div>
                                    </div>   


                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Registered On :</label>
                                        <div class="col-lg-8">
                                            {{isset($arr_patient_detials['created_at']) ? date('d M Y' , strtotime($arr_patient_detials['created_at'])) : ''}}
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
