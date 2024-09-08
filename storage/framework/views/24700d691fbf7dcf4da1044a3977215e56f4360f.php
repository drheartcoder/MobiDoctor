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
                    <h2>Document &amp; Verification</h2>

                    <form name="frm_document_verification" id="frm_document_verification" method="post" action="<?php echo e($module_url_path); ?>/document_verification/update" enctype="multipart/form-data">
                        <div class="prescription-section">
                            <div class="doc-note">Note : Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</div>
                            <br/>

                            <div class="document-upload-block">

                                <?php
                                    $driving_licence = isset($arr_doctor_details['driving_licence']) ? decrypt_value($arr_doctor_details['driving_licence']) : '';

                                    if(isset($driving_licence) && !empty($driving_licence) && File::exists($driving_base_path.'/'.$driving_licence)):
                                        $driving_file = $driving_public_path.'/'.$driving_licence;
                                        ?>
                                            <a id="dec_driving_licence" data-name="driving_licence" data-file="<?php echo e($driving_licence); ?>" data-path="<?php echo e($driving_file); ?>" href="" download>
                                                <p><span class="bg-img">&nbsp;</span>Download Uploaded Driving Licence or Passport</p>
                                            </a>
                                        <?php
                                    endif;
                                ?>
                                <input type="hidden" id="old_file_driving_licence" name="old_file_driving_licence" value="<?php echo e($driving_licence); ?>">
                                <p>Upload Driving Licence or Passport</p>
                                <div class="form-group">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group">
                                            
                                            <div class="form-inputs uneditable-input">
                                                <span class="fileupload-preview for-color"></span>
                                            </div>
                                            
                                            <div class="input-group-btn">
                                                <div class="btn btn-file">
                                                    <span class="fileupload-new">Choose File</span>
                                                    <span class="fileupload-exists change-btn">Change</span>
                                                    <input type="file" class="file-input" id="file_driving_licence" data-name="driving_licence" />
                                                </div>
                                                <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="error" id="err_driving_licence"></div>
                                </div>
                                <!-- <div class="doc-note">Note : Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</div> -->
                            </div>

                            <div class="document-upload-block">
                                
                                <?php
                                    $medical_registration = isset($arr_doctor_details['medical_registration']) ? decrypt_value($arr_doctor_details['medical_registration']) : '';

                                    if(isset($medical_registration) && !empty($medical_registration) && File::exists($medical_reg_base_path.'/'.$medical_registration)):
                                        $medical_file = $medical_reg_public_path.'/'.$medical_registration;
                                        ?>
                                            <a id="dec_medical_registration" data-name="medical_registration" data-file="<?php echo e($medical_registration); ?>" data-path="<?php echo e($medical_file); ?>" href="" download>
                                                <p><span class="bg-img">&nbsp;</span>Download Uploaded Medical Registration Certificate</p>
                                            </a>
                                        <?php
                                    endif;
                                ?>
                                <input type="hidden" id="old_file_medical_registration" name="old_file_medical_registration" value="<?php echo e($medical_registration); ?>">
                                <p>Upload Medical Registration Certificate</p>
                                <div class="form-group">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group">
                                            
                                            <div class="form-inputs uneditable-input">
                                                <span class="fileupload-preview for-color"></span>
                                            </div>
                                            
                                            <div class="input-group-btn">
                                                <div class="btn btn-file">
                                                    <span class="fileupload-new">Choose File</span>
                                                    <span class="fileupload-exists change-btn">Change</span>
                                                    <input type="file" class="file-input" id="file_medical_registration" data-name="medical_registration" />
                                                </div>
                                                <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="error" id="err_medical_registration"></div>
                                </div>
                                <!-- <div class="doc-note">Note : Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</div> -->
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Medicare Provider No.<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Medicare Provider No." id="medicare_provider_no" name="medicare_provider_no" maxlength="10" />
                                        <div class="error" id="err_medicare_provider_no"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Prescriber No.<i class="red">*</i></label>
                                        <input type="text" placeholder="Enter Prescriber No." id="prescriber_no" name="prescriber_no" />
                                        <div class="error" id="err_prescriber_no"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">AHPRA Registration No.<i class="red">*</i></label>
                                <input type="text" placeholder="Enter AHPRA Registration No." id="ahpra_registration_no" name="ahpra_registration_no" />
                                <div class="error" id="err_ahpra_registration_no"></div>
                            </div>

                            <input type="hidden" name="old_medicare_provider_no" value="old_medicare_provider_no">
                            <input type="hidden" name="old_prescriber_no" value="old_prescriber_no">
                            <input type="hidden" name="old_ahpra_registration_no" value="old_ahpra_registration_no">

                            <div class="save-btn">
                                <button type="button" id="btn_document_verification" class="green-trans-btn">Save</button>
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
<?php echo $__env->make('common.fileupload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var medicare_provider_no  = '<?php echo e(isset($arr_doctor_details['medicare_provider_no']) ? $arr_doctor_details['medicare_provider_no'] : ''); ?>';
        var prescriber_no         = '<?php echo e(isset($arr_doctor_details['prescriber_no']) ? $arr_doctor_details['prescriber_no'] : ''); ?>';
        var ahpra_registration_no = '<?php echo e(isset($arr_doctor_details['ahpra_registration_no']) ? $arr_doctor_details['ahpra_registration_no'] : ''); ?>';

        $("#medicare_provider_no").val( decrypt(medicare_provider_no) );
        $("#prescriber_no").val( decrypt(prescriber_no) );
        $("#ahpra_registration_no").val( decrypt(ahpra_registration_no) );

        $("#old_medicare_provider_no").val( decrypt(medicare_provider_no) );
        $("#old_prescriber_no").val( decrypt(prescriber_no) );
        $("#old_ahpra_registration_no").val( decrypt(ahpra_registration_no) );


        var formData = new FormData( $(this)[0] );

        $("#btn_document_verification").click(function()
        {
            var medicare_provider_no  = $("#medicare_provider_no").val();
            var prescriber_no         = $("#prescriber_no").val();
            var ahpra_registration_no = $("#ahpra_registration_no").val();

            if($.trim(medicare_provider_no) == '')
            {
                $("#medicare_provider_no").focus();
                $("#err_medicare_provider_no").show();
                $("#err_medicare_provider_no").html('Pleasev enter medicare provider number.');
                $("#err_medicare_provider_no").fadeOut(4000);
            }
            else if($.trim(prescriber_no) == '')
            {
                $("#prescriber_no").focus();
                $("#err_prescriber_no").show();
                $("#err_prescriber_no").html('Pleasev enter prescriber number.');
                $("#err_prescriber_no").fadeOut(4000);
            }
            else if($.trim(ahpra_registration_no) == '')
            {
                $("#ahpra_registration_no").focus();
                $("#err_ahpra_registration_no").show();
                $("#err_ahpra_registration_no").html('Pleasev enter AHPRA registration number.');
                $("#err_ahpra_registration_no").fadeOut(4000);
            }
            else
            {
                showProcessingOverlay();

                var old_medicare_provider_no  = $("#old_medicare_provider_no") .val();
                var old_prescriber_no         = $("#old_prescriber_no").val();
                var old_ahpra_registration_no = $("#old_ahpra_registration_no").val();

                var old_file_medical_registration = $("#old_file_medical_registration").val();
                var old_file_driving_licence      = $("#old_file_driving_licence").val();

                var flag = 0;

                if($.trim(old_medicare_provider_no) != $.trim(medicare_provider_no))
                {
                    flag = 1;
                }

                if($.trim(old_prescriber_no) != $.trim(prescriber_no))
                {
                    flag = 1;
                }

                if($.trim(old_ahpra_registration_no) != $.trim(ahpra_registration_no))
                {
                    flag = 1;
                }

                // get User's card(s)
                api.cards.get(card_id).then(function (cards)
                {
                    var _token                    = '<?php echo e(csrf_token()); ?>';
                    var enc_medicare_provider_no  = encrypt(api, medicare_provider_no, cards);
                    var enc_prescriber_no         = encrypt(api, prescriber_no, cards);
                    var enc_ahpra_registration_no = encrypt(api, ahpra_registration_no, cards);

                    formData.append('_token', _token);
                    formData.append('medicare_provider_no', enc_medicare_provider_no);
                    formData.append('prescriber_no', enc_prescriber_no);
                    formData.append('ahpra_registration_no', enc_ahpra_registration_no);
                    formData.append('is_update',flag);
                    formData.append('old_file_medical_registration',old_file_medical_registration);
                    formData.append('old_file_driving_licence',old_file_driving_licence);

                   
                    $.ajax({
                        url         : "<?php echo e($module_url_path); ?>/document_verification/update",
                        type        : 'post',
                        data        : formData,
                        processData : false,
                        contentType : false,
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


        $('#file_driving_licence').on('change', function() {
            encrypt_file( $(this).data('name'), formData );
        });

        $('#file_medical_registration').on('change', function() {
            encrypt_file( $(this).data('name'), formData );
        });


        if( $("#dec_driving_licence").length ){
            var name = $("#dec_driving_licence").data('name');
            var file = $("#dec_driving_licence").data('file');
            var path = $("#dec_driving_licence").data('path');

            decrypt_file(name, file, path);
        }

        if( $("#dec_medical_registration").length ){
            var name = $("#dec_medical_registration").data('name');
            var file = $("#dec_medical_registration").data('file');
            var path = $("#dec_medical_registration").data('path');

            decrypt_file(name, file, path);
        }
        

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>