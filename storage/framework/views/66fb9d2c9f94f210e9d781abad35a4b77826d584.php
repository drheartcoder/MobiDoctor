    

<?php $__env->startSection('main_content'); ?>
    
    <style>
        .error
        {
            color:red;
        }
    </style>

    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo e(url($admin_panel_slug.'/dashboard')); ?>">Dashboard</a></li>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
            <li class="active"><?php echo e(isset($page_title) ? $page_title : ""); ?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i><?php echo e(isset($page_title) ? $page_title : ""); ?> </h3>
                    <div class="box-tool"></div>
                </div>
                <div class="box-content">
                    <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                      <form method="post" action="<?php echo e(url($module_url_path.'/update/'.base64_encode($arr_data['id']))); ?>" class="form-horizontal" enctype="multipart/form-data" id="validation-form">
                      <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Profile Image</label>
                            <div class="col-sm-9 col-lg-4 controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input type="hidden" value="<?php echo e($profile_image_public_img_path.'default-profile.png'); ?>" id="default_image">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        <?php if(isset($arr_data['profile_pic']) && !empty($arr_data['profile_pic']) && $arr_data['profile_pic'] != null && file_exists($profile_image_base_img_path.$arr_data['profile_pic'] )): ?>                    
                                        <img src="<?php echo e($profile_image_public_img_path.$arr_data['profile_pic']); ?>" id="preview" >
                                        <?php else: ?>
                                        <img src="<?php echo e($profile_image_public_img_path.'default-profile.png'); ?>" id="preview" >                    
                                        <?php endif; ?>
                                    </div>
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file" style="height:32px;">
                                            <span class="fileupload-new">Change</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file"  data-validation-allowing="jpg, jpeg, png" class="file-input news-image validate-image" name="image" id="image"  /><br>
                                            <input type="hidden" class="file-input " name="oldimage" id="oldimage" value="<?php echo e($arr_data['profile_pic']); ?>"/>
                                        </span>
                                    </div>
                                    <i class="red"> 
                                        <span class="label label-important">NOTE!</span>
                                        <i class="red"> Allowed only jpg | jpeg | png <br/> 
                                            Please upload image with Height and Width greater than or equal to 250 X 250 for best result. </i>
                                            <input type="hidden" id="invalid_size" value="">
                                            <input type="hidden" id="invalid_ext" value="">
                                            <span for="cat_img" id="err_cat_image" class='help-block'><?php echo e($errors->first('image')); ?></span> 
                                        </i>
                                        <div id="file-upload-error" class="error"></div>
                                        <span for="image" id="err-image" class="help-block"><?php echo e($errors->first('image')); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                        </div>
                        
                        <input type="hidden" class="form-control" name="prev_image_url" id="prev_image_url" value="<?php echo e($profile_image_public_img_path.$arr_data['profile_pic']); ?>" />
                        <input type="hidden" class="form-control" name="old_profile_image" value="<?php echo e(isset($arr_data['profile_pic']) ? $arr_data['profile_pic'] : ''); ?>" />

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">First Name<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                            <input type="text" name="first_name" id="first_name" value="<?php echo e(isset($arr_data['user_details']['first_name']) ? decrypt_value($arr_data['user_details']['first_name']) : ''); ?>" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="First Name">   
                            <span class='help-block'><?php echo e($errors->first('first_name')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Last Name<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                <input type="text" name="last_name" id="last_name" value="<?php echo e(isset($arr_data['user_details']['last_name']) ?decrypt_value($arr_data['user_details']['last_name']): ''); ?>" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Last Name">   
                                <span class='help-block'><?php echo e($errors->first('last_name')); ?></span>
                            </div>
                        </div>
                        <?php 
                            $admin_email = "";
                            $user = Sentinel::check();
                            if($user)
                            {
                                $admin_email = $user->email;
                            }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Email<i class="red">*</i></label>
                            <div class="col-sm-9 col-lg-4 controls">
                             <input type="text" name="email" id="email" value="<?php echo e(isset($admin_email) ? $admin_email : ''); ?>" class="form-control" data-rule-required="true" data-rule-email="true" data-rule-maxlength="255" placeholder="Email" readonly=""> 
                             <span class='help-block'><?php echo e($errors->first('email')); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Contact Email<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                  <input type="text" class="form-control" name="contact_email" id="contact_email" value="<?php echo e(isset($arr_data['contact_email']) ? $arr_data['contact_email'] : ''); ?>" data-rule-required="true" data-rule-email="true"  />
                                <span class='error'><?php echo e($errors->first('contact_email')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Contact Number<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                 
                                  <input type="text" class="form-control" name="contact_no" id="contact_no" data-no-type='contact' data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-msg-minlength="Contact no should be atleast 6 digits" data-msg-maxlength="Contact no should not be more than 16 digits"  value="<?php echo e(isset($arr_data['contact_no']) ? $arr_data['contact_no'] : ''); ?>"/>
                                <span class='error err'><?php echo e($errors->first('contact_no')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Mobile Number<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                 
                                  <input type="text" class="form-control" name="mobile_no" data-no-type='mobile' id="mobile_no" data-rule-required="true" data-rule-maxlength="16" data-msg-minlength="Mobile no should be atleast 6 digits" data-msg-maxlength="Mobile no should not be more than 16 digits" data-rule-minlength="6" value="<?php echo e(isset($arr_data['mobile_no']) ? $arr_data['mobile_no'] : ''); ?>"/>
                                <span class='error err'><?php echo e($errors->first('mobile_no')); ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Fax</label>
                            <div class="col-sm-9 col-lg-4 controls">
                                  <input type="text" class="form-control" name="fax" id="fax" data-rule-number="true" data-rule-maxlength="16" data-msg-minlength="Fax no should be atleast 6 digits" data-msg-maxlength="Fax no should not be more than 16 digits" data-rule-minlength="6" value="<?php echo e(isset($arr_data['fax']) ? $arr_data['fax'] : ''); ?>"/>
                                <span class='error'><?php echo e($errors->first('fax')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Address<span class="red">*</span></label>
                            <div class="col-sm-9 col-lg-4 controls">

                                <textarea class="form-control" name="address" data-rule-required="true"><?php echo e(isset($arr_data['address']) ? $arr_data['address'] : ''); ?></textarea>
                                <span class='error'><?php echo e($errors->first('address')); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                               <input  type="submit" name="btn_update" id="btn_update" class="btn btn-success" value="Update">
                               <button type="submit" class="btn btn-success" id="btn_send_otp_spinner" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button>


                            </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    
    <!-- END Main Content --> 


<?php $user = Sentinel::check();?>
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
<input type="hidden" name="email" id="email" value="<?php echo e($user->email); ?>">

<script>
    $(document).ready(function(){
      $('#mobile_no,#contact_no,#fax').keydown(function(){
        if (this.value.match(/[^0-9+]/g)) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        }
      });
      $('#first_name,#last_name').keyup(function() {
          if (this.value.match(/[^a-zA-Z]/g)) {
              this.value = this.value.replace(/[^a-zA-Z]/g, '');
          }
      });
   });
</script>
<script type="text/javascript">
  $(document).on("change",".validate-image", function()
    {            
        var file=this.files;
        validateImage(this.files, 250,250);
    });
</script>
<script>
    $(document).ready(function(){
        $('#contact_no, #mobile_no').blur(function(){
            var a = $(this).val();
            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
             if (filter.test(a)) {
                $(this).closest('div').find('.err').html('');
                return true;
             }
            else 
            {
                if($(this).val() != '' && $(this).val().length > 5)
                {
                    var no_type = $(this).attr('data-no-type');
                    $(this).closest('div').find('.err').html('Invalid '+no_type+' Number');
                    $(".close").click();
                    return false;    
                }
                else
                {
                    $(this).closest('div').find('.err').html('');
                }
            }

       });
    });
    $(document).ready(function(){    
        $("#validation-form").validate({
          rules: {
            first_name: { lettersonly: true },
            last_name: { lettersonly: true }
          }
        });    

    });

    

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>