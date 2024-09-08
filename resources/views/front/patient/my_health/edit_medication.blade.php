@extends('front.patient.layout.master')
@section('main_content')
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.patient.layout._leftbar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                @include('front.layout._operation_status')

                <div class="white-wrapper prescription-wrapper">
                    <h2>{{$page_title or ''}}</h2>
                    <form name="frm_update_medication" id="frm_update_medication" method="post" action="{{$module_url_path}}/medication/update/{{$enc_id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="prescription-section">
                            <div class="form-group">
                                <label class="form-label">Name of the Medications</label>
                                <input type="text" id="name" name="name" placeholder="Enter Name of the Medications" maxlength="50"/>
                                 <div class="error" id="err_name"></div>
                            </div>


                            <?php
                                $medication_file = isset($arr_medication_details['medication_file']) ? $arr_medication_details['medication_file'] : '';

                                if(isset($medication_file) && !empty($medication_file) && File::exists($medication_base_path.'/'.$medication_file)):
                                    $driving_file = $medication_public_path.'/'.$medication_file;
                                    ?>
                                        <a id="dec_medication_file" data-name="medication_file" data-file="{{ $medication_file }}" data-path="{{ $driving_file }}" href="" download>
                                            <p><span class="bg-img">&nbsp;</span>Download Medication</p>
                                        </a>
                                    <?php
                                endif;
                            ?>
                            <input type="hidden" id="old_medication_file" name="old_medication_file" value="{{$medication_file}}">

                            <div class="form-group">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group">
                                        
                                        <div class="form-inputs uneditable-input">
                                            <span class="fileupload-preview for-color"></span>
                                        </div>
                                        
                                        <div class="input-group-btn">
                                            <div class="btn btn-file">
                                                <span class="fileupload-new">Choose File</span>
                                                <span class="fileupload-exists change-btn">Change</span>
                                                <input type="file" class="file-input" id="file_medication" data-name="medication" />
                                            </div>
                                            <a href="#" class="btn fileupload-exists remove-file" data-dismiss="fileupload">Remove</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="error" id="err_file_medication"></div>
                            </div>
                            <div class="doc-note">Note : Please upload document/image with jpg/jpeg/png/gif/bmp/txt/pdf/csv/doc/docx/xlsx extension only.</div>
                            <br/>


                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Date Started</label>
                                        <div class="date-input relative-block">
                                            <input class="date-input" name="date" id="datepicker" type="text" value="{{isset($arr_medication_details['date'])?date('m/d/Y',strtotime($arr_medication_details['date'])):''}}" placeholder="Enter Date Started"/>
                                            <div class="error" id="err_date"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Frequency</label>
                                        <input type="text" id="frequency" name="frequency" placeholder="Enter Frequency" maxlength="2" />
                                        <div class="error" id="err_frequency"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Use</label>
                                <input type="text" id="medication_use" name="medication_use" placeholder="Enter Use" maxlength="250" />
                            </div>
                            <div class="save-btn">
                                <button id="btn_update_medication" type="button" class="green-trans-btn">Update</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('common.datepicker')
@include('common.fileupload')

<script>
$("#datepicker").datepicker({
    todayHighlight: true,
    autoclose: true
});

$(document).ready(function()
{
    var name  = '{{ isset($arr_medication_details['name']) ? $arr_medication_details['name'] : '' }}';
    var frequency = '{{ isset($arr_medication_details['frequency']) ? $arr_medication_details['frequency'] : '' }}';
    var medication_use = '{{ isset($arr_medication_details['medication_use']) ? $arr_medication_details['medication_use'] : '' }}';

    $("#name").val( decrypt(name) );
    $("#frequency").val( decrypt(frequency) );
    $("#medication_use").val( decrypt(medication_use) );

    if( $("#dec_medication_file").length ){
        var name = $("#dec_medication_file").data('name');
        var file = $("#dec_medication_file").data('file');
        var path = $("#dec_medication_file").data('path');

        decrypt_file(name, file, path);
    }

    var formData = new FormData( $(this)[0] );

    $("#btn_update_medication").click(function(){
        var name           = $("#name").val();
        var date           = $("#datepicker").val();
        var frequency      = $("#frequency").val();
        var medication_use = $("#medication_use").val();
        var old_medication_file = $("#old_medication_file").val();

        if($.trim(name) == '')
        {
            $("#name").focus();
            $("#err_name").show();
            $("#err_name").html('Please enter medication name.');
            $("#err_name").fadeOut(4000);
            return false;
        }
        else if($.trim(old_medication_file) == '')
        {
            $("#file_medication").focus();
            $("#err_file_medication").show();
            $("#err_file_medication").html('Please upload medication file.');
            $("#err_file_medication").fadeOut(4000);
            return false;
        }
        else if($.trim(date) == '')
        {
            $("#date").focus();
            $("#err_date").show();
            $("#err_date").html('Please select date.');
            $("#err_date").fadeOut(4000);
            return false;
        }
        else if($.trim(frequency) == '')
        {
            $("#frequency").focus();
            $("#err_frequency").show();
            $("#err_frequency").html('Please enter frequency.');
            $("#err_frequency").fadeOut(4000);
            return false;
        }
        else
        {
            showProcessingOverlay();
             // get User's card(s)
            api.cards.get(card_id).then(function (cards)
            {
                var _token             = '{{ csrf_token() }}';
                var enc_name           = encrypt(api, name, cards);
                var enc_frequency      = encrypt(api, frequency, cards);
                var enc_medication_use = encrypt(api, medication_use, cards);

                formData.append('_token', _token);
                formData.append('name', enc_name);
                formData.append('date', date);
                formData.append('frequency', enc_frequency);
                formData.append('medication_use',enc_medication_use);
                formData.append('old_medication_file',old_medication_file);

                $.ajax({
                    url         : "{{ $module_url_path }}/medication/update/{{$enc_id}}",
                    type        : 'post',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success : function(res)
                    {
                        hideProcessingOverlay();
                        location.reload();
                    }
                });

            })
            .then(null, function (error)
            {
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            })
            .catch(function(error)
            {
                $("#btn_open_function_output_modal")[0].click();
                $("#function_output_msg").html(error);
            });
        }
    });

    $('#file_medication').on('change', function() {
        encrypt_file( $(this).data('name'), formData );
    });

});



</script>
@endsection