@extends('front.patient.layout.master')
@section('main_content')

<?php
	$id = $consult_id = $booking_datetime = $booking_date = $booking_time = $doc_name = '';

	if( isset( $arr_consultation ) && !empty( $arr_consultation ) ):
		$id = isset( $arr_consultation['id'] ) && !empty( $arr_consultation['id'] ) ? base64_encode( $arr_consultation['id'] ) : '';
		$consult_id = isset( $arr_consultation['consultation_id'] ) && !empty( $arr_consultation['consultation_id'] ) ? $arr_consultation['consultation_id'] : '';
		$consult_date = isset( $arr_consultation['date'] ) && !empty( $arr_consultation['date'] ) ? $arr_consultation['date'] : '';
		$consult_time = isset( $arr_consultation['time'] ) && !empty( $arr_consultation['time'] ) ? $arr_consultation['time'] : '';
		
		$booking_datetime = convert_datetime($consult_date.' '.$consult_time, 'user', 'datetime');
		$booking_date = date( "D, d M, Y", strtotime($booking_datetime) );
		$booking_time = date( "h:i A", strtotime($booking_datetime) );

		$doc_prefix = isset( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) && !empty( $arr_consultation['doctor_details']['doctor_prefix']['name'] ) ? $arr_consultation['doctor_details']['doctor_prefix']['name'] : 'Dr';
		$doc_first_name = isset( $arr_consultation['doctor_details']['first_name'] ) && !empty( $arr_consultation['doctor_details']['first_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['first_name'] ) : '';
		$doc_last_name = isset( $arr_consultation['doctor_details']['last_name'] ) && !empty( $arr_consultation['doctor_details']['last_name'] ) ? decrypt_value( $arr_consultation['doctor_details']['last_name'] ) : '';
		$doc_name = $doc_prefix.'. '.$doc_first_name.' '.$doc_last_name;
	endif;

	$reschedule_option = isset( $arr_consultationsetting['reschedule'] ) && !empty( $arr_consultationsetting['reschedule'] ) ? $arr_consultationsetting['reschedule'] : 0;

    $user_timezone = isset( $arr_timezone['location'] ) && !empty( $arr_timezone['location'] ) ? $arr_timezone['location'] : 'UTC';
?>
	
	<div class="page-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.patient.layout._leftbar')
                </div>
                
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="white-wrapper prescription-wrapper online-consultation">
                        <h2>Online Waiting Room <span class="cons-id">Consultation ID: {{ $consult_id }}</span></h2>
                        <div class="prescription-section">
                            <div class="clock-wrapper">
                                <div class="clock-section relative-block">
                                    <div class="clock-block relative-block">
                                        <img src="{{ url('/') }}/public/front/images/clock-img.png" class="img-responsive" alt=""/>
                                        <div class="timing-details">
                                            <p>Time Until Consultation</p>
                                            <p id="get_countdown"></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="timing-section">
                                        <div class="timing-left">
                                            <b>{{ $booking_time }}</b>
                                            <span>{{ $booking_date }}</span>
                                        </div>
                                        <div class="check-img bg-img">&nbsp;</div>
                                        <div class="timing-right">
                                            <span>Consultation with {{ $doc_name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="two-btns">
                            	
                            	@if( $reschedule_option == 0 )
									<div class="half-btns">
										<button class="green-trans-btn reschedute-btn">Reschedule</button>
									</div>
                            	@endif

								<div class="half-btns">
									<button class="green-btn completed-btn">Medical History</button>
								</div>
								<div class="clearfix"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/public/moment/moment.js"></script>
	<script src="{{ url('/') }}/public/moment/moment-with-locales.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		get_remaining_time();
    	});

		function get_remaining_time()
		{
			var user_sel_timezone = "{{ $user_timezone }}";

			// Set the date we're counting down to
			var given_time = "{{ $booking_datetime }}";
			var countDownDate = new Date(given_time).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() 
			{
	            // Get todays date and time
	            var aus = new Date().toLocaleString('en-US', { timeZone: user_sel_timezone });
	            var now = new Date(aus).getTime();
	            
	            // Find the distance between now an the count down date
	            var distance = countDownDate - now;
	            
	            // Time calculations for days, hours, minutes and seconds
	            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	            if(days > 0)
	            {
	                days = days + ' days ';
	            }
	            else
	            {
	                days = "";
	            }

	            if(hours > 0)
	            {
	                hours = hours + ' hrs ';
	            }
	            else
	            {
	               hours = "";
	            }

	            if(minutes > 0)
	            {
	                minutes = minutes + ' mins ';
	            }
	            else
	            {
	                minutes = "";
	            }

	            // If the count down is over, write some text 
	            if ( $.isNumeric(distance) == false ) 
	            {
	                clearInterval(x);
	                document.getElementById("get_countdown").innerHTML = "Time Expired";
	            }
	            else
	            {
	            	// Output the result in an element with id="demo"
	            	document.getElementById("get_countdown").innerHTML = days + hours + minutes + seconds + ' secs';
	            }
			}, 1000);
		}
    </script>

@endsection