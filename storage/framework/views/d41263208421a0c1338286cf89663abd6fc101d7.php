<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.patient.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="white-wrapper prescription-wrapper">
                    <h2>Subscription Transaction Details</h2>
                    <form name="frm_contact_us" id="frm_contact_us" method="post" action="<?php echo e($module_url_path); ?>/contact_us/store">
                        <?php echo e(csrf_field()); ?>

                        <div class="prescription-section contact-section">
                            <table>
                                <tr>
                                    <td><label class="form-label"> Transaction ID :</label></td>
                                    <td><?php echo e(isset($arr_transactions['transaction_id'])?$arr_transactions['transaction_id']:'-'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Transaction Date :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['created_at'])?date('d-M-Y',strtotime($arr_transactions['created_at'])):'00.00.0000'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Invoice No :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['invoice_no'])?$arr_transactions['invoice_no']:'-'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Amount<b> (€)</b> :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['sp_amount'])?$arr_transactions['sp_amount']:0.00); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Discount Code :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['discount_details']['code'])?$arr_transactions['discount_details']['code']:'-'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Discount Amount<b> (€)</b> :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['discount_amount'])?$arr_transactions['discount_amount']:0.00); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Paid Amount<b> (€)</b> :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['paid_amount'])?$arr_transactions['paid_amount']:0.00); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Start Date :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['start_date'])?date('d-M-Y',strtotime($arr_transactions['start_date'])):'00.00.0000'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> End Date :</label></td>
                                    <td> <?php echo e(isset($arr_transactions['end_date'])?date('d-M-Y',strtotime($arr_transactions['end_date'])):'00.00.0000'); ?> </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label"> Status :</label></td>
                                    <td class="green-text" <?php if(isset($arr_transactions['status']) && $arr_transactions['status']!='paid'): ?> style="color: red;"<?php endif; ?>> <?php echo e(isset($arr_transactions['status'])?ucwords($arr_transactions['status']):'-'); ?> </td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>