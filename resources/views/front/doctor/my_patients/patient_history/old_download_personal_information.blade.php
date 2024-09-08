<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9 col-lg-9">
                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Personal Information</h2>
                        <div class="prescription-section">
                            <div class="lifestyle-details">
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Name</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['first_name'])?decrypt_value($arr_patient_details['first_name']):''}} {{isset($arr_patient_details['last_name'])?decrypt_value($arr_patient_details['last_name']):'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Date Of Birth</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['date_of_birth'])?date('d M Y',strtotime($arr_patient_details['date_of_birth'])):'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Gender</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['gender'])?$arr_patient_details['gender']:''}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Contact No</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['contact_no'])?$arr_patient_details['contact_no']:'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Mobile No</span>
                                        <span class="lifestyle-desc">+{{isset($arr_patient_details['phone_code'])?$arr_patient_details['phone_code']:''}} {{isset($arr_patient_details['mobile_no'])?$arr_patient_details['mobile_no']:'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Email</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['email'])?$arr_patient_details['email']:'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Address</span>
                                        <span class="lifestyle-desc">{{isset($arr_patient_details['address'])?decrypt_value($arr_patient_details['address']):'-'}}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Family Member Details</h2>
                        <div class="prescription-section">
                            <div class="lifestyle-details">
                                @if(isset($arr_patient_details['family_member']) && sizeof($arr_patient_details['family_member'])>0)
                                @foreach($arr_patient_details['family_member'] as $family_key => $family_data)
                                <h2>Family Member {{$family_key+1}}</h2>
                                <br>
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Name</span>
                                        <span class="lifestyle-desc">{{isset($family_data['first_name'])?decrypt_value($family_data['first_name']):''}} {{isset($family_data['last_name'])?decrypt_value($family_data['last_name']):'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Date Of Birth</span>
                                        <span class="lifestyle-desc">{{isset($family_data['birth_date'])?date('d M Y',strtotime($family_data['birth_date'])):'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Gender</span>
                                        <span class="lifestyle-desc">{{isset($family_data['gender'])?decrypt_value($family_data['gender']):'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Mobile No</span>
                                        <span class="lifestyle-desc">+{{isset($family_data['phone_code'])?$family_data['phone_code']:''}} {{isset($family_data['mobile_no'])?$family_data['mobile_no']:'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Email</span>
                                        <span class="lifestyle-desc">{{isset($family_data['email'])?$family_data['email']:'-'}}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Relation</span>
                                        <span class="lifestyle-desc">{{isset($family_data['relation'])?decrypt_value($family_data['relation']):'-'}}
                                        </span>
                                    </li>
                                </ul>
                                @endforeach
                                @else
                                    Family members not available
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Medical General</h2>
                        @if(isset($arr_selected_general) && sizeof($arr_selected_general)>0)
                        <div class="prescription-section">
                            <div class="lifestyle-details">
                                @foreach($arr_selected_general as $general_key => $selected_general)
                                    {{$general_key+1}}. {{isset($selected_general['general_details']['name'])?decrypt_value($selected_general['general_details']['name']):''}}</br>
                                @endforeach
                            </div>
                        </div>
                        @else
                            Medical General information not available.
                        @endif
                    </div>

                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Lifestyle</h2>
                        <div class="prescription-section">
                            <div class="lifestyle-details">
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Smoking</span>
                                        <span class="lifestyle-desc">
                                            @if(isset($arr_patient_details['life_style_details']['smoking']) && $arr_patient_details['life_style_details']['smoking']!='' && $arr_patient_details['life_style_details']['smoking']=='1')
                                                Yes
                                            @elseif(isset($arr_patient_details['life_style_details']['smoking']) && $arr_patient_details['life_style_details']['smoking']!='' && $arr_patient_details['life_style_details']['smoking']=='0')
                                                No
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Exercise</span>
                                        <span class="lifestyle-desc">
                                            @if(isset($arr_patient_details['life_style_details']['exercise']) && $arr_patient_details['life_style_details']['exercise']!='' && $arr_patient_details['life_style_details']['exercise']=='1')
                                                Yes
                                            @elseif(isset($arr_patient_details['life_style_details']['exercise']) && $arr_patient_details['life_style_details']['exercise']!='' && $arr_patient_details['life_style_details']['exercise']=='0')
                                                No
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Alcohol</span>
                                        <span class="lifestyle-desc">
                                            @if(isset($arr_patient_details['life_style_details']['alcohol']) && $arr_patient_details['life_style_details']['alcohol']!='' && $arr_patient_details['life_style_details']['alcohol']=='1')
                                                Yes
                                            @elseif(isset($arr_patient_details['life_style_details']['alcohol']) && $arr_patient_details['life_style_details']['alcohol']!='' && $arr_patient_details['life_style_details']['alcohol']=='0')
                                                No
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Stress Level</span>
                                        <span class="lifestyle-desc">
                                            @if(isset($arr_patient_details['life_style_details']['stress_level']) && $arr_patient_details['life_style_details']['stress_level']!='' && $arr_patient_details['life_style_details']['stress_level']=='1')
                                                High
                                            @elseif(isset($arr_patient_details['life_style_details']['stress_level']) && $arr_patient_details['life_style_details']['stress_level']!='' && $arr_patient_details['life_style_details']['stress_level']=='0')
                                                Low
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Marital Status</span>
                                        <span class="lifestyle-desc">
                                            @if(isset($arr_patient_details['life_style_details']['marital_status']) && $arr_patient_details['life_style_details']['marital_status']!='' && $arr_patient_details['life_style_details']['marital_status']=='1')
                                                Married
                                            @elseif(isset($arr_patient_details['life_style_details']['marital_status']) && $arr_patient_details['life_style_details']['marital_status']!='' && $arr_patient_details['life_style_details']['marital_status']=='0')
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

                    <div class="white-wrapper prescription-wrapper history-wrapper">
                        <h2>Medications</h2>
                        <div class="prescription-section">
                            <div class="lifestyle-details">
                                @if(isset($medication_arr) && sizeof($medication_arr)>0)
                                @foreach($medication_arr as $medication_key => $medication)
                                <h2>Medication {{$medication_key + 1}}</h2>
                                <br>
                                <ul>
                                    <li>
                                        <span class="lifestyle-label">Name of Medication</span>
                                        <span class="lifestyle-desc">{{isset($medication['dec_medication_name'])?$medication['dec_medication_name']:'-'}}</span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Frequency</span>
                                        <span class="lifestyle-desc">{{isset($medication['dec_frequency'])?$medication['dec_frequency']:'-'}}</span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Medication Use</span>
                                        <span class="lifestyle-desc">{{isset($medication['dec_medication_use'])?$medication['dec_medication_use']:'-'}}</span>
                                    </li>
                                    <li>
                                        <span class="lifestyle-label">Added On</span>
                                        <span class="lifestyle-desc">{{ isset($medication['created_at']) ? date('d M y h:m A',strtotime($medication['created_at'])) : '' }}</span>
                                    </li>
                                </ul>
                                @endforeach
                                @else
                                    Medications not available.
                                @endif
                            </div>
                        </div>
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('virgil.patient_virgil')
<script type="text/javascript">
    var card_id = "{{ $arr_patient_details['dump_id'] or '' }}";
    var userkey = "{{ $arr_patient_details['dump_session'] or ''}}";
</script> --}}