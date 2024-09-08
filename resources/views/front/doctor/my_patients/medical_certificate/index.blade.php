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
                        <li>
                            <a id="patient_history" href="{{ $module_url_path }}/patient_history/{{ $patient_user_id }}">Patient History</a>
                        </li>
                        <li>
                            <a id="medical_history" href="{{ $module_url_path }}/medical_history/{{ $patient_user_id }}">Medical History</a>
                        </li>
                        <li>
                            <a class="active" id="medical_certificate" href="{{ $module_url_path }}/medical_certificate/{{ $patient_user_id }}">Medical Certificate</a>
                        </li>
                    </ul>
                </div>

                <div class="content">
                    
                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Make your Certificate here</h2>
                        <form name="frm_medical_certificate" id="frm_medical_certificate" method="post" action="{{$module_url_path}}/medical_certificate/save_and_generate_medical_certificate">
                            {{csrf_field()}}
                            <div class="prescription-section">
                                <div class="row">
                                    
                                    <input type="hidden" name="patient_id" value="{{ isset( $patient_user_id ) ? base64_decode( $patient_user_id ) : 0 }}">
                                    <input type="hidden" id="patient_type" name="patient_type" value="user">

                                    <div class="col-sm-12 col-md-6 col-lg-12">
                                        <div class="form-group">
                                            
                                            <select id="family_member" name="family_member">
                                                
                                                <?php 
                                                    $first_name   = isset( $arr_patient_details['first_name'] ) && !empty( $arr_patient_details['first_name'] ) ? ucwords( decrypt_value($arr_patient_details['first_name']) ) :'';
                                                    $last_name    = isset( $arr_patient_details['last_name'] ) && !empty( $arr_patient_details['last_name'] ) ? ucwords( decrypt_value($arr_patient_details['last_name']) ) :'';                                                        
                                                    $patient_id   = isset( $patient_user_id ) ? base64_decode($patient_user_id) : 0;
                                                    $patient_name = $first_name.' '.$last_name;
                                                ?>
                                                <option value="{{ $patient_id }}" data-type="user">{{$patient_name}}</option>
                                                
                                                @if(isset( $arr_family_member ) && sizeof( $arr_family_member )>0)
                                                    @foreach($arr_family_member as $family_member) 
                                                        <?php  
                                                            $famili_member_id   = isset( $family_member['id'] ) && !empty( $family_member['id'] ) ? $family_member['id']:0;
                                                            $first_name         = isset( $family_member['first_name'] ) && !empty( $family_member['first_name'] ) ? ucwords( decrypt_value($family_member['first_name']) ) :'';
                                                            $last_name          = isset( $family_member['last_name'] ) && !empty( $family_member['last_name'] ) ? ucwords( decrypt_value($family_member['last_name']) ) :'';
                                                            $family_member_name = $first_name.' '.$last_name;
                                                        ?>
                                                        <option value="{{ $famili_member_id }}" data-type="family">{{$family_member_name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>

                                            <div class="error" id="err_family_member"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="date-input relative-block">
                                                <input class="date-input" id="datepicker" type="text" name="from_date" placeholder="Select From Date" />
                                                 <div class="error" id="err_datepicker"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="date-input relative-block">
                                                <input class="date-input" id="datepicker-2" type="text" name="to_date" placeholder="Select To Date" />
                                                 <div class="error" id="err_datepicker-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <select id="reason" name="reason">
                                                <option value="">Absent For</option>
                                                @if(isset($arr_reason) && sizeof($arr_reason)>0)
                                                    @foreach($arr_reason as $reason) 
                                                        <option value="{{$reason['id']}}">{{$reason['reason']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                             <div class="error" id="err_reason"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-12">
                                        <div class="form-group"> 
                                            <input type="text" id="for_reason" name="for_reason" placeholder="Enter Reason" maxlength="100" />
                                            <div class="error" id="err_for_reason"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="medical-certificate-section">
                                <h2>Preview</h2>
                                <div class="medical-certificate-bx">
                                    <div class="medical-certification-title">Medical Certificate</div>
                                    <div class="infomation-add-certi">
                                        <div class="medi-info-add">Dr. [Doctor's Full Name]</div>
                                        <div class="medi-info-add">Example Address</div>
                                        <div class="medi-info-add">Example Address 2</div>
                                        <div class="medi-info-add">Phone : (02) 98765 43210</div>
                                        <div class="medi-info-add">Provider Number : (02) 988765</div>
                                        <div class="medi-info-add date-of-certi">Date: 24/04/2017</div>
                                        <div class="medi-info-add certi-dr-description">Dr [Doctor's Full Name], after careful examination on [todays date], hereby certify that [Patient's Name] is suffering from [condition - optional].I consider that a period of absence from [activity - work, study, sport, other] during [date] to [date] [inclusive/exclusive] is absolutely necessary for the restoration of their health.</div>
                                    </div>
                                    <div class="medi-info-add">Yours Sincerely</div>
                                    <div class="medi-info-add">Dr. [Doctor's Full Name] </div>
                                </div>

                                <div class="certificate-generate-btn">
                                    <button type="submit" id="btn_certificate_generate" >Save and Generate</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@include('virgil.virgil')
@include('common.datepicker')

<script type="text/javascript">
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
$("#datepicker, #datepicker-2").datepicker({
    todayHighlight: true,
    autoclose: true
});
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        var address     = '{{ isset($arr_doctor_details['doctor_data']['clinic_address']) ? $arr_doctor_details['doctor_data']['clinic_address'] : '' }}';
        var contact_no  = '{{ isset($arr_doctor_details['doctor_data']['clinic_contact_no']) ? $arr_doctor_details['doctor_data']['clinic_contact_no'] : '' }}';
        var medicare_provider_no  = '{{ isset($arr_doctor_details['doctor_data']['medicare_provider_no']) ? $arr_doctor_details['doctor_data']['medicare_provider_no'] : '' }}';
        var clinic_name  = '{{ isset($arr_doctor_details['doctor_data']['clinic_name']) ? $arr_doctor_details['doctor_data']['clinic_name'] : '' }}';

        $("#address").html( decrypt(address));
        $("#contact_no").html( decrypt(contact_no));
        $("#medicare_provider_no").html( decrypt(medicare_provider_no));
        $("#clinic_name").html( decrypt(clinic_name));

        $("#family_member").change(function(){
            var type = $(this).children("option:selected").data("type");
            $("#patient_type").val(type);
        });
    }); 

    $("#btn_certificate_generate").click(function()
    {
        var from_date     = $("#datepicker").val();
        var to_date       = $("#datepicker-2").val();
        var reason        = $("#reason").val();
        var for_reason    = $("#for_reason").val();
        var family_member = $("#family_member").val();

        if($.trim(family_member)=='')
        {
            $('#family_member').focus();
            $('#err_family_member').show();
            $('#err_family_member').html('Please select family member.');
            $('#err_family_member').fadeOut(4000);
            return false;  
        }
        else if($.trim(from_date)=='')
        {
            $('#datepicker').focus();
            $('#err_datepicker').show();
            $('#err_datepicker').html('Please select from date.');
            $('#err_datepicker').fadeOut(4000);
            return false;  
        }
        else if($.trim(to_date)=='')
        {
            $('#datepicker-2').focus();
            $('#err_datepicker-2').show();
            $('#err_datepicker-2').html('Please select to date.');
            $('#err_datepicker-2').fadeOut(4000);
            return false;  
        }
        else if(Date.parse(to_date) <= Date.parse(from_date)) 
        {
            $('#datepicker-2').focus();
            $('#err_datepicker-2').show();
            $('#err_datepicker-2').html('To date should not be equal or should be greater than from date');
            $('#err_datepicker-2').fadeOut(4000);
            return false;
        }
        else if($.trim(reason)=='')
        {
            $('#reason').focus();
            $('#err_reason').show();
            $('#err_reason').html('Please select reason absent for.');
            $('#err_reason').fadeOut(4000);
            return false;  
        }
        else if($.trim(for_reason)=='')
        {
            $('#for_reason').focus();
            $('#err_for_reason').show();
            $('#err_for_reason').html('Please enter reason absent for.');
            $('#err_for_reason').fadeOut(4000);
            return false;  
        }
        else
        {
            return true;
        }
    });
</script>




@endsection