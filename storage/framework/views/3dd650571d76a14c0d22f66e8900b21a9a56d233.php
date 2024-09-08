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
      <i class="fa fa-user"></i>
      <a href="<?php echo e($module_url_path); ?>"><?php echo e(isset($module_title) ? $module_title : ''); ?></a>
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
    $profile_data = calculate_profile( $arr_doctor_details['id'], 'doctor');
    
    $disabled = 'disabled';
    if($profile_data > '81'):
        $disabled = '';
    endif;
?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3>
                  <i class="fa fa-text-width"></i>
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
                            <div class="panel-heading font-bold">Doctor About Me</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Profile Image :</label>
                                        <div class="col-lg-8">
                                            <?php $profile_img_src = $default_img_path .'/profile.jpeg'; ?>
                                            <?php if(isset($arr_doctor_details['profile_image']) && $arr_doctor_details['profile_image'] != ''): ?>
                                                <?php if(file_exists($profile_image_base_path.'/'.$arr_doctor_details['profile_image'])): ?>
                                                    <?php $profile_img_src = $profile_image_public_path.'/'.$arr_doctor_details['profile_image']; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                    
                                           <img src="<?php echo e($profile_img_src); ?>" class="img-responsive img-preview" style="width: 100px;height: 100px" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Profile Completed :</label>
                                        <div class="col-lg-8">
                                          <?php echo e($profile_data); ?> %
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Name :</label>
                                        <div class="col-lg-8">
                                           <?php echo e(isset($arr_doctor_details['doctor_prefix']['name'])?$arr_doctor_details['doctor_prefix']['name']:''); ?> <?php echo e(isset($arr_doctor_details['first_name']) ? decrypt_value($arr_doctor_details['first_name']) : ''); ?> <?php echo e(isset($arr_doctor_details['last_name']) ? decrypt_value($arr_doctor_details['last_name']) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email :</label>
                                        <div class="col-lg-8">
                                             <?php echo e(isset($arr_doctor_details['email']) ? $arr_doctor_details['email'] : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Date of Birth :</label>
                                        <div class="col-lg-8">
                                             <?php echo e(isset($arr_doctor_details['date_of_birth']) ? date('d M Y',strtotime($arr_doctor_details['date_of_birth'])) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile No :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['phone_code']) ? '+'.$arr_doctor_details['phone_code'] : ''); ?><?php echo e(isset($arr_doctor_details['mobile_no']) ? $arr_doctor_details['mobile_no'] : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Contact No :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['contact_no']) ? $arr_doctor_details['contact_no'] : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Gender :</label>
                                        <div class="col-lg-8">
                                             <?php echo e(isset($arr_doctor_details['gender']) ? $arr_doctor_details['gender'] : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Address :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['address']) ? decrypt_value($arr_doctor_details['address']) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">City :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['city']) ? decrypt_value($arr_doctor_details['city']) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Country :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['country']) ? decrypt_value($arr_doctor_details['country']) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Timezone :</label>
                                        <div class="col-lg-8">
                                            <?php if(isset($arr_doctor_details['timezone_details']['location_name']) && $arr_doctor_details['timezone_details']['location_name']!=''): ?>
                                                <?php echo e($arr_doctor_details['timezone_details']['location_name']); ?>  (<?php echo e(isset($arr_doctor_details['timezone_details']['utc_offset']) ? $arr_doctor_details['timezone_details']['utc_offset'] : ''); ?>)
                                            <?php else: ?>
                                            
                                            <?php endif; ?> 
                                          
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Social Login :</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['social_login']) ? ucfirst($arr_doctor_details['social_login']) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Status:</label>
                                        <div class="col-lg-8">
                                            <?php if(isset($arr_doctor_details['status']) && $arr_doctor_details['status'] != '' && $arr_doctor_details['status'] == '1'): ?>
                                                Active
                                            <?php else: ?>
                                                Inactive
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email Verification:</label>
                                        <div class="col-lg-8">
                                            <?php if(isset($arr_doctor_details['is_email_verified']) && $arr_doctor_details['is_email_verified'] != '' && $arr_doctor_details['is_email_verified'] == '1'): ?>
                                                Verified
                                            <?php else: ?>
                                                Unverified
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile Verification:</label>
                                        <div class="col-lg-8">
                                            <?php if(isset($arr_doctor_details['is_mobile_verified']) && $arr_doctor_details['is_mobile_verified'] != '' && $arr_doctor_details['is_mobile_verified'] == '1'): ?>
                                                Verified
                                            <?php else: ?>
                                                Unverified
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Last login:</label>
                                        <div class="col-lg-8">
                                            <?php echo e(isset($arr_doctor_details['last_login']) ? date('d M Y h:i A', strtotime($arr_doctor_details['last_login'])) : '-'); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Registered On :</label>
                                        <div class="col-lg-8">
                                             <?php echo e(isset($arr_doctor_details['created_at']) ? date('d M Y' , strtotime($arr_doctor_details['created_at'])) : ''); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Document Verification:</label>
                                        <div class="col-lg-8">
                                           <?php if( isset($arr_doctor_details['doctor_data']['admin_verified']) && $arr_doctor_details['doctor_data']['admin_verified'] != '' && $arr_doctor_details['doctor_data']['admin_verified'] == '1' ): ?>
                                                <a onclick="confirm_action(this,event,'Do you really want to unverified this doctor ?')" href="<?php echo e($module_url_path.'/admin_unverified/'.base64_encode($arr_doctor_details['id'])); ?>" class="btn btn-success">Verified</a>
                                            <?php else: ?>
                                                <a onclick="confirm_action(this,event,'Do you really want to verified this doctor ?')" href="<?php echo e($module_url_path.'/admin_verified/'.base64_encode($arr_doctor_details['id'])); ?>" class="btn btn-danger" <?php echo e($disabled); ?> >Unverified</a>
                                             <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Medical Practice</div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Clinic Name :</label>
                                        <div class="col-lg-8" id="clinic_name"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Experience :</label>
                                        <div class="col-lg-8">
                                            <?php if(isset($arr_doctor_details['doctor_data']['experience']) && $arr_doctor_details['doctor_data']['experience']!=''): ?>

                                                <?php echo e($arr_doctor_details['doctor_data']['experience']); ?> Year(s)
                                            <?php else: ?>


                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Mobile No :</label>
                                        <div class="col-lg-8" id="clinic_mobile_no"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Contact No :</label>
                                        <div class="col-lg-8" id="clinic_contact_no"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Email :</label>
                                        <div class="col-lg-8" id="clinic_email"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Language :</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                $selected_language = '';
                                                $arr_selected_language = [];
                                                $arr_selected_language = isset($arr_doctor_details['doctor_data']['language']) ? json_decode($arr_doctor_details['doctor_data']['language']) :[];

                                                if(isset($arr_language) && sizeof($arr_language)>0)
                                                {
                                                    $temp_arr_language = [];
                                                    foreach ($arr_language as $key => $language) 
                                                    {
                                                        if(in_array($language['id'],$arr_selected_language))
                                                        {
                                                            $language_name = '';
                                                            $language_name = $language['language'];
                                                            array_push($temp_arr_language, $language_name);
                                                        }
                                                    }

                                                    $selected_language = implode(",",$temp_arr_language);
                                                }
                                            ?>
                                            <?php echo e($selected_language); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Address :</label>
                                        <div class="col-lg-8" id="clinic_address"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Medical Qualifications</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Primary Medical Qualification :</label>
                                        <div class="col-lg-8" id="medical_qualification"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Medical School :</label>
                                        <div class="col-lg-8" id="medical_school"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Year Obtained :</label>
                                        <div class="col-lg-8" id="year_obtained"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Country Obtained :</label>
                                        <div class="col-lg-8" id="country_obtained"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Other Related Qualifications :</label>
                                        <div class="col-lg-8" id="other_qualifications"></div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading font-bold">Bank Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Bank Name :</label>
                                        <div class="col-lg-8" id="bank_name"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Account Name :</label>
                                        <div class="col-lg-8" id="bank_account_name"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Account No :</label>
                                        <div class="col-lg-8" id="bank_account_no"></div>
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
                            <div class="panel-heading font-bold">Document & Verification  Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Medicare Provider No. :</label>
                                        <div class="col-lg-8" id="medicare_provider_no"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Prescriber No. :</label>
                                        <div class="col-lg-8" id="prescriber_no"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">AHPRA Registration No. :</label>
                                        <div class="col-lg-8" id="ahpra_registration_no"></div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label"> Driving Licence or Passport :</label>
                                        <div class="col-lg-8">
                                            <?php
                                                $driving_licence = isset($arr_doctor_details['doctor_data']['driving_licence']) ? decrypt_value($arr_doctor_details['doctor_data']['driving_licence']) : '';

                                                if(isset($driving_licence) && !empty($driving_licence) && File::exists($driving_base_path.'/'.$driving_licence)):
                                                    $driving_file = $driving_public_path.'/'.$driving_licence;
                                                    ?>
                                                        <a id="dec_driving_licence" data-name="driving_licence" data-file="<?php echo e($driving_licence); ?>" data-path="<?php echo e($driving_file); ?>" href="" download>
                                                            <p><span class="bg-img">&nbsp;</span>Download</p>
                                                        </a>
                                                    <?php
                                                endif;
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="col-lg-4 control-label">Medical Registration Certificate :</label>
                                        <div class="col-lg-8" id="medical_registration">
                                            <?php
                                                $medical_registration = isset($arr_doctor_details['doctor_data']['medical_registration']) ? decrypt_value($arr_doctor_details['doctor_data']['medical_registration']) : '';

                                                if(isset($medical_registration) && !empty($medical_registration) && File::exists($medical_reg_base_path.'/'.$medical_registration)):
                                                    $medical_file = $medical_reg_public_path.'/'.$medical_registration;
                                                    ?>
                                                        <a id="dec_medical_registration" data-name="medical_registration" data-file="<?php echo e($medical_registration); ?>" data-path="<?php echo e($medical_file); ?>" href="" download>
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

                         <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <a href="<?php echo e($module_url_path); ?>" class="btn btn-cancel">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    


<!-- END Main Content -->
<script type="text/javascript">

var VIRGIL_TOKEN = $('#VIRGIL_TOKEN').val();
var api = virgil.API(VIRGIL_TOKEN);

$(document).ready(function(){

    var clinic_name = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_name']) ? $arr_doctor_details['doctor_data']['clinic_name'] : ''); ?>';
    var clinic_address     = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_address']) ? $arr_doctor_details['doctor_data']['clinic_address'] : ''); ?>';
    var clinic_contact_no  = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_contact_no']) ? $arr_doctor_details['doctor_data']['clinic_contact_no'] : ''); ?>';
    var clinic_mobile_no   = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_mobile_no']) ? $arr_doctor_details['doctor_data']['clinic_mobile_no'] : ''); ?>';
    var clinic_email       = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_email']) ? $arr_doctor_details['doctor_data']['clinic_email'] : ''); ?>';
    var clinic_phone_code  = '<?php echo e(isset($arr_doctor_details['doctor_data']['clinic_phone_code']) ? $arr_doctor_details['doctor_data']['clinic_phone_code'] : ''); ?>';
    
    $("#clinic_name").html( decrypt(clinic_name));
    $("#clinic_address").html( decrypt(clinic_address));
    $("#clinic_email").html( decrypt(clinic_email));
    if(clinic_mobile_no !='')
    {
        $("#clinic_mobile_no").html('+'+clinic_phone_code+' '+decrypt(clinic_mobile_no));
    }
    $("#clinic_contact_no").html( decrypt(clinic_contact_no));

    var bank_name         = '<?php echo e(isset($arr_doctor_details['doctor_data']['bank_name'])?$arr_doctor_details['doctor_data']['bank_name']:''); ?>';
    var bank_account_name = '<?php echo e(isset($arr_doctor_details['doctor_data']['bank_account_name'])?$arr_doctor_details['doctor_data']['bank_account_name']:''); ?>';
    var bank_account_no   = '<?php echo e(isset($arr_doctor_details['doctor_data']['bank_account_no'])?$arr_doctor_details['doctor_data']['bank_account_no']:''); ?>';
    
    $("#bank_name").html( decrypt(bank_name) );
    $("#bank_account_name").html( decrypt(bank_account_name) );
    $("#bank_account_no").html( decrypt(bank_account_no) );

    var medical_qualification = '<?php echo e(isset($arr_doctor_details['doctor_data']['medical_qualification']) ? $arr_doctor_details['doctor_data']['medical_qualification'] : ''); ?>';
    var medical_school        = '<?php echo e(isset($arr_doctor_details['doctor_data']['medical_school'])        ? $arr_doctor_details['doctor_data']['medical_school']        : ''); ?>';
    var year_obtained         = '<?php echo e(isset($arr_doctor_details['doctor_data']['year_obtained'])         ? $arr_doctor_details['doctor_data']['year_obtained']         : ''); ?>';
    var country_obtained      = '<?php echo e(isset($arr_doctor_details['doctor_data']['country_obtained'])      ? $arr_doctor_details['doctor_data']['country_obtained']      : ''); ?>';
    var other_qualifications  = '<?php echo e(isset($arr_doctor_details['doctor_data']['other_qualifications'])  ? $arr_doctor_details['doctor_data']['other_qualifications']  : ''); ?>';

    $("#medical_qualification").html( decrypt(medical_qualification) );
    $("#medical_school").html( decrypt(medical_school) );
    $("#year_obtained").html( decrypt(year_obtained) );
    $("#country_obtained").html( decrypt(country_obtained) );
    $("#other_qualifications").html( decrypt(other_qualifications) );

    var medicare_provider_no  = '<?php echo e(isset($arr_doctor_details['doctor_data']['medicare_provider_no']) ? $arr_doctor_details['doctor_data']['medicare_provider_no'] : ''); ?>';
    var prescriber_no         = '<?php echo e(isset($arr_doctor_details['doctor_data']['prescriber_no']) ? $arr_doctor_details['doctor_data']['prescriber_no'] : ''); ?>';
    var ahpra_registration_no = '<?php echo e(isset($arr_doctor_details['doctor_data']['ahpra_registration_no']) ? $arr_doctor_details['doctor_data']['ahpra_registration_no'] : ''); ?>';

    var medical_registration = '<?php echo e(isset($arr_doctor_details['doctor_data']['medical_registration']) ? $arr_doctor_details['doctor_data']['medical_registration'] : ''); ?>';

    $("#medicare_provider_no").html( decrypt(medicare_provider_no) );
    $("#prescriber_no").html( decrypt(prescriber_no) );
    $("#ahpra_registration_no").html( decrypt(ahpra_registration_no) );
    //$("#medical_registration").html(medical_registration);


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



function decrypt(enctext)
{
    var text = enctext;

    if( $.trim(enctext) != '' )
    {
        var userkey = "<?php echo e(isset($arr_doctor_details['dump_session']) ? $arr_doctor_details['dump_session'] : ''); ?>";
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
        var userkey = "<?php echo e(isset($arr_doctor_details['dump_session']) ? $arr_doctor_details['dump_session'] : ''); ?>";
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
            //blob.name = name;

            var urlCreator = window.URL || window.webkitURL;
            var imageUrl   = urlCreator.createObjectURL( blob );
            imageUrl.name = name;
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