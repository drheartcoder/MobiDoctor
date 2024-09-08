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
                    <h2>Medical Qualifications</h2>
                     <form name="frm_medical_qualification" id="frm_medical_qualification" method="post" action="<?php echo e($module_url_path); ?>/medical_qualifications/update">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Primary Medical Qualification<i class="red">*</i></label>
                                         <input type="text" name="medical_qualification" id="medical_qualification" placeholder="Enter Primary Medical Qualification" maxlength="100" />
                                         <div class="error" id="err_medical_qualification"></div>
                                     </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Medical School<i class="red">*</i></label>
                                         <input type="text" name="medical_school" id="medical_school" placeholder="Enter Medical School" maxlength="100"/>
                                         <div class="error" id="err_medical_school"></div>
                                     </div>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Year Obtained<i class="red">*</i></label>
                                         <input type="text" name="year_obtained" id="year_obtained" placeholder="Ex. <?php echo e(date('Y')); ?>" maxlength="4"/>
                                         <div class="error" id="err_year_obtained"></div>
                                     </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label class="form-label">Country Obtained<i class="red">*</i></label>
                                          <input type="text" name="country_obtained" id="country_obtained" placeholder="Enter country Name" maxlength="15"/>
                                         <div class="error" id="err_country_obtained"></div>
                                     </div>
                                 </div>
                            </div>
                            <div class="form-group">
                                 <label class="form-label">Other Related Qualifications</label>
                                 <input type="text" name="other_qualifications" id="other_qualifications" placeholder="Enter Other Related Qualifications"/>
                                 <div class="error" id="err_other_qualifications"></div>
                            </div>

                            <input type="hidden" name="old_medical_qualification" id="old_medical_qualification">
                            <input type="hidden" name="old_medical_school" id="old_medical_school">
                            <input type="hidden" name="old_year_obtained" id="old_year_obtained">
                            <input type="hidden" name="old_country_obtained" id="old_country_obtained">

                            <div class="save-btn">
                                <button type="button" class="green-trans-btn" id="btn_medical_qulification">Save</button>
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

<script type="text/javascript">
    $(document).ready(function(){
        var medical_qualification = '<?php echo e(isset($arr_doctor_details['medical_qualification']) ? $arr_doctor_details['medical_qualification'] : ''); ?>';
        var medical_school        = '<?php echo e(isset($arr_doctor_details['medical_school'])        ? $arr_doctor_details['medical_school']        : ''); ?>';
        var year_obtained         = '<?php echo e(isset($arr_doctor_details['year_obtained'])         ? $arr_doctor_details['year_obtained']         : ''); ?>';
        var country_obtained      = '<?php echo e(isset($arr_doctor_details['country_obtained'])      ? $arr_doctor_details['country_obtained']      : ''); ?>';
        var other_qualifications  = '<?php echo e(isset($arr_doctor_details['other_qualifications'])  ? $arr_doctor_details['other_qualifications']  : ''); ?>';

        $("#medical_qualification").val( decrypt(medical_qualification) );
        $("#medical_school").val( decrypt(medical_school) );
        $("#year_obtained").val( decrypt(year_obtained) );
        $("#country_obtained").val( decrypt(country_obtained) );
        $("#other_qualifications").val( decrypt(other_qualifications) );

        $("#old_medical_qualification").val( decrypt(medical_qualification) );
        $("#old_medical_school").val( decrypt(medical_school) );
        $("#old_year_obtained").val( decrypt(year_obtained) );
        $("#old_country_obtained").val( decrypt(country_obtained) );
    });

    $("#btn_medical_qulification").click(function(){
        var medical_qualification = $("#medical_qualification").val();
        var medical_school        = $("#medical_school").val();
        var year_obtained         = $("#year_obtained").val();
        var country_obtained      = $("#country_obtained").val();
        var other_qualifications  = $("#other_qualifications").val();
        var numeric               = /^[0-9]*$/;
        var alpha                 = /^[A-Za-z]*$/;
        var alphaNumeric          = /^[0-9A-Za-z]*$/;

        if($.trim(medical_qualification) == '')
        {
            $("#medical_qualification").focus();
            $("#err_medical_qualification").show();
            $("#err_medical_qualification").html('Please enter primary medical qualification.');
            $("#err_medical_qualification").fadeOut(4000);
            return false;
        }
        else if($.trim(medical_school) == '')
        {
            $("#medical_school").focus();
            $("#err_medical_school").show();
            $("#err_medical_school").html('Please enter medical school name.');
            $("#err_medical_school").fadeOut(4000);
        }
        else if($.trim(year_obtained) == '')
        {
            $("#year_obtained").focus();
            $("#err_year_obtained").show();
            $("#err_year_obtained").html('This field is required');
            $("#err_year_obtained").fadeOut(4000);
            return false;
        }
        else if(!numeric.test(year_obtained))
        {
            $("#year_obtained").focus();
            $("#err_year_obtained").show();
            $("#err_year_obtained").html('Please enter valid year.');
            $("#err_year_obtained").fadeOut(4000);
            return false;
        }
        else if($.trim(year_obtained).length > 4)
        {
            $("#year_obtained").focus();
            $("#err_year_obtained").show();
            $("#err_year_obtained").html('Please enter valid year.');
            $("#err_year_obtained").fadeOut(4000);
            return false;
        }
        else if($.trim(year_obtained).length < 4)
        {
            $("#year_obtained").focus();
            $("#err_year_obtained").show();
            $("#err_year_obtained").html('Please enter valid year.');
            $("#err_year_obtained").fadeOut(4000);
            return false;
        }
        else if($.trim(country_obtained) == '')
        {
            $("#country_obtained").focus();
            $("#err_country_obtained").show();
            $("#err_country_obtained").html('Please enter country name.');
            $("#err_country_obtained").fadeOut(4000);
            return false;
        }
        else if(!alpha.test(country_obtained))
        {
            $("#country_obtained").focus();
            $("#err_country_obtained").show();
            $("#err_country_obtained").html('Please enter valid country name.');
            $("#err_country_obtained").fadeOut(4000);
            return false;
        }
        else
        {
            showProcessingOverlay();

            var old_medical_qualification = $("#old_medical_qualification").val();
            var old_medical_school = $("#old_medical_school").val();
            var old_year_obtained = $("#old_year_obtained").val();
            var old_country_obtained = $("#old_country_obtained").val();
            var flag = 0;

            if($.trim(medical_qualification) != $.trim(old_medical_qualification))
            {
                flag = 1;
            }

            if($.trim(medical_school) != $.trim(old_medical_school))
            {
                flag = 1;
            }

            if($.trim(country_obtained) != $.trim(old_country_obtained))
            {
                flag = 1;
            }

            if($.trim(year_obtained) != $.trim(old_year_obtained))
            {
                flag = 1;
            }


            // get User's card(s)
            api.cards.get(card_id).then(function (cards)
            {
                var _token                    = '<?php echo e(csrf_token()); ?>';
                var enc_medical_qualification = encrypt(api, medical_qualification, cards);
                var enc_medical_school        = encrypt(api, medical_school, cards);
                var enc_country_obtained      = encrypt(api, country_obtained, cards);
                var enc_other_qualifications  = encrypt(api, other_qualifications, cards);
                var enc_year_obtained         = encrypt(api, year_obtained, cards);
               
                $.ajax({
                    url  : "<?php echo e($module_url_path); ?>/medical_qualifications/update",
                    type : 'post',
                    data : {
                                _token                : _token,
                                medical_qualification : enc_medical_qualification,
                                medical_school        : enc_medical_school,
                                year_obtained         : enc_year_obtained,
                                country_obtained      : enc_country_obtained,
                                other_qualifications  : enc_other_qualifications,
                                is_update             : flag

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
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            })
            .catch(function(error)
            {
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>