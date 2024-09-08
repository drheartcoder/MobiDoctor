@extends('front.doctor.layout.master')
@section('main_content')

<?php
    $view_type = isset( $user_view_type ) && !empty( $user_view_type ) ? $user_view_type : '';
?>

	<div class="page-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.doctor.layout._leftbar')
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

                                    $pat_first_name = isset( $consult['user_details']['first_name'] ) && !empty( $consult['user_details']['first_name'] ) ? decrypt_value( $consult['user_details']['first_name'] ) : '';
                                    $pat_last_name = isset( $consult['user_details']['last_name'] ) && !empty( $consult['user_details']['last_name'] ) ? decrypt_value( $consult['user_details']['last_name'] ) : '';

                                    $pat_name = $pat_first_name.' '.$pat_last_name;

                                    $pat_profile_img = isset( $consult['user_details']['profile_image'] ) && !empty( $consult['user_details']['profile_image'] ) ? $consult['user_details']['profile_image'] : '';

                                    $pat_img_src = $default_img_path .'/profile.jpeg';
                                    if(isset($pat_profile_img) && $pat_profile_img != '' && file_exists($patient_image_base_path.'/'.$pat_profile_img)):
                                        $pat_img_src = $patient_image_public_path.'/'.$pat_profile_img;
                                    endif;
                                ?>

                                <div class="col-sm-6 col-md-6 col-lg-6 list_view" style="display: none;">
                                    <div class="doctoe-consultation-section">
                                        <a href="{{ $module_url_path.'/upcoming/'.$id }}/details">
                                            <div class="consultation-img">
                                                <img src="{{ $pat_img_src }}" alt="dr" />
                                            </div>
                                            <div class="consultation-tct-box">
                                                <div class="consultation-name">{{ $pat_name }}</div>
                                                <div class="consultation-date">{{ $consult_datetime }}</div>
                                                <div class="confirmed-msg">Pending</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-4 grid_view" style="display: none;">
                                    <div class="patient-photo-bx">
                                        <a href="{{ $module_url_path.'/upcoming/'.$id }}/details">
                                            <div class="patient-image-new">
                                                <img src="{{ $pat_img_src }}" alt="" />
                                            </div>
                                            <div class="patient-status-name">{{ $pat_name }}</div>
                                            <div class="patient-birth-date">{{ $consult_datetime }}</div>
                                            <div class="confirmed-msg">Pending</div>
                                        </a>
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