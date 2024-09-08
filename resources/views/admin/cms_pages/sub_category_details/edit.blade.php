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
        <form method="post" action="{{url($module_url_path.'/update')}}" id="validation-form" class="form-horizontal" enctype="multipart/form-data" name="Form" >
         {{ csrf_field() }}
         <input type="hidden" name="enc_id" value="{{$enc_id}}">
            <div class="box-content">
                @include('admin.layout._operation_status') 
                <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN Left Side -->
                        <div class="box-content">
                        
                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="page_title">Category
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                   <input type="text" name="category_name" class="form-control" id="category_name" value="{{isset($arr_sub_category_details['category_details']['name'])?decrypt_value($arr_sub_category_details['category_details']['name']):''}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="page_title">Sub Category
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                    <input type="text" name="sub_category_name" class="form-control" id="sub_category_name" value="{{isset($arr_sub_category_details['sub_category_details']['name'])?decrypt_value($arr_sub_category_details['sub_category_details']['name']):''}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_title"> Meta Title
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title" value="{{isset($arr_sub_category_details['meta_title'])?$arr_sub_category_details['meta_title']:''}}">
                                   <div class="err" id="err_meta_title"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_keyword"> Meta Keyword
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Meta Keyword"value="{{isset($arr_sub_category_details['meta_keyword'])?$arr_sub_category_details['meta_keyword']:''}}">
                                   <div class="err" id="err_meta_keyword"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_desc">Meta Description
                                <i class="red">*</i>
                                </label>
                                <div class="col-sm-8 col-lg-6 controls">
                                   <input type="text" name="meta_desc" class="form-control" id="metadesc" placeholder="Meta description" value="{{isset($arr_sub_category_details['meta_desc'])?$arr_sub_category_details['meta_desc']:''}}">
                                   <div class="err" id="err_metadesc"></div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-3 col-lg-3 control-label" for="meta_desc">Is Investigation Details
                                </label>
                                <div class="col-sm-4 col-lg-4 controls">
                                    <div class="radio-btn">
                                        @if(isset($arr_sub_category_details['is_investigation_details']) && $arr_sub_category_details['is_investigation_details']!='' && $arr_sub_category_details['is_investigation_details']=='Yes')
                                           <input type="text" name="tab" class="form-control" value="Yes" readonly>
                                        @elseif(isset($arr_sub_category_details['is_investigation_details']) && $arr_sub_category_details['is_investigation_details']!='' && $arr_sub_category_details['is_investigation_details']=='No')
                                           <input type="text" name="tab" class="form-control" value="No" readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="is_investigation_details" value="{{$arr_sub_category_details['is_investigation_details']}}">
                            
                            
                            @if(isset($arr_sub_category_details['is_investigation_details']) && $arr_sub_category_details['is_investigation_details']!='' && $arr_sub_category_details['is_investigation_details']=='Yes')
                              <div class="form-group tab_section">
                                  <label class="col-sm-3 col-lg-3 control-label" for="page_title">Select Tab
                                  <i class="red">*</i>
                                  </label>
                                  <div class="col-sm-4 col-lg-4 controls">
                                      <input type="text" name="tab" class="form-control" value="{{isset($arr_sub_category_details['tab_name'])?$arr_sub_category_details['tab_name']:''}}" readonly>
                                  </div>
                              </div>
                            @endif

                            @if(isset($arr_sub_category_details['get_question_answer']) && count($arr_sub_category_details['get_question_answer'])>0)
                              
                              @foreach($arr_sub_category_details['get_question_answer'] as $key => $value)

                                <div id="normal_typ_equestion_div_{{$key}}" class="normal_typ_equestion_div">

                                  <div class="form-group">
                                      <label class="col-sm-3 col-lg-3 control-label" for="description">Question<i class="red">*</i></label>
                                      <div class="form-group">
                                        
                                        <div class="col-sm-8 col-lg-6 controls">
                                            <input type="text" name="question[]" data-rule-required="true" class="form-control desc" value="{{ isset($value['question']) ? $value['question'] : '' }}">
                                            <span class='help-block'> {{ $errors->first('description') }} </span> 
                                            <div class="err" id="err_template_html1"></div>
                                        </div>

                                         <div class="col-sm-3 col-lg-2 controls">
                                          @if($key == 0)
                                            <button type="button" class="btn btn-success" onclick="addNormalTypeQuestion()"><i class="fa fa-plus"> </i></button>
                                          @else
                                            <button type="button" class="btn btn-danger" data-question-cnt="{{ $key }}" onclick="removeNormalTypeQuestion(this)"><i class="fa fa-minus"></i></button>
                                          @endif
                                         </div>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 col-lg-3 control-label" for="description">Description
                                      <i class="red">*</i>
                                      </label>
                                      <div class="form-group">
                                         <div class="col-sm-8 col-lg-6 controls">
                                            <textarea class='form-control desc' name="answer[]" rows='10' placeholder='Email Template Body' data-rule-required="true">{{ isset($value['answer']) ? $value['answer'] : '' }}</textarea>
                                            <span class='help-block'> {{ $errors->first('description') }} </span> 
                                            <div class="err" id="err_template_html2"></div>
                                         </div>
                                      </div>
                                  </div>
                                </div>
                              @endforeach

                            @else
                            
                            <div id="normal_typ_equestion_div_0" class="normal_typ_equestion_div">

                              <div class="form-group">
                                  <label class="col-sm-3 col-lg-3 control-label" for="description">Question<i class="red">*</i></label>
                                  <div class="form-group">
                                    
                                    <div class="col-sm-8 col-lg-6 controls">
                                        <input type="text" name="question[]" data-rule-required="true" class="form-control desc">
                                        <span class='help-block'> {{ $errors->first('description') }} </span> 
                                        <div class="err" id="err_template_html1"></div>
                                    </div>

                                     <div class="col-sm-3 col-lg-2 controls">
                                      <button type="button" class="btn btn-success" onclick="addNormalTypeQuestion()"><i class="fa fa-plus"> </i></button>
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
                            </div>
                            @endif

                    

                            <div id="append_question_div"></div>
                        </div>
                    </div>
                </div>

                <center>
                    
                    <input type="hidden" name="normal_type_question_cnt" id="normal_type_question_cnt" value="{{ isset($arr_sub_category_details['get_question_answer']) ? count($arr_sub_category_details['get_question_answer']) : '0' }}">

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
        // '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
      ]
    });
    
    normal_type_question_cnt = normal_type_question_cnt +1;
    $('#normal_type_question_cnt').val(normal_type_question_cnt);
}

function removeNormalTypeQuestion(ref)
{
    var data_question_cnt = $(ref).attr('data-question-cnt');    
    $('#normal_typ_equestion_div_'+data_question_cnt).remove();
}



$('#valid').click(function()
{    

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
          // '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
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

