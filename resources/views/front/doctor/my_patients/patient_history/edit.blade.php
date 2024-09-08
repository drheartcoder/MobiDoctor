@extends('front.doctor.layout.master')
@section('main_content')
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.doctor.layout._leftbar')
            </div>
            <form name="frm_patient_about_me" id="frm_patient_about_me" method="post" autocomplete="off" action="{{$module_url_path}}/patient_history/update" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="patient_user_id" value="{{$enc_id}}">
                <div class="col-sm-8 col-md-9 col-lg-9">

                    @include('front.layout._operation_status')

                    <div class="white-wrapper">
                        
                        <div class="form-group profile-img-wrapper">
                            <div class="profile-img-block">
                                <div class="pro-img">
                                    @if(isset($arr_patient_details['profile_image']) && $arr_patient_details['profile_image']!='')
                                        @if(file_exists($patient_image_base_path.'/'.$arr_patient_details['profile_image']))
                                            <?php $profile_img_src = $patient_image_public_path.'/'.$arr_patient_details['profile_image']; ?>
                                        @else
                                            <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?> 
                                        @endif
                                    @else
                                         <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?> 
                                    @endif

                                    <img src="{{$profile_img_src}}" class="img-responsive img-preview" id="img-preview" alt=""/>
                                </div>
                                <div class="update-pic-btns">
                                    <input id="profile_image" name="profile_image" type="file" class="attachment_upload validate-image">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                     <label class="form-label">First Name<i class="red">*</i></label>
                                     <input type="text" placeholder="First Name" name="first_name" id="first_name" value="{{isset($arr_patient_details['first_name'])?decrypt_value($arr_patient_details['first_name']):''}}" maxlength="15" />
                                     <div class="error" id="err_first_name"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                     <label class="form-label">Last Name<i class="red">*</i></label>
                                     <input type="text" placeholder="Last Name" name="last_name" id="last_name" value="{{isset($arr_patient_details['last_name'])?decrypt_value($arr_patient_details['last_name']):''}}" maxlength="15"/>
                                     <div class="error" id="err_last_name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email<i class="red">*</i></label>
                                    <input type="email" readonly="" placeholder="Email" name="email" id="email" value="{{isset($arr_patient_details['email'])?$arr_patient_details['email']:''}}" maxlength="80"/>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth<i class="red">*</i></label>
                                    <div class="date-input relative-block">
                                        <input class="date-input" id="datepicker" type="text" placeholder="Select Date of Birth" name="birth_date" value="{{ isset($arr_patient_details['date_of_birth']) ? date('m/d/Y',strtotime($arr_patient_details['date_of_birth'])) : '' }}" />
                                        <div class="error" id="err_datepicker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Country Code<i class="red">*</i></label>
                                    <select name="phone_code" id="phone_code" disabled>
                                    <option value="">Code</option>
                                        @if(!empty($mobcode_data) && isset($mobcode_data))
                                            @foreach($mobcode_data as $mobcode)
                                                <option value="{{ $mobcode['phonecode'] }}" @if($arr_patient_details['phone_code'] == $mobcode['phonecode']) selected @endif >+{{ $mobcode['phonecode'] }} ({{ $mobcode['iso3'] }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="error" id="err_phone_code"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<i class="red">*</i></label>
                                    <input type="text" placeholder="Mobile Number" name="mobile_no" id="mobile_no" readonly maxlength="15" value="{{isset($arr_patient_details['mobile_no'])?$arr_patient_details['mobile_no']:''}}" maxlength="16"/>
                                    <div class="error" id="err_mobile_no"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Contact No.</label>
                                    <input type="text" placeholder="Contact Number" name="contact_no" id="contact_no" value="{{isset($arr_patient_details['contact_no'])?$arr_patient_details['contact_no']:''}}" maxlength="16"/>
                                </div>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address<i class="red">*</i></label>
                            <textarea placeholder="Address" name="address" id="autocomplete" rows="2">{{isset($arr_patient_details['address'])?decrypt_value($arr_patient_details['address']):''}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group">
                                     <label class="form-label">Country<i class="red">*</i></label>
                                     <input type="text" placeholder="Country" name="country" id="country" value="{{isset($arr_patient_details['country'])?decrypt_value($arr_patient_details['country']):''}}" maxlength="50"/>
                                     <div class="error" id="err_country"></div>
                                 </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group">
                                     <label class="form-label">City<i class="red">*</i></label>
                                     <input type="text" placeholder="City" id="locality" name="city" value="{{isset($arr_patient_details['city'])?decrypt_value($arr_patient_details['city']):''}}" maxlength="50"/>
                                     <div class="error" id="err_city"></div>
                                 </div>
                            </div>
                        </div>
                        <input type="hidden" name="postal_code" id="postal_code">
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lon">
                        
                        <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Fax</label>
                                <input type="text" placeholder="Fax" name="fax_no" id="fax_no" value="{{isset($arr_patient_details['fax_no'])?decrypt_value($arr_patient_details['fax_no']):''}}" maxlength="16"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Timezone<i class="red">*</i></label>
                                <select name="timezone" id="timezone">
                                    <option value="">Select Timezone</option>
                                    @if(isset($arr_timezone) && sizeof($arr_timezone)>0)
                                        @foreach($arr_timezone as $timezone)
                                            <option value="{{ $timezone['id'] }}" @if(isset($arr_patient_details['timezone']) && $arr_patient_details['timezone']!='' && $arr_patient_details['timezone'] == $timezone['id']) selected @endif>{{isset($timezone['location_name'])?$timezone['location_name']:''}} ({{isset($timezone['utc_offset'])?$timezone['utc_offset']:''}})</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error" id="err_timezone"></div>
                            </div>
                        </div>
                        </div>

                        <div class="save-btn">
                            <button type="button" class="green-trans-btn" id="btn_update_about_me">Update</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--datepicker strat-->
@include('common.datepicker')
<!--datepicker end-->


<!-- profile image upload demo script start-->
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

$("#btn_update_about_me").click(function()
{
    AboutMeValidationCheck();
});

function AboutMeValidationCheck()
{
    var first_name   = $("#first_name").val();
    var last_name    = $("#last_name").val();
    var mobile_no    = $("#mobile_no").val();
    var address      = $("#autocomplete").val();
    var phone_code   = $("#phone_code").val();
    var city         = $("#locality").val();
    var country      = $("#country").val();
    var timezone     = $("#timezone").val();
    var contact_no   = $("#contact_no").val();
    var datepicker   = $('#datepicker').val();
    var alpha        = /^[a-zA-Z]*$/;
    var numeric      = /^[0-9]*$/;
    var contact_no_filter = /^[- +()0-9]*$/;

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
    else if($.trim(datepicker) == '')
    {
        $('#datepicker').focus();
        $('#err_datepicker').show();
        $('#err_datepicker').html('Please select date of birth.');
        $('#err_datepicker').fadeOut(4000);
        return false;  
    }
   /* else if($.trim(phone_code) == '')
    {
       $('#phone_code').focus();
       $('#err_phone_code').show();
       $('#err_phone_code').html('Please select Country code.');
       $('#err_phone_code').fadeOut(4000);
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
    else if($.trim(mobile_no).length < 9)
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Mobile number should be more than 9 digits.');
        $('#err_mobile_no').fadeOut(4000);
        return false;
    }
    else if($.trim(mobile_no).length > 16)
    {
        $('#mobile_no').focus();
        $('#err_mobile_no').show();
        $('#err_mobile_no').html('Mobile number should not more than 16 digits');
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
    }*/
    else if($.trim(contact_no) != '' && (!contact_no_filter.test(contact_no) || $.trim(contact_no).length < 7))
    {
        $('#contact_no').focus();
        $('#err_contact_no').show();
        $('#err_contact_no').html('Please enter valid contact no.');
        $('#err_contact_no').fadeOut(4000);
        return false;
    }
    else if($.trim(contact_no) != '' && (!contact_no_filter.test(contact_no) || $.trim(contact_no).length > 16))
    {
        $('#contact_no').focus();
        $('#err_contact_no').show();
        $('#err_contact_no').html('Please enter valid contact no.');
        $('#err_contact_no').fadeOut(4000);
        return false;
    }
    else if($.trim(address) == '')
    {
        $('#address').focus();
        $('#err_address').show();
        $('#err_address').html('Please enter address.');
        $('#err_address').fadeOut(4000);
        return false;
    }
    else if($.trim(country) == '')
    {
        $('#country').focus();
        $('#err_country').show();
        $('#err_country').html('Please enter country name.');
        $('#err_country').fadeOut(4000);
        return false;
    }
    else if(!alpha.test(country))
    {
        $('#country').focus();
        $('#err_country').show();
        $('#err_country').html('Please enter valid country name.');
        $('#err_country').fadeOut(4000);
        return false;
    }
    else if($.trim(city) == '')
    {
        $('#locality').focus();
        $('#err_city').show();
        $('#err_city').html('Please enter city name.');
        $('#err_city').fadeOut(4000);
        return false;
    }
    else if(!alpha.test(city))
    {
        $('#locality').focus();
        $('#err_city').show();
        $('#err_city').html('Please enter valid city name.');
        $('#err_city').fadeOut(4000);
        return false;
    }
    else if($.trim(timezone) == '')
    {
       $('#timezone').focus();
       $('#err_timezone').show();
       $('#err_timezone').html('Please select timezone.');
       $('#err_timezone').fadeOut(4000);
       return false;  
    }
    else
    {
        var form = $('#frm_patient_about_me')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '{{ $module_url_path }}/patient_history/update',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            beforeSend  : showProcessingOverlay(),
            success     : function (res)
            {
                hideProcessingOverlay();
                location.reload();
            }
        });
    }
}

var _URL = window.URL || window.webkitURL;
$('#profile_image').change(function() 
{
    var tempThis = $(this);
    var file, img;
    var file_name = $(this).val();
    var ext = file_name.substr( (file_name.lastIndexOf('.') +1) );
    if(ext!='' && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
    {       
        swal("Invalid File , Allowed extensions are: jpeg , jpg , png");
        $('#img-preview').attr('src',$('.old_image').val());
        $("#profile_image").val('');
        return false;
    }
    else
    {
        if(this.files[0].size > 2200000)
        {
            swal('','Image size should be upto 2 MB only.','error');
            $("#profile_image").val('');                
            $('#img-preview').attr('src',$('.old_image').val());
            return false;                            
        }

        if ((file = this.files[0])) 
        {
            img = new Image();
            img.onload = function (e) 
            {  
            
                if(this.width > 250 || this.height > 250)
                {   
                    $('#img-preview').attr('src',e.target.src);
                
                    return true;    
                }
                else
                { 
                    swal("Height and Width must be greater than or equal to 250 X 250.");
                    $("#profile_image").val('');                
                    $('#img-preview').attr('src',$('.old_image').val());
                    return false;                            
                }
            };
        img.src = _URL.createObjectURL(file);
        }      
    }
});

</script>   
@endsection