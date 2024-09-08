@extends('front.doctor.layout.master')
@section('main_content')
<style type="text/css">
    .pati-new-tab li a.active{color: #189108;border-bottom: 1px solid #189108;}
</style>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.doctor.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                @include('front.layout._operation_status')
               
                      <div class="pati-new-tab">
                        <ul>
                            <li id="patient_history_li">
                                <a id="patient_history" href="{{$module_url_path}}/patient_history/{{$patient_user_id}}">Patient History</a>
                            </li>
                            <li class="<?php if(Request::segment(3) == 'medical_history'){ echo 'active'; } ?>">
                                <a class="active" id="medical_history" href="{{$module_url_path}}/medical_history/{{$patient_user_id}}">Medical History</a>
                            </li>
                            <li>
                                <a id="medical_certificate" href="{{$module_url_path}}/medical_certificate/{{$patient_user_id}}">Medical Certificate</a>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                       
                            <div class="white-wrapper prescription-wrapper history-wrapper">
                                <h2>General</h2>
                                <div class="prescription-section">
                                    <form name="frm_add_general" id="frm_add_general" method="post" action="{{$module_url_path}}/medical_history/general/store">
                                        {{csrf_field()}}
                                        <input type="hidden" name="enc_id" value="{{$patient_user_id}}">
                                        <div class="row">
                                           <div class="col-sm-8 col-md-9 col-lg-9">
                                               <div class="form-group">
                                                   <select name="medical_general[]" id="medical_general" class="js-example-basic-multiple" multiple="multiple">
                                                        @if(isset($arr_general) && sizeof($arr_general)>0)
                                                            @foreach($arr_general as $general_key => $general)
                                                                @if(!in_array($general['id'],$selected_general_ids))
                                                                <option value="{{$general['id']}}">{{isset($general['name'])?decrypt_value($general['name']):''}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                     </select>
                                                     <div class="error" id="err_medical_general"></div>
                                               </div>
                                           </div>
                                            <div class="col-sm-4 col-md-3 col-lg-3">
                                               <div class="form-group">
                                                   <button id="btn_add_general" type="button" class="green-btn full-width">+ Add</button>
                                               </div>
                                           </div>
                                        </div>
                                   </form>

                                    @if(isset($arr_selected_general) && sizeof($arr_selected_general)>0)
                                    <div class="issues-list">
                                        <ul>
                                            @foreach($arr_selected_general as $selected_general)
                                                <li>
                                                    <span class="issue-name">{{isset($selected_general['general_details']['name'])?decrypt_value($selected_general['general_details']['name']):''}}
                                                    </span>
                                                    <span class="close-issue">
                                                        <a onclick="confirm_action(this,event,'Do you really want to remove medical general?')" href="{{$module_url_path.'/medical_history/general/delete/'.base64_encode($selected_general['id']) }}"><img src="{{url('/')}}/public/front/images/close-list.png"/></a>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="white-wrapper prescription-wrapper history-wrapper">
                                <h2>Medications <a class="add-medi" href="{{$module_url_path}}/medical_history/medication/{{$patient_user_id}}">+ Add Medication</a></h2>
                                <div class="prescription-section medi-list">
                                    <div class="row">

                                       @if(isset($arr_medication) && sizeof($arr_medication)>0)
                                            @foreach($arr_medication as $key => $medication)
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="medication-list-block">
                                                    <b id="medication_{{ $key }}"></b>
                                                    <div class="consu-drop-wrapper view-medi-drop-w">
                                                        <div class="ellipses-block"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>
                                                        <div class="consu-drop">
                                                            <ul>
                                                                <li><a href="{{$module_url_path}}/medical_history/medication/view/{{base64_encode($medication['id'])}}">View Medication</a></li>
                                                                <li><a href="{{$module_url_path}}/medical_history/medication/edit/{{base64_encode($medication['id'])}}">Edit Medication</a></li>
                                                                <li><a onclick="confirm_action(this,event,'Do you really want to remove medication?')" href="{{$module_url_path}}/medical_history/medication/delete/{{base64_encode($medication['id'])}}">Delete Medication</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $("#medication_{{ $key }}").html(decrypt("{{$medication['name']}}"));
                                                });
                                            </script>
                                            @endforeach
                                        @endif
                                       
                                    </div>
                                </div>
                            </div>
                            
                            <div class="white-wrapper prescription-wrapper history-wrapper">
                                <h2>Lifestyle <a class="edit-icon" href="{{$module_url_path}}/medical_history/lifestyle/{{$patient_user_id}}"><i class="fa fa-pencil-square-o"></i></a></h2>
                                <div class="prescription-section">
                                    <div class="lifestyle-details">
                                        <ul>
                                            <li>
                                                <span class="lifestyle-label">Smoking</span>
                                                <span class="lifestyle-desc">
                                                    @if(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='1')
                                                        Yes
                                                    @elseif(isset($arr_lifestyle['smoking']) && $arr_lifestyle['smoking']!='' && $arr_lifestyle['smoking']=='0')
                                                        No
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="lifestyle-label">Exercise</span>
                                                <span class="lifestyle-desc">
                                                    @if(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='1')
                                                        Yes
                                                    @elseif(isset($arr_lifestyle['exercise']) && $arr_lifestyle['exercise']!='' && $arr_lifestyle['exercise']=='0')
                                                        No
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="lifestyle-label">Alcohol</span>
                                                <span class="lifestyle-desc">
                                                    @if(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='1')
                                                        Yes
                                                    @elseif(isset($arr_lifestyle['alcohol']) && $arr_lifestyle['alcohol']!='' && $arr_lifestyle['alcohol']=='0')
                                                        No
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="lifestyle-label">Stress Level</span>
                                                <span class="lifestyle-desc">
                                                    @if(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='1')
                                                        High
                                                    @elseif(isset($arr_lifestyle['stress_level']) && $arr_lifestyle['stress_level']!='' && $arr_lifestyle['stress_level']=='0')
                                                        Low
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="lifestyle-label">Marital Status</span>
                                                <span class="lifestyle-desc">
                                                    @if(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='1')
                                                        Married
                                                    @elseif(isset($arr_lifestyle['marital_status']) && $arr_lifestyle['marital_status']!='' && $arr_lifestyle['marital_status']=='0')
                                                        Single
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>                       
                    </div>
                </div>


            </div>
        </div>
    
</div>
<!--view Member details modal end-->



@include('common.multiselect')
@include('virgil.patient_virgil')

<script>

var card_id = "{{ $arr_patient_details['dump_id'] or '' }}";
var userkey = "{{ $arr_patient_details['dump_session'] or ''}}";

$(document).ready(function()
{
    $('#patient_history').click(function(){
        window.location.href = "{{$module_url_path}}/patient_history/{{$patient_user_id}}";
    });
    $('#medical_history').click(function(){
        window.location.href = "{{$module_url_path}}/medical_history/{{$patient_user_id}}";
    });
    $('#medical_certificate').click(function(){
        window.location.href = "{{$module_url_path}}/medical_certificate/{{$patient_user_id}}";
    });
});

</script>

<script>
$(document).ready(function() {
    $('[data-responsive-tabs]').responsivetabs({
        
    });
});
</script>

<script type="application/javascript">
    $('.consu-drop-wrapper').click(function() {
        $(this).toggleClass('active');
        $(this).parent().parent().siblings().children('.medication-list-block').children('.consu-drop-wrapper').removeClass('active');
    });
</script>

<script type="text/javascript">
$("#btn_add_general").click(function(){
    var medical_general = $("#medical_general").val();

    if($.trim(medical_general) == '')
    {
        $("#medical_general").focus();
        $('#err_medical_general').show();
        $('#err_medical_general').html('Please select general.');
        $('#err_medical_general').fadeOut(4000);
        return false;
    }
    else
    {
        var form = $('#frm_add_general')[0];
        var formData = new FormData(form);
        $.ajax({
            url         : '{{ $module_url_path }}/medical_history/general/store',
            type        : 'post',
            data        : formData,
            processData : false,
            contentType : false,
            cache       : false,
            beforeSend  : showProcessingOverlay(),
            success     : function (res)
            {
                hideProcessingOverlay();
                location.reload();
            }
        });
    }
});

</script>
@endsection