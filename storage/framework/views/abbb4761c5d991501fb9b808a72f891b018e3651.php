<?php $__env->startSection('main_content'); ?>

<body>
	<div class="home-banner-section">
        <div class="container">
            <div class="banner-content">
            	<h1><span><?php echo e(isset( $status ) && !empty( $status ) ? $status : 'Error'); ?></span></h1>
				<h3><?php echo e(isset( $msg ) && !empty( $msg ) ? $msg : 'Something thing went wrong!'); ?></h3>
            </div>
        </div>
    </div>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>