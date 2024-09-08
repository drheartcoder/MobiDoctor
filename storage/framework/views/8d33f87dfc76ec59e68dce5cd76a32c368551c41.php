<?php $__env->startSection('main_content'); ?>

<link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">
<style type="text/css">
  .table>tbody>tr>td:last-child{white-space: nowrap;}
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
                  <i class="fa fa-list"></i>
            </span>
            <li class="active"><?php echo e(isset($page_title) ? $page_title : ''); ?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-medkit"></i><?php echo e(isset($page_title) ? $page_title : ""); ?></h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
        <div class="box-content">
            
            <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <form method="post" class="form-horizontal" id="frm_manage" action="<?php echo e(url($module_url_path.'/multi_action')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="col-md-10">
                    <div id="ajax_op_status"></div>
                    <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                    <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                </div>

                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group"> 
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo e($module_url_path); ?>" style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/>

                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <input type="hidden" name="multi_action" value="" />
                    <table class="table table-advance"  id="table1" >
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>File</th>
                                <th>Size</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no = 0;?>
                        <tbody>
                      	<?php if(isset($arr_backup) && sizeof($arr_backup)>0): ?>
                      		<?php foreach($arr_backup as $key => $data): ?>

                            <?php 
                                $file_name = isset($data['file_name']) && !empty($data['file_name']) ? $data['file_name'] : '';
                                $file_size = isset($data['file_size']) && !empty($data['file_size']) ? $data['file_size'] : '';
                                $last_modified = isset($data['last_modified']) && !empty($data['last_modified']) ? $data['last_modified'] : '';
                             ?>

                            <tr>
                      			<td><?php echo e(++$no); ?></td>
                                <td><?php echo e($file_name); ?></td>
                      			<td><?php echo e($file_size); ?></td>
                                <td><?php echo e($last_modified); ?></td>
                      			<td>
                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path); ?>/download/<?php echo e($file_name); ?>" title="Download"><i class="fa fa-download" ></i></a>

                                    <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path); ?>/delete/<?php echo e($file_name); ?>" title="Delete" onclick="return confirm_action(this,event,'Do you really want to delete this backup','Are You Sure?','Yes','No')"><i class="fa fa-trash"></i> </a>
                                </td>
                      		</tr>

                      		<?php endforeach; ?>
                      	<?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        </div>
    </div>

<!-- END Main Content -->
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() 
    {
        $('#table_module').DataTable({
            "pageLength" : 10,
            "aoColumns"  : [
                { "bSortable" : true },
                { "bSortable" : true },
                { "bSortable" : true },
                { "bSortable" : false },
                { "bSortable" : false },
                { "bSortable" : false },
                { "bSortable" : false }
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>