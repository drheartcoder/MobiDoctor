<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9 col-lg-9">
            <table width="100%" cellspacing="0" cellpadding="0px" style="max-width: 800px; font-size:11pt; font-family:Arial, Helvetica, sans-serif; line-height:16pt; color:#333; text-align:justify;">

                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td colspan="2" bgcolor="#efefef">
                                    <strong>Personal Information</strong>
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td width="50%"><strong>First Name :</strong> 
                                    {{isset($arr_patient_details['first_name'])?decrypt_value($arr_patient_details['first_name']):''}} {{isset($arr_patient_details['last_name'])?decrypt_value($arr_patient_details['last_name']):'-'}}
                                </td>
                                <td><strong>Email :</strong>
                                    {{isset($arr_patient_details['email'])?$arr_patient_details['email']:'-'}}
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td><strong>Date of Birth :</strong> {{isset($arr_patient_details['date_of_birth'])?date('d M Y',strtotime($arr_patient_details['date_of_birth'])):'-'}}
                                </td>
                                <td><strong>Gender :</strong> 
                                    {{isset($arr_patient_details['gender'])?$arr_patient_details['gender']:''}}
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td><strong>Phone No. :</strong> 
                                    {{isset($arr_patient_details['contact_no'])?$arr_patient_details['contact_no']:'-'}}
                                </td>
                                <td><strong>Mobile No. :</strong>  
                                    +{{isset($arr_patient_details['phone_code'])?$arr_patient_details['phone_code']:''}} {{isset($arr_patient_details['mobile_no'])?$arr_patient_details['mobile_no']:'-'}}
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td colspan="2"><strong>Address :</strong> 
                                    {{isset($arr_patient_details['address'])?decrypt_value($arr_patient_details['address']):'-'}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr> 

                <tr>
                    <td height="5px"></td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td colspan="2" bgcolor="#efefef">
                                    <strong>LifeStyle</strong>
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td width="50%"><strong>Smoking :</strong> 
                                    @if(isset($arr_patient_details['life_style_details']['smoking']) && $arr_patient_details['life_style_details']['smoking']!='' && $arr_patient_details['life_style_details']['smoking']=='1')
                                        Yes
                                    @elseif(isset($arr_patient_details['life_style_details']['smoking']) && $arr_patient_details['life_style_details']['smoking']!='' && $arr_patient_details['life_style_details']['smoking']=='0')
                                        No
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><strong>Exercise :</strong>
                                    @if(isset($arr_patient_details['life_style_details']['exercise']) && $arr_patient_details['life_style_details']['exercise']!='' && $arr_patient_details['life_style_details']['exercise']=='1')
                                        Yes
                                    @elseif(isset($arr_patient_details['life_style_details']['exercise']) && $arr_patient_details['life_style_details']['exercise']!='' && $arr_patient_details['life_style_details']['exercise']=='0')
                                        No
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td><strong>Alcohol :</strong> 
                                    @if(isset($arr_patient_details['life_style_details']['alcohol']) && $arr_patient_details['life_style_details']['alcohol']!='' && $arr_patient_details['life_style_details']['alcohol']=='1')
                                        Yes
                                    @elseif(isset($arr_patient_details['life_style_details']['alcohol']) && $arr_patient_details['life_style_details']['alcohol']!='' && $arr_patient_details['life_style_details']['alcohol']=='0')
                                        No
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><strong>Stress Level :</strong> 
                                    @if(isset($arr_patient_details['life_style_details']['stress_level']) && $arr_patient_details['life_style_details']['stress_level']!='' && $arr_patient_details['life_style_details']['stress_level']=='1')
                                        High
                                    @elseif(isset($arr_patient_details['life_style_details']['stress_level']) && $arr_patient_details['life_style_details']['stress_level']!='' && $arr_patient_details['life_style_details']['stress_level']=='0')
                                        Low
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-size:11pt;">
                                <td colspan="2"><strong>Marital Status :</strong> 
                                     @if(isset($arr_patient_details['life_style_details']['marital_status']) && $arr_patient_details['life_style_details']['marital_status']!='' && $arr_patient_details['life_style_details']['marital_status']=='1')
                                        Married
                                    @elseif(isset($arr_patient_details['life_style_details']['marital_status']) && $arr_patient_details['life_style_details']['marital_status']!='' && $arr_patient_details['life_style_details']['marital_status']=='0')
                                        Single
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                          
                
                        </table>
                    </td>
                </tr> 

                @if(isset($arr_selected_general) && sizeof($arr_selected_general)>0)
                    <tr>
                        <td height="5px"></td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td colspan="4" bgcolor="#efefef">
                                        <strong>Medical General</strong>
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    @foreach($arr_selected_general as $general_key => $selected_general)
                                    <td>
                                        {{$general_key+1}}. {{isset($selected_general['general_details']['name'])?decrypt_value($selected_general['general_details']['name']):''}}
                                    </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif

                @if(isset($arr_patient_details['family_member']) && sizeof($arr_patient_details['family_member'])>0)
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td colspan="2" bgcolor="#efefef">
                                        <strong>Family Member</strong>
                                    </td>
                                </tr>
                                
                                @foreach($arr_patient_details['family_member'] as $family_key => $family_data)
                                <tr>
                                    <td colspan="2">
                                        <strong>{{$family_key+1}}] {{isset($family_data['first_name'])?decrypt_value($family_data['first_name']):''}} {{isset($family_data['last_name'])?decrypt_value($family_data['last_name']):'-'}}</strong>
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    <td width="50%"><strong>Date Of Birth :</strong> 
                                       {{isset($family_data['birth_date'])?date('d M Y',strtotime($family_data['birth_date'])):'-'}}
                                    </td>
                                    <td><strong>Gender :</strong>
                                       {{isset($family_data['gender'])?decrypt_value($family_data['gender']):'-'}}
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    <td><strong>Mobile No :</strong> 
                                       +{{isset($family_data['phone_code'])?$family_data['phone_code']:''}} {{isset($family_data['mobile_no'])?$family_data['mobile_no']:'-'}}
                                    </td>
                                    <td><strong>Email :</strong> 
                                       {{isset($family_data['email'])?$family_data['email']:'-'}}
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    <td><strong>Relation :</strong> 
                                       {{isset($family_data['relation'])?decrypt_value($family_data['relation']):'-'}}
                                    </td>
                                </tr>
                               
                                @endforeach
                               
                              
                    
                            </table>
                        </td>
                    </tr> 
                @endif

                @if(isset($medication_arr) && sizeof($medication_arr)>0)
                    <tr>
                        <td height="5px"></td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="10">
                                <tr>
                                    <td colspan="2" bgcolor="#efefef">
                                        <strong>Medications</strong>
                                    </td>
                                </tr>
                                
                                @foreach($medication_arr as $medication_key => $medication)
                                <tr>
                                    <td colspan="2">
                                        <strong>{{$medication_key + 1}}] {{isset($medication['dec_medication_name'])?$medication['dec_medication_name']:'-'}}</strong>
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    <td width="50%"><strong>Frequency :</strong> 
                                       {{isset($medication['dec_frequency'])?$medication['dec_frequency']:'-'}}
                                    </td>
                                    <td><strong>Medication Use :</strong>
                                       {{isset($medication['dec_medication_use'])?$medication['dec_medication_use']:'-'}}
                                    </td>
                                </tr>
                                <tr style="font-size:11pt;">
                                    <td><strong>Added On :</strong> 
                                       {{ isset($medication['created_at']) ? date('d M y h:m A',strtotime($medication['created_at'])) : '' }}
                                    </td>
                                </tr>
                                
                                @endforeach
                            </table>
                        </td>
                    </tr> 
                @endif

            </table>

            </div>
        </div>
    </div>
</div>
