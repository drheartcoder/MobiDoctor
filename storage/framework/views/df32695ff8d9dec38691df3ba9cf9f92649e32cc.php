<?php $__env->startSection('main_content'); ?>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="white-wrapper prescription-wrapper">
                    <h2>Prescription</h2>
                    <div class="prescription-section" id="list-wrapper">
                        
                        <?php if( isset( $arr_prescription['data'] ) && sizeof( $arr_prescription['data'] )>0 ): ?>  
                            <?php foreach( $arr_prescription['data'] as $key => $data ): ?>
                                <div class="prescri-block">
                                    <div class="prescri-icon bg-img">&nbsp;</div>
                                    <div class="prescri-name"><span class="doc-name"> Prescription  
                                    </span> - <?php echo e(isset( $data['created_at'] ) ? date('d-M-Y',strtotime($data['created_at'])) : '00-00-0000'); ?></div>
                                    <div class="clearfix"></div>
                                    <div class="view-btns">
                                        
                                        <?php
                                            $file_path = 'javascript:void(0)';
                                            
                                            $file_id = isset( $data['id'] ) ? base64_encode( $data['id'] ) : '';
                                            $file    = isset( $data['name'] ) && !empty( $data['name'] ) ? $data['name'] : '';

                                            if( isset( $file ) && !empty( $file ) && File::exists( $prescription_file_base_path.'/'.$file ) ):
                                                $file_path = $prescription_file_public_path.'/'.$file;
                                            endif;  
                                        ?>

                                        <a class="view" href="<?php echo e($module_url_path); ?>/view/<?php echo e($file_id); ?>"><i class="fa fa-eye"></i></a>
                                        
                                        <?php if($file_path!=''): ?>
                                            <a class="download" id="dec_image<?php echo e($key); ?>" data-name="image<?php echo e($key); ?>" data-file="<?php echo e($file); ?>" data-path="<?php echo e($file_path); ?>" href="<?php echo e($file_path); ?>" download><i class="fa fa-download"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="pagination-block"><?php echo e(( isset( $arr_pagination ) && sizeof( $arr_pagination ) > 0 ) ? $arr_pagination->links() : ''); ?></div>

                        <?php else: ?>
                            <div class="no-date-found-bx">
                                <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="no-record-txt">No Record Found </div>                    
                            </div>
                        <?php endif; ?>  
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {   
        /*--------------------------Decrypt Data Presciption Starts----------------*/
       
        var record_length = $('#list-wrapper').children('div').length - 1;
        
        for( i = 0; i<record_length; i++)
        {
            if( $("#dec_image"+i).length )
            {
                var name = $("#dec_image"+i).data('name');
                var file = $("#dec_image"+i).data('file');
                var path = $("#dec_image"+i).data('path');
                decrypt_file(name, file, path);
            }
        }
        
        /*--------------------------Decrypt Data Presciption End----------------*/
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>