<?php $__env->startSection('main_content'); ?>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                <?php echo $__env->make('front.doctor.layout._leftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <?php echo $__env->make('front.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="row">
                    
                    <!-- <div class="col-sm-12 col-md-6 col-lg-6"> -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="payment-card family-card account-details">
                            <h4><b>Bank Account Details</b> <a class="edit-card" href="<?php echo e($module_url_path); ?>/bank_details/edit"><i class="fa fa-pencil-square-o"></i></a></h4>
                            <div class="payment-card-details">
                                <div class="lifestyle-details">
                                    <ul>
                                        <li>
                                            <span class="lifestyle-label">Bank Name</span>
                                            <span class="lifestyle-desc" id="bank_name"></span>
                                        </li>
                                        <li>
                                            <span class="lifestyle-label">Account Name</span>
                                            <span class="lifestyle-desc" id="bank_account_name"></span>
                                        </li>
                                        <li>
                                            <span class="lifestyle-label">Account No.</span>
                                            <span class="lifestyle-desc" id="bank_account_no"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="payment-card family-card stripe-details">
                            <h4><b>Stripe Details</b></h4>
                            <div class="payment-card-details">
                                <p>Login to your Strip Account</p>
                                <a href="https://dashboard.stripe.com/login" target="_blank" class="green-trans-btn">Login</a>
                                <p>Connect your Strip Account to Mobidoctor Account</p>
                                <a href="<?php echo e(isset( $arr_stripe['oauth'] ) && !empty( $arr_stripe['oauth'] ) ? $arr_stripe['oauth'] : 'javascript:void(0)'); ?>" target="_blank" class="green-trans-btn">Connect with Stripe</a>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('virgil.virgil', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var bank_name         = '<?php echo e(isset($arr_doctor_details['bank_name']) ? $arr_doctor_details['bank_name'] : ''); ?>';
        var bank_account_name = '<?php echo e(isset($arr_doctor_details['bank_account_name']) ? $arr_doctor_details['bank_account_name'] : ''); ?>';
        var bank_account_no   = '<?php echo e(isset($arr_doctor_details['bank_account_no']) ? $arr_doctor_details['bank_account_no'] : ''); ?>';

        $("#bank_name").html( decrypt(bank_name) );
        $("#bank_account_name").html( decrypt(bank_account_name) );
        $("#bank_account_no").html( decrypt(bank_account_no) );
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.doctor.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>