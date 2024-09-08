    
<?php $__env->startSection('main_content'); ?>
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
</style>
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="<?php echo e(url($admin_panel_slug.'/dashboard')); ?>">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li>
        <i class="fa fa-sitemap"></i>
        <a href="<?php echo e($module_url_path); ?>"><?php echo e(isset($module_title) ? $module_title : ''); ?></a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
       <i class="fa fa-plus-square-o"></i>
      <li class="active"><?php echo e(isset($page_title) ? $page_title : ''); ?></li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
        <div class="box-title">
            <h3><i class="fa fa-file"></i> <?php echo e(isset($page_title)?$page_title:""); ?> </h3>
            <div class="box-tool">
            </div>
        </div>
      <br/>
      <form method="post" action="<?php echo e(url($module_url_path.'/store')); ?>" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         <?php echo e(csrf_field()); ?>

         <div class="box-content">
            <?php echo $__env->make('admin.layout._operation_status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN Left Side -->
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="title">Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="title" class="form-control" id="title" placeholder="Title" >
                           <div class="err" id="err_title"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 


                       <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="category">Category<i class="red">*</i></label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <select data-placeholder="Select Category" name="category[]" id="category" class="form-control chosen" multiple="multiple" tabindex="6" data-rule-required="true">
                              <option value="">--Select--</option>
                                  <?php if(isset($arr_category) && sizeof($arr_category)>0): ?>
                                    <?php foreach($arr_category as $category): ?>
                                       <option value="<?php echo e($category['id']); ?>"><?php echo e(isset($category['name'])?decrypt_value($category['name']):''); ?></option>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                           </select>
                           <div class="err" id="err_category"></div>
                        </div>
                     </div>

                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="date">Date
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="date" placeholder="Date" id="date" class="form-control datepicker" >
                           <div class="err" id="err_date"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group ">
                        <label class="col-sm-3 col-lg-3 control-label" for="posted_by">Posted By
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="posted_by" id="posted_by"  placeholder="Posted By" class="form-control" >
                           <div class="err" id="err_posted_by"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Featured Image</label>
                        <div class="col-sm-3 col-lg-7 controls">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                 <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                              </div>
                              <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                 <span class="fileupload-exists">Change</span>
                                 <input type="file" name="blog_image"  id="image" class="file-input validate-image" /></span>
                                 <!--<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>-->
                              </div>
                               <i class="red"> 
                                    <span class="label label-important">NOTE!</span>
                                    <i class="red"> Allowed only jpg | jpeg | png <br/> 
                                        Please upload image with Height and Width greater than or equal to 600 X 800 for best result. </i>
                                        <span for="cat_img" id="err_cat_image" class='help-block'><?php echo e($errors->first('image')); ?></span> 
                                    </i>
                              <div class="err" id="err_image"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="meta_title"> Meta Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title">
                           <div class="err" id="err_meta_title"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="meta_keyword"> Meta Keyword
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Meta Keyword">
                           <div class="err" id="err_meta_keyword"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="meta_desc">Meta Description
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_desc" class="form-control" id="metadesc" placeholder="Meta description" >
                           <div class="err" id="err_metadesc"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                      <div class="form-group ">
                        <label class="col-sm-3 col-lg-3 control-label" for="description">Content
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html' name="description" rows='10' data-rule-required='true' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> <?php echo e($errors->first('template_html')); ?> </span> 
                              <div class="err" id="err_desc"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 

                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <center>
               <div class="form-group">
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
               </div>
            </center>
         </div>
      </form>
   </div>
</div>
<link href="<?php echo e(url('/')); ?>/public/front/css/bootstrap-datepicker.min.css" rel=stylesheet type="text/css" />
<!-- END Main Content --> 
<script type="text/javascript">
  $(document).on("change",".validate-image", function()
    {            
        var file=this.files;
        validateImage(this.files, 600,800);
    });
</script>
<script>
   function saveTinyMceContent()
   {
     tinyMCE.triggerSave();
   }
   $(document).ready(function()
    {
      tinymce.init({
        selector: 'textarea',
        relative_urls: false,
        remove_script_host:false,
        convert_urls:false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
          '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
          '//www.tinymce.com/css/codepen.min.css'
        ]
      });
      
    $(function()
    {
      $('.datepicker').datepicker({format: "yyyy-mm-dd",todayHighlight: true });
    });
   
    $('#valid').click(function(){
   
       var title                     = $('#title').val();
       var category                  = $('#category').val();
       var date                      = $('#date').val();
       var posted_by                  = $('#posted_by').val();
       var desc                      = $('.desc').val();
       var meta_title                 = $('#meta_title').val();
       var meta_keyword               = $('#meta_keyword').val();
       var metadesc                  = $('#metadesc').val();
       var image                     = $('#image').val();
       if($.trim(title)=="")
       {
          $('#title').val('');
          $('#err_title').fadeIn();         
          $('#err_title').html('Please enter title.');
          $('#err_title').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#title').focus();
          return false;
       }
       if($.trim(category)=="")
       {
          $('#category').val('');
          $('#err_category').fadeIn();         
          $('#err_category').html('Please select category.');
          $('#err_category').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#category').focus();
          return false;
       }
       if($.trim(date)=="")
       {
          $('#date').val('');
          $('#err_date').fadeIn();         
          $('#err_date').html('Please enter date.');
          $('#err_date').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#date').focus();
          return false;
       }
       if($.trim(posted_by)=="")
       {
          $('#posted_by').val('');
          $('#err_posted_by').fadeIn();         
          $('#err_posted_by').html('Please enter posted by.');
          $('#err_posted_by').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#posted_by').focus();
          return false;
       }
       if($.trim(image)=="")
       {
          $('#image').val('');
          $('#err_image').fadeIn();         
          $('#err_image').html('Please upload image.');
          $('#err_image').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#image').focus();
          return false;
       }
       if($.trim(desc)=="")
       {
          $('.desc').val('');
          $('#err_desc').fadeIn();         
          $('#err_desc').html('Please enter description.');
          $('#err_desc').fadeOut(4000);
         
          $('.desc').focus();
          return false;
       }
       if($.trim(meta_title)=="")
       {
          $('#meta_title').val('');
          $('#err_meta_title').fadeIn();         
          $('#err_meta_title').html('Please enter meta title.');
          $('#err_meta_title').fadeOut(4000);
         
          $('#meta_title').focus();
          return false;
       }
        if($.trim(meta_keyword)=="")
       {
          $('#meta_keyword').val('');
          $('#err_meta_keyword').fadeIn();         
          $('#err_meta_keyword').html('Please enter meta keyword.');
          $('#err_meta_keyword').fadeOut(4000);
         
          $('#meta_keyword').focus();
          return false;
       }
        if($.trim(metadesc)=="")
       {
          $('#metadesc').val('');
          $('#err_metadesc').fadeIn();         
          $('#err_metadesc').html('Please enter meta description.');
          $('#err_metadesc').fadeOut(4000);
         
          $('#metadesc').focus();
          return false;
       }
    
   });
});
   
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>