<?php $__env->startSection('main_content'); ?>
<link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">

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
        <li class="active">Manage <?php echo e(isset($page_title) ? $page_title : ''); ?></li>
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
                <?php echo e(isset($page_title)?$page_title:""); ?>

                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
        <div class="box-content">
          <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

            <form method="post" class="form-horizontal" id="frm_manage" action="<?php echo e(url($module_url_path.'/multi_action')); ?>"><?php echo e(csrf_field()); ?>

                <div class="col-md-10">
                    <div id="ajax_op_status">
                        
                    </div>
                  <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                  <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
                </div>
                <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                      <a href="<?php echo e($module_url_path); ?>/create" class="btn btn-primary btn-add-new-records" title="Add Category">Add Blog</a> 
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
                        title="Multiple Delete" 
                        href="javascript:void(0);" 
                        onclick="javascript : return check_multi_action('frm_manage','delete');"  
                        style="text-decoration:none;">
                        <i class="fa fa-trash-o"></i>
                        </a>
                    </div>  

                    <div class="btn-group"> 
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                         title="Refresh" 
                         href="<?php echo e($module_url_path); ?>"
                         style="text-decoration:none;">
                         <i class="fa fa-repeat"></i>
                        </a> 
                    </div>
                </div>
                <br/>

                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                  <input type="hidden" name="multi_action" value="" />
                    <table class="table table-advance"  id="table1" >
                        <thead>
                            <tr>
                               <th style="width:18px"> <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                               <th>Title</th>
                               <?php /* <th>Description</th> */ ?>
                               <th>Date</th>
                               <th>Status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($arr_blog) && sizeof($arr_blog)>0): ?>
                                <?php foreach($arr_blog as $blog): ?>
                                    <tr>
                                        <td> 
                                           <input type="checkbox" 
                                              name="checked_record[]"  
                                              value="<?php echo e(base64_encode($blog['id'])); ?>" /> 
                                        </td>
                                        <td>
                                            <?php echo e(isset($blog['title'])?str_limit(decrypt_value($blog['title']),50):''); ?>

                                        </td>
                                       <?php /*  <td>
                                            <?php echo decrypt_value($blog['description']); ?>

                                        </td> */ ?>
                                        <td>
                                            <?php echo e(isset($blog['date'])?$blog['date']:''); ?>

                                        </td>
                                        
                                        <td>
                                           <?php if($blog['status']=="1"): ?>
                                           <a onclick="confirm_action(this,event,'Do you really want to blocked this record ?')" title="Active" href="<?php echo e($module_url_path.'/deactivate/'.base64_encode($blog['id'])); ?>" class="btn btn-success">Active</a>
                                           <?php else: ?>
                                           <a onclick="confirm_action(this,event,'Do you really want to activate this record ?')" title="Block" href="<?php echo e($module_url_path.'/activate/'.base64_encode($blog['id'])); ?>" class="btn btn-danger">Block</a>
                                           <?php endif; ?>
                                        </td>
                                        <td> 
                                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path.'/edit/'.base64_encode($blog['id'])); ?>"  title="Edit">
                                           <i class="fa fa-edit" ></i></a>  

                                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path.'/comment/'.base64_encode($blog['id'])); ?>" title="View Comments">
                                          <i class="fa fa-eye" ></i></a>

                                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path.'/delete/'.base64_encode($blog['id'])); ?>" onclick="confirm_action(this,event,'Do you really want to delete this record ?')"  title="Delete">
                                          <i class="fa fa-trash" ></i></a>

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
    
     $(document).ready(function() {
        $('#table_module').DataTable( {
            "pageLength": 10,
            "aoColumns": [
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
            ]

        });
    });
</script>
<?php $__env->stopSection(); ?>                    




<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>