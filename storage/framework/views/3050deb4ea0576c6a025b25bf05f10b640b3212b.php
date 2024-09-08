<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-sm-8 col-md-9 col-lg-9">

                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="white-wrapper prescription-wrapper">
                <h2>About Me</h2>

                <form name="frm_doctor_about_me" id="frm_doctor_about_me" method="post" autocomplete="off" action="<?php echo e($module_url_path); ?>/about_me/update" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    
                    <div class="prescription-section">
                    	<div class="form-group profile-img-wrapper">
                            <div class="profile-img-block">
                                <div class="pro-img">

                                    <?php $profile_img_src = $default_img_path .'/upload-img.png'; ?>
                                    <?php if(isset($arr_doctor['profile_image']) && $arr_doctor['profile_image'] != ''): ?>
                                        <?php if(file_exists($profile_image_base_path.'/'.$arr_doctor['profile_image'])): ?>
                                            <?php $profile_img_src = $profile_image_public_path.'/'.$arr_doctor['profile_image']; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <img src="<?php echo e($profile_img_src); ?>" class="img-responsive img-preview" id="img-preview" alt=""/>
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
                                    <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" maxlength="20" value="<?php echo e(isset($arr_doctor['first_name']) ? decrypt_value($arr_doctor['first_name']) : ''); ?>"/>
                                    <div class="error" id="err_first_name"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group">
                                    <label class="form-label">Last Name<i class="red">*</i></label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" maxlength="20" value="<?php echo e(isset($arr_doctor['last_name']) ? decrypt_value($arr_doctor['last_name']) : ''); ?>"/>
                                    <div class="error" id="err_last_name"></div>
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email<i class="red">*</i></label>
                                    <input type="email" id="email" name="email" placeholder="Enter Email" readonly maxlength="25" value="<?php echo e(isset($arr_doctor['email']) ? $arr_doctor['email'] : ''); ?>"/>
                                    <div class="error" id="err_email"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth<i class="red">*</i></label>
                                    <div class="date-input relative-block">
                                        <input class="date-input" id="datepicker" type="text" placeholder="Select Date of Birth" name="birth_date" value="<?php echo e(isset($arr_doctor['date_of_birth']) ? date('m/d/Y',strtotime($arr_doctor['date_of_birth'])) : ''); ?>"/>
                                        <div class="error" id="err_datepicker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="contact_no" id="contact_no" placeholder="Enter Contact Number" value="<?php echo e(isset($arr_doctor['contact_no']) ? $arr_doctor['contact_no'] : ''); ?>"/>
                                    <div class="error" id="err_contact_no"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Country Code<i class="red">*</i></label>
                                    <select name="phone_code" id="phone_code" disabled="true">
                                    <option value="">Code</option>
                                        <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                            <?php foreach($mobcode_data as $mobcode): ?>
                                                <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if($arr_doctor['phone_code'] == $mobcode['phonecode']): ?> selected <?php endif; ?> >+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="error" id="err_phone_code"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<i class="red">*</i></label>
                                    <input type="text" placeholder="Mobile Number" name="mobile_no" id="mobile_no" readonly maxlength="15" value="<?php echo e(isset($arr_doctor['mobile_no']) ? $arr_doctor['mobile_no'] : ''); ?>"/>
                                    <div class="error" id="err_mobile_no"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Title<i class="red">*</i></label>
                                    <select name="prefix" id="prefix">
                                        <option value="">Select Title</option>
                                        <?php if(isset($arr_prefix) && sizeof($arr_prefix)>0): ?>
                                            <?php foreach($arr_prefix as $prefix): ?>
                                                <option value="<?php echo e($prefix['id']); ?>" <?php if(isset($arr_doctor['prefix']) && $arr_doctor['prefix']!='' && $arr_doctor['prefix'] == $prefix['id']): ?> selected <?php endif; ?>><?php echo e(isset($prefix['name']) ? $prefix['name'] : ''); ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="error" id="err_prefix"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Timezone<i class="red">*</i></label>
                                    <select name="timezone" id="timezone">
                                        <option value="">Select Timezone</option>
                                        <?php if(isset($arr_timezone) && sizeof($arr_timezone)>0): ?>
                                            <?php foreach($arr_timezone as $timezone): ?>
                                                <option value="<?php echo e($timezone['id']); ?>"  <?php if(isset($arr_doctor['timezone']) && $arr_doctor['timezone']!='' && $arr_doctor['timezone'] == $timezone['id']): ?> selected <?php endif; ?>><?php echo e(isset($timezone['location_name'])?$timezone['location_name']:''); ?> (<?php echo e(isset($timezone['utc_offset'])?$timezone['utc_offset']:''); ?>)</option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="error" id="err_timezone"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Address<i class="red">*</i></label>
                            <textarea placeholder="Address" name="address" id="autocomplete" rows="2"><?php echo e(isset($arr_doctor['address']) ? decrypt_value($arr_doctor['address']) : ''); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Country<i class="red">*</i></label>
                                    <input type="text" placeholder="Country" name="country" id="country" value="<?php echo e(isset($arr_doctor['country']) ? decrypt_value($arr_doctor['country']) : ''); ?>" maxlength="50"/>
                                    <div class="error" id="err_country"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">City<i class="red">*</i></label>
                                    <input type="text" placeholder="City" id="locality" name="city"  maxlength="50" value="<?php echo e(isset($arr_doctor['city']) ? decrypt_value($arr_doctor['city']) : ''); ?>"/>
                                    <div class="error" id="err_city"></div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="postal_code" id="postal_code">
                        <input type="hidden" name="lat"         id="lat">
                        <input type="hidden" name="lng"         id="lon">

                        <div class="save-btn">
                            <button type="button" id="btn_update_about_me" class="green-trans-btn">Update</button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php echo $__env->make('virgil.virgil', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.datepicker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>   
	$(document).ready(function ()
    {
        var today = new Date();
        $('#datepicker').datepicker({
            format    : 'dd-mm-yyyy',
            autoclose : true,
            endDate   : "today",
            maxDate   : today
        });
    });
</script>
<script type="text/javascript">
$("#btn_update_about_me").click(function()
{
    var first_name        = $("#first_name").val();
    var last_name         = $("#last_name").val();
    var mobile_no         = $("#mobile_no").val();
    var address           = $("#autocomplete").val();
    var phone_code        = $("#phone_code").val();
    var city              = $("#locality").val();
    var country           = $("#country").val();
    var prefix            = $("#prefix").val();
    var timezone          = $("#timezone").val();
    var birth_date        = $("#datepicker").val();
    var contact_no        = $("#contact_no").val();
    var alpha             = /^[a-zA-Z]*$/;
    var numeric           = /^[0-9]*$/;
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
    else if($.trim(birth_date) == '')
    {
        $('#datepicker').focus();
        $('#err_datepicker').show();
        $('#err_datepicker').html('Please enter date of birth.');
        $('#err_datepicker').fadeOut(4000);
        return false;
    }
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
    else if($.trim(phone_code) == '')
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
    }
    else if($.trim(prefix) == '')
    {
       $('#prefix').focus();
       $('#err_prefix').show();
       $('#err_prefix').html('Please select title.');
       $('#err_prefix').fadeOut(4000);
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
    else
    {
        var form = $('#frm_doctor_about_me')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '<?php echo e($module_url_path); ?>/about_me/update',
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
});

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>