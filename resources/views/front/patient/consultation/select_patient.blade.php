@extends('front.patient.layout.master')
@section('main_content')

<?php
    $patient_id = $who_is_patient = '';
    if( isset( $arr_consultation ) && !empty( $arr_consultation ) ):
        $patient_id     = isset($arr_consultation['patient_id']) ? $arr_consultation['patient_id'] : '';
        $who_is_patient = isset($arr_consultation['who_is_patient']) ? $arr_consultation['who_is_patient'] : '';
    endif;
?>

<div class="page-wrapper">
    <div class="container">
        <div class="booking-step-wrapper">
            
            <div class="booking-title text-center">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <!--<a class="prev-arrow bg-img" href="javascript:void(0);">&nbsp;</a>-->
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><h4>Who is the Patient?</h4></div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a class="next-arrow bg-img" href="javascript:void(0);" id="submit_page">&nbsp;</a>
                    </div>
                </div>
            </div>

            <div class="booking-content radio-btns">
                
                <form method="post" id="select_patient_form" name="select_patient_form" action="{{ url('/') }}/patient/consultation/{{ $session_consultation_id }}/patient/process">
                    {{ csrf_field() }}

                    @include('front.patient.layout._operation_status')

                    <div class="row">

                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <div class="radio-btn patient-box">
                                <input type="radio" id="user" name="select_patient" value="user" @if( $who_is_patient == 'user' ) checked @endif />
                                <label for="user"><span class="patient-icon bg-img">&nbsp;</span> <span class="name">Me</span></label>
                            </div> 
                        </div>

                        @if( isset( $arr_family_member ) && !empty( $arr_family_member ) && $arr_family_member != null )

                            @foreach( $arr_family_member as $family )

                                <?php
                                    $family_id    = isset( $family['id'] ) && !empty( $family['id'] ) ? $family['id'] : '';
                                    $family_fname = isset( $family['first_name'] ) && !empty( $family['first_name'] ) ? decrypt_value($family['first_name']) : '';
                                    $family_lname = isset( $family['last_name'] ) && !empty( $family['last_name'] ) ? decrypt_value($family['last_name']) : '';
                                ?>

                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                    <div class="radio-btn patient-box">
                                        <input type="radio" id="family_{{ $family_id }}" name="select_patient" value="{{ $family_id }}" @if( $who_is_patient == 'family' && $patient_id == $family_id ) checked @endif />
                                        <label for="family_{{ $family_id }}"><span class="patient-icon bg-img">&nbsp;</span> <span class="name">{{ $family_fname.' '.$family_lname }}</span></label>
                                    </div>
                                </div>

                            @endforeach

                        @endif

                    </div>

                    <div class="error" id="err_select_patient"></div>

                    <button type="button" class="green-btn submit-btn" id="btn_submit_select_patient_form">Submit</button>

                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btn_submit_select_patient_form").click(function(){
            form_validation();
        });

        $("#submit_page").click(function(){
            form_validation();
        });
    });

    function form_validation()
    {
        var select_patient = $("input[name='select_patient']").is(":checked");

        if( $.trim(select_patient) == 'false' )
        {
            $('#err_select_patient').show();
            $('#err_select_patient').html('Please select patient for the consultation.');
            $('#err_select_patient').fadeOut(4000);
            return false;
        }
        else
        {
            $("#select_patient_form").submit();
        }
    }
</script>

@endsection