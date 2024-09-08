<!-- Header -->        
<?php echo $__env->make('front.layout_blog._header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
<!-- BEGIN Content -->

    <?php echo $__env->yieldContent('main_content'); ?>

<!-- END Main Content -->

<!-- Footer --> 
<?php echo $__env->make('front.layout_blog._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    