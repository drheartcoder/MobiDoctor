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
      <li><i class="fa fa-list"></i><a href="{{$category_url_path}}">{{ $category_module_title or ''}}</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
       <i class="fa fa-plus"></i>
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
      <form method="post" action="{{url($module_url_path.'/store')}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         {{ csrf_field() }}
         <div class="box-content">
            @include('admin.layout._operation_status') 
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN Left Side -->
                  <div class="box-content">
                    <br/>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="page_title">Category
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-4 col-lg-4 controls">
                            <select name="category_id" id="category_id" class="form-control">
                              <option value="">--Select--</option>
                              @if(isset($arr_category) && sizeof($arr_category)>0)
                                 @foreach($arr_category as $category)
                                    <option value="{{$category['id']}}">{{isset($category['name'])?decrypt_value($category['name']):''}}</option>
                                 @endforeach
                              @endif
                           </select>
                           <div class="err" id="err_category_id"></div>
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

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label" for="meta_desc">Is Investigation Details
                        <i class="red">*</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <div class="radio-btn">
                                <input class="is_investigation_details" type="radio" name="is_investigation_details" id="yes" value="Yes"/>Yes
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="is_investigation_details" type="radio" name="is_investigation_details" id="no" value="No" checked/>No
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>

                    <input type="hidden" name="is_investigation_details" id="is_investigation_details">

                    <div class="form-group box_content">
                        <label class="col-sm-3 col-lg-3 control-label" for="common">Common
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html1' name="common" rows='10'placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('common') }} </span> 
                              <div class="err" id="err_template_html1"></div>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/> 

                    <div class="form-group box_content">
                        <label class="col-sm-3 col-lg-3 control-label" for="symptoms">Symptoms
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html2' name="symptoms" rows='10' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('symptoms') }} </span> 
                              <div class="err" id="err_template_html2"></div>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/> 

                    <div class="form-group box_content">
                        <label class="col-sm-3 col-lg-3 control-label" for="causes">Causes
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html3' name="causes" rows='10' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('causes') }} </span> 
                              <div class="err" id="err_template_html3"></div>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/> 

                    <div class="form-group box_content">
                        <label class="col-sm-3 col-lg-3 control-label" for="treatment_prevention">Treatment & Prevention
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html4' name="treatment_prevention" rows='10' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('treatment_prevention') }} </span> 
                              <div class="err" id="err_template_html4"></div>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/> 

                    <div class="form-group normal_page">
                        <label class="col-sm-3 col-lg-3 control-label" for="description">Description
                        <i class="red">*</i>
                        </label>
                        <div class="form-group">
                           <div class="col-sm-8 col-lg-8 controls">
                              <textarea class='form-control desc' id='template_html5' name="description" rows='10' placeholder='Email Template Body'></textarea>
                              <span class='help-block'> {{ $errors->first('description') }} </span> 
                              <div class="err" id="err_template_html5"></div>
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
<!-- END Main Content --> 
<script>
$(document).ready(function()
{    
    var is_investigation_details = $('.is_investigation_details:checked').val();

    if(is_investigation_details == 'Yes' )
    {
        $(".box_content").show();
    }
    else
    {
        $(".box_content").hide();
        $(".normal_page").show();
    }

});

$('.is_investigation_details').change(function(){

    var is_investigation_details = $('.is_investigation_details:checked').val();

    if(is_investigation_details == 'Yes' )
    {
        $(".box_content").show();
        $(".normal_page").hide();
    }
    else
    {
        $(".box_content").hide();
        $(".normal_page").show();
    }

});

$('#valid').click(function()
{
    var category_id        = $('#category_id').val();
    var meta_title         = $('#meta_title').val();
    var meta_keyword       = $('#meta_keyword').val();
    var metadesc           = $('#metadesc').val();
    
    var is_investigation_details     = $('.is_investigation_details:checked').val();
    $('#is_investigation_details').val(is_investigation_details);

    var template_html1  = tinymce.get('template_html1').getContent();
    var template_html2  = tinymce.get('template_html2').getContent();
    var template_html3  = tinymce.get('template_html3').getContent();
    var template_html4  = tinymce.get('template_html4').getContent();
    var template_html5  = tinymce.get('template_html5').getContent();
    
   if($.trim(category_id) == "")
   {
      $('#category_id').val('');
      $('#err_category_id').fadeIn();         
      $('#err_category_id').html('Please select category.');
      $('#err_category_id').fadeOut(4000);
      $('#category_id').focus();
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
    
    if(is_investigation_details == 'Yes' )
    {
        if($.trim(template_html1) == "")
        {
            $('#template_html1').val('');
            $('#err_template_html1').fadeIn();         
            $('#err_template_html1').html('This field is required.');
            $('#err_template_html1').fadeOut(4000);
            $('#template_html1').focus();
            return false;
        }
        if($.trim(template_html2) == "")
        {
            $('#template_html2').val('');
            $('#err_template_html2').fadeIn();         
            $('#err_template_html2').html('This field is required.');
            $('#err_template_html2').fadeOut(4000);
            $('#template_html2').focus();
            return false;
        }
        if($.trim(template_html3) == "")
        {
            $('#template_html3').val('');
            $('#err_template_html3').fadeIn();         
            $('#err_template_html3').html('This field is required.');
            $('#err_template_html3').fadeOut(4000);
            $('#template_html3').focus();
            return false;
        }
        if($.trim(template_html4) == "")
        {
            $('#template_html4').val('');
            $('#err_template_html4').fadeIn();         
            $('#err_template_html4').html('This field is required.');
            $('#err_template_html4').fadeOut(4000);
            $('#template_html4').focus();
            return false;
        }
    }
    else
    {
        if($.trim(template_html5) == "")
        {
            $('#template_html5').val('');
            $('#err_template_html5').fadeIn();         
            $('#err_template_html5').html('This field is required.');
            $('#err_template_html5').fadeOut(4000);
            $('#template_html5').focus();
            return false;
        }

    }

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
});
   
</script>
@endsection

