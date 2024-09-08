<?php
    
            \Excel::create(ucwords('report').'-'.date('d-m-Y').'-'.uniqid(), function($excel) use($arr_doctor,$arr_fields) 
                {
                    $excel->sheet(ucwords('report'), function($sheet) use($arr_doctor,$arr_fields) 
                    {
                        $sheet->row(2, [ucwords('report').' - '.date('d M Y'),'','','']);
                        $sheet->row(4, $arr_fields);
                        
                        // To set Colomn head
                        $j = 'A'; $k = '4';
                        for($i=0; $i<=37;$i++)
                        {
                            $sheet->cell($j.$k, function($cells) {
                                $cells->setBackground('#495b79');
                                $cells->setFontWeight('bold');
                                $cells->setAlignment('center');
                                $cells->setFontColor('#ffffff');
                            });
                            $j++;
                        }

                        if(sizeof($arr_doctor)>0)
                        {
                            $arr_tmp = [];
                            $count = 1;
                            foreach($arr_doctor as $key => $result)
                            {
                                $phone_code         = isset($result['phone_code'])?'+'.$result['phone_code']:'';
                                $mobile             = isset($result['mobile_no']) ? $result['mobile_no'] : '';

                                $clinic_phone_code  = isset($result['doctor_data']['phone_code'])?'+'.$result['doctor_data']['phone_code']:'';
                                $clinic_mobile      = isset($result['doctor_data']['mobile_no']) ? $result['doctor_data']['mobile_no'] : '';


                                $arr_tmp[$key]['sr_no']         = $count++;
                                $arr_tmp[$key]['name']          = (isset($result['first_name'])?decrypt_value($result['first_name']) : '').' '.(isset($result['last_name']) ? decrypt_value($result['last_name']) : '');
                                $arr_tmp[$key]['email']         = isset($result['email'])?$result['email'] : '';
                                $arr_tmp[$key]['date_of_birth']   = isset($result['date_of_birth'])?date('d M Y',strtotime($result['date_of_birth'])) : '';
                                $arr_tmp[$key]['mobile_no']         = $phone_code.$mobile;
                                $arr_tmp[$key]['contact_no']        = isset($result['contact_no']) ? $result['contact_no'] : '';
                                $arr_tmp[$key]['gender']        = isset($result['gender']) ? $result['gender'] : '';
                                $arr_tmp[$key]['address']       = isset($result['address']) ? decrypt_value($result['address']) : '';
                                $arr_tmp[$key]['city']          = isset($result['city']) ? decrypt_value($result['city']) : '';
                                $arr_tmp[$key]['country']       = isset($result['country']) ? decrypt_value($result['country']) : '';
                                if(isset($result['timezone_details']['location_name']) && $result['timezone_details']['location_name']!='')
                                {
                                    $arr_tmp[$key]['timezone']      = $result['timezone_details']['location_name'].' '.(isset($result['timezone_details']['utc_offset']) ? $result['timezone_details']['utc_offset'] : '');
                                }
                                $arr_tmp[$key]['social_login']   = isset($result['social_login']) ? ucfirst($result['social_login']) : '' ;
                                if(isset($result['status']) && $result['status'] != '' && $result['status'] == '1')
                                {
                                    $arr_tmp[$key]['status']         = 'Active';
                                }
                                else
                                {
                                    $arr_tmp[$key]['status']         = 'Inactive';
                                }
                                
                                if(isset($result['is_email_verified']) && $result['is_email_verified'] != '' && $result['is_email_verified'] == '1')
                                {
                                    $arr_tmp[$key]['email_verification']    = 'Verified';
                                }
                                else
                                {   
                                    $arr_tmp[$key]['email_verification']    = 'Unverified';
                                } 

                                if(isset($result['is_mobile_verified']) && $result['is_mobile_verified'] != '' && $result['is_mobile_verified'] == '1')
                                {
                                    $arr_tmp[$key]['mobile_verified']    = 'Verified';
                                }
                                else
                                {   
                                    $arr_tmp[$key]['mobile_verified']    = 'Unverified';
                                }   

                                $arr_tmp[$key]['last_login']        =   isset($result['last_login']) ? date('d M Y h:i A', strtotime($result['last_login'])) : '-';
                                $arr_tmp[$key]['registered_on']     =    isset($result['created_at']) ? date('d M Y' , strtotime($result['created_at'])) : '' ;

                                if( isset($result['doctor_data']['admin_verified']) && $result['doctor_data']['admin_verified'] != '' && $result['doctor_data']['admin_verified'] == '1' )
                                {
                                    $arr_tmp[$key]['document_verification']  = 'Verified';
                                }
                                else
                                {
                                    $arr_tmp[$key]['document_verification']  = 'Unverified';
                                }
                                $arr_tmp[$key]['clinic_name']              = isset($result['doctor_data']['clinic_name'])?$result['doctor_data']['clinic_name'] : '';
                                $arr_tmp[$key]['experience']               = isset($result['doctor_data']['experience'])?$result['doctor_data']['experience'] : '';
                                $arr_tmp[$key]['clinic_mobile']            = $clinic_phone_code.$clinic_mobile;
                                $arr_tmp[$key]['clinic_contact']           = isset($result['doctor_data']['clinic_contact_no'])?$result['doctor_data']['clinic_contact_no'] : '';
                                $arr_tmp[$key]['clinic_email']             = isset($result['doctor_data']['clinic_email'])?$result['doctor_data']['clinic_email'] : '';
                                $arr_tmp[$key]['language']                 = 'Language';
                                $arr_tmp[$key]['clinic_address']           = isset($result['doctor_data']['clinic_address'])?$result['doctor_data']['clinic_address']: '';
                                $arr_tmp[$key]['primary_medical_qual']     = isset($result['doctor_data']['medical_qualification'])?$result['doctor_data']['medical_qualification']: '';
                                $arr_tmp[$key]['medical_school']           = isset($result['doctor_data']['modical_school'])?$result['doctor_data']['modical_school']: '';
                                $arr_tmp[$key]['yr_obtained']              = isset($result['doctor_data']['year_obtained'])?$result['doctor_data']['year_obtained']: '';
                                $arr_tmp[$key]['country_obtained']         = isset($result['doctor_data']['country_obtained'])?$result['doctor_data']['country_obtained']: '';
                                $arr_tmp[$key]['other_qualifications']     = isset($result['doctor_data']['other_qualifications'])?$result['doctor_data']['other_qualifications']: '';
                                $arr_tmp[$key]['bank_name']                = isset($result['doctor_data']['bank_name'])?$result['doctor_data']['bank_name']: '';
                                $arr_tmp[$key]['ac_name']                  = isset($result['doctor_data']['bank_account_name'])?$result['doctor_data']['bank_account_name']: '';
                                $arr_tmp[$key]['ac_no']                    = isset($result['doctor_data']['bank_account_no'])?$result['doctor_data']['bank_account_no']: '';
                                $arr_tmp[$key]['provider_no']              = isset($result['doctor_data']['medicare_provider_no'])?$result['doctor_data']['medicare_provider_no']: '';
                                $arr_tmp[$key]['prescriber_no']            = isset($result['doctor_data']['prescriber_no'])?$result['doctor_data']['prescriber_no']: '';
                                $arr_tmp[$key]['registration_no']          = isset($result['doctor_data']['ahpra_registration_no'])?$result['doctor_data']['ahpra_registration_no']: '';
                                $arr_tmp[$key]['driving_licence']          = isset($result['doctor_data']['driving_licence'])?$result['doctor_data']['driving_licence']: '';
                                $arr_tmp[$key]['medical_reg_cert']         = isset($result['doctor_data']['medical_registration'])?$result['doctor_data']['medical_registration']: '';

                            }
                            $sheet->rows($arr_tmp);
                        }
                    });
                })->export('xlsx');    
        
?>