<?php $__env->startSection('main_content'); ?>
<!-- BEGIN Page Title -->

<script crossorigin="anonymous" src="<?php echo e(url('/')); ?>/public/virgil/virgil-sdk.min.js"></script>
<input type="hidden" id="VIRGIL_TOKEN" name="VIRGIL_TOKEN" value="<?php echo e(env('VIRGIL_TOKEN')); ?>" />

<div class="page-title">
  <div>

  </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="<?php echo e(url($admin_panel_slug.'/dashboard')); ?>">Dashboard</a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-medkit"></i>
      <a href="<?php echo e($module_url_path); ?>"><?php echo e(isset($module_title) ? $module_title : ''); ?></a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <a href="<?php echo e($module_url_path.'/upcoming'); ?>"><?php echo e(isset($previous_page) ? $previous_page : ''); ?></a>
    </span> 
    <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-eye"></i>
    </span>
    <li class="active"><?php echo e(isset($page_title) ? $page_title : ''); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php
    $consultation_id = isset($arr_consultation['consultation_id']) && !empty($arr_consultation['consultation_id']) ? $arr_consultation['consultation_id'] : '';
    $date            = isset($arr_consultation['date']) && !empty($arr_consultation['date']) ? date("d-M-Y",strtotime($arr_consultation['date'])) : '-';
    $time            = isset($arr_consultation['time']) && !empty($arr_consultation['time']) ? date("H:i A",strtotime($arr_consultation['time'])) : '-';
    $payment         = isset($arr_consultation['payment']) && !empty($arr_consultation['payment']) ? ucfirst($arr_consultation['payment']) : '-';
    $illness        = isset( $arr_consultation['category_name']['name'] ) && !empty( $arr_consultation['category_name']['name'] ) ? decrypt_value( $arr_consultation['category_name']['name'] ) : '';
    $description     = isset($arr_consultation['description']) && !empty($arr_consultation['description']) ? $arr_consultation['description'] : '';
    $illness_image   = isset($arr_consultation['image']) && !empty($arr_consultation['image']) ? $arr_consultation['image'] : '';
    $who_is_patient  = isset($arr_consultation['who_is_patient']) && !empty($arr_consultation['who_is_patient']) ? ucfirst($arr_consultation['who_is_patient']) : '';

    $illness_image_base_path   = isset($illness_image_base_path) && !empty($illness_image_base_path) ? $illness_image_base_path : '';
    $illness_image_public_path = isset($illness_image_public_path) && !empty($illness_image_public_path) ? $illness_image_public_path : '';

    // User & Patient Details
    $user_id         = isset($arr_consultation['user_id']) && !empty($arr_consultation['user_id']) ? $arr_consultation['user_id'] : '';
    $user_fname      = isset($arr_consultation['user_details']['first_name']) && !empty($arr_consultation['user_details']['first_name']) ? decrypt_value($arr_consultation['user_details']['first_name']) : '';
    $user_lname      = isset($arr_consultation['user_details']['last_name']) && !empty($arr_consultation['user_details']['last_name']) ? decrypt_value($arr_consultation['user_details']['last_name']) : '';
    $user_email      = isset($arr_consultation['user_details']['email']) && !empty($arr_consultation['user_details']['email']) ? $arr_consultation['user_details']['email'] : '-';
    $user_phone_code = isset($arr_consultation['user_details']['phone_code']) && !empty($arr_consultation['user_details']['phone_code']) ? '+'.$arr_consultation['user_details']['phone_code'] : '';
    $user_mobile_no  = isset($arr_consultation['user_details']['mobile_no']) && !empty($arr_consultation['user_details']['mobile_no']) ? $arr_consultation['user_details']['mobile_no'] : '-';
    $user_contact_no = isset($arr_consultation['user_details']['contact_no']) && !empty($arr_consultation['user_details']['contact_no']) ? $arr_consultation['user_details']['contact_no'] : '-';
    $user_gender     = isset($arr_consultation['user_details']['gender']) && !empty($arr_consultation['user_details']['gender']) ? $arr_consultation['user_details']['gender'] : '-';
    $user_address    = isset($arr_consultation['user_details']['address']) && !empty($arr_consultation['user_details']['address']) ? decrypt_value($arr_consultation['user_details']['address']) : '-';
    $user_dob        = isset($arr_consultation['user_details']['date_of_birth']) && !empty($arr_consultation['user_details']['date_of_birth']) ? date("d-M-Y",strtotime($arr_consultation['user_details']['date_of_birth'])) : '-';
    $dump_id         = isset($arr_consultation['user_details']['dump_id']) && !empty($arr_consultation['user_details']['dump_id']) ? $arr_consultation['user_details']['dump_id'] : '';
    $dump_session    = isset($arr_consultation['user_details']['dump_session']) && !empty($arr_consultation['user_details']['dump_session']) ? $arr_consultation['user_details']['dump_session'] : '';

    $patient_id = isset($arr_consultation['patient_id']) && !empty($arr_consultation['patient_id']) ? $arr_consultation['patient_id'] : '';
    if( $who_is_patient == 'Family' ):
        $arr_family = get_family_member($user_id, $patient_id);

        $patient_fname = isset($arr_family['first_name']) && !empty($arr_family['first_name']) ? decrypt_value($arr_family['first_name']) : '';
        $patient_lname = isset($arr_family['last_name']) && !empty($arr_family['last_name']) ? decrypt_value($arr_family['last_name']) : '';
    else:
        $patient_fname = isset($arr_consultation['user_details']['first_name']) && !empty($arr_consultation['user_details']['first_name']) ? decrypt_value($arr_consultation['user_details']['first_name']) : '';
        $patient_lname = isset($arr_consultation['user_details']['last_name']) && !empty($arr_consultation['user_details']['last_name']) ? decrypt_value($arr_consultation['user_details']['last_name']) : '';
    endif;

    // Doctor Details
    $doctor_prefix     = isset($arr_consultation['doctor_details']['doctor_prefix']['name']) && !empty($arr_consultation['doctor_details']['doctor_prefix']['name']) ? $arr_consultation['doctor_details']['doctor_prefix']['name'] : 'Dr';
    $doctor_fname      = isset($arr_consultation['doctor_details']['first_name']) && !empty($arr_consultation['doctor_details']['first_name']) ? decrypt_value($arr_consultation['doctor_details']['first_name']) : '';
    $doctor_lname      = isset($arr_consultation['doctor_details']['last_name']) && !empty($arr_consultation['doctor_details']['last_name']) ? decrypt_value($arr_consultation['doctor_details']['last_name']) : '';
    $doctor_email      = isset($arr_consultation['doctor_details']['email']) && !empty($arr_consultation['doctor_details']['email']) ? $arr_consultation['doctor_details']['email'] : '-';
    $doctor_phone_code = isset($arr_consultation['doctor_details']['phone_code']) && !empty($arr_consultation['doctor_details']['phone_code']) ? '+'.$arr_consultation['doctor_details']['phone_code'] : '';
    $doctor_mobile_no  = isset($arr_consultation['doctor_details']['mobile_no']) && !empty($arr_consultation['doctor_details']['mobile_no']) ? $arr_consultation['doctor_details']['mobile_no'] : '-';
    $doctor_contact_no = isset($arr_consultation['doctor_details']['contact_no']) && !empty($arr_consultation['doctor_details']['contact_no']) ? $arr_consultation['doctor_details']['contact_no'] : '-';
    $doctor_gender     = isset($arr_consultation['doctor_details']['gender']) && !empty($arr_consultation['doctor_details']['gender']) ? $arr_consultation['doctor_details']['gender'] : '-';
    $doctor_address    = isset($arr_consultation['doctor_details']['address']) && !empty($arr_consultation['doctor_details']['address']) ? decrypt_value($arr_consultation['doctor_details']['address']) : '-';
    $doctor_dob        = isset($arr_consultation['doctor_details']['date_of_birth']) && !empty($arr_consultation['doctor_details']['date_of_birth']) ? date("d-M-Y",strtotime($arr_consultation['doctor_details']['date_of_birth'])) : '-';
?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3>
                  <i class="fa fa-medkit"></i>
                  <?php echo e(isset($page_title) ? $page_title : ""); ?>

                </h3>
                <div class="box-tool">
                  <a data-action="collapse" href="#"></a>
                  <a data-action="close" href="#"></a>
                </div>
            </div>

            <div class="box-content">       
                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Consultation Details</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Consultation ID :</label>
                                        <div class="col-lg-8">
                                           <?php echo e($consultation_id); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">User Name :</label>
                                        <div class="col-lg-8">
                                             <?php echo e($user_fname.' '.$user_lname); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Patient Type :</label>
                                        <div class="col-lg-8">
                                             <?php echo e($who_is_patient); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Patient Name :</label>
                                        <div class="col-lg-8">
                                             <?php echo e($patient_fname.' '.$patient_lname); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Doctor Name :</label>
                                        <div class="col-lg-8">
                                            <?php echo e($doctor_prefix.'. '.$doctor_fname.' '.$doctor_lname); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Date :</label>
                                        <div class="col-lg-8">
                                            <?php echo e($date); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Time :</label>
                                        <div class="col-lg-8">
                                            <?php echo e($time); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Payment Status :</label>
                                        <div class="col-lg-8">
                                            <?php echo e($payment); ?>

                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Illness Description</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Illness :</label>
                                        <div class="col-lg-8" id="dec_illness"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Description :</label>
                                        <div class="col-lg-8" id="dec_description">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Image :</label>
                                        <div class="col-lg-8">
                                            <?php
                                                if(isset($illness_image) && !empty($illness_image) && File::exists($illness_image_base_path.'/'.$illness_image)):
                                                    $illness_file = $illness_image_public_path.'/'.$illness_image;
                                                    ?>
                                                        <a id="dec_illness_image" data-name="illness_image" data-file="<?php echo e($illness_image); ?>" data-path="<?php echo e($illness_file); ?>" href="" download>
                                                            <p><span class="bg-img">&nbsp;</span>Download </p>
                                                        </a>
                                                    <?php
                                                endif;
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">User Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Name :</label>
                                        <div class="col-lg-8"><?php echo e($user_fname.' '.$user_lname); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email :</label>
                                        <div class="col-lg-8"><?php echo e($user_email); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Date of Birth :</label>
                                        <div class="col-lg-8"><?php echo e($user_dob); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile No. :</label>
                                        <div class="col-lg-8"><?php echo e($user_phone_code.''.$user_mobile_no); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Contact No. :</label>
                                        <div class="col-lg-8"><?php echo e($user_contact_no); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Gender :</label>
                                        <div class="col-lg-8"><?php echo e($user_gender); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Address :</label>
                                        <div class="col-lg-8"><?php echo e($user_address); ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Doctor Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Name :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_prefix.'. '.$doctor_fname.' '.$doctor_lname); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_email); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Date of Birth :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_dob); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile No. :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_phone_code.''.$doctor_mobile_no); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Contact No. :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_contact_no); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Gender :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_gender); ?></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Address :</label>
                                        <div class="col-lg-8"><?php echo e($doctor_address); ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    


<!-- END Main Content -->
<script type="text/javascript">
    var VIRGIL_TOKEN = $('#VIRGIL_TOKEN').val();
    var api = virgil.API(VIRGIL_TOKEN);

    $(document).ready(function()
    {
        var illness     = '<?php echo e($illness); ?>';
        var description = '<?php echo e($description); ?>';
        
        $("#dec_illness").html( '<?php echo e($illness); ?>' );
        $("#dec_description").html( decrypt(description));

        if( $("#dec_illness_image").length )
        {
            var name = $("#dec_illness_image").data('name');
            var file = $("#dec_illness_image").data('file');
            var path = $("#dec_illness_image").data('path');

            decrypt_file(name, file, path);
        }
    });


    function decrypt(enctext)
    {
        var text = enctext;

        if( $.trim(enctext) != '' )
        {
            var userkey = "<?php echo e($dump_session); ?>";
            var key     = api.keys.import(userkey);
            var dectext = key.decrypt(enctext);
            text = dectext.toString();
        }
        return text;
    }

    function decrypt_file(name, file, path)
    {
        var xhr = new XMLHttpRequest();
        
        // this example with cross-domain issues.
        xhr.open( "GET", path, true );
        
        // Ask for the result as an ArrayBuffer.
        xhr.responseType = "blob";
        xhr.onload = function(e)
        {
            var userkey = "<?php echo e($dump_session); ?>";
            var key     = api.keys.import(userkey);

            // Obtain a blob: URL for the image data.
            var file      = this.response;
            var mime_type = file.type;

            var fileReader = new FileReader();
            fileReader.readAsArrayBuffer(file);
            fileReader.onload = function ()
            {
                var imageData    = fileReader.result;
                var fileAsBuffer = new Buffer(imageData);

                var decryptedFile = key.decrypt(fileAsBuffer);
                var blob          = new Blob([decryptedFile], { type: mime_type });

                var urlCreator = window.URL || window.webkitURL;
                var imageUrl   = urlCreator.createObjectURL( blob );
                imageUrl.name  = name;
                var img        = document.querySelector( "#dec_"+name );
                img.download   = file;
                img.href       = imageUrl;
            }
        };
        xhr.send();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>