<?php $__env->startSection('main_content'); ?>
<link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.css">
<?php $cnt = 0;  ?>
<style type="text/css">
  .table>tbody>tr>td:last-child{white-space: nowrap;}
  .dataTables_filter, .dataTables_info { display: none; }
  .col-sm-2 { margin-left: 1100px; }
  .form-horizontal .btn-group { margin-bottom: -43px;}
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
            <li class="active">Subscription Transactions <?php echo e(isset($page_title) ? $page_title : ''); ?></li>
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
               Subscription Transactions <?php echo e(isset($page_title) ? $page_title : ""); ?>

                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"></a>
                    <a data-action="close" href="#"></a>
                </div>
            </div>
        <div class="box-content">

          <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

          <form method="post" class="form-horizontal" id="frm_manage" action="<?php echo e(url($module_url_path.'/export')); ?>"><?php echo e(csrf_field()); ?>

            <div class="col-md-10">
                <div id="ajax_op_status">
                    
                </div>
              <div class="alert alert-danger" id="no_select" style="display:none;"></div>
              <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
            </div>
            <div class="btn-toolbar pull-right clearfix">
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

            <div class="btn-group">
                <div class="col-sm-2">
                  <input type="submit" value="Export to CSV" class="btn btn-primary">
                </div>
            </div>
        </form>  
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">

              <input type="hidden" name="multi_action" value="" />

                <table class="table table-advance"  id="table1" >
                 <thead>
                    <tr>
                       <th style="display: none;">ID</th>
                       <th>Invoice No</th>
                       <th>Patient Name</th>
                       <th>Transaction ID</th>
                       <th>Transaction Date</th>
                       <th>Paid Amount<b> (€)</b></th>
                       <th>Status</th>
                    </tr>
                 </thead>
                 <tbody>
                  	<?php if(isset($arr_transaction) && sizeof($arr_transaction)>0): ?>
                  		<?php foreach($arr_transaction as $key => $data): ?>
                        <tr>
                          <td style="display: none;">
                            <?php echo e(++$cnt); ?>

                          </td>
                          <td><?php echo e(isset($data['invoice_no']) ? $data['invoice_no'] : '-'); ?></td>
                          <td>
                              <?php echo e(isset($data['user_details']['first_name']) ? ucfirst(decrypt_value($data['user_details']['first_name'])) : ''); ?> <?php echo e(isset($data['user_details']['last_name']) ? ucfirst(decrypt_value($data['user_details']['last_name'])) : '-'); ?>

                          </td>
                          <td><?php echo e(isset($data['transaction_id']) ? $data['transaction_id'] : '-'); ?></td>
                          <td><?php echo e(isset($data['created_at']) ? date('d-M-Y',strtotime($data['created_at'])) : '00-00-0000'); ?></td>
                          <td><?php echo e(isset($data['paid_amount']) ? $data['paid_amount'] : 0.00); ?></td>
                  				<td><?php echo e(isset($data['status']) ? ucfirst($data['status']) : '-'); ?></td>
                  			</tr>
                  		<?php endforeach; ?>
                  	<?php endif; ?>
                 </tbody>
              </table>
            </div>
        </div>
  </div>
</div>

<!-- END Main Content -->
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {
        $('#table_module').DataTable({
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