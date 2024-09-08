@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">

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
                <i class="fa fa-list"></i>
                <a href="{{ $module_url_path }}">{{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-edit"></i>
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

            <form method="post" name="frm_faq" id="frm_faq" action="{{ url($module_url_path)}}/update/{{isset($arr_faq['id']) ? base64_encode($arr_faq['id']):0 }}" class="form-horizontal" >
               {{ csrf_field() }}
               
                <div class="col-sm-6 col-lg-6">
                        
                         <div class="form-group">
                          <label class="col-sm-3 col-lg-4 control-label" for="user_type">User Type
                          <i class="red">*</i>
                          </label>
                          <div class="col-sm-6 col-lg-8 controls">
                              <select class="form-control" id="user_type" name="user_type">
                                <option value="" > Select User Type</option>
                                <option value="doctor" <?php if( isset( $arr_faq['user_type'] ) && $arr_faq['user_type']=='doctor'): echo 'selected'; endif;  ?> > Doctor</option>
                                <option value="patient" <?php if( isset( $arr_faq['user_type'] ) && $arr_faq['user_type']=='patient'): echo 'selected'; endif;  ?> >Patient</option>
                                <option value="front" <?php if( isset( $arr_faq['user_type'] ) && $arr_faq['user_type']=='front'): echo 'selected'; endif;  ?> >Front</option>
                              </select>
                             <span id="err_user_type" style="color:red;">{{ $errors->first('user_type') }}</span>
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-4 control-label" for="question">Question
                            <i class="red">*</i>
                            </label>
                            <div class="col-sm-6 col-lg-8 controls">
                                <input type="text" name="question" id="question" class="form-control"  placeholder="Question" value="{{ isset($arr_faq['question'] ) && !empty( $arr_faq['question'] ) ? decrypt_value( $arr_faq['question'] ) : ''}}">   
                             <span id="err_question" style="color:red;">{{ $errors->first('question') }} </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-4 control-label" for="answer">Answer
                            <i class="red">*</i>
                            </label>
                            <div class="col-sm-6 col-lg-8 controls">
                               <textarea class="form-control" rows="5"  name="answer" id="answer" placeholder="Answer"> {{ isset($arr_faq['answer'] ) && !empty( $arr_faq['answer'] ) ? decrypt_value( $arr_faq['answer'] ) : ''}} </textarea>  
                             <span id="err_answer" style="color:red;">{{ $errors->first('answer') }} </span>
                            </div>
                        </div>
                </div>
               <br>

               <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <button type="button" id="btn_save" name="btn_save" class="btn btn-success" >Update</button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>

<!-- END Main Content -->

<script type="text/javascript">

 $('#btn_save').click(function()
 {
      var user_type  = $('#user_type').val();
      var question   = $('#question').val();
      var answer     = $('#answer').val();

      if ($.trim(user_type) == '') 
      {
          $('#err_user_type').show();
          $('#user_type').focus();
          $('#err_user_type').html('Please select user type');
          $('#err_user_type').fadeOut(8000);
          return false;
      }
      else if ($.trim(question) == '')
      {
          $('#err_question').show();
          $('#question').focus();
          $('#err_question').html('Please enter question.');
          $('#err_question').fadeOut(8000);
          return false;
      }
      else if ($.trim(answer) == '')
      {
          $('#err_answer').show();
          $('#answer').focus();
          $('#err_answer').html('Please enter answer.');
          $('#err_answer').fadeOut(8000);
          return false;
      }
      else
      {
          $('#frm_faq').submit();
      }
  });


</script>

@stop                    
