@extends('front.doctor.layout.master')
@section('main_content')
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
               @include('front.doctor.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                @include('front.layout._operation_status')
                
                <!-- <div class="new-patient-btn">
                    <a href="doctor-my-practice-add-patients.html">Add Patient</a>
                </div>
                <div class="clearfix"></div> -->

                <div class="patient-gallrey-bx">
                    <div class="row">
                        @if(isset($arr_patients) && sizeof($arr_patients)>0)
                            @foreach($arr_patients as $key => $patient)
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <a href="{{$module_url_path}}/patient_history/{{isset($patient['user_details']['id'])?base64_encode($patient['user_details']['id']):'0'}}">
                                        <div class="patient-photo-bx">
                                            <div class="patient-image-new"> 
                                                <?php 
                                                    if(isset($patient['user_details']['profile_image']) && $patient['user_details']['profile_image']!='')
                                                    {
                                                        if(file_exists($patient_image_base_path.'/'.$patient['user_details']['profile_image']))
                                                        {
                                                            $profile_image = $patient_image_public_path.'/'.$patient['user_details']['profile_image'];
                                                        }
                                                        else
                                                        {
                                                            $profile_image = $default_img_path.'/profile.jpeg';
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $profile_image = $default_img_path.'/profile.jpeg';
                                                    }
                                                       

                                                ?>
                                                <img src="{{$profile_image}}" alt="" /> 
                                            </div>
                                            <div class="patient-status-name">
                                                @if(isset($patient['user_details']['is_online']) && $patient['user_details']['is_online']!='' && $patient['user_details']['is_online'] == '0')
                                                    <i class="fa fa-circle grey-dot"></i>
                                                @else
                                                    <i class="fa fa-circle"></i>
                                                @endif
                                                {{isset($patient['user_details']['first_name'])?decrypt_value($patient['user_details']['first_name']):''}} {{isset($patient['user_details']['last_name'])?decrypt_value($patient['user_details']['last_name']):''}}</div>
                                            <div class="patient-birth-date"><i class="fa fa-birthday-cake"></i>{{ isset($patient['user_details']['date_of_birth']) ? date('d M Y',strtotime($patient['user_details']['date_of_birth'])) : '' }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="white-wrapper prescription-wrapper">
                            <h2>Patients</h2>
                                <div class="no-date-found-bx">
                                    <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                    <div class="no-record-txt">No Record Found </div>                    
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection