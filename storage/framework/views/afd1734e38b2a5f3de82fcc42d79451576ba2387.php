<?php $__env->startSection('main_content'); ?>

<?php
    $illness = $description = $image = '';
    if( isset( $arr_consultation ) && !empty( $arr_consultation ) ):
        $illness     = isset($arr_consultation['illness'])     ? $arr_consultation['illness']     : '';
        $description = isset($arr_consultation['description']) ? $arr_consultation['description'] : '';
        $image       = isset($arr_consultation['image'])       ? $arr_consultation['image']       : '';
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper booking-step5">

            <div class="booking-title text-center">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a class="prev-arrow bg-img" href="<?php echo e($module_url_path.'/'.$session_consultation_id); ?>/payment">&nbsp;</a>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h4>Describe your Illness</h4>
                    </div>
                    <div class="col-xs-2 sm-2 col-md-2 col-lg-2">
                        <a class="next-arrow bg-img" href="javascript:void(0);" id="submit_page">&nbsp;</a>
                    </div>
                </div>
            </div>

            <div class="booking-content">

                <form method="post" id="reason_form" name="reason_form" action="<?php echo e(url('/')); ?>/patient/consultation/<?php echo e($session_consultation_id); ?>/reason/process">
                    <?php echo e(csrf_field()); ?>


                    <!-- Form Status Starts -->
                    <div class="alert alert-success" id="reason_form_success" style="display: none;">
                        <strong>Success!</strong> <span id="reason_form_success_msg"></span>
                    </div>

                    <div class="alert alert-danger" id="reason_form_error" style="display: none;">
                        <strong>Error!</strong> <span id="reason_form_error_msg"></span>
                    </div>
                    <!-- Form Status Ends -->

                    <div class="document-upload-block">
                        <?php
                            if(isset($image) && !empty($image) && File::exists($illness_image_base_path.'/'.$image)):
                                $illness_image = $illness_image_public_path.'/'.$image;
                                ?>
                                    <a id="dec_illness_image" data-name="illness_image" data-file="<?php echo e($image); ?>" data-path="<?php echo e($illness_image); ?>" href="" download>
                                        <p><span class="bg-img">&nbsp;</span>Download Uploaded Image</p>
                                    </a>
                            <?php
                            endif;
                        ?>
                        <input type="hidden" id="old_illness_image" name="old_illness_image" value="<?php echo e($image); ?>">

                        <p>Upload Image</p>
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
                                            <input type="file" class="file-input" id="file_illness_image" data-name="illness_image" />
                                        </div>
                                        <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                    </div>

                                </div>
                            </div>
                            <div class="error" id="err_illness_image"></div>
                        </div>
                    </div>
                    
                    <?php if(isset($arr_category) && sizeof($arr_category)>0): ?>
                        <div class="form-group reason-page-radio-btn">
                            <div class="radio-btns">

                                <?php foreach($arr_category as $key => $category): ?>
                                    <div class="radio-btn">
                                        <input type="radio" id="<?php echo e($key); ?>" name="illness" value="<?php echo e(isset( $category['id'] ) && !empty( $category['id'] ) ? $category['id'] : ''); ?>" />
                                        <label for="<?php echo e($key); ?>">
                                            <div class="ill-img"> 
                                                <?php $illness_category_image = $illness_category_default_img_path .'/illness_category.png'; ?>

                                                <?php if(isset($category['image']) && $category['image']!=''): ?>
                                                    <?php if(file_exists($illness_category_image_base_path.'/'.$category['image'])): ?>
                                                        <?php $illness_category_image = $illness_category_image_public_path.'/'.$category['image']; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <img src="<?php echo e($illness_category_image); ?>" /> 
                                            </div>
                                            <div class="illi-name"><?php echo e(isset( $category['name'] ) && !empty( $category['name'] ) ? decrypt_value( $category['name'] ) : ''); ?></div>
                                        </label>
                                    </div>
                                    <div class="error" id="err_illness"></div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <textarea rows="5" id="description" name="description" placeholder="Describe your illness*" maxlength="500"></textarea>
                        <div class="error" id="err_description"></div>
                    </div>

                    <button type="button" class="green-btn submit-btn" id="btn_submit_reason_form">Book Appointment</button>

                </form>
            </div>

            <div class="step-indicator">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="active"></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<!--fileupload start-->
<script src="<?php echo e(url('/')); ?>/public/front/js/bootstrap-fileupload.js"></script>
<link href="<?php echo e(url('/')); ?>/public/front/css/bootstrap-fileupload.css" rel=stylesheet type="text/css" />
<!--fileupload end-->

<script type="text/javascript">
    var form = $('#reason_form')[0];
    var formData = new FormData(form);

    $(document).ready(function() {
        $("#illness").val(decrypt("<?php echo e($illness); ?>"));
        $("#description").val(decrypt("<?php echo e($description); ?>"));

        $("#btn_submit_reason_form").click(function() {
            form_validation();
        });

        $("#submit_page").click(function() {
            form_validation();
        });

        $('#file_illness_image').on('change', function() {
            encrypt_file($(this).data('name'), formData);
        });

        if ($("#dec_illness_image").length) {
            var name = $("#dec_illness_image").data('name');
            var file = $("#dec_illness_image").data('file');
            var path = $("#dec_illness_image").data('path');

            decrypt_file(name, file, path);
        }

    });

    function form_validation() {
        var illness           = $("input[name='illness']:checked").val();
        var description       = $("#description").val();
        var old_illness_image = $("#old_illness_image").val();

        console.log(illness);

        if ($.trim(illness) == '') {
            $('#err_illness').show();
            $('#err_illness').html('Please select illness for the consultation.');
            $('#err_illness').fadeOut(4000);
            return false;
        } else if ($.trim(description) == '') {
            $('#err_description').show();
            $('#err_description').html('Please enter description for the consultation.');
            $('#err_description').fadeOut(4000);
            return false;
        } else {
            showProcessingOverlay();

            // get User's card(s)
            api.cards.get(card_id).then(function(cards) 
            {
                var _token = '<?php echo e(csrf_token()); ?>';

                formData.append('_token', _token);
                formData.append('illness', illness);
                formData.append('description', encrypt(api, description, cards));
                formData.append('old_illness_image', old_illness_image);

                $.ajax({
                    url         : "<?php echo e(url('/')); ?>/patient/consultation/<?php echo e($session_consultation_id); ?>/reason/process",
                    type        : 'post',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    cache       : false,
                    success     : function(res) {
                        hideProcessingOverlay();
                        if (res.status == 'success') {
                            // reset signup form
                            //$('#reason_form')[0].reset();

                            $("#reason_form_success_msg").html(res.message);
                            $("#reason_form_success").css('display', 'block').delay(4000).fadeOut();

                            setTimeout(function() {
                                window.location.href = res.redirectTo;
                            }, 4000);
                        } else {
                            $("#reason_form_error_msg").html(res.message);
                            $("#reason_form_error").css('display', 'block').delay(4000).fadeOut();
                        }
                    }
                });
            })
            .then(null, function(error) {
                hideProcessingOverlay();
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            })
            .catch(function(error) {
                hideProcessingOverlay();
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            });
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>