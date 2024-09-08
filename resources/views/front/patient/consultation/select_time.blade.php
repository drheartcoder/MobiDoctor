@extends('front.patient.layout.master')
@section('main_content')

<?php
    $cnt = 0;

    if( isset( $arr_consultation ) && !empty( $arr_consultation )):
        $selected_doctor_id = isset( $arr_consultation['doctor_id'] ) && !empty( $arr_consultation['doctor_id'] ) ? $arr_consultation['doctor_id'] : '';
        $selected_date = isset( $arr_consultation['date'] ) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '';
        $selected_time = isset( $arr_consultation['time'] ) && !empty( $arr_consultation['time'] ) ? convert_datetime( $arr_consultation['time'], 'user', 'time' ) : '';
    endif;

    $time_slot_shown = [];
?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper booking-step2 booking-step3">
            
            <div class="booking-title text-center">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a class="prev-arrow bg-img" href="{{ $module_url_path.'/'.$session_consultation_id }}/patient">&nbsp;</a>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h4>Book your Appointment</h4>
                        <span class="date-label">{{ date("l, d F Y", strtotime($selected_date)) }}</span>
                    </div>
                    <div class="col-xs-2 sm-2 col-md-2 col-lg-2">
                        <a class="next-arrow bg-img" href="javascript:void(0);" id="submit_page">&nbsp;</a>
                    </div>
                </div>
            </div>

            <div class="booking-content radio-btns">

                <form method="post" id="select_time_form" name="select_time_form" action="{{ url('/') }}/patient/consultation/{{ $session_consultation_id }}/time/process">
                    {{ csrf_field() }}

                    @include('front.patient.layout._operation_status')

                    <div class="row">
                        
                        @if( isset( $time_slot ) && !empty( $time_slot ) )

                            @foreach( $time_slot as $slots )

                                @if ( !in_array($slots['time'], $time_slot_shown) )

                                    @php array_push( $time_slot_shown, $slots['time'] ); $cnt++; @endphp

                                    @if( $cnt <= 6 )
                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                            <div class="radio-btn patient-box">
                                                <input type="radio" id="slot{{ $cnt }}" class="select_time" name="select_time" value="{{ $slots['time']}}" data-doctor_id="{{ $slots['doctor_id'] }}" @if( $selected_time == $slots['time']) checked @endif />
                                                <label for="slot{{ $cnt }}">
                                                    <span class="patient-icon bg-img">&nbsp;</span>
                                                    <span class="book">Book</span>
                                                    <span class="name">{{ date("H:i A",strtotime($slots['time'])) }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    @if( $cnt > 6 )
                                        <div class="more-time" style="display:none;">
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                                <div class="radio-btn patient-box">
                                                    <input type="radio" id="slot{{ $cnt }}" class="select_time" name="select_time" value="{{ $slots['time'] }}" data-doctor_id="{{ $slots['doctor_id'] }}" @if( $selected_time == $slots['time']) checked @endif />
                                                    <label for="slot{{ $cnt }}">
                                                        <span class="patient-icon bg-img">&nbsp;</span>
                                                        <span class="book">Book</span>
                                                        <span class="name">{{ date("H:i A",strtotime($slots['time'])) }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endif

                            @endforeach

                        @else

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="radio-btn patient-box">
                                    <label><span>No Doctor Available</span></label>
                                </div>
                            </div>

                        @endif

                        <div class="error" id="err_select_time"></div>

                    </div>

                    <div class="two-btns">
                        
                        @if( isset( $time_slot ) && !empty( $time_slot ) && count( $time_slot ) > 6 )
                            <div class="half-btns">
                                <button type="button" class="green-btn" id="show_more">
                                    <span class="see-more">See all times</span>
                                    <span class="see-less">Show Less</span>
                                </button>
                            </div>
                        @endif
                        
                        <div class="half-btns">
                            <button type="button" class="green-trans-btn" id="alternate_day">Choose Alternative day</button>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>

                    <input type="hidden" name="selected_doctor_id" id="selected_doctor_id" value="{{ $selected_doctor_id }}" />

                    <button type="button" class="green-btn submit-btn" id="btn_submit_select_time_form">Submit</button>

                </form>

            </div>
            
            <div class="step-indicator">
                <ul>
                    <li></li>
                    <li></li>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btn_submit_select_time_form").click(function() {
            form_validation();
        });

        $(".select_time").on('click',function() {
            var doctor_id = $(this).data('doctor_id');
            $("#selected_doctor_id").val( doctor_id );
        });

        $("#submit_page").click(function() {
            form_validation();
        });

        $('#show_more').click(function() {
            $('.more-time').slideToggle();
            $(this).toggleClass('active');
        });

        $("#alternate_day").click(function(){
            window.location.href = "{{ url('/') }}/patient/consultation/{{ $session_consultation_id }}/day";
        });
    });

    function form_validation()
    {
        var select_time = $("input[name='select_time']").is(":checked");

        if( $.trim(select_time) == 'false' )
        {
            $('#err_select_time').show();
            $('#err_select_time').html('Please select time for the consultation.');
            $('#err_select_time').fadeOut(4000);
            return false;
        }
        else
        {
            $("#select_time_form").submit();
        }
    }
</script>

@endsection