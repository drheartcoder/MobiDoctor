<?php $__env->startSection('main_content'); ?>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="white-wrapper prescription-wrapper">
                    <h2>Medical Certificate</h2>
                    <div class="prescription-section" id="list-wrapper">
                        
                        <?php if( isset( $arr_medical['data'] ) && sizeof( $arr_medical['data'] )>0 ): ?>  
                            <?php foreach( $arr_medical['data'] as $key => $data ): ?>
                                <div class="prescri-block">
                                    <div class="prescri-icon bg-img">&nbsp;</div>
                                    <div class="prescri-name"><span class="doc-name"> Medical Certificate </span> - <?php echo e(isset( $data['created_at'] ) ? date('d-M-Y',strtotime($data['created_at'])) : '00-00-0000'); ?></div>
                                    <div class="clearfix"></div>
                                    <div class="view-btns">
                                        <?php
                                            $file_path = 'javascript:void(0)';
                                            $file = isset( $data['file_name'] ) && !empty( $data['file_name'] ) ? $data['file_name'] : '';

                                            if( isset( $file ) && !empty( $file ) && File::exists( $medical_certificate_file_base_path.'/'.$file ) ):
                                                $file_path = $medical_certificate_file_public_path.'/'.$file;
                                            endif;  
                                        ?>
                                        <a class="view" href="<?php echo e($file_path); ?>" target="_blank"><i class="fa fa-eye"></i></a>
                                        <a class="download" href="<?php echo e($file_path); ?>" download><i class="fa fa-download"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="pagination-block"><?php echo e(( isset( $arr_pagination ) && sizeof( $arr_pagination ) > 0 ) ? $arr_pagination->links() : ''); ?></div>

                        <?php else: ?>
                            No record found    
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