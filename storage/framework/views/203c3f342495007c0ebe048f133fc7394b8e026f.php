<?php $__env->startSection('main_content'); ?>

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                   <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    <?php if(isset($arr_transactions['data']) && sizeof($arr_transactions['data'])>0): ?>
                        <div class="table-responsive custom-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="trans-date">Transaction ID</th>
                                        <th>Consultation ID</th>
                                        <th class="trans-date">Transaction Date</th>
                                        <th style="min-width: 110px;">Invoice No.</th>
                                        <th>Paid Amount<b> (€)</b></th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($arr_transactions['data'] as $key => $transactions): ?>    
                                    <tr>
                                        <td><?php echo e(isset($transactions['transaction_id'])?$transactions['transaction_id']:'-'); ?></td>
                                        <td><?php echo e(isset($transactions['consultation_id'])?$transactions['consultation_id']:'-'); ?></td>
                                        <td><?php echo e(isset($transactions['created_at'])?date('d-M-Y',strtotime($transactions['created_at'])) : '00-00-0000'); ?></td>
                                        <td><?php echo e(isset($transactions['invoice_no'])?$transactions['invoice_no']:'-'); ?></td>
                                        <td><?php echo e(isset($transactions['paid_amount'])?$transactions['paid_amount']:'0.00'); ?></td>
                                        <td class="green-text" <?php if(isset($transactions['status']) && $transactions['status']!='paid'): ?> style="color: red;"<?php endif; ?>><?php echo e(isset($transactions['status'])?ucfirst($transactions['status']):'-'); ?></td>
                                        <td> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="<?php echo e($module_url_path); ?>/consultation/view_transaction?id=<?php echo e(isset($transactions['id'])?base64_encode($transactions['id']):0); ?>"  title="View"><i class="fa fa-eye" ></i></a> </td>
                                    </tr>
                                <?php endforeach; ?>    
                                </tbody>
                            </table>
                        </div>
                    <div class="pagination-block">
                        <?php /* <ul>
                            <li><a class="arrow" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
                            <li><a class="active" href="javascript:void(0)">1</a></li>
                            <li><a href="javascript:void(0)">2</a></li>
                            <li><a href="javascript:void(0)">3</a></li>
                            <li><a class="arrow" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
                        </ul> */ ?>
                        <?php /* <ul> */ ?>
                        <?php echo e((isset($arr_pagination) && sizeof($arr_pagination)>0) ? $arr_pagination->links() : ''); ?>

                        <?php /* </ul> */ ?>
                    </div>
                <?php else: ?>
                    <div class="question-block copmlete-test">
                        <div class="table-block">
                           <div class="review-option">
                               <center><div class="complete-text-head">No records found.</div></center>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>    
                </div>
            </div>
        </div>
    </div> 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>