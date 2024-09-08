/*
|
|function used for load sub question type details
|
*/
function loadSubTypeQuestions(ref) 
{
    var question_type_id = $(ref).val();

    $('#enc_question_type_id').val(question_type_id);

    var question_name = $(ref).find(':selected').attr('data-question-name');

    if(question_type_id && question_type_id!="" && question_type_id!=0 && question_type_id==2)
    {
        $('#questions_sub_type_id').removeAttr('disabled');

        $('#questions_sub_type_div').show();
        $('#questions_sub_type_id').attr('data-rule-required',true);
        $('select[id="questions_sub_type_id"]').find('option').remove().end().append('<option value="">-- Select Sub Questions Type --</option>').val('');

        $.ajax({
              url:locations_url_path+'/get_sub_question_type?question_type_id='+btoa(question_type_id),
              type:'GET',
              data:'flag=true',
              dataType:'json',
             beforeSend:function()
              {
                  showProcessingOverlay();
                  $('select[id="questions_sub_type_id"]').attr('readonly','readonly');
              },
              success:function(response)
              {
                  if(response.status=="success")
                  {
                      $('select[id="questions_sub_type_id"]').removeAttr('readonly');

                      if(typeof(response.arr_questions_sub_type) == "object")
                      {
                         var option = '<option value="">-- Select Sub Questions Type --</option>'; 
                         $(response.arr_questions_sub_type).each(function(index,value)
                         {
                              option+='<option data-sub-question-name="'+value.name+'" value="'+value.id+'">'+value.name+'</option>';
                         });

                         $('select[id="questions_sub_type_id"]').html(option);
                         hideProcessingOverlay();
                      }

                      hideProcessingOverlay();
                  }
                  hideProcessingOverlay();
                  return false;
              },error:function(res){
                hideProcessingOverlay();
              }    
        });

        $('#btn_change_question_type_div').show();
        
        
        $(ref).attr('disabled','true');

        $('#type_1_div').hide();
        
    }
    else
    {
      if(question_type_id == 1)
      {
        $('#btn_change_question_type_div').show();
        $('#btn_submit_div').show();
        $(ref).attr('disabled','true');
          
        $('#type_1_div').show();
        //$('#btn_type_1').html('Add '+question_name+' Question');

        $('#type_2_div').hide();
        //$('#btn_type_2').html('');

        $('#hr_line').show();
        var normal_type_question_cnt =  parseInt($('#normal_type_question_cnt').val());

        var normal_question_html = '';
        normal_question_html+='<div id="normal_typ_equestion_div_'+normal_type_question_cnt+'" class="normal_typ_equestion_div">';
        normal_question_html+='  <div class="form-group">';
        normal_question_html+='    <label class="control-label col-lg-2" for="question">Question<i class="red">*</i></label>';
        normal_question_html+='    <div class="col-lg-5">';
        normal_question_html+='      <textarea class="form-control text-editor ques" rows="5" data-src="arr_question_'+normal_type_question_cnt+'"  name="arr_normal_type_question[arr_question]['+normal_type_question_cnt+']" id="arr_question_'+normal_type_question_cnt+'" placeholder="Enter Question"></textarea>';
        normal_question_html+='   <label for="arr_question_'+normal_type_question_cnt+'" id="err'+normal_type_question_cnt+'" class="error"></lable></div>';
        normal_question_html+='   <input type="hidden" data-que="normal"  name="id_arr[]" id="que-id" value="'+normal_type_question_cnt+'">' ;  
        normal_question_html+='<div class="col-lg-2">';
        normal_question_html+=  '<button type="button" class="btn btn-danger" data-question-cnt="'+normal_type_question_cnt+'" onclick="removeNormalTypeQuestion(this)"><i class="fa fa-minus"></i></button>';
        normal_question_html+='</div>';

        normal_question_html+='  </div>';

        normal_question_html+='  <div class="form-group">';
        normal_question_html+='    <label class="control-label col-lg-2" for="answer">Answer<i class="red">*</i></label>';
        normal_question_html+='    <div class="col-lg-5">';
        normal_question_html+='      <input type="text" name="arr_normal_type_question[arr_answer]['+normal_type_question_cnt+']" id="arr_answer_'+normal_type_question_cnt+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" data-rule-number="true" >';
        normal_question_html+='    </div>';
        normal_question_html+='  </div>';


        normal_question_html+='  <div class="form-group">';
        normal_question_html+='    <label class="control-label col-lg-2" for="answer">Answer Unit</label>';
        normal_question_html+='    <div class="col-lg-5">';
        normal_question_html+='      <select name="arr_normal_type_question[arr_answer_unit]['+normal_type_question_cnt+']" id="arr_answer_unit_'+normal_type_question_cnt+'" class="form-control">';
        normal_question_html+='         <option value=""> -- Select Unit -- </option>';
        normal_question_html+='      </select>';                              
        normal_question_html+='    </div>';
        normal_question_html+='  </div>';

        // normal_question_html+='  <div class="form-group">';
        // normal_question_html+='    <label class="control-label col-lg-2" for="answer">Ideal Answer</label>';
        // normal_question_html+='    <div class="col-lg-5">';
        // normal_question_html+='      <textarea class="form-control" rows="5"  name="arr_normal_type_question[arr_ideal_answer]['+normal_type_question_cnt+']" id="arr_ideal_answer_'+normal_type_question_cnt+'" placeholder="Enter Ideal Answer"></textarea>';
        // normal_question_html+='    </div>';
        // normal_question_html+='  </div>';
        normal_question_html+='</div>';

        $('#append_question_div').append(normal_question_html);
        var question_id = '#arr_question_'+normal_type_question_cnt;

        $(document).ready(function()
        {
          tinymce.init({
            selector: question_id,
            theme: "modern",
            paste_data_images: true,
            plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
            ],
            valid_elements : '*[*]',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
            image_advtab: true,
            file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('.tinymce_upload').trigger('click');
                $('.tinymce_upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },
            content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
            ]
          });  
        });

        $.ajax({
              url:locations_url_path+'/get_answer_units',
              type:'GET',
              data:'flag=true',
              dataType:'json',
             beforeSend:function()
              {
                  showProcessingOverlay();
                  /*$('select[id="questions_sub_type_id"]').attr('readonly','readonly');*/
              },
              async: false,
              success:function(response)
              {
                 var select_id = 'arr_answer_unit_'+normal_type_question_cnt;
                  if(response.status=="success")
                  { 
                      /*$('select[id="questions_sub_type_id"]').removeAttr('readonly');*/
                      if(typeof(response.arr_units) == "object")
                      {
                         var option = '<option value="">-- Select unit --</option>';

                         $(response.arr_units).each(function(index,value)
                         {
                              option+='<option value="'+value.unit+'">'+value.unit+'</option>';
                         });

                         $('select[id="'+select_id+'"]').html(option);
                         hideProcessingOverlay();
                      }
                      hideProcessingOverlay();
                  }
                  hideProcessingOverlay();
                  return false;
              },error:function(res){
                hideProcessingOverlay();
              }    
        });  

        normal_type_question_cnt = normal_type_question_cnt +1;

        $('#normal_type_question_cnt').val(normal_type_question_cnt);

      }
      else
      {
        
        $('#type_1_div').hide();
        //$('#btn_type_1').html('');

        $('#btn_change_question_type_div').hide();
        $('#btn_submit_div').hide();
        $(ref).removeAttr('disabled');

      }
      
      $('#type_2_div').hide();
      //$('#btn_type_2').html('');

      $('#questions_sub_type_div').hide();
      $('select[id="questions_sub_type_id"]').find('option').remove().end().append('<option value="">-- Select Sub Questions Type --</option>').val('');
      $('#questions_sub_type_id').attr('data-rule-required',false);
    }
}

/*
|
|function used for remove desable of question type select box
|
*/

function confirmChangeQuestionType() {
  
  swal({
          title: "Are you sure ?",
          text: 'Do you really want to change Questions Type ?',
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
            if(isConfirm==true)
            {
                swal.close();   
                $('#questions_type_id').removeAttr('disabled');
                $('#append_question_div').html('');
                $('#normal_type_question_cnt').val('0');
                $('#mcq_type_question_cnt').val('0');
                location.reload();
            }
        });
}

/*
|
|function used to check sub question type select box value
|
*/

function checkSubTypeQuestion(ref){

    var question_sub_type_id = $(ref).val();

    if(question_sub_type_id!='')
    {
        var sub_question_name = $(ref).find(':selected').attr('data-sub-question-name');
        
        $('#btn_submit_div').show();

        $('#enc_question_sub_type_id').val(question_sub_type_id);

        $('#questions_sub_type_id').attr('disabled','true');
        $('#btn_change_sub_question_type_div').show();
        $('#type_2_div').show();

        var question_sub_type_id = $('#enc_question_sub_type_id').val();

        if(question_sub_type_id!='' && (question_sub_type_id == '1' || question_sub_type_id == '2'))
        {
            $('#hr_line').show();

            var mcq_type_question_cnt =  parseInt($('#mcq_type_question_cnt').val());

            var mcq_question_html = '';
            
            mcq_question_html+= '<div id="mcq_type_question_div_'+mcq_type_question_cnt+'" class="mcq_type_question_div">';
            // mcq_question_html+= '    <div class="form-group">';
            // mcq_question_html+= '      <label class="control-label col-lg-2" for="question">Question Description</label>';
            // mcq_question_html+= '        <div class="col-lg-5">';
            // mcq_question_html+= '          <textarea class="form-control" rows="3"  name="arr_mcq_type_question[arr_description]['+mcq_type_question_cnt+']" id="arr_mcq_question_description_'+mcq_type_question_cnt+'" placeholder="Enter Question Description"></textarea>';
            // mcq_question_html+= '        </div>';
            // mcq_question_html+= '    </div>';
            mcq_question_html+='   <input type="hidden" data-que="mcq" name="id_arr[]" id="que-id" value="'+mcq_type_question_cnt+'">' ;
            mcq_question_html+= '   <div class="form-group">';
            mcq_question_html+= '      <label class="control-label col-lg-2" for="question">Question<i class="red">*</i></label>';
            mcq_question_html+= '        <div class="col-lg-5">';
            mcq_question_html+= '          <textarea class="form-control text-editor ques" rows="3"  name="arr_mcq_type_question[arr_question]['+mcq_type_question_cnt+']" id="arr_mcq_question_'+mcq_type_question_cnt+'" placeholder="Enter Question"></textarea>';
            mcq_question_html+='           <label for="arr_question_'+mcq_type_question_cnt+'" id="err'+mcq_type_question_cnt+'" class="error"></lable>';
            mcq_question_html+= '     </div>';
            mcq_question_html+= '     <div class="col-lg-2">';
            mcq_question_html+= '          <button type="button" class="btn btn-danger" data-question-cnt="'+mcq_type_question_cnt+'" onclick="removeMcqTypeQuestion(this)"><i class="fa fa-minus"></i></button>';
            mcq_question_html+= '     </div>';
            mcq_question_html+= '   </div>';
              
            if(question_sub_type_id == '1') /*best of 5 questions*/
            { 
                for (var i = 0; i < 5; i++) 
                {
                    mcq_question_html+= ' <div class="form-group">';
                    mcq_question_html+= '          <label class="control-label col-lg-2" for="answer"></label>';
                    mcq_question_html+= '          <div class="col-lg-5 radio-min">';
                    mcq_question_html+= '        <div class="checkbox-box">';
                    mcq_question_html+= '          <label>';
                    mcq_question_html+= '            <input type="radio" class="styled" name="arr_mcq_type_question[arr_right_answer]['+mcq_type_question_cnt+']" id="arr_mcq_right_answer_'+mcq_type_question_cnt+'" value="'+i+'" >'; /*data-rule-required="true"*/
                    mcq_question_html+= '          </label>';
                    mcq_question_html+= '        </div>';
                    mcq_question_html+= '            <div class="answer-input">';
                    mcq_question_html+= '                <input type="text" name="arr_mcq_type_question[arr_answer]['+mcq_type_question_cnt+']['+i+']" id="arr_mcq_answer_'+mcq_type_question_cnt+'_'+i+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" >';
                    mcq_question_html+= '            </div>';
                    mcq_question_html+= '          </div>';
                    mcq_question_html+= '    </div>';
                }
                mcq_question_html+= '<div class="form-group"> <label class="control-label col-lg-2" for="answer"></label><div class="note-for-question col-lg-5"><span>Note :</span> Please select a right answer from above question </div></div>';
            }

            if(question_sub_type_id == '2') /*best of 8 questions*/
            { 
                for (var i = 0; i < 8; i++) 
                {
                    mcq_question_html+= '<div class="form-group">';
                    mcq_question_html+= '          <label class="control-label col-lg-2" for="answer"></label>';
                    mcq_question_html+= '          <div class="col-lg-5 radio-min">';
                    mcq_question_html+= '        <div class="checkbox-box">';
                    mcq_question_html+= '          <label>';
                    mcq_question_html+= '            <input type="radio" class="styled" name="arr_mcq_type_question[arr_right_answer]['+mcq_type_question_cnt+']" id="arr_mcq_right_answer_'+mcq_type_question_cnt+'" value="'+i+'">'; /*data-rule-required="true"*/
                    mcq_question_html+= '          </label>';
                    mcq_question_html+= '        </div>';
                    mcq_question_html+= '            <div class="answer-input">';
                    mcq_question_html+= '                <input type="text" name="arr_mcq_type_question[arr_answer]['+mcq_type_question_cnt+']['+i+']" id="arr_mcq_answer_'+mcq_type_question_cnt+'_'+i+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" >';
                    mcq_question_html+= '            </div>';
                    mcq_question_html+= '          </div>';
                    mcq_question_html+= '</div>';  
                }
                mcq_question_html+= '<div class="form-group"> <label class="control-label col-lg-2" for="answer"></label><div class="note-for-question col-lg-5"><span>Note :</span> Please select a right answer from above question </div></div>';
            }
            mcq_question_html+= '</div>';
            
            $('#append_question_div').append(mcq_question_html);
            var mcq_question_id = '#arr_mcq_question_'+mcq_type_question_cnt;
            
            $(document).ready(function()
            {
              tinymce.init({
                selector: mcq_question_id,
                theme: "modern",
                paste_data_images: true,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
                ],
                valid_elements : '*[*]',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
                image_advtab: true,
                file_picker_callback: function(callback, value, meta) {
                  if (meta.filetype == 'image') {
                    $('.tinymce_upload').trigger('click');
                    $('.tinymce_upload').on('change', function() {
                      var file = this.files[0];
                      var reader = new FileReader();
                      reader.onload = function(e) {
                        callback(e.target.result, {
                          alt: ''
                        });
                      };
                      reader.readAsDataURL(file);
                    });
                  }
                },
                content_css: [
                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                '//www.tinymce.com/css/codepen.min.css'
                ]
              });  
            });

            mcq_type_question_cnt = mcq_type_question_cnt +1;
            $('#mcq_type_question_cnt').val(mcq_type_question_cnt);
        }
    }
    else
    {
      $('#type_2_div').hide();
      $('#btn_change_sub_question_type_div').hide();
      $('#btn_submit_div').hide();
    }
}

/*
|
|function used for remove desable of sub question type select box
|
*/

function confirmChangeQuestionSubType() {
  
  swal({
          title: "Are you sure ?",
          text: 'Do you really want to change Sub Questions Type ?',
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
            if(isConfirm==true)
            {
                swal.close();   
                $('#questions_sub_type_id').removeAttr('disabled');
                $('#append_question_div').html('');
                $('#normal_type_question_cnt').val('0');
                $('#mcq_type_question_cnt').val('0');
                location.reload();
            }
        });
}

/*
|
|function used for adding normal type question
|
*/

function addNormalTypeQuestion()
{
   // $('#hr_line').show();
    var normal_type_question_cnt =  parseInt($('#normal_type_question_cnt').val());
    var normal_question_html = '';
    normal_question_html+='<div id="normal_typ_equestion_div_'+normal_type_question_cnt+'" class="normal_typ_equestion_div">';
    normal_question_html+='  <div class="form-group">';
    normal_question_html+='    <label class="control-label col-lg-2" for="question">Question<i class="red">*</i></label>';
    normal_question_html+='    <div class="col-lg-5">';
    normal_question_html+='      <textarea class="form-control text-editor ques" rows="5" data-src="arr_question_'+normal_type_question_cnt+'"  name="arr_normal_type_question[arr_question]['+normal_type_question_cnt+']" id="arr_question_'+normal_type_question_cnt+'" placeholder="Enter Question"></textarea>';
    normal_question_html+='   <label for="arr_question_'+normal_type_question_cnt+'" id="err'+normal_type_question_cnt+'" class="error"></lable></div>';
    normal_question_html+='   <input type="hidden" data-que="normal"  name="id_arr[]" id="que-id" value="'+normal_type_question_cnt+'">' ;  
    normal_question_html+='<div class="col-lg-2">';
    normal_question_html+=  '<button type="button" class="btn btn-danger" data-question-cnt="'+normal_type_question_cnt+'" onclick="removeNormalTypeQuestion(this)"><i class="fa fa-minus"></i></button>';
    normal_question_html+='</div>';

    normal_question_html+='  </div>';

    normal_question_html+='  <div class="form-group">';
    normal_question_html+='    <label class="control-label col-lg-2" for="answer">Answer<i class="red">*</i></label>';
    normal_question_html+='    <div class="col-lg-5">';
    normal_question_html+='      <input type="text" name="arr_normal_type_question[arr_answer]['+normal_type_question_cnt+']" id="arr_answer_'+normal_type_question_cnt+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" data-rule-number="true" >';
    normal_question_html+='    </div>';
    normal_question_html+='  </div>';

    normal_question_html+='  <div class="form-group">';
    normal_question_html+='    <label class="control-label col-lg-2" for="answer">Answer Unit</label>';
    normal_question_html+='    <div class="col-lg-5">';
    normal_question_html+='      <select name="arr_normal_type_question[arr_answer_unit]['+normal_type_question_cnt+']" id="arr_answer_unit_'+normal_type_question_cnt+'" class="form-control">';
    normal_question_html+='         <option value=""> -- Select Unit -- </option>';
    normal_question_html+='      </select>';                              
    normal_question_html+='    </div>';
    normal_question_html+='  </div>';

    // normal_question_html+='  <div class="form-group">';
    // normal_question_html+='    <label class="control-label col-lg-2" for="answer">Ideal Answer</label>';
    // normal_question_html+='    <div class="col-lg-5">';
    // normal_question_html+='      <textarea class="form-control" rows="5"  name="arr_normal_type_question[arr_ideal_answer]['+normal_type_question_cnt+']" id="arr_ideal_answer_'+normal_type_question_cnt+'" placeholder="Enter Ideal Answer"></textarea>';
    // normal_question_html+='    </div>';
    // normal_question_html+='  </div>';
    normal_question_html+='</div>';
                          
    $('#append_question_div').append(normal_question_html);
    var question_id = '#arr_question_'+normal_type_question_cnt;

    $(document).ready(function()
    {
      tinymce.init({
        selector: question_id,
        theme: "modern",
        paste_data_images: true,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
        image_advtab: true,
        file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('.tinymce_upload').trigger('click');
            $('.tinymce_upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
        content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
    
    $.ajax({
              url:locations_url_path+'/get_answer_units',
              type:'GET',
              data:'flag=true',
              dataType:'json',
             beforeSend:function()
              {
                  showProcessingOverlay();
              },
              async: false,
              success:function(response)
              {
                 var select_id = 'arr_answer_unit_'+normal_type_question_cnt;
                  if(response.status=="success")
                  { 
                      if(typeof(response.arr_units) == "object")
                      {
                         var option = '<option value="">-- Select unit --</option>';

                         $(response.arr_units).each(function(index,value)
                         {
                              option+='<option value="'+value.unit+'">'+value.unit+'</option>';
                         });

                         $('select[id="'+select_id+'"]').html(option);
                         hideProcessingOverlay();
                      }
                      hideProcessingOverlay();
                  }
                  hideProcessingOverlay();
                  return false;
              },error:function(res){
                hideProcessingOverlay();
              }    
        });  

    normal_type_question_cnt = normal_type_question_cnt +1;
    $('#normal_type_question_cnt').val(normal_type_question_cnt);
}



function addMCQTypeQuestion()
{
    var question_sub_type_id = $('#enc_question_sub_type_id').val();

    if(question_sub_type_id!='' && (question_sub_type_id == '1' || question_sub_type_id == '2'))
    {
        $('#hr_line').show();

        var mcq_type_question_cnt =  parseInt($('#mcq_type_question_cnt').val());

        var mcq_question_html = '';
        
        mcq_question_html+= '<div id="mcq_type_question_div_'+mcq_type_question_cnt+'" class="mcq_type_question_div">';
        // mcq_question_html+= '    <div class="form-group">';
        // mcq_question_html+= '      <label class="control-label col-lg-2" for="question">Question Description</label>';
        // mcq_question_html+= '        <div class="col-lg-5">';
        // mcq_question_html+= '          <textarea class="form-control" rows="3"  name="arr_mcq_type_question[arr_description]['+mcq_type_question_cnt+']" id="arr_mcq_question_description_'+mcq_type_question_cnt+'" placeholder="Enter Question Description"></textarea>';
        // mcq_question_html+= '        </div>';
        // mcq_question_html+= '    </div>';
        mcq_question_html+='   <input type="hidden" data-que="mcq" name="id_arr[]" id="que-id" value="'+mcq_type_question_cnt+'">' ;
        mcq_question_html+= '    <div class="form-group">';
        mcq_question_html+= '      <label class="control-label col-lg-2" for="question">Question<i class="red">*</i></label>';
        mcq_question_html+= '        <div class="col-lg-5">';
        mcq_question_html+= '          <textarea class="form-control text-editor ques" rows="3"  name="arr_mcq_type_question[arr_question]['+mcq_type_question_cnt+']" id="arr_mcq_question_'+mcq_type_question_cnt+'" placeholder="Enter Question"></textarea>';
        mcq_question_html+='   <label for="arr_question_'+mcq_type_question_cnt+'" id="err'+mcq_type_question_cnt+'" class="error"></lable>';
        mcq_question_html+= '    </div>';
        mcq_question_html+= '      <div class="col-lg-2">';
        mcq_question_html+= '          <button type="button" class="btn btn-danger" data-question-cnt="'+mcq_type_question_cnt+'" onclick="removeMcqTypeQuestion(this)"><i class="fa fa-minus"></i></button>';
        mcq_question_html+= '      </div>';
        mcq_question_html+= '</div>';
          
        if(question_sub_type_id == '1') /*best of 5 questions*/
        { 
            for (var i = 0; i < 5; i++) 
            {
                mcq_question_html+= ' <div class="form-group">';
                mcq_question_html+= '          <label class="control-label col-lg-2" for="answer"></label>';
                mcq_question_html+= '          <div class="col-lg-5 radio-min">';
                mcq_question_html+= '        <div class="checkbox-box">';
                mcq_question_html+= '          <label>';
                mcq_question_html+= '            <input type="radio" class="styled" name="arr_mcq_type_question[arr_right_answer]['+mcq_type_question_cnt+']" id="arr_mcq_right_answer_'+mcq_type_question_cnt+'" value="'+i+'" >'; /*data-rule-required="true"*/
                mcq_question_html+= '          </label>';
                mcq_question_html+= '        </div>';
                mcq_question_html+= '            <div class="answer-input">';
                mcq_question_html+= '                <input type="text" name="arr_mcq_type_question[arr_answer]['+mcq_type_question_cnt+']['+i+']" id="arr_mcq_answer_'+mcq_type_question_cnt+'_'+i+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" >';
                mcq_question_html+= '            </div>';
                mcq_question_html+= '          </div>';
                mcq_question_html+= '    </div>';
            }
            mcq_question_html+= '<div class="form-group"> <label class="control-label col-lg-2" for="answer"></label><div class="note-for-question col-lg-5"><span>Note :</span> Please select a right answer from above question </div></div>';
        }

        if(question_sub_type_id == '2') /*best of 8 questions*/
        { 
            for (var i = 0; i < 8; i++) 
            {
                mcq_question_html+= '<div class="form-group">';
                mcq_question_html+= '          <label class="control-label col-lg-2" for="answer"></label>';
                mcq_question_html+= '          <div class="col-lg-5 radio-min">';
                mcq_question_html+= '        <div class="checkbox-box">';
                mcq_question_html+= '          <label>';
                mcq_question_html+= '            <input type="radio" class="styled" name="arr_mcq_type_question[arr_right_answer]['+mcq_type_question_cnt+']" id="arr_mcq_right_answer_'+mcq_type_question_cnt+'" value="'+i+'">'; /*data-rule-required="true"*/
                mcq_question_html+= '          </label>';
                mcq_question_html+= '        </div>';
                mcq_question_html+= '            <div class="answer-input">';
                mcq_question_html+= '                <input type="text" name="arr_mcq_type_question[arr_answer]['+mcq_type_question_cnt+']['+i+']" id="arr_mcq_answer_'+mcq_type_question_cnt+'_'+i+'" class="form-control" placeholder="Enter Answer" data-rule-required="true" >';
                mcq_question_html+= '            </div>';
                mcq_question_html+= '          </div>';
                mcq_question_html+= '</div>';  
            }
            mcq_question_html+= '<div class="form-group"> <label class="control-label col-lg-2" for="answer"></label><div class="note-for-question col-lg-5"><span>Note :</span> Please select a right answer from above question </div></div>';
        }
        mcq_question_html+= '</div>';

        $('#append_question_div').append(mcq_question_html);
        var mcq_question_id = '#arr_mcq_question_'+mcq_type_question_cnt;
        
        $(document).ready(function()
        {
          tinymce.init({
            selector: mcq_question_id,
            theme: "modern",
            paste_data_images: true,
            plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
            ],
            valid_elements : '*[*]',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
            image_advtab: true,
            file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('.tinymce_upload').trigger('click');
                $('.tinymce_upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },
            content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
            ]
          });  
        });

        mcq_type_question_cnt = mcq_type_question_cnt +1;
        $('#mcq_type_question_cnt').val(mcq_type_question_cnt);
    }
}
                                  
function removeNormalTypeQuestion(ref)
{
    var data_question_cnt = $(ref).attr('data-question-cnt');  
    $('#normal_typ_equestion_div_'+data_question_cnt).remove();
    if($(".normal_typ_equestion_div").length>0)
    {
        $(".normal_typ_equestion_div").each(function(index) 
        {
            $(this).find('input').attr('name', 'arr_normal_type_question[arr_question]['+index+']');
            $(this).find('textarea').attr('name', 'arr_normal_type_question[arr_answer]['+index+']');
        });
    }
}

function removeMcqTypeQuestion(ref)
{
    var data_question_cnt = $(ref).attr('data-question-cnt');    
    $('#mcq_type_question_div_'+data_question_cnt).remove();
    if($(".mcq_type_question_div").length>0)
    {
        $(".mcq_type_question_div").each(function(index) {
            $(this).find('textarea').attr('name','arr_mcq_type_question[arr_question]['+index+']');
            $(this).find('input[type=radio]').attr('name', 'arr_mcq_type_question[arr_right_answer]['+index+']');
            $(this).find('input[type=text]').each(function(inner_index){
                $(this).attr('name','arr_mcq_type_question[arr_answer]['+index+']['+inner_index+']')
            });
        });
    }

}
