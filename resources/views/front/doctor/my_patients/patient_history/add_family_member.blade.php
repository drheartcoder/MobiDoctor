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
                    <h2>Add a Member</h2>
                    <form name="frm_add_family_member" id="frm_add_family_member" method="post" action="{{ $module_url_path }}/patient_history/family_member/store">
                        {{csrf_field()}}
                        <input type="hidden" name="enc_id" value="{{$enc_id}}">
                        <div class="prescription-section">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter First Name" name="first_name" id="first_name" maxlength="50" />
                                        <div class="error" id="err_first_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Last Name" name="last_name" id="last_name" maxlength="50"/>
                                        <div class="error" id="err_last_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" placeholder="Enter Email" name="email" id="email" maxlength="80"/>
                                        <div class="error" id="err_email"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Gender<i class="red">*</i></label>
                                        <select name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="error" id="err_gender"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Relationship<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Relationship" name="relation" id="relation" maxlength="50"/>
                                        <div class="error" id="err_relation"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth<i class="red">*</i></label>
                                        <div class="date-input relative-block">
                                            <input class="date-input" id="datepicker" type="text" placeholder="Select Date of Birth" name="birth_date" />
                                            <div class="error" id="err_datepicker"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code</label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            @if(!empty($mobcode_data) && isset($mobcode_data))
                                                @foreach($mobcode_data as $mobcode)
                                                    <option value="{{ $mobcode['phonecode'] }}">+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" placeholder="Enter Mobile no." id="mobile_no" name="mobile_no" maxlength="16" />
                                        <div class="error" id="err_mobile_no"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_add_member">Save</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--datepicker strat-->
@include('common.datepicker')
<!--datepicker end-->

<script type="text/javascript">
$(document).ready(function () {
    var today = new Date();
    $('#datepicker').datepicker({
      //  format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    });
});

$(document).ready(function()
{
    $("#first_name, #last_name, #gender, #relation, #birth_date").on('keypress',function(event)
    {
        var keycode = event.keyCode || event.which;
        if(keycode == '13')
        {
            AddMemberValidationCheck();
        }
    });

    $('#btn_add_member').click(function() 
    {
        AddMemberValidationCheck();
    });
});

function AddMemberValidationCheck()
{
    var first_name   = $('#first_name').val();
    var last_name    = $('#last_name').val();
    var gender       = $('#gender').val();
    var relation     = $('#relation').val();
    var datepicker   = $('#datepicker').val();
    var email        = $('#email').val();
    var mobile_no    = $('#mobile_no').val();
    var phone_code   = $('#phone_code').val();
    var alpha        = /^[a-zA-Z]*$/;
    var alpha_with_space = /^[a-zA-Z ]*$/;
    var numeric      = /^[0-9]*$/;
    var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if($.trim(first_name) == '')
    {
        $('#first_name').focus();
        $('#err_first_name').show();
        $('#err_first_name').html('Please enter first name.');
        $('#err_first_name').fadeOut(4000);
        return false;
    }  
    else if(!alpha.test(first_name))
    {
        $('#first_name').focus();
        $('#err_first_name').show();
        $('#err_first_name').html('Please enter valid first name.');
        $('#err_first_name').fadeOut(4000);
        return false;
    }   
    else if($.trim(last_name) == '')
    {
        $('#last_name').focus();
        $('#err_last_name').show();
        $('#err_last_name').html('Please enter last name.');
        $('#err_last_name').fadeOut(4000);
        return false;
    }
    else if(!alpha.test(last_name))
    {
        $('#last_name').focus();
        $('#err_last_name').show();
        $('#err_last_name').html('Please enter valid last name.');
        $('#err_last_name').fadeOut(4000);
        return false;
    }
    else if($.trim(email) != '' && !email_filter.test(email))
    {
        $('#email').focus();
        $('#err_email').show();
        $('#err_email').html('Please enter valid email id.');
        $('#err_email').fadeOut(4000);
        return false;
    }
    else if($.trim(gender) == '')
    {
        $('#gender').focus();
        $('#err_gender').show();
        $('#err_gender').html('Please select gender.');
        $('#err_gender').fadeOut(4000);
        return false;  
    }
    else if($.trim(relation) == '')
    {
        $('#relation').focus();
        $('#err_relation').show();
        $('#err_relation').html('Please enter relation.');
        $('#err_relation').fadeOut(4000);
        return false;  
    }
    else if(!alpha_with_space.test(relation))
    {
        $('#relation').focus();
        $('#err_relation').show();
        $('#err_relation').html('Please enter valid relation.');
        $('#err_relation').fadeOut(4000);
        return false;
    } 
    else if($.trim(datepicker) == '')
    {
        $('#datepicker').focus();
        $('#err_datepicker').show();
        $('#err_datepicker').html('Please select date of birth.');
        $('#err_datepicker').fadeOut(4000);
        return false;  
    }
    else if($.trim(mobile_no) != '' && !numeric.test(mobile_no))
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Please enter valid mobile.');
        $('#err_mobile_no').fadeOut(4000);
        return false;
    }
    else if($.trim(mobile_no) != '' && $.trim(phone_code) == '')
    {
        $('#phone_code').focus();
        $('#err_phone_code').show();
        $('#err_phone_code').html('Please select country code.');
        $('#err_phone_code').fadeOut(4000);
        return false;  
    }
    else if($.trim(mobile_no) == '' && $.trim(phone_code) != '')
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Please enter mobile no.');
        $('#err_mobile_no').fadeOut(4000);
        return false;  
    }
    else
    {
        var form = $('#frm_add_family_member')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '{{ $module_url_path }}/patient_history/family_member/store',
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