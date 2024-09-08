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
                <div class="notification-wrapper">
                    
                    @if(isset($arr_notification['data']) && sizeof($arr_notification['data'])>0)
                    @foreach($arr_notification['data'] as $value)
                        <div class="notification-strip">
                            <div class="user-img">
                                @if(isset($value['user_details']['profile_image']) && $value['user_details']['profile_image']!='')
                                    @if(file_exists($profile_image_base_path.'/'.$value['user_details']['profile_image']))
                                        <?php $profile_img_src = $profile_image_public_path.'/'.$value['user_details']['profile_image']; ?>
                                    @else
                                        <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?> 
                                    @endif
                                @else
                                    <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?>
                                @endif
                                <img src="{{$profile_img_src}}" class="img-responsive" alt=""/>
                            </div>
                            <div class="noti-details">
                                <h5><a href="javascript:void(0)">{{isset($value['user_details']['first_name'])?decrypt_value($value['user_details']['first_name']):''}} {{isset($value['user_details']['last_name'])?decrypt_value($value['user_details']['last_name']):''}}</a></h5>
                                <span>{{isset($value['created_at'])?date('d M Y h:i A',strtotime($value['created_at'])):''}}</span>
                                <p>{{isset($value['message'])?decrypt_value($value['message']):''}}</p>

                                <a class="close-icon bg-img" onclick="confirm_action(this,event,'Do you really want to remove this notification?')" href="{{$module_url_path}}/delete/{{ base64_encode($value['id'])}}"></a>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="white-wrapper prescription-wrapper">
                            <h2>Notification</h2>
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        </div>
                    @endif
                </div>
                <div class="pagination-block">
                    {{ (isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection