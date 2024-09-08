<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="white-wrapper prescription-wrapper">
                    <h2><?php echo e(isset($page_title) ? $page_title : ''); ?></h2>
                    <form name="frm_add_medication" id="frm_add_medication" method="post" action="<?php echo e($module_url_path); ?>/medication/store" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="form-group">
                                <label class="form-label">Name of the Medications<i class="red">*</i></label>
                                <input type="text" name="name" id="name" maxlength="50" placeholder="Enter Name of the Medications"/>
                                <div class="error" id="err_name"></div>
                            </div>

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
                                                <input type="file" class="file-input" id="file_medication" data-name="medication" />
                                            </div>
                                            <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="error" id="err_file_medication"></div>
                            </div>
                            <div class="doc-note">Note : Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                       <label class="form-label">Date Started<i class="red">*</i></label>
                                       <div class="date-input relative-block">
                                           <input class="date-input" name="date" id="datepicker" type="text" placeholder="Enter Date Started"/>
                                           <div class="error" id="err_date"></div>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Frequency<i class="red">*</i></label>
                                        <input type="text" id="frequency" name="frequency" placeholder="Enter Frequency" maxlength="2" />
                                        <div class="error" id="err_frequency"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Use</label>
                                <input type="text" id="medication_use" name="medication_use" maxlength="250" placeholder="Enter Use"/>
                            </div>
                            <div class="save-btn">
                                <button type="button" id="btn_add_medication" class="green-trans-btn">Save</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('common.datepicker', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.fileupload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
$(document).ready(function(){
    $("#datepicker").datepicker({
        todayHighlight: true,
        autoclose: true
    });

    var formData = new FormData( $(this)[0] );

    $("#btn_add_medication").click(function(){

        var name  = $("#name").val();
        var date  = $("#datepicker").val();
        var frequency  = $("#frequency").val();
        var medication_use  = $("#medication_use").val();
        var file_medication = $("#file_medication").val();

        var numeric      = /^[0-9]*$/;

        if($.trim(name)=='')
        {
            $("#name").focus();
            $("#err_name").show();
            $("#err_name").html('Please enter medication name.');
            $("#err_name").fadeOut(4000);
            return false;
        }
        else if($.trim(file_medication)=='')
        {
            $("#file_medication").focus();
            $("#err_file_medication").show();
            $("#err_file_medication").html('Please upload file.');
            $("#err_file_medication").fadeOut(4000);
            return false;
        }
        else if($.trim(date)=='')
        {
            $("#date").focus();
            $("#err_date").show();
            $("#err_date").html('Select start date.');
            $("#err_date").fadeOut(4000);
            return false;
        }
        else if($.trim(frequency)=='')
        {
            $("#frequency").focus();
            $("#err_frequency").show();
            $("#err_frequency").html('Please enter frequency.');
            $("#err_name").fadeOut(4000);
            return false;
        }
        else if(!numeric.test(frequency))
        {
            $('#frequency').focus();
            $('#err_frequency').show();
            $('#err_frequency').html('Please enter valid frequency.');
            $('#err_frequency').fadeOut(4000);
            return false;
        }
        else
        {
            showProcessingOverlay();
             // get User's card(s)
            api.cards.get(card_id).then(function (cards)
            {
                var _token             = '<?php echo e(csrf_token()); ?>';
                var enc_name           = encrypt(api, name, cards);
                var enc_frequency      = encrypt(api, frequency, cards);
                var enc_medication_use = encrypt(api, medication_use, cards);

                formData.append('_token', _token);
                formData.append('name', enc_name);
                formData.append('date', date);
                formData.append('frequency', enc_frequency);
                formData.append('medication_use',enc_medication_use);

                $.ajax({
                    url         : "<?php echo e($module_url_path); ?>/medication/store",
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

    $('#file_medication').on('change', function() {
        encrypt_file( $(this).data('name'), formData );
    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>