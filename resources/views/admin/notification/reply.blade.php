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

            
            <form method="post" action="{{url($module_url_path.'/send')}}" id="validation-form" class="form-horizontal">
            {{ csrf_field() }}
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Email
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="email" placeholder="Email" readonly="" id="email" class="form-control" value="{{isset($arr_data['email'])?$arr_data['email']:''}}">
                    <span class='help-block'>{{ $errors->first('email') }}</span>
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_desc">Message
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <textarea name="message" placeholder="Message" data-rule-required="true" id="message" class="form-control"></textarea>
                     <span class='help-block'>{{ $errors->first('message') }}</span>
                  </div>
                </div>
             <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <button type="submit" id="btn_send_response" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Send</button>
             </div>
            </div>
            </form>
          </div>

        </div>
      </div>
    </div>
 
  <!-- END Main Content -->

  <script>
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
      });  
    });
  </script>

  @stop
