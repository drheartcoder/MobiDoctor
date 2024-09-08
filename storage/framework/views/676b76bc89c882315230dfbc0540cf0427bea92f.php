    
<?php $__env->startSection('main_content'); ?>

    <!-- BEGIN Page Title -->
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
            </span> 
            <li class="active">  <?php echo e(isset($page_title)?$page_title:""); ?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i><?php echo e(isset($page_title)?$page_title:""); ?> </h3>
                    <div class="box-tool">
                    </div>
                </div>
                <div class="box-content">
                    <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                      <form method="post" action="<?php echo e(url($module_url_path.'/update')); ?>" class="form-horizontal" enctype="multipart/form-data" id="validation-form">

                      <?php echo e(csrf_field()); ?>      
                       <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Facebook <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                              
                                <input type="text" class="form-control" name="facebook" id="facebook"  value="<?php echo e(isset($arr_data['facebook_link'])?$arr_data['facebook_link']:''); ?>"/>
                                <span class='help-block' id="err_faecbook"><?php echo e($errors->first('facebook')); ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Twitter <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="twitter" id="twitter"  value="<?php echo e(isset($arr_data['twitter_link'])?$arr_data['twitter_link']:''); ?>"/>
                                <span class='help-block' id="err_twitter"><?php echo e($errors->first('twitter')); ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Linkedin <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="linkedin" id="linkedin"  value="<?php echo e(isset($arr_data['linkedin_link'])?$arr_data['linkedin_link']:''); ?>"/>
                                <span class='help-block' id="err_linkedin"><?php echo e($errors->first('linkedin')); ?></span>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Google plus <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="gplus" id="gplus"  value="<?php echo e(isset($arr_data['google_link'])?$arr_data['google_link']:''); ?>"/>
                                <span class='help-block' id="err_google"><?php echo e($errors->first('gplus')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Pinterest <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="pinterest" id="pinterest"  value="<?php echo e(isset($arr_data['pinterest_link'])?$arr_data['pinterest_link']:''); ?>"/>
                                <span class='help-block' id="err_pinterest"><?php echo e($errors->first('pinterest')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Instagram <!-- <font color="red">*</font> --></label>
                            <div class="col-sm-9 col-lg-4 controls">                                 
                                  <input type="text" class="form-control" name="instagram" id="instagram"  value="<?php echo e(isset($arr_data['instagram_link'])?$arr_data['instagram_link']:''); ?>"/>
                                <span class='help-block' id="err_instagram"><?php echo e($errors->first('instagram')); ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                              <input type="submit" name="btn_update" id="btn_update_link" class="btn btn-success" value="Update">
                            </div>
                       </div>
                    
                    </form>
                </div>
            </div>
        </div>
    
    <!-- END Main Content --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>