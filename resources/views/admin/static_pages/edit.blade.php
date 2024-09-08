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

            <form method="post" action="{{$module_url_path.'/update/'.$enc_id}}" class="form-horizontal" id="validation-form">
            {{ csrf_field() }}
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Page Name <i class="red">*</i></label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="page_name" placeholder="Page Name" id="page_name" class="form-control" data-rule-required="true" data-rule-maxlength="255" value="{{isset($pages_data['page_name'])?$pages_data['page_name']:''}}">
                    <span class='help-block'>{{ $errors->first('page_name') }}</span>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Page Title<i class="red">*</i></label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="page_title" placeholder="Page Title" id="page_title" class="form-control" data-rule-required="true" data-rule-maxlength="255" value="{{isset($pages_data['page_title'])?$pages_data['page_title']:''}}">
                    <span class='help-block'>{{ $errors->first('page_title') }}</span>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Meta Title
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="meta_title" placeholder="Meta Title" id="meta_title" class="form-control" data-rule-required="true" data-rule-maxlength="255" value="{{isset($pages_data['meta_title'])?$pages_data['meta_title']:''}}">
                   <span class='help-block'>{{ $errors->first('meta_title') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Meta Keyword
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                    <input type="text" name="meta_keyword" placeholder="Meta Keyword" id="meta_keyword" class="form-control" data-rule-required="true" data-rule-maxlength="255" value="{{isset($pages_data['meta_keyword'])?$pages_data['meta_keyword']:''}}">
                   <span class='help-block'>{{ $errors->first('meta_keyword') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_desc">Meta Description
                       <i class="red">*</i>
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">
                     <input type="text" name="meta_desc" placeholder="Meta Description" id="meta_desc" class="form-control" data-rule-required="true" data-rule-maxlength="255" value="{{isset($pages_data['meta_desc'])?$pages_data['meta_desc']:''}}">
                     <span class='help-block'>{{ $errors->first('meta_desc') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_desc">Page Content
                     <i class="red">*</i>
                  </label>
                   <div class="col-sm-6 col-lg-8 controls">
                       <textarea name="page_desc" placeholder="Page Content" id="page_desc" class="form-control" data-rule-required="true">{{isset($pages_data['page_desc'])?$pages_data['page_desc']:''}}  </textarea>                
                    <span class='help-block'>{{ $errors->first('page_desc') }}</span>
                  </div>
                </div>
             <br>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <button type="submit" name="btn_save" class="btn btn-success" onclick="saveTinyMceContent()">Save</button>
             </div>
            </div>
          </form> 
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
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
  </script>

  @stop
