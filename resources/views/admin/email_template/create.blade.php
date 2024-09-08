@extends('admin.layout.master')
@section('main_content')
<!-- BEGIN Page Title -->
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
      <i class="fa fa-desktop"></i>
      <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
      </span> 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
      </span>
      <li class="active">{{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3>
               <i class="fa fa-text-width"></i>
               {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
               <a data-action="collapse" href="#"></a>
               <a data-action="close" href="#"></a>
            </div>
         </div>
         <div class="box-content">
            @include('admin.layout._operation_status') 

            <form method="post" action="{{url($module_url_path.'/store')}}" onsubmit="return validateform()" id="validation-form" enctype="multipart/form-data" class="form-horizontal" name="form-horizontal" >
             
               {{ csrf_field() }}
               
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Name 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                     <input type="text" name="template_name" id="template_name" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template Name'  value="{{ old('template_name') }}"/> 
                    <span class='help-block'> {{ $errors->first('template_name') }} 
                  </div>
                  <span id="err_template" style="color:red;"></span>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Subject 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <input type="text" name="template_subject" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template Subject'  value="{{ old('template_subject') }}"/> 
                   <span class='help-block'> {{ $errors->first('template_subject') }} 
              </span>
                  </div>

               </div>
              
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Body 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <textarea rows='10'  name="template_html" class='form-control wysihtml5' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template Subject'  value="{{ old('template_html') }}">
                </textarea>
                    <span class='help-block'> {{ $errors->first('template_html') }} 
              </span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Variables 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <input type="text" name="variables[]" class='form-control' data-rule-required='true' data-rule-maxlength='500' placeholder='Variables' />
                    <span id="err_desc2" style="color:red;"></span>
                 <a class="btn btn-primary" href="javascript:void(0)" onclick="add_text_field()">
                <i class="fa fa-plus">
                </i>
              </a>
              <a class="btn btn-danger" href="javascript:void(0)" onclick="remove_text_field(this)">
                <i class="fa fa-minus">
                </i>
              </a>
              <span class='help-block'> 
              </span>  
                  </div>
               </div>

               <div id="append_variables">
            </div>
               <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <input type="submit" name="" class='btn btn btn-primary' value='true' onclick='saveTinyMceContent()' />
              </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>


<!-- END Main Content -->
<script>
    function add_text_field() 
    {
      var html = "<div class='form-group appended' id='appended'><label class='col-sm-3 col-lg-2 control-label'></label><div class='col-sm-6 col-lg-4 controls'><input class='form-control' name='variables[]' data-rule-required='true' placeholder='Variables' /></div><div id='append_variables'></div></div>";
      jQuery("#append_variables").append(html);
    }
    function remove_text_field(elem)
    {
      $( ".appended:last" ).remove();
    }
    function saveTinyMceContent()
    {
      tinyMCE.triggerSave();
    }
    $(document).ready(function()
                      {
      tinymce.init({
        selector: 'textarea',
        height:350,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
        content_css: [
          '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
          '//www.tinymce.com/css/codepen.min.css'
        ]
      }
      );
    }
    );

     /*function validateform()
     {
       var template_name= document.forms["form-horizontal"]["template_name"].value;
      if(template_name=="")
       {
          document.getElementById('err_template').innerHTML="Please Enter Processing Fees"; 
           return false;
       }

     }*/


  </script>
@stop