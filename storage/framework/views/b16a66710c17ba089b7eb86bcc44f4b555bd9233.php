<?php $__env->startSection('main_content'); ?>

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="white-wrapper prescription-wrapper Support-faq-section">
                        <h2>FAQ</h2>
                        <div class="prescription-section">

                            <div id='faq_acc'>
                                <?php if( isset( $arr_faq['data'] ) && sizeof( $arr_faq['data'] ) > 0 ): ?>
                                    <ul>
                                        <?php foreach( $arr_faq['data'] as $key => $data ): ?>
                                            <li class='has-sub'>
                                                <a href='#'><span> <?php echo e(isset( $data['question'] ) && !empty( $data['question'] ) ? decrypt_value( $data['question'] ) : ''); ?> </span> </a>
                                                <ul>
                                                    <li>
                                                        <div class="faq-text">
                                                            <?php echo e(isset( $data['answer'] ) && !empty( $data['answer'] ) ? decrypt_value( $data['answer'] ) : ''); ?>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                  

                                <?php else: ?>
                                    <div class="no-date-found-bx">
                                        <div class="no-record-img"><i class="fa fa-exclamation-triangle"></i></div>
                                        <div class="no-record-txt">No Record Found </div>                    
                                    </div>
                                <?php endif; ?>    
                            </div>

                            <div class="pagination-block">
                                <?php echo e((isset($arr_paginate) && sizeof($arr_paginate)>0) ? $arr_paginate->links() : ''); ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo e(url('/public/front/js/accordian.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>