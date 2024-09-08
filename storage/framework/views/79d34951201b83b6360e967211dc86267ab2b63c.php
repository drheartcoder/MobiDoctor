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
            <li class="active"><?php echo e(isset($page_title) ? $page_title : ''); ?></li>
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

           <form method="post" class="form-horizontal" id="frm_manage" action="<?php echo e(url($module_url_path.'/multi_action')); ?>">                     
          
           <?php echo e(csrf_field()); ?>

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

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

              <table class="table table-advance"  id="table1" >
               <thead>
                  <tr>
                     <th>Notification</th>
                     <th>Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>

                  <?php foreach($arr_data as $contact): ?>

                  <?php
                    $date = isset($contact['created_at'])?$contact['created_at']:'';
                  ?>

                  <tr>
                     <td> <?php echo e(isset($contact['message'])?decrypt_value($contact['message']):''); ?>   </td>
                     <td> <?php echo e(date("d-M-Y h:i:sa", strtotime($date))); ?> </td>
                     <td>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path.'/delete/'.base64_encode($contact['id'])); ?>" onclick="javascript:return confirm_delete()"  title="Delete">
                        <i class="fa fa-trash" ></i></a>
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
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="<?php echo e(url('/')); ?>/public/admin/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
    
     $(document).ready(function() {
        $('#table_module').DataTable( {
            "pageLength": 10,
            "aoColumns": [
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false }
              ]
        });
    });
    
    function confirm_delete()
    {
       if(confirm('Are you sure to delete this record?'))
       {
        return true;
       }
       return false;
    }

    function check_multi_action(checked_record,frm_id,action)
    {
      var checked_record = document.getElementsByName(checked_record);
      var len = checked_record.length;
      var flag=1;
      var input_multi_action = jQuery('input[name="multi_action"]');
      var frm_ref = jQuery("#"+frm_id);
      
      if(len<=0)
      {
        alert("No records to perform this action");
        return false;
      }
      
      if(confirm('Do you really want to perform this action'))
      {
        for(var i=0;i<len;i++)
        {
          if(checked_record[i].checked==true)
          {  
              flag=0;
              /* Set Action in hidden input*/
              jQuery('input[name="multi_action"]').val(action);

              /*Submit the referenced form */
              jQuery(frm_ref)[0].submit();  
            }
        }

        if(flag==1)
        {
          alert('Please select record(s)');
          return false;
        }  
          
      } 
      
  }

</script>
<?php $__env->stopSection(); ?>                    



<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>