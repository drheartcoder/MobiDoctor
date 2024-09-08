@extends('front.patient.layout.master')
@section('main_content')

<?php
    $user_firstname = isset($user_data['first_name']) && !empty($user_data['first_name']) ? decrypt_value($user_data['first_name']) : '';
    $user_lastname  = isset($user_data['last_name']) && !empty($user_data['last_name']) ? decrypt_value($user_data['last_name']) : '';

    $sp_name  = isset($arr_subscription_plan['name']) && !empty($arr_subscription_plan['name']) ? $arr_subscription_plan['name'] : '';
    $sp_slug  = isset($arr_subscription_plan['slug']) && !empty($arr_subscription_plan['slug']) ? $arr_subscription_plan['slug'] : '';
    $sp_price = isset($arr_subscription_plan['price']) && !empty($arr_subscription_plan['price']) ? $arr_subscription_plan['price'] : '';
?>

<div class="page-wrapper">
	<div class="container">
		<div class="booking-step-wrapper full-width">
			
			<div class="booking-title text-center">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><a class="prev-arrow bg-img" href="{{ url('/') }}/patient/consultation/subscription_plan">&nbsp;</a></div>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h4>Make your Payment</h4></div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>

			<div class="booking-content payemnt-section">
				
				<form method="post" name="subscription_plan_payment_form" id="subscription_plan_payment_form" action="{{ url('/') }}/patient/consultation/subscription_plan/payment/process" autocomplete="off" >
					{{ csrf_field() }}

					<input type="hidden" name="sp_price"       id="sp_price"       value="{{ $sp_price }}" />
					<input type="hidden" name="discount_price" id="discount_price" value=""  />
					<input type="hidden" name="discount_id"    id="discount_id"    value=""  />
					<input type="hidden" name="customer_id"    id="customer_id"    value=""  />
					<input type="hidden" name="card_id"        id="card_id"        value=""  />

					<div class="checkout-wrapper">
						<h2>Checkout</h2>

						<!-- Form Status Starts -->
	                    <div class="alert alert-success" id="form_success" style="display: none;">
	                        <strong>Success!</strong> <span id="form_success_msg"></span>
	                    </div>
	                    
	                    <div class="alert alert-danger" id="form_error" style="display: none;">
	                        <strong>Error!</strong> <span id="form_error_msg"></span>
	                    </div>
	                    <!-- Form Status Ends -->

						<div class="form-group">
							<select id="stripe_card" name="stripe_card">
								<option value="">Select Card</option>
								@if( isset( $card_details ) && !empty( $card_details ) )
									@foreach( $card_details as $card )
										
										@php
		                                    $card_no = str_pad( $card['card_no'], 16, "X", STR_PAD_LEFT );
	                                    @endphp

										<option value="{{ $card['id'] }}" data-card_id="{{ $card['card_id'] }}" data-customer_id="{{ $card['customer_id'] }}" >{{ $card_no }}</option>
										
									@endforeach
								@endif
							</select>
							<div class="error" id="err_stripe_card"></div>
						</div>

						<div class="pay-with-card">
							<div class="form-group">
								<label>Pay with New card</label>
								<div class="card-strip bg-img"></div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="sm-3 col-md-3 col-lg-3">
									<label>Name on Card</label>
								</div>
								<div class="sm-9 col-md-9 col-lg-9">
									<input type="text" placeholder="Name on card" name="card_name" id="card_name" value="" maxlength="100" />
									<div class="error" id="err_card_name"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="sm-3 col-md-3 col-lg-3">
									<label>Card Number</label>
								</div>
								<div class="sm-9 col-md-9 col-lg-9">
									<input type="password" placeholder="Enter Card Number" name="card_no" id="card_no" value="" maxlength="16" />
									<div class="hide-pwd" id="hide_password" style="display: none;"><i class="fa fa-eye"></i></div>
                        			<div class="hide-pwd" id="show_password"><i class="fa fa-eye-slash"></i></div>
                        			<div class="error" id="err_card_no"></div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="sm-3 col-md-3 col-lg-3">
									<label>Expires on</label>
								</div>
								<div class="sm-4 col-md-4 col-lg-4">
									<input type="text" placeholder="MM" name="expiry_month" id="expiry_month" value="" maxlength="2" />
									<div class="error" id="err_expiry_month"></div>
								</div>
								<div class="sm-5 col-md-5 col-lg-5">
									<input type="text" placeholder="YYYY" name="expiry_year" id="expiry_year" value="" maxlength="4" />
									<div class="error" id="err_expiry_year"></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="sm-3 col-md-3 col-lg-3">
									<label>CVV</label>
								</div>
								<div class="sm-9 col-md-9 col-lg-9">
									<input type="text" placeholder="CVV" name="cvv" id="cvv" value="" maxlength="3" />
									<div class="error" id="err_cvv"></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="sm-3 col-md-3 col-lg-3">
									<label>Discount Code</label>
								</div>
								<div class="sm-9 col-md-9 col-lg-9">
									<div class="cvc-block">
										<input type="text" placeholder="Discount Code" name="discount_code" id="discount_code" />
										
										<div class="info-block" id="apply_discount">
                                            <i class="fa fa-check" id="apply_code"></i>
                                            <div class="info-text">
                                                Apply Discount Code
                                            </div>
                                        </div>

                                        <div class="info-block" id="remove_discount" style="display: none;">
                                            <i class="fa fa-times" id="remove_code"></i>
                                            <div class="info-text">
                                                Remove Discount Code
                                            </div>
                                        </div>

                                        <div class="error" id="err_discount_code"></div>

									</div>
								</div>
							</div>
						</div>

						<button type="button" class="green-btn make-payement" id="btn_submit_sp_payment_form">Make Payment</button>
					</div>

					<div class="payment-wrapper">
						<h3>{{ $user_firstname.' '.$user_lastname }}</h3>
						
						<div class="user-info">
							<p><b>Subscription Plan</b></p>
							<p>{{ $sp_name }}</p>
						</div>
						
						<div class="user-info description">
							<p><b></b></p>
							<p></p>
						</div>
						
						<div class="total-block">
							<p>Total</p>
							<h2> {{ $sp_price }} <i class="fa fa-eur"></i></h2>
							<span id="discount_span" style="display: none;"><b id="show_discount_price"></b><i class="fa fa-eur"></i> off</span>
						</div>
						
						<div class="note">By completing your purchase, you agree to these Terms of Service.</div>
					</div>

				</form>

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#card_no, #cvv, #expiry_month, #expiry_year').keydown(function ()
		{
			$(this).val($(this).val().replace(/[^\d]/, ''));
			$(this).keyup(function ()
			{
				$(this).val($(this).val().replace(/[^\d]/, ''));
			});
		});


		$('#expiry_date').keyup(function(event)
		{
			var inputLength = event.target.value.length; 
	        if(inputLength === 2 || inputLength === 5)
	        {
				var thisVal = event.target.value;
				if(inputLength < 5)
				{
					thisVal += '/';
					$(event.target).val(thisVal);
				}
			}
    	});


    	/*--- Hide / Show Password Start ---*/
	        $("#hide_password").click(function()
	        {
	            $("#card_no").attr('type','password');

	            $("#hide_password").css('display', 'none');
	            $("#show_password").css('display', 'block');
	        });

	        $("#show_password").click(function()
	        {
	            $("#card_no").attr('type','text');

	            $("#hide_password").css('display', 'block');
	            $("#show_password").css('display', 'none');
	        });
        /*--- Hide / Show Password End ---*/


		$("#stripe_card").change(function()
		{
			var customer_id = $(this).find(':selected').data("customer_id");
			var card_id     = $(this).find(':selected').data("card_id");

			$("#customer_id").val(customer_id);
			$("#card_id").val(card_id);
		});


		$("#btn_submit_sp_payment_form").click(function()
		{
			var stripe_card  = $("#stripe_card option:selected").val();
			var card_name    = $("#card_name").val();
			var card_no      = $("#card_no").val();
			var expiry_month = $("#expiry_month").val();
			var expiry_year  = $("#expiry_year").val();
			var cvv          = $("#cvv").val();
			var alpha        = /^[a-zA-Z ]*$/;
			var numeric      = /^[0-9]*$/;

			if( $.trim(stripe_card) == '' )
			{
				if( $.trim(card_name) == '' && $.trim(card_no) == '' && $.trim(expiry_month) == '' && $.trim(expiry_year) == '' && $.trim(cvv) == '' )
				{
					$('#stripe_card').focus();
					$('#err_stripe_card').show();
					$('#err_stripe_card').html('Please select payment card');
					$('#err_stripe_card').fadeOut(4000);
					return false;
				}
				else if( $.trim(card_name) == '' )
				{
					$('#card_name').focus();
					$('#err_card_name').show();
					$('#err_card_name').html('Please enter name');
					$('#err_card_name').fadeOut(4000);
					return false;
				}
				else if(!alpha.test(card_name))
				{
					$('#pfirst_name').focus();
					$('#err_card_name').show();
					$('#err_card_name').html('Please enter valid name.');
					$('#err_card_name').fadeOut(4000);
					return false;
				}
				else if( $.trim(card_no) == '' )
				{
					$('#card_no').focus();
					$('#err_card_no').show();
					$('#err_card_no').html('Please enter card number');
					$('#err_card_no').fadeOut(4000);
					return false;
				}
				else if(!numeric.test(card_no))
				{
					$('#card_no').focus();
					$('#err_card_no').show();
					$('#err_card_no').html('Please enter valid card number.');
					$('#err_card_no').fadeOut(4000);
					return false;
				}
				else if( $.trim(expiry_month) == '' )
				{
					$('#expiry_month').focus();
					$('#err_expiry_month').show();
					$('#err_expiry_month').html('Please enter expiry month');
					$('#err_expiry_month').fadeOut(4000);
					return false;
				}
				else if(!numeric.test(expiry_month))
				{
					$('#expiry_month').focus();
					$('#err_expiry_month').show();
					$('#err_expiry_month').html('Please enter valid expiry month.');
					$('#err_expiry_month').fadeOut(4000);
					return false;
				}
				else if( $.trim(expiry_year) == '' )
				{
					$('#expiry_year').focus();
					$('#err_expiry_year').show();
					$('#err_expiry_year').html('Please enter expiry year');
					$('#err_expiry_year').fadeOut(4000);
					return false;
				}
				else if(!numeric.test(expiry_year))
				{
					$('#expiry_year').focus();
					$('#err_expiry_year').show();
					$('#err_expiry_year').html('Please enter valid expiry year.');
					$('#err_expiry_year').fadeOut(4000);
					return false;
				}
				else if( $.trim(cvv) == '' )
				{
					$('#cvv').focus();
					$('#err_cvv').show();
					$('#err_cvv').html('Please enter cvv');
					$('#err_cvv').fadeOut(4000);
					return false;
				}
				else if(!numeric.test(cvv))
				{
					$('#cvv').focus();
					$('#err_cvv').show();
					$('#err_cvv').html('Please enter valid cvv.');
					$('#err_cvv').fadeOut(4000);
					return false;
				}
				else
				{
					sp_payment();
				}
			}
			else
			{
				sp_payment();
			}
		});


		$("#apply_code").click(function() {
            var discount_code = $("#discount_code").val();
            var sp_price      = "{{ $sp_price }}";

            if( $.trim( discount_code ) != '' )
            {
                var token = "{{ csrf_token() }}";

                $.ajax({
                    url         : '{{ url("/") }}/patient/consultation/subscription_plan/payment/apply_discount',
                    type       : 'post',
                    data       : { _token:token, discount_code:discount_code, sp_price:sp_price },
                    dataType   : 'json',
                    beforeSend : showProcessingOverlay(),
                    success    : function (res)
                    {
                        hideProcessingOverlay();

                        if(res.status == 'success')
                        {
                            $("#discount_span").css('display','block');
                            $("#discount_id").val(res.discount_id);
                            $("#discount_price").val(res.discount_price);
                            $("#show_discount_price").html(res.discount_price);
                            $("#discount_code").prop("readonly",true);

                            $("#err_discount_code").html(res.message).css('display','block').css('color','green').delay(6000).fadeOut();

                            $("#apply_discount").css('display','none');
                            $("#remove_discount").css('display','block');
                        }
                        else
                        {
                            $("#err_discount_code").html(res.message).css('display','block').css('color','red').delay(6000).fadeOut();
                        }
                    }
                });
            }
            
        });

        $("#remove_code").click(function() {
            $("#discount_span").css('display','none');
            $("#discount_id").val('');
            $("#discount_price").val('');
            $("#show_discount_price").html('');
            $("#discount_code").val('');
            $("#discount_code").prop("readonly",false);

            $("#err_discount_code").html('Success! Applied discount code removed.').css('display','block').css('color','green').delay(6000).fadeOut();

            $("#apply_discount").css('display','block');
            $("#remove_discount").css('display','none');
        });

	});

	function sp_payment()
	{
		showProcessingOverlay();

		var form = $('#subscription_plan_payment_form')[0];
        var formData = new FormData(form);

        $.ajax({
            url         : '{{ url("/") }}/patient/consultation/subscription_plan/payment/process',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function (res)
            {
                hideProcessingOverlay();

                if(res.status == 'success')
                {
                    // reset form
                    $('#subscription_plan_payment_form')[0].reset();

                    $("#form_success_msg").html(res.message);
                    $("#form_success").css('display','block').delay(6000).fadeOut();

                    setTimeout(function() {
                        showProcessingOverlay();

                        window.location.href = "{{ url('/') }}/patient/consultation/{{ Session::get('consultation_id') }}/patient";
                    }, 6000);
                }
                else
                {
                    $("#form_error_msg").html(res.message);
                    $("#form_error").css('display','block').delay(6000).fadeOut();
                }
            }
        });
	}
</script>

@endsection