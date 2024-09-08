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
                      <h2>Refer a Friend</h2>
                      <div class="prescription-section">
                          <div class="link-wrapper">
                              <div class="row">
                                  <div class="col-sm-7 col-md-9 col-lg-9">
                                      <div class="form-group">
                                          <input type="text" value="www.mobidoctor.com"/>
                                      </div>
                                  </div>
                                  <div class="col-sm-5 col-md-3 col-lg-3">
                                      <button class="green-trans-btn">Copy Link</button>
                                  </div>
                              </div>
                              <a href="javascript:void()" class="social-btn"><span class="icon"><i class="fa fa-facebook"></i></span> Share With Facebook</a>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.patient.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>