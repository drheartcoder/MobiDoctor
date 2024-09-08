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
                         <div class="prescription-section">
                            <div class="lifestyle-details">
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Name of Medication</span>
                                        <span class="lifestyle-desc" id="name">
                                           
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Frequency</span>
                                        <span class="lifestyle-desc" id="frequency">
                                          
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Medication Use</span>
                                        <span class="lifestyle-desc" id="medication_use">
                                          
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Medication File</span>
                                        <span class="lifestyle-desc">
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
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Added On</span>
                                        <span class="lifestyle-desc" id="medication_use">
                                          {{ isset($arr_medication_details['created_at']) ? date('d M y h:m A',strtotime($arr_medication_details['created_at'])) : '' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="save-btn">
                                    <a class="green-trans-btn" href="{{$module_url_path}}/medical_history">Back</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function()
{
    var name  = '{{ isset($arr_medication_details['name']) ? $arr_medication_details['name'] : '' }}';
    var frequency = '{{ isset($arr_medication_details['frequency']) ? $arr_medication_details['frequency'] : '' }}';
    var medication_use = '{{ isset($arr_medication_details['medication_use']) ? $arr_medication_details['medication_use'] : '' }}';

    $("#name").html( decrypt(name) );
    $("#frequency").html( decrypt(frequency) );
    $("#medication_use").html( decrypt(medication_use) );

    if( $("#dec_medication_file").length ){
        var name = $("#dec_medication_file").data('name');
        var file = $("#dec_medication_file").data('file');
        var path = $("#dec_medication_file").data('path');

        decrypt_file(name, file, path);
    }
});



</script>
@endsection