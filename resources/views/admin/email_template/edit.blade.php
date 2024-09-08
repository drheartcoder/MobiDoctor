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

            <form method="post" action=" <?php echo $module_url_path.'/update/'.base64_encode($arr_data['id']); ?>" id="validation-form" enctype="multipart/form-data" class="form-horizontal" name="form-horizontal" >
             
               {{ csrf_field() }}
               
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Name 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <input type="text" name="template_name" value="{{ $arr_data['template_name'] }}" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template Name' />
                    <span class='help-block'> {{ $errors->first('template_name') }} </span>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template From 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                     <input type="text" name="template_from" value="{{ $arr_data['template_from'] }}" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template From' />
                   <span class='help-block'> {{ $errors->first('template_from') }} </span> 
                  </div>
               </div>
              
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template From Email 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <input type="text" name="template_from_mail" value="{{ $arr_data['template_from_mail'] }}" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template From Email' />
                    <span class='help-block'> {{ $errors->first('template_from_mail') }} </span>
                  </div>
               </div>
                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Subject 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <input type="text" name="template_subject" value="{{ $arr_data['template_subject'] }}" class='form-control' data-rule-required='true' data-rule-maxlength='255' placeholder='Email Template subject' />
                     <span class='help-block'> {{ $errors->first('template_subject') }} </span>
                  </div>
               </div>
               
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="email"> Email Template Body 
                <i class="red">*
                </i> 
              </label>
                  <div class="col-sm-6 col-lg-7 controls">
                    <textarea class='form-control' id='template_html' name="template_html" rows='10' data-rule-required='true' placeholder='Email Template Body'>{{$arr_data['template_html']}}</textarea>
                  <span class='help-block'> {{ $errors->first('template_html') }} </span> 
                    <span> Variables: </span>
                    @if(sizeof($arr_variables)>0)
                        @foreach($arr_variables as $variable)
                            <br> <label> {{ $variable }} </label> 
                        @endforeach
                    @endif 
                  </div>
               </div>
               
               <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                 <input type="submit" name="Update" class='btn btn btn-primary' value='true' />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <a class="btn btn btn-primary" target="_blank" href="{{ url('/admin/email_template').'/view/'.base64_encode($arr_data['id']) }}"  title="Preview">
                  <i class="fa fa-eye" ></i> Preview
                </a>
              </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>


<!-- END Main Content -->
<script>
    $('#validation-form').submit(function(){
        tinyMCE.triggerSave();
     });

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
    });
  </script>
@stop