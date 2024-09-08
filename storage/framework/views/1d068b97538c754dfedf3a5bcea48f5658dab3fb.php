<?php $__env->startSection('main_content'); ?>
<link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/data-tables/latest/dataTables.bootstrap.min.css">
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
      <a href="<?php echo e($module_url_path); ?>/category"><?php echo e(isset($module_title) ? $module_title : ''); ?></a>
      </span> 
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box">
      <div class="box-title">
         <h3>
            <i class="fa fa-text-width"></i>
            <?php echo e(isset($module_title) ? $module_title : ''); ?>

         </h3>
         <div class="box-tool">
            <a data-action="collapse" href="#"></a>
            <a data-action="close" href="#"></a>
         </div>
      </div>
      <div class="box-content">
         <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
         <form method="post" class="form-horizontal" id="frm_manage" action="<?php echo e(url($module_url_path.'/category/multi_action')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="col-md-10">
               <div id="ajax_op_status">
               </div>
               <div class="alert alert-danger" id="no_select" style="display:none;"></div>
               <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
            </div>
            <div class="btn-toolbar pull-right clearfix">
               <div class="btn-group">
                  <a href="<?php echo e($module_url_path.'/category/create'); ?>" class="btn btn-primary btn-add-new-records"  title="Add Category">Add Category</a> 
               </div>
               <div class="btn-group">
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                     title="Multiple Active/Unblock" 
                     href="javascript:void(0);" 
                     onclick="javascript : return check_multi_action('frm_manage','activate');" 
                     style="text-decoration:none;">
                  <i class="fa fa-unlock"></i>
                  </a> 
               </div>
               <div class="btn-group">
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                     title="Multiple Deactive/Block" 
                     href="javascript:void(0);" 
                     onclick="javascript : return check_multi_action('frm_manage','deactivate');"  
                     style="text-decoration:none;">
                  <i class="fa fa-lock"></i>
                  </a> 
               </div>
               <div class="btn-group"> 
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                     title="Refresh" 
                     href="<?php echo e($module_url_path); ?>/category"
                     style="text-decoration:none;">
                  <i class="fa fa-repeat"></i>
                  </a> 
               </div>
            </div>
            <br/>
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">
               <input type="hidden" name="multi_action" value="" />
               <table class="table table-advance"  id="blog-table" >
                  <thead>
                     <tr>
                        <th width="15%"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                        <th width="15px">Category</th>
                        <th width="15px">Status</th>
                        <th width="15px">Category Details</th>
                        <th width="15px">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach($arr_category as $category): ?>
                     <tr>
                        <td> 
                           <input type="checkbox" 
                              name="checked_record[]"  
                              value="<?php echo e(base64_encode($category['id'])); ?>" /> 
                        </td>
                        <td><?php echo e(isset($category['name'])?decrypt_value($category['name']):''); ?></td>
                        <td>
                           <?php if($category['status']=="1"): ?>
                           <a onclick="confirm_action(this,event,'Do you really want to blocked this record ?')" title="Active" href="<?php echo e($module_url_path.'/category/deactivate/'.base64_encode($category['id'])); ?>" class="btn btn-success">Active</a>
                           <?php else: ?>
                           <a onclick="confirm_action(this,event,'Do you really want to activate this record ?')" title="Block" href="<?php echo e($module_url_path.'/category/activate/'.base64_encode($category['id'])); ?>" class="btn btn-danger">Block</a>
                           <?php endif; ?>
                        </td>
                        <th>
                           <?php if(isset($category['details']) && sizeof($category['details'])>0): ?>
                              <a href="<?php echo e($module_url_path); ?>/category_details/edit/<?php echo e(base64_encode($category['details']['id'])); ?>" class="btn btn-primary btn-sm" title="Edit Category Details"><i class="fa fa-edit"></i> Edit Details</a>
                           <?php else: ?>
                              <a href="<?php echo e($module_url_path); ?>/category_details/create" class="btn btn-primary btn-sm" title="Add Category Details"><i class="fa fa-plus"></i> Add Details</a>
                           <?php endif; ?>
                        </th>
                        <td> 
                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path.'/category/edit/'.base64_encode($category['id'])); ?>"  title="Edit Category">
                           <i class="fa fa-edit" ></i>
                           </a>  
                           &nbsp;   
                        </td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- END Main Content -->
<script src="<?php echo e(url('/')); ?>/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="<?php echo e(url('/')); ?>/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {

 $('#blog-table').DataTable( {
       "pageLength": 10
    } );
 

});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>