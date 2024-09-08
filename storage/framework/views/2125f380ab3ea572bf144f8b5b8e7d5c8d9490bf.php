<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="white-wrapper prescription-wrapper">
                    <h2>Invitation</h2>
                     <a class="pull-right" href="<?php echo e($module_url_path); ?>/invitation/download_template">Downlaod Sample Template</a>
                    <form name="frm_invitation" id="frm_invitation" method="post" action="<?php echo e($module_url_path); ?>/invitation/import" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                        <div class="prescription-section">
                            <div class="clearfix"></div>
                            <div class="document-upload-block">
                                <p>Upload Template<i class="red">*</i></p>
                                <div class="form-group">
                                     <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="input-group">
                                             <div class="form-inputs uneditable-input">
                                                <span class="fileupload-preview for-color"></span>
                                             </div>
                                             <div class="input-group-btn">
                                                <div class="btn btn-file">
                                                    <span class="fileupload-new">Choose File</span>
                                                    <span class="fileupload-exists change-btn">Change</span>
                                                    <input type="file" name="input_file" id="input_file" class="file-input"/>
                                                </div>
                                                <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                             </div>
                                          </div>
                                       </div>
                                        <div class="error" id="err_input_file"></div>
                                </div>
                                <div class="doc-note">Note :  Please fill data in sample file & then upload in same given format.</div>
                            </div>
                          
                            <div class="save-btn">
                                <button type="submit" id="btn_send_invitation" class="green-trans-btn">Send</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>

             <?php if(isset($arr_invitation['data']) && sizeof($arr_invitation['data'])>0): ?>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="white-wrapper prescription-wrapper">
                    <div class="table-responsive custom-table">
                            <table class="table">
                                <thead> 
                                    <tr>
                                        <th class="trans-date">Name</th>
                                        <th class="trans-date">Email</th>
                                        <th style="min-width: 150px;">Added On</th>
                                        <th class="trans-date">Is Register</th>
                                        <th class="trans-date">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($arr_invitation['data'] as $key => $invitation): ?>    
                                    <tr>
                                        <td><?php echo e(isset($invitation['name'])?$invitation['name']:'-'); ?></td>
                                        <td><?php echo e(isset($invitation['email'])?$invitation['email']:'-'); ?></td>
                                        <td><?php echo e(isset($invitation['created_at'])?date('d-M-Y',strtotime($invitation['created_at'])) : '00-00-0000'); ?></td>
                                        <td>
                                            <?php if(isset($invitation['is_user_register']) && sizeof($invitation['is_user_register'])>0): ?>
                                                <a href="javascript:void(0)" class="btn btn-success">Yes</a>
                                            <?php else: ?>
                                                 <a  href="javascript:void(0)" class="btn btn-danger">No</a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($invitation['is_mail_send']=="1"): ?>
                                              <a href="javascript:void(0)" class="btn btn-success">Sent</a>
                                            <?php else: ?>
                                              <a  href="javascript:void(0)" class="btn btn-danger">Pending</a>
                                            <?php endif; ?>  
                                        </td>
                                    </tr>
                                <?php endforeach; ?>    
                                </tbody>
                            </table>
                    </div>
                    <div class="pagination-block">
                        <?php echo e((isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?> 

        </div>
    </div>
</div>

<?php echo $__env->make('common.fileupload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
$("#btn_send_invitation").click(function(){
    var input_file = $("#input_file").val();
    if($.trim(input_file) == '')
    {
        $('#input_file').focus();
        $('#err_input_file').show();
        $('#err_input_file').html('Please upload file.');
        $('#err_input_file').fadeOut(4000);
        return false;
    }  

});


var _URL = window.URL || window.webkitURL;
$('#input_file').change(function() 
{
    var tempThis = $(this);
    var file, img;
    var file_name = $(this).val();
    var ext = file_name.substr( (file_name.lastIndexOf('.') +1) );
    if(ext!='' && ext!="xls")
    {       
        swal("Invalid File , Allowed extensions are: xls");
        $("#input_file").val('');
        return false;
    }
    else
    {
        console.log(this.files[0].size);
        if(this.files[0].size > 2200000)
        {
            swal('','File size should be upto 2 MB only.','error');
            $("#input_file").val('');                
            return false;                            
        }   
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>