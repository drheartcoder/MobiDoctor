<?php $__env->startSection('main_content'); ?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper">
            <div class="booking-title text-center">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h4>Select Subscription Plan</h4></div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
				</div>
            </div>
			<div class="booking-content radio-btns">

				<form method="post" id="subscription_plan_form" name="subscription_plan_form" action="<?php echo e(url('/')); ?>/patient/consultation/subscription_plan/payment">
					<?php echo e(csrf_field()); ?>


					<?php echo $__env->make('front.patient.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<div class="row">

						<?php if( isset($arr_subscription_plan) && !empty($arr_subscription_plan) ): ?>
							<?php foreach( $arr_subscription_plan as $subscription_plan ): ?>

								<?php
									$sp_id    = isset($subscription_plan['id'])    ? $subscription_plan['id']        : '';
									$sp_name  = isset($subscription_plan['name'])  ? $subscription_plan['name']      : '';
									$sp_slug  = isset($subscription_plan['slug'])  ? $subscription_plan['slug']      : '';
									$sp_price = isset($subscription_plan['price']) ? $subscription_plan['price'].'€' : '';
								?>

								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<div class="radio-btn patient-box" style="height:auto;">
										<input type="radio" id="<?php echo e($sp_slug); ?>" name="subscription_plan_id" value="<?php echo e($sp_id); ?>" />
										<label for="<?php echo e($sp_slug); ?>">
											<h4><?php echo e($sp_name); ?></h4>
											<span><?php echo e($sp_price); ?></span>
										</label>
									</div>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>

					</div>
					<div class="clearfix"></div>

					<button type="submit" class="green-btn submit-btn" id="btn_submit_subscription_plan_form">Let's Go</button>

				</form>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>