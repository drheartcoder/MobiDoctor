@extends('front.patient.layout.master')
@section('main_content')

<?php
    $user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
    $user_lastname  = isset($user_data['last_name'])  && !empty($user_data['last_name'])  ? decrypt_value($user_data['last_name'])  : '';
    $user_address   = isset($user_data['address'])    && !empty($user_data['address'])    ? decrypt_value($user_data['address'])    : '';
    $profile_image  = isset($user_data['profile_image']) ? $user_data['profile_image'] : '';
    $social_login   = isset($user_data['social_login']) ? $user_data['social_login'] : '';
?>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.patient.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">

                <div class="row">

                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="profile-detail-block">
                            <div class="profile-top-block">
                                <a class="edit" href="{{ url('/') }}/patient/my_account/about_me"><i class="fa fa-pencil"></i></a>
                                @if(isset($profile_image) && $profile_image!='')
                                    @if(file_exists($patient_profile_image_base_path.'/'.$profile_image))
                                        <?php $profile_img_src = $patient_profile_image_public_path.'/'.$profile_image;  ?>
                                    @else
                                        <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                    @endif
                                @else
                                    <?php $profile_img_src = $default_img_path.'/profile.jpeg'; ?>
                                @endif
                                @if( $social_login == 'yes' )
                                    <?php $profile_img_src = $profile_image; ?>
                                @endif
                                <img src="{{ $profile_img_src }}" class="img-responsive" alt="MobiDoctor"/>
                            </div>
                            <div class="profile-content">
                                <h5>{{ $user_firstname.' '.$user_lastname }}</h5>
                                <p>{{ str_limit($user_address,90) }}</p>
                                <div class="clearfix"></div>
                                <span class="profile-complete">{{ calculate_profile() }}% Completed</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="dash-noti-block">
                            <h4><i class="fa fa-bell-o"></i> Notifications <a class="view" href="{{ url('/') }}/patient/notification">View All</a></h4>
                            <div class="dash-noti-list-wrapper content-d">
                                
                                @if(isset($arr_notification) && sizeof($arr_notification)>0)
                                @foreach($arr_notification as $notification)

                                    <div class="dash-noti-list">
                                        @if(isset($notification['user_details']['profile_image']) && $notification['user_details']['profile_image']!='')
                                            @if(file_exists($profile_image_base_path.'/'.$notification['user_details']['profile_image']))
                                                <?php $profile_img_src = $profile_image_public_path.'/'.$notification['user_details']['profile_image']; ?>
                                            @else
                                                <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?> 
                                            @endif
                                        @else
                                            <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?>
                                        @endif
                                        <img class="dash-noti-user img-responsive" src="{{$profile_img_src}}" alt="MobiDoctor"/>
                                        <div class="dash-noti-details">
                                            <h5>{{isset($notification['user_details']['first_name'])?decrypt_value($notification['user_details']['first_name']):''}} {{isset($notification['user_details']['last_name'])?decrypt_value($notification['user_details']['last_name']):''}}</h5>
                                            <p>{{isset($notification['message'])?decrypt_value($notification['message']):''}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach
                                @else
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found</div>                    
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="consultation-section">
                            <h4>Upcoming Consultation</h4>
                            <ul class="content-d">
                                @if( isset( $arr_upcoming ) && !empty( $arr_upcoming ) )
                                    @foreach( $arr_upcoming as $upcoming )
                                        <?php
                                            $id = isset( $upcoming['id'] ) && !empty( $upcoming['id'] ) ? base64_encode( $upcoming['id'] ) : '';

                                            $doc_prefix = isset( $upcoming['doctor_details']['doctor_prefix']['name'] ) && !empty( $upcoming['doctor_details']['doctor_prefix']['name'] ) ? $upcoming['doctor_details']['doctor_prefix']['name'] : 'Dr ';
                                            $doc_first = isset( $upcoming['doctor_details']['first_name'] ) && !empty( $upcoming['doctor_details']['first_name'] ) ? decrypt_value( $upcoming['doctor_details']['first_name'] ) : '';
                                            $doc_last = isset( $upcoming['doctor_details']['last_name'] ) && !empty( $upcoming['doctor_details']['last_name'] ) ? decrypt_value( $upcoming['doctor_details']['last_name'] ) : '';

                                            $doc_name = $doc_prefix.' '.$doc_first.' '.$doc_last;

                                            $date = isset( $upcoming['date'] ) && !empty( $upcoming['date'] ) ? $upcoming['date'] : '';
                                            $time = isset( $upcoming['time'] ) && !empty( $upcoming['time'] ) ? $upcoming['time'] : '';

                                            $booking_datetime = convert_datetime($date.' '.$time, 'user', 'datetime');
                                            $consult_datetime = date( "d-m-Y, h:i A", strtotime($booking_datetime) );
                                        ?>
                                        <li>
                                            <span class="cons-details">{{ $doc_name.', '.$consult_datetime }}</span>
                                            <a class="link" href="{{ url('/') }}/patient/my_consultation/upcoming/{{ $id }}/details">Details</a>
                                        </li>
                                    @endforeach
                                @else
                                <div class="no-date-found-bx">
                                    <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                    <div class="no-record-txt">No Record Found </div>                    
                                </div>
                                @endif
                            </ul>
                            <a class="details-btn" href="{{ url('/') }}/patient/my_consultation/upcoming"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="consultation-section">
                            <h4>Completed Consultation</h4>
                            <ul class="content-d">
                                @if( isset( $arr_completed ) && !empty( $arr_completed ) )
                                    @foreach( $arr_completed as $completed )
                                        <?php
                                            $id = isset( $completed['id'] ) && !empty( $completed['id'] ) ? base64_encode( $completed['id'] ) : '';

                                            $doc_prefix = isset( $completed['doctor_details']['doctor_prefix']['name'] ) && !empty( $completed['doctor_details']['doctor_prefix']['name'] ) ? $completed['doctor_details']['doctor_prefix']['name'] : 'Dr ';
                                            $doc_first = isset( $completed['doctor_details']['first_name'] ) && !empty( $completed['doctor_details']['first_name'] ) ? decrypt_value( $completed['doctor_details']['first_name'] ) : '';
                                            $doc_last = isset( $completed['doctor_details']['last_name'] ) && !empty( $completed['doctor_details']['last_name'] ) ? decrypt_value( $completed['doctor_details']['last_name'] ) : '';

                                            $doc_name = $doc_prefix.' '.$doc_first.' '.$doc_last;

                                            $date = isset( $completed['date'] ) && !empty( $completed['date'] ) ? $completed['date'] : '';
                                            $time = isset( $completed['time'] ) && !empty( $completed['time'] ) ? $completed['time'] : '';

                                            $booking_datetime = convert_datetime($date.' '.$time, 'user', 'datetime');
                                            $consult_datetime = date( "d-m-Y, h:i A", strtotime($booking_datetime) );
                                        ?>
                                        <li>
                                            <span class="cons-details">{{ $doc_name.', '.$consult_datetime }}</span>
                                            <a class="link" href="{{ url('/') }}/patient/my_consultation/completed/{{ $id }}/details">Details</a>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                   
                                    </div>
                                @endif
                            </ul>
                            <a class="details-btn" href="{{ url('/') }}/patient/my_consultation/completed"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="consultation-section">
                            <h4>Family Members</h4>
                            <ul class="content-d">
                                @if( isset( $arr_family ) && !empty( $arr_family ) )
                                    @foreach( $arr_family as $family )
                                        <?php
                                            $id           = isset( $family['id'] ) && !empty( $family['id'] ) ? base64_encode( $family['id'] ) : '';
                                            $family_first = isset( $family['first_name'] ) && !empty( $family['first_name'] ) ? decrypt_value( $family['first_name'] ) : '';
                                            $family_last  = isset( $family['last_name'] ) && !empty( $family['last_name'] ) ? decrypt_value( $family['last_name'] ) : '';
                                        ?>
                                        <li>
                                            <span class="cons-details">{{ $family_first.' '.$family_last }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                    
                                    </div>
                                @endif
                            </ul>
                            <a class="details-btn" href="{{ url('/') }}/patient/my_account/family_member"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="consultation-section">
                            <h4>My Transactions</h4>
                            <ul class="content-d">
                                @if( isset( $arr_transaction ) && !empty( $arr_transaction ) )
                                    @foreach( $arr_transaction as $transaction )
                                        <?php
                                            $id         = isset( $transaction['id'] ) && !empty( $transaction['id'] ) ? base64_encode( $transaction['id'] ) : '';
                                            $consult_id = isset( $transaction['consultation_id'] ) && !empty( $transaction['consultation_id'] ) ? $transaction['consultation_id'] : '';
                                            $invoice_no = isset( $transaction['invoice_no'] ) && !empty( $transaction['invoice_no'] ) ? $transaction['invoice_no'] : '';
                                            $amount     = isset( $transaction['amount'] ) && !empty( $transaction['amount'] ) ? $transaction['amount'] : '';
                                        ?>
                                        <li>
                                            <span class="cons-details">{{ $consult_id }}</span>
                                            <span class="price-div2"><i class="fa fa-eur"></i> {{ $amount }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                    
                                    </div>
                                @endif
                            </ul>
                            <a class="details-btn" href="{{ url('/') }}/patient/transactions/consultation"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection