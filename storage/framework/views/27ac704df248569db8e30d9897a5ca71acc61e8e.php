<?php $__env->startSection('main_content'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                 <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
            	<?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="white-wrapper prescription-wrapper">
                    <h2><?php echo e(isset($page_title) ? $page_title : ''); ?></h2>
                    
                    <form name="frm_medical_practice" id="frm_medical_practice" method="post" action="<?php echo e($module_url_path); ?>/medical_practice/update">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Clinic Name<i class="red">*</i></label>
                                         <input type="text" name="clinic_name" id="clinic_name" placeholder="Enter Clinic Name" maxlength="150" />
                                         <div class="error" id="err_clinic_name"></div>
                                     </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Experience<i class="red">*</i></label>
                                        <select name="experience" id="experience">
                                            <option value="">Select Experience</option>
                                                <?php
                                             	for($i=1;$i<100;$i++) {
                                                ?>
                                                <option value="<?php echo e($i); ?>" <?php if(isset($arr_doctor_details['experience']) && $arr_doctor_details['experience']!='' && $arr_doctor_details['experience'] == $i): ?> selected <?php endif; ?>><?php echo e($i); ?> Year(s)</option>
                                            <?php } ?>
                                        </select>
                                        <div class="error" id="err_experience"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Contact Number</label>
                                         <input type="text" name="contact_no" id="contact_no" placeholder="Enter Contact Number" maxlength="16" />
                                         <div class="error" id="err_contact_no"></div>
                                     </div>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code</label>
                                        <select name="phone_code" id="phone_code">
                                        <option value="">Code</option>
                                            <?php if(!empty($mobcode_data) && isset($mobcode_data)): ?>
                                                <?php foreach($mobcode_data as $mobcode): ?>
                                                    <option value="<?php echo e($mobcode['phonecode']); ?>" <?php if(isset($arr_doctor_details['clinic_phone_code']) && $arr_doctor_details['clinic_phone_code'] == $mobcode['phonecode']): ?> selected <?php endif; ?>>+<?php echo e($mobcode['phonecode']); ?> (<?php echo e($mobcode['iso3']); ?>)</option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="error" id="err_phone_code"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" placeholder="Mobile Number" name="mobile_no" id="mobile_no" maxlength="15"  value="<?php echo e(isset($arr_doctor['mobile_no'])?$arr_doctor['mobile_no']:''); ?>"/>
                                        <div class="error" id="err_mobile_no"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Email</label>
                                         <input type="email" placeholder="Enter Email" id="email" name="email"/>
                                     </div>
                                 </div>
                                 <?php
                                    $selected_language = [];
                                    $selected_language = json_decode(isset($arr_doctor_details['language'])?$arr_doctor_details['language']:'');
                                 ?>
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group example">
                                        <label class="form-label">Language<i class="red">*</i></label>
                                        <select id="multi-select-demo" name="language[]" multiple="multiple">
                                            <?php if(isset($arr_language) && sizeof($arr_language)>0): ?>
                                                <?php foreach($arr_language as $key => $language): ?>
                                                    <option value="<?php echo e($language['id']); ?>" <?php if(isset($selected_language) && sizeof($selected_language)>0 && in_array($language['id'],$selected_language)): ?> selected <?php endif; ?>><?php echo e($language['language']); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="error" id="err_language"></div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Address<i class="red">*</i></label>
                                		<textarea placeholder="Address" name="address" id="autocomplete" rows="2"></textarea>
                                		 <div class="error" id="err_address"></div>
                                    </div>
                                </div>  
                            </div>

                            <input type="hidden" name="postal_code" id="postal_code">
                            <input type="hidden" name="lat"         id="lat">
                            <input type="hidden" name="lng"         id="lon">
                            <input type="hidden" name="country"     id="country">
                            <input type="hidden" name="city"        id="locality">
                            
                            <input type="hidden" id="check_clinic_name" name="check_clinic_name">
                            <input type="hidden" id="check_experience" name="check_experience" value="<?php echo e(isset($arr_doctor_details['experience'])?$arr_doctor_details['experience']:''); ?>">
                            <input type="hidden" id="check_address" name="check_address">


                            <div class="save-btn">
                                <button type="button" id="btn_medical_practice" class="green-trans-btn">Save</button>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>   

<script type="text/javascript">
    $(document).ready(function() {
        $('#multi-select-demo').multiselect();
    });
</script>
<script type="text/javascript">

    $(document).ready(function()
    {
        var clinic_name = '<?php echo e(isset($arr_doctor_details['clinic_name']) ? $arr_doctor_details['clinic_name'] : ''); ?>';
        var experience  = '<?php echo e(isset($arr_doctor_details['experience']) ? $arr_doctor_details['experience'] : ''); ?>';
        var address     = '<?php echo e(isset($arr_doctor_details['clinic_address']) ? $arr_doctor_details['clinic_address'] : ''); ?>';
        var contact_no  = '<?php echo e(isset($arr_doctor_details['clinic_contact_no']) ? $arr_doctor_details['clinic_contact_no'] : ''); ?>';
        var mobile_no   = '<?php echo e(isset($arr_doctor_details['clinic_mobile_no']) ? $arr_doctor_details['clinic_mobile_no'] : ''); ?>';
        var email       = '<?php echo e(isset($arr_doctor_details['clinic_email']) ? $arr_doctor_details['clinic_email'] : ''); ?>';
        var phone_code  = '<?php echo e(isset($arr_doctor_details['clinic_phone_code']) ? $arr_doctor_details['clinic_phone_code'] : ''); ?>';

        $("#clinic_name").val( decrypt(clinic_name));
        $("#autocomplete").val( decrypt(address));
        $("#email").val( decrypt(email));
        $("#mobile_no").val( decrypt(mobile_no));
        $("#contact_no").val( decrypt(contact_no));
        $("#check_clinic_name").val( decrypt(clinic_name));
        $("#check_address").val( decrypt(address));
    });

	$("#btn_medical_practice").click(function(){
        var clinic_name       = $("#clinic_name").val();
        var experience        = $("#experience").val();
        var address           = $("#autocomplete").val();
        var contact_no        = $("#contact_no").val();
        var mobile_no         = $("#mobile_no").val();
        var email             = $("#email").val();
        var country           = $("#country").val();
        var city              = $("#locality").val();
        var postal_code       = $("#postal_code").val();
        var lat               = $("#lat").val();
        var lng               = $("#lon").val();
        var phone_code        = $("#phone_code").val();
        var language          = $("#multi-select-demo").val();

        var email_filter      = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var contact_no_filter = /^[- +()0-9]*$/;
        var numeric           = /^[0-9]*$/;

		if($.trim(clinic_name) == '')
	    {
	        $('#clinic_name').focus();
	        $('#err_clinic_name').show();
	        $('#err_clinic_name').html('Please enter clinic name.');
	        $('#err_clinic_name').fadeOut(4000);
	        return false;
	    }  
	    else if($.trim(experience) == '')
	    {
	    	$('#experience').focus();
	        $('#err_experience').show();
	        $('#err_experience').html('Please select experience.');
	        $('#err_experience').fadeOut(4000);
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
	    else if($.trim(email) != '' && !email_filter.test(email))
        {
            $('#email').focus();
            $('#err_email').show();
            $('#err_email').html('Please enter valid email id.');
            $('#err_email').fadeOut(4000);
          return false;  
        }
        else if($.trim(language) == '')
        {
            $('#language').focus();
            $('#err_language').show();
            $('#err_language').html('Please select language.');
            $('#err_language').fadeOut(4000);
          return false;   
        }
        else if($.trim(address) == '')
        {
            $('#autocomplete').focus();
            $('#err_address').show();
            $('#err_address').html('Please enter address.');
            $('#err_address').fadeOut(4000);
          return false;  
        }
        else
        {
        	showProcessingOverlay();

            var check_clinic_name = $('#check_clinic_name').val();
            var check_experience  = $('#check_experience').val();
            var check_address     = $('#check_address').val();
            var flag = 0;

            if($.trim(clinic_name) !=  $.trim(check_clinic_name))
            {
                flag = 1;
            }

            if($.trim(check_experience) != $.trim(experience))
            {
                flag = 1;
            }

            if($.trim(check_address) != $.trim(address))
            {
                flag = 1;
            }

            // get User's card(s)
            api.cards.get(card_id).then(function (cards)
            {
                var _token          = '<?php echo e(csrf_token()); ?>';
                var enc_clinic_name = encrypt(api, clinic_name, cards);
                var enc_contact_no  = encrypt(api, contact_no, cards);
                var enc_mobile_no   = encrypt(api, mobile_no, cards);
                var enc_email       = encrypt(api, email, cards);
                var enc_address     = encrypt(api, address, cards);
                var enc_country     = encrypt(api, country, cards);
                var enc_city        = encrypt(api, city, cards);
               
                $.ajax({
                    url  : "<?php echo e($module_url_path); ?>/medical_practice/update",
                    type : 'post',
                    data : {
                                _token              : _token,
                                clinic_name         : enc_clinic_name,
                                clinic_contact_no   : enc_contact_no,
                                clinic_mobile_no    : enc_mobile_no,
                                clinic_email        : enc_email,
                                clinic_address      : enc_address,
                                clinic_city         : enc_city,
                                clinic_country      : enc_country,
                                clinic_postal_code  : postal_code,
                                clinic_phone_code   : phone_code,
                                experience          : experience,
                                clinic_lat          : lat,
                                clinic_lng          : lng,
                                language            : language,
                                is_update           : flag

                            },
                    success : function(res)
                    {
                        hideProcessingOverlay();
                        location.reload();
                    }
                });
            })
            .then(null, function (error)
            {
                hideProcessingOverlay();
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            })
            .catch(function(error)
            {
                hideProcessingOverlay();
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            });
        }
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>