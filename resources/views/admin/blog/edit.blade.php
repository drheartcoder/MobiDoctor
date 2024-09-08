@extends('admin.layout.master')    
@section('main_content')
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
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li>
        <i class="fa fa-sitemap"></i>
        <a href="{{$module_url_path}}">{{ $module_title or ''}}</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <i class="fa fa-edit"></i>
      <li class="active">{{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($page_title)?$page_title:"" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <form method="post" action="{{url($module_url_path.'/update')}}/{{base64_encode($blog_details['id'])}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         {{ csrf_field() }}
         <div class="box-content">
            @include('admin.layout._operation_status') 
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
                           <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{isset($blog_details['title'])?decrypt_value($blog_details['title']):''}}" >
                           <div class="err" id="err_title"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Category<i class="red">*</i></label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <select data-placeholder="Select Category" name="category[]" id="category" class="form-control chosen" multiple="multiple" tabindex="6" data-rule-required="true">
                              <option value=""></option>
                                  @if(isset($arr_category) && sizeof($arr_category)>0)
                                      @foreach($arr_category as $category)
                                         <option value="{{ $category['id'] }}" @if(in_array($category['id'],$arr_blog_category)) selected @endif>{{ isset($category['name'])?decrypt_value($category['name']):'' }}</option>
                                      @endforeach
                                  @endif
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
                           <input type="text" name="date" placeholder="Date" id="date" class="form-control datepicker" value="{{isset($blog_details['date'])?$blog_details['date']:''}}">
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
                           <input type="text" name="posted_by" id="posted_by"  placeholder="Posted By" class="form-control" value="{{isset($blog_details['posted_by'])?decrypt_value($blog_details['posted_by']):''}}">
                           <div class="err" id="err_posted_by"></div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/> 
                      <div class="form-group">
                            <label class="col-sm-3 col-lg-3 control-label">Image<i class="red">*</i></label>
                            <div class="col-sm-6 col-lg-7 controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input type="hidden" value="{{$default_img_path.'/blog.jpg'}}" id="default_image">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        @if(isset($blog_details['image']) && !empty($blog_details['image']) && $blog_details['image'] != null && file_exists($blog_image_base_img_path.$blog_details['image']))
                                            <?php $blog_image = $blog_details['image']; ?>                    
                                        <img src="{{ $blog_image_public_img_path.$blog_details['image'] }}" id="preview" >
                                        @else
                                        <img src="{{ $default_img_path.'/blog.jpg' }}" id="preview" >                    
                                        @endif
                                    </div>
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file" style="height:32px;">

                                            <span class="fileupload-new">Change</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file"  data-validation-allowing="jpg, jpeg, png" class="file-input news-image validate-image" name="blog_image" id="blog_image"/><br>
                                            <input type="hidden" class="file-input " name="oldimage" id="oldimage" value="{{ $blog_details['image'] }}"/>
                                        </span>
                                    </div>
                                    <i class="red"> 
                                        <span class="label label-important">NOTE!</span>
                                        <i class="red"> Allowed only jpg | jpeg | png <br/> 
                                            Please upload image with Height and Width greater than or equal to 600 X 800 for best result. </i>
                                            <input type="hidden" id="invalid_size" value="">
                                            <input type="hidden" id="invalid_ext" value="">
                                            <span for="cat_img" id="err_cat_image" class='help-block'>{{ $errors->first('image') }}</span> 
                                        </i>
                                        <div id="file-upload-error" class="error"></div>
                                        <span for="image" id="err_image" class="help-block">{{ $errors->first('blog_image') }}</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                        </div>
                     <div class="clearfix"></div>
                     <br/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="meta_title"> Meta Title
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                           <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title"value="{{isset($blog_details['meta_title'])?decrypt_value($blog_details['meta_title']):''}}">
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
                           <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Meta Keyword"value="{{isset($blog_details['meta_keyword'])?decrypt_value($blog_details['meta_keyword']):''}}">
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
                           <input type="text" name="meta_desc" class="form-control" id="meta_desc" placeholder="Meta description" value="{{isset($blog_details['meta_desc'])?decrypt_value($blog_details['meta_desc']):''}}">
                           <div class="err" id="err_meta_desc"></div>
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
                              <textarea class='form-control desc' id='template_html' name="description" rows='10' data-rule-required='true' placeholder='Email Template Body'>{{isset($blog_details['description'])?decrypt_value($blog_details['description']):''}}</textarea>
                              <span class='help-block'> {{ $errors->first('template_html') }} </span> 
                              <div class="err" id="err_description"></div>
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
                  <button type="submit" name="btn_save" id="valid" class="btn btn-success" onclick="saveTinyMceContent()">Update</button>
               </div>
            </center>
         </div>
      </form>
   </div>
</div>
<link href="{{url('/')}}/public/front/css/bootstrap-datepicker.min.css" rel=stylesheet type="text/css" />
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
          'insertdatetime media table contextmenu paste code',
          'textcolor colorpicker'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
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
       var meta_desc                  = $('#meta_desc').val();
       var image                     = $('#blog_image').val();
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
       // if($.trim(image)=="")
       // {
       //    $('#image').val('');
       //    $('#err_image').fadeIn();         
       //    $('#err_image').html('Please upload image.');
       //    $('#err_image').fadeOut(4000);
       //    $('html, body').animate({
       //          scrollTop: $('#main-content').offset().top
       //      }, 'slow');
       //    $('#image').focus();
       //    return false;
       // }
       if($.trim(desc)=="")
       {
          $('.desc').val('');
          $('#err_description').fadeIn();         
          $('#err_description').html('Please enter description.');
          $('#err_description').fadeOut(4000);
         
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
        if($.trim(meta_desc)=="")
       {
          $('#meta_desc').val('');
          $('#err_meta_desc').fadeIn();         
          $('#err_meta_desc').html('Please enter meta description.');
          $('#err_meta_desc').fadeOut(4000);
         
          $('#meta_desc').focus();
          return false;
       }
    
   });
});
   
</script>
@endsection

