    
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
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo e(url($admin_panel_slug.'/dashboard')); ?>">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span> 
            <li class="active">  <?php echo e(isset($page_title) ? $page_title : ""); ?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-blue">
                
                <div class="box-title">
                    <h3><i class="fa fa-file"></i><?php echo e(isset($page_title) ? $page_title : ""); ?> </h3>
                    <div class="box-tool">
                    </div>
                </div>

                <div class="box-content">
                    <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <form method="post" action="<?php echo e(url($module_url_path.'/setting/process')); ?>" class="form-horizontal" id="validation-form">
                    <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Time Interval  (Mins) <font color="red">*</font></label>
                            <div class="col-sm-9 col-lg-4 controls">                              
                                <input type="text" class="form-control" name="time_interval" id="time_interval" value="<?php echo e(isset($arr_setting['time_interval']) ? $arr_setting['time_interval'] : ''); ?>" data-rule-required="true" data-rule-maxlength="2" maxlength="2" />
                                <span class='help-block' id="err_time_interval"><?php echo e($errors->first('time_interval')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Reschedule Option <font color="red">*</font></label>
                            <div class="col-sm-9 col-lg-4 controls">
                                <?php $reschedule = isset($arr_setting['reschedule']) ? $arr_setting['reschedule'] : ''; ?>
                                <label class="radio-inline">
                                    <input type="radio" name="reschedule" value="0" <?php if( $reschedule == 0 ): ?> checked <?php endif; ?> data-rule-required="true" > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="reschedule" value="1" <?php if( $reschedule == 1 ): ?> checked <?php endif; ?> data-rule-required="true" > Deactive
                                </label>
                                <span class='help-block' id="err_reschedule"><?php echo e($errors->first('reschedule')); ?></span>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" name="btn_update" id="btn_update" class="btn btn-success" value="Update">
                            </div>
                        </div>
                    
                    </form>
                </div>

            </div>
        </div>

    <!-- END Main Content --> 
    <script type="text/javascript">
        $(document).ready(function(){    
            $("#validation-form").validate({
                rules: {
                    time_interval: { number : true },
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>