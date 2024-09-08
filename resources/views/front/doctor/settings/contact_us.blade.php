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
                <div class="white-wrapper prescription-wrapper">
                    <h2>Contact Us</h2>
                    <form name="frm_contact_us" id="frm_contact_us" method="post" action="{{ $module_url_path }}/contact_us/store">
                        {{csrf_field()}}
                        <div class="prescription-section contact-section">
                            <div class="form-group">
                                <label class="form-label">Doctor Name<i class="red">*</i></label>
                                <input type="text" id="doctor_name" name="doctor_name" placeholder="Doctor Name" maxlength="50" value="{{isset($full_name)?$full_name:''}}" readonly />
                                <div class="error" id="err_doctor_name"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email Id<i class="red">*</i></label>
                                        <input type="email" id="email" name="email" placeholder="Email Id" maxlength="80"  value="{{isset($email)?$email:''}}" readonly />
                                        <div class="error" id="err_email"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code<i class="red">*</i></label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            @if(!empty($mobcode_data) && isset($mobcode_data))
                                                @foreach($mobcode_data as $mobcode)
                                                    <option value="{{ $mobcode['phonecode'] }}" @if(isset($phone_code) && $phone_code!='' && $phone_code == $mobcode['phonecode']) selected @endif>+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>

                                <input type="hidden" name="hidden_phone_code" value="{{$phone_code}}">

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Mobile no." id="mobile_no" name="mobile_no" maxlength="16"  value="{{isset($mobile_no)?$mobile_no:''}}" readonly />
                                        <div class="error" id="err_mobile_no"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Message<i class="red">*</i></label>
                                <textarea name="message" id="message" placeholder="Leave a Message" rows="3"></textarea>
                                <div class="error" id="err_message"></div>
                            </div>
                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_contact_us">Send</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#doctor_name, #email, #phone_code, #mobile_no, #message").on('keypress',function(event)
        {
            var keycode = event.keyCode || event.which;
            if(keycode == '13')
            {
                ContactUsValidationCheck();
            }
        });

        $('#btn_contact_us').click(function()
        {
            ContactUsValidationCheck();
        });
    });

    function ContactUsValidationCheck()
    {
        var doctor_name = $('#doctor_name').val();
        var email        = $('#email').val();
        var phone_code   = $('#phone_code').val();
        var mobile_no    = $('#mobile_no').val();
        var message      = $('#message').val();
        var alpha        = /^[a-zA-Z ]*$/;
        var numeric      = /^[0-9]*$/;
        var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if($.trim(doctor_name) == '')
        {
            $('#doctor_name').focus();
            $('#err_doctor_name').show();
            $('#err_doctor_name').html('Please enter name.');
            $('#err_doctor_name').fadeOut(4000);
            return false;
        }  
        else if(!alpha.test(doctor_name))
        {
            $('#doctor_name').focus();
            $('#err_doctor_name').show();
            $('#err_doctor_name').html('Please enter valid name.');
            $('#err_doctor_name').fadeOut(4000);
            return false;
        }   
        else if($.trim(email) == '')
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter email id.');
            $('#err_email').fadeOut(4000);
          return false;  
        }
        else if(!email_filter.test(email))
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
            return false;  
        }
        else if($.trim(mobile_no) == '')
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter mobile number.');
            $('#err_mobile_no').fadeOut(4000);
            return false;
        }
        else if(!numeric.test(mobile_no))
        {
            $('#mobile_no').focus();
            $('#err_mobile_no').show();
            $('#err_mobile_no').html('Please enter valid mobile.');
            $('#err_mobile_no').fadeOut(4000);
            return false;
        }
        else if($.trim(message) == '')
        {
            $('#message').focus();
            $('#err_message').show();
            $('#err_message').html('Please enter message.');
            $('#err_message').fadeOut(4000);
            return false;
        }
        else
        {
            var form = $('#frm_contact_us')[0];
            var formData = new FormData(form);
            $.ajax({
                url         : '{{ $module_url_path }}/contact_us/store',
                type        : 'post',
                data        : formData,
                processData : false,
                contentType : false,
                cache       : false,
                beforeSend : showProcessingOverlay(),
                success     : function (res)
                {
                    hideProcessingOverlay();
                    location.reload();
                }
            });
        }
    }

</script>
@endsection