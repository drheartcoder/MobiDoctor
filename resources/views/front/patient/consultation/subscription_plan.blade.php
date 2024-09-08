@extends('front.patient.layout.master')
@section('main_content')

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper">
            <div class="booking-title text-center">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h4>Select Subscription Plan</h4></div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
				</div>
            </div>
			<div class="booking-content radio-btns">

				<form method="post" id="subscription_plan_form" name="subscription_plan_form" action="{{ url('/') }}/patient/consultation/subscription_plan/payment">
					{{ csrf_field() }}

					@include('front.patient.layout._operation_status')

					<div class="row">

						@if( isset($arr_subscription_plan) && !empty($arr_subscription_plan) )
							@foreach( $arr_subscription_plan as $subscription_plan )

								<?php
									$sp_id    = isset($subscription_plan['id'])    ? $subscription_plan['id']        : '';
									$sp_name  = isset($subscription_plan['name'])  ? $subscription_plan['name']      : '';
									$sp_slug  = isset($subscription_plan['slug'])  ? $subscription_plan['slug']      : '';
									$sp_price = isset($subscription_plan['price']) ? $subscription_plan['price'].'€' : '';
								?>

								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<div class="radio-btn patient-box" style="height:auto;">
										<input type="radio" id="{{ $sp_slug }}" name="subscription_plan_id" value="{{ $sp_id }}" />
										<label for="{{ $sp_slug }}">
											<h4>{{ $sp_name }}</h4>
											<span>{{ $sp_price }}</span>
										</label>
									</div>
								</div>

							@endforeach
						@endif

					</div>
					<div class="clearfix"></div>

					<button type="submit" class="green-btn submit-btn" id="btn_submit_subscription_plan_form">Let's Go</button>

				</form>

            </div>
        </div>
    </div>
</div>

@endsection