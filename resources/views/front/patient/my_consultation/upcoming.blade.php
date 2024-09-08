@extends('front.patient.layout.master')
@section('main_content')

<?php
    $view_type = isset( $user_view_type ) && !empty( $user_view_type ) ? $user_view_type : '';
?>

	<div class="page-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.patient.layout._leftbar')
                </div>
                
                <div class="col-sm-8 col-md-9 col-lg-9">
                    
                    <div class="grid-box-section">
                        <div class="list-grid-view view_type" id="grid_view" data-view_type="grid">
                            <a href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
                        </div>
                        <div class="list-grid-view view_type" id="list_view" data-view_type="list">
                            <a href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
                        </div>
                    </div>

                    <div class="my-consultation-wrapper row">
                        
                        @if( isset( $arr_consultation['data'] ) && !empty( $arr_consultation['data'] ) )

                            @foreach( $arr_consultation['data'] as $consult )
                                
                                <?php
                                    $id = isset( $consult['id'] ) && !empty( $consult['id'] ) ? base64_encode( $consult['id'] ) : '';
                                    $consult_id   = isset( $consult['consultation_id'] ) && !empty( $consult['consultation_id'] ) ? base64_encode( $consult['consultation_id'] ) : '';
                                    $consult_date = isset( $consult['date'] ) && !empty( $consult['date'] ) ? $consult['date'] : '';
                                    $consult_time = isset( $consult['time'] ) && !empty( $consult['time'] ) ? $consult['time'] : '';

                                    $booking_datetime = convert_datetime($consult_date.' '.$consult_time, 'user', 'datetime');
                                    $consult_datetime = date( "h:i A, l d F, Y", strtotime($booking_datetime) );

                                    $doc_prefix = isset( $consult['doctor_details']['doctor_prefix']['name'] ) && !empty( $consult['doctor_details']['doctor_prefix']['name'] ) ? $consult['doctor_details']['doctor_prefix']['name'] : 'Dr';
                                    $doc_first_name = isset( $consult['doctor_details']['first_name'] ) && !empty( $consult['doctor_details']['first_name'] ) ? decrypt_value( $consult['doctor_details']['first_name'] ) : '';
                                    $doc_last_name = isset( $consult['doctor_details']['last_name'] ) && !empty( $consult['doctor_details']['last_name'] ) ? decrypt_value( $consult['doctor_details']['last_name'] ) : '';

                                    $doc_name = $doc_prefix.'. '.$doc_first_name.' '.$doc_last_name;

                                    $doc_profile_img = isset( $consult['doctor_details']['profile_image'] ) && !empty( $consult['doctor_details']['profile_image'] ) ? $consult['doctor_details']['profile_image'] : '';

                                    $doc_img_src = $default_img_path .'/profile.jpeg';
                                    if(isset($doc_profile_img) && $doc_profile_img != '' && file_exists($doctor_image_base_path.'/'.$doc_profile_img)):
                                        $doc_img_src = $doctor_image_public_path.'/'.$doc_profile_img;
                                    endif;
                                ?>

                                <div class="col-sm-6 col-md-6 col-lg-6 list_view" style="display: none;">
                                    <div class="doctoe-consultation-section dot-menu-set">
                                        <div class="consultation-img">
                                            <img src="{{ $doc_img_src }}" class="img-responsive" alt="MobiDoctor"/>
                                        </div>
                                        
                                        <div class="consultation-tct-box">
                                            <div class="consultation-name">{{ $doc_name }}</div>
                                            <div class="consultation-date">{{ $consult_datetime }}</div>
                                            <div class="confirmed-msg">Upcoming</div>

                                            <div class="consu-drop-wrapper">
                                                <div class="ellipses-icon bg-img">&nbsp;</div>
                                                <div class="consu-drop">
                                                    <ul>
                                                        <li><a href="{{ url('/') }}/patient/my_consultation/upcoming/{{ $id }}/online_waiting_room">Online Waiting Room</a></li>
                                                        <li><a href="{{ url('/') }}/patient/my_consultation/upcoming/{{ $id }}/details">View Consultation Details</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-4 grid_view" style="display: none;">
                                    <div class="patient-photo-bx">
                                        <div class="patient-image-new">
                                            <img src="{{ $doc_img_src }}" alt="" />
                                        </div>
                                        <div class="patient-status-name">{{ $doc_name }}</div>
                                        <div class="patient-birth-date">{{ $consult_datetime }}</div>
                                        <div class="confirmed-msg">Pending</div>

                                        <div class="consu-drop-wrapper">
                                            <div class="ellipses-icon bg-img">&nbsp;</div>
                                            <div class="consu-drop">
                                                <ul>
                                                    <li><a href="{{ url('/') }}/patient/my_consultation/upcoming/{{ $id }}/online_waiting_room">Online Waiting Room</a></li>
                                                    <li><a href="{{ url('/') }}/patient/my_consultation/upcoming/{{ $id }}/details">View Consultation Details</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @else
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        @endif

                    </div>

                    @if( isset( $paginate ) && !empty( $paginate ) )
                        {{ $paginate }}
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            var selected_view = "{{ $view_type }}";
            view_type(selected_view);

            $(".view_type").click(function() {
                var selected_view = ($(this).data("view_type") == "list") ? "list" : "grid";
                
                view_type(selected_view);
                change_view(selected_view);
            });

            $('.consu-drop-wrapper').click(function() {
                $(this).toggleClass('active');
                $(this).parent().parent().parent().siblings().children('.doctoe-consultation-section').children('.consultation-tct-box').children('.consu-drop-wrapper').removeClass('active');
            });
        });

        function view_type(selected_view)
        {
            var active_type = (selected_view == "list") ? "list" : "grid";
            var deactive_type = (active_type != "list") ? "list" : "grid";

            $("."+active_type+"_view").show();
            $("."+deactive_type+"_view").hide();

            $("#"+active_type+"_view").addClass("active");
            $("#"+deactive_type+"_view").removeClass("active");
        }

        function change_view(view)
        {
            $.ajax({
                url      : "{{ url('/') }}/change_view",
                type     : "GET",
                dataType : 'json',
                data     : {view:view},
                success  : function(res) {  }
            });
        }
    </script>

@endsection