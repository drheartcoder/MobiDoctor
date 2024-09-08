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
      <li><i class="fa fa-list"></i><a href="{{$module_url_path}}">{{ $module_title or ''}}</a></li>
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
                        
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="page_title">Category
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                    <select name="category_id" id="category_id" class="form-control" onchange="load_subcategory(this);" data-rule-required="true">
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

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="page_title">Sub Category
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                    <select name="sub_category_id" id="sub_category" class="form-control" data-rule-required="true">
                                   </select>
                                   <div class="err" id="err_sub_category"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_title"> Meta Title
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title">
                                   <div class="err" id="err_meta_title"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_keyword"> Meta Keyword
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Meta Keyword">
                                   <div class="err" id="err_meta_keyword"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_desc">Meta Description
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_desc" class="form-control" id="metadesc" placeholder="Meta description" >
                                   <div class="err" id="err_metadesc"></div>
                                </div>
                            </div>

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

                            <div class="form-group tab_section">
                                <label class="col-sm-3 col-lg-3 control-label" for="page_title">Select Tab
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                    <select name="tab" id="tab" class="form-control">
                                      <option value="">--Select Tab--</option>
                                      <option value="Overview">Overview</option>
                                      <option value="Symptoms">Symptoms</option>
                                      <option value="Treatment">Treatment</option>
                                      <option value="Causes">Causes</option>
                                      <option value="Diagnosis">Diagnosis</option>
                                      <option value="Pregnancy">Pregnancy</option>                                    
                                   </select>
                                   <div class="err" id="err_tab"></div>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="description">Question<i class="red">*</i></label>
                                <div class="form-group">
                                  
                                  <div class="col-sm-8 col-lg-6 controls">
                                      <input type="text" name="question[]" data-rule-required="true" class="form-control desc">
                                      <span class='help-block'> {{ $errors->first('description') }} </span> 
                                      <div class="err" id="err_template_html1"></div>
                                  </div>

                                   <div class="col-sm-3 col-lg-2 controls">
                                    <button type="button" id="btn_type_1" class="btn btn-success" onclick="addNormalTypeQuestion()"><i class="fa fa-plus"> </i></button>
                                   </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="description">Description
                                <i class="red">*</i>
                                </label>
                                <div class="form-group">
                                   <div class="col-sm-8 col-lg-6 controls">
                                      <textarea class='form-control desc' name="answer[]" rows='10' placeholder='Email Template Body' data-rule-required="true"></textarea>
                                      <span class='help-block'> {{ $errors->first('description') }} </span> 
                                      <div class="err" id="err_template_html2"></div>
                                   </div>
                                </div>
                            </div>
                            <div id="append_question_div"></div>

                        </div>
                    </div>
                </div>

                <center>
                    <input type="hidden" name="normal_type_question_cnt" id="normal_type_question_cnt" value="1">
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

function addNormalTypeQuestion()
{
    var normal_type_question_cnt =  parseInt($('#normal_type_question_cnt').val());

    var normal_question_html = '';

    normal_question_html+='<div id="normal_typ_equestion_div_'+normal_type_question_cnt+'" class="normal_typ_equestion_div">';
    normal_question_html+= '<div class="form-group">';
    normal_question_html+= '    <label class="col-sm-3 col-lg-3 control-label" for="description">Question<i class="red">*</i></label>';
    normal_question_html+= '    <div class="form-group">';
    normal_question_html+= '      <div class="col-sm-8 col-lg-6 controls">';
    normal_question_html+= '          <input type="text" name="question['+normal_type_question_cnt+']" class="form-control desc" data-rule-required="true">';
    normal_question_html+= '          <span class="help-block"></span> ';
    normal_question_html+= '          <div class="err" id="err_template_html5"></div>';
    normal_question_html+= '      </div>';
    normal_question_html+= '       <div class="col-sm-3 col-lg-2 controls">';
    normal_question_html+= '        <button type="button" class="btn btn-danger" data-question-cnt="'+normal_type_question_cnt+'" onclick="removeNormalTypeQuestion(this)"><i class="fa fa-minus"></i></button>';
    normal_question_html+= '       </div>';
    normal_question_html+= '    </div>';
    normal_question_html+= '</div>';

    normal_question_html+= '<div class="form-group">';
    normal_question_html+= '    <label class="col-sm-3 col-lg-3 control-label" for="description">Description<i class="red">*</i></label>';
    normal_question_html+= '    <div class="form-group">';
    normal_question_html+= '       <div class="col-sm-8 col-lg-6 controls">';
    normal_question_html+= '          <textarea text-editor class="form-control desc" id="answer_'+normal_type_question_cnt+'" name="answer['+normal_type_question_cnt+']" rows="10" placeholder="Email Template Body" data-rule-required="true"></textarea>';
    normal_question_html+= '          <span class="help-block"></span> ';
    normal_question_html+= '          <div class="err" id="err_template_html5"></div>';
    normal_question_html+= '       </div>';
    normal_question_html+= '    </div>';
    normal_question_html+= '</div>';
    normal_question_html+='</div>';

    $('#append_question_div').append(normal_question_html);
    var answer_id = '#answer_'+normal_type_question_cnt;

    $(document).ready(function()
    {
          tinymce.init({
            selector: answer_id,
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

    normal_type_question_cnt = normal_type_question_cnt +1;
    $('#normal_type_question_cnt').val(normal_type_question_cnt);
}

function removeNormalTypeQuestion(ref)
{
    var data_question_cnt = $(ref).attr('data-question-cnt');    
    $('#normal_typ_equestion_div_'+data_question_cnt).remove();
}

$(document).ready(function()
{    
    var is_investigation_details = $('.is_investigation_details:checked').val();

    if(is_investigation_details == 'Yes' )
    {
        $(".tab_section").show();
    }
    else
    {
        $(".tab_section").hide();
    }

});

$('.is_investigation_details').change(function(){

    var is_investigation_details = $('.is_investigation_details:checked').val();

    if(is_investigation_details == 'Yes' )
    {
        $(".tab_section").show();
    }
    else
    {
        $(".tab_section").hide();
    }

});

$('#valid').click(function()
{    
    var tab                = $('#tab').val();
    var is_investigation_details     = $('.is_investigation_details:checked').val();

    if(is_investigation_details == 'Yes' )
    {
        if($.trim(tab) == "")
        {
            $('#tab').val('');
            $('#err_tab').fadeIn();         
            $('#err_tab').html('Please select tab.');
            $('#err_tab').fadeOut(4000);
            $('#tab').focus();
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

var url = "{{ $module_url_path }}";
function load_subcategory(ref)
{ 
    var category_id = $("#category_id").val();
    var processing = $.ajax({ 
                        url:url+'/get_subcategory',
                        type:'GET',
                        data: {category_id:category_id},
                        success: function (response) 
                        {
                            $('#sub_category').html(response);                         
                        }
                    });
}
</script>
@endsection

