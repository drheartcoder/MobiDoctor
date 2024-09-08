<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DoctorDetailsModel;
use App\Models\UserModel;
use App\Models\LanguageModel;
use App\Models\SubscriptionTransactionModel;
use App\Models\ConsultationTransactionModel;

use Flash;
use Validator;
use Excel;
class ReportsController extends Controller
{
    public function __construct(
                                    UserModel $user_model
                                )
    {
        $this->LanguageModel                = new LanguageModel();
        $this->SubscriptionTransactionModel = new SubscriptionTransactionModel();
        $this->ConsultationTransactionModel = new ConsultationTransactionModel();
        $this->DoctorDetailsModel           = new DoctorDetailsModel();
        $this->UserModel                    = $user_model;
        $this->arr_view_data                = [];
        $this->module_url_path              = url(config('app.project.admin_panel_slug')."/reports");
        $this->module_title                 = "Reports";
        $this->module_view_folder           = "admin.reports";
        $this->admin_panel_slug             = config('app.project.admin_panel_slug');
    }

    public function patient()
    {
    	$arr_patient = [];
        $obj_patient = $this->UserModel->where('user_type','=','patient')->orderBy('id','desc')->get();
        if($obj_patient)
        {
            $arr_patient = $obj_patient->toArray();
        }   

        $this->arr_view_data['arr_patient']     = $arr_patient;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/patient';
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        return view($this->module_view_folder.'/patient',$this->arr_view_data);
    }

    // Work by Gaurav Shewale
    public function patient_export(Request $request)
    {
        $arr_patient = [];
        $data        = array();
        $obj_patient = $this->UserModel->where('user_type','=','patient')->orderBy('id','desc')->get();
        if($obj_patient)
        {
           $arr_patient = $obj_patient->toArray();
        }

        if(isset($arr_patient) && sizeof($arr_patient)>0) 
        {
            foreach($arr_patient as $key => $user) 
            {
                $data['Sr. No.']     = ($key+1);
                $data['First Name']  = isset($user['first_name'])?decrypt_value($user['first_name']):'-';
                $data['Last Name']   = isset($user['last_name'])?decrypt_value($user['last_name']):'-';
                $data['Email']       = isset($user['email'])? $user['email']:'-';
                if(isset($user['is_email_verified']) && $user['is_email_verified']!='' && $user['is_email_verified']=='1')
                {
                   $data['Email Verify Status'] = 'Verified';
                }    
                else
                {   
                   $data['Email Verify Status'] = 'Unverified';
                }
                
                $data['Mobile No'] = isset($user['mobile_no'])? $user['mobile_no']:'-';
                if(isset($user['is_mobile_verified']) && $user['is_mobile_verified']!='' && $user['is_mobile_verified']=='1')
                {
                  $data['Mobile Verify Status'] =  'Verified';
                }   
                else
                {
                  $data['Mobile Verify Status'] =  'Unverified';
                }
                $data['Social Login']    = isset($user['social_login']) ? ucfirst($user['social_login']):'-';
                $data['Gender']          = isset($user['gender'])? $user['gender']:'-';
                $data['Address']         = isset($user['address']) && $user['address']!=null ?decrypt_value($user['address']):'-';
                $data['Country']         = isset($user['country'])? decrypt_value($user['country']):'-';
                $data['City']            = isset($user['city'])? decrypt_value($user['city']):'-';
                $data['Fax. No.']        = isset($user['fax_no'])? decrypt_value($user['fax_no']):'-';
                $data['Last Login']      = isset($user['last_login'])? date('d M Y h:i A', strtotime($user['last_login'])):'0000 00 00 00:00 00';
                $data['Registered On']   = isset($user['created_at'])? date('d-M-Y', strtotime($user['created_at'])):'00-00-0000';
                

                $status = isset($user['status'])? $user['status']:'';
                if($status == '1')
                {
                    $data['Status']  = 'Active';
                }
                else
                {
                    $data['Status']  = 'Blocked';
                }

                array_push($this->arr_view_data, $data);    
            }

            $data = $this->arr_view_data;
            return Excel::create('Patient Reports', function($excel) use ($data) {
                // Set the title
                $excel->setTitle('Patient Reports');
                // Chain the setters
                $excel->setCreator(config('app.project.name'))
                      ->setCompany(config('app.project.name'));
                // Call them separately
                $excel->setDescription('Patient Reports');
                $excel->sheet('Patient Reports', function($sheet) use ($data)
                {
                    //$sheet->row(2, [ucwords('report').' - '.date('d M Y'),'','','']);
                    //$sheet->row(1, $data);
                    $j = 'A'; $k = '1';
                    for($i=0; $i<=15;$i++)
                    {
                        $sheet->cell($j.$k, function($cells) {
                            $cells->setBackground('#495b79');
                            $cells->setFontWeight('bold');
                            $cells->setAlignment('center');
                            $cells->setFontColor('#ffffff');
                        });
                        $j++;
                    }
                    $sheet->fromArray($data);
                    $sheet->setColumnFormat([
                    ]);
                });

            })->download('xlsx');
        }
        else
        {
           Flash::error('Record not available');
        }       
        return redirect()->back();       
    } 
    // End work  


    public function doctor()
    {
        $arr_doctor = [];
        $obj_doctor = $this->UserModel->where('user_type','doctor')
                                      ->with('verification')
                                      ->orderBy('id','desc')
                                      ->get();
        if($obj_doctor)
        {
            $arr_doctor = $obj_doctor->toArray();
        }


        $this->arr_view_data['arr_doctor']     = $arr_doctor;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/doctor';

        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
    
        return view($this->module_view_folder.'/doctor',$this->arr_view_data);
    }
    
    public function doctor_export()
    {
        $arr_doctor = [];
        $obj_doctor = $this->UserModel->with('doctor_data','timezone_details')
                                      ->where('user_type','doctor')
                                      ->with('verification')
                                      ->orderBy('id','desc')
                                      ->get();
        if($obj_doctor)
        {
            $arr_doctor = $obj_doctor->toArray();
        }
        else
        {
            Flash::error('No records for export');
            return redirect()->back();
        }

        if(sizeof($arr_doctor)>500){
            Flash::error("Too many records to export");
            return redirect()->back();
        }

        $arr_fields['sr_no']                    = 'Sr No.';
        $arr_fields['name']                     = 'Name';
        $arr_fields['email']                    = 'Email';
        $arr_fields['date_of_birth']            = 'Date Of Birth';
        $arr_fields['mobile_no']                = 'Mobile No.';
        $arr_fields['contact_no']               = 'Contact No.';
        $arr_fields['gender']                   = 'Gender';
        $arr_fields['address']                  = 'Address';
        $arr_fields['city']                     = 'City';
        $arr_fields['country']                  = 'Country';
        $arr_fields['timezone']                 = 'Timezone';
        $arr_fields['social_login']             = 'Social Login';
        $arr_fields['status']                   = 'Status';
        $arr_fields['email_verification']       = 'Email Verification';
        $arr_fields['mobile_verification']      = 'Mobile Verification';
        $arr_fields['last_login']               = 'Last Login';
        $arr_fields['registered_on']            = 'Registered On';
        $arr_fields['document_verification']    = 'Document Verfication';
        $arr_fields['clinic_name']              = 'Clinic Name';
        $arr_fields['experience']               = 'Experience';
        $arr_fields['clinic_mobile']            = 'Clinic Mobile No.';
        $arr_fields['clinic_contact']           = 'Clinic Contact No.';
        $arr_fields['clinic_email']             = 'Clinic Email';
        $arr_fields['language']                 = 'Language';
        $arr_fields['clinic_address']           = 'Clinic Address';
        $arr_fields['primary_medical_qual']     = 'Primary Medical Qualification';
        $arr_fields['medical_school']           = 'Medical School';
        $arr_fields['yr_obtained']              = 'Year Obtained';
        $arr_fields['country_obtained']         = 'Country Obtained';
        $arr_fields['other_qualifications']     = 'Other Related Qualifications';
        $arr_fields['bank_name']                = 'Bank Name';
        $arr_fields['ac_name']                  = 'Account Name';
        $arr_fields['ac_no']                    = 'Account No';
        $arr_fields['provider_no']              = 'Medicare Provider No';
        $arr_fields['prescriber_no']            = 'Prescriber No';
        $arr_fields['registration_no']          = 'AHPRA Registration No';
        $arr_fields['driving_licence']          = 'Driving License Or Passport';
        $arr_fields['medical_reg_cert']         = 'Medical Registration Certifiate';


        $this->arr_view_data['arr_doctor']      = $arr_doctor;
        $this->arr_view_data['arr_fields']      = $arr_fields;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
    
        return view($this->module_view_folder.'/export_doctor',$this->arr_view_data);
    }

    public function subscription_transactions()
    {
        $arr_transaction = [];
        $obj_transaction = $this->SubscriptionTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->orderBy('id','Desc')
                                                ->get();
        
        if(isset($obj_transaction) && $obj_transaction!=null)
        {
            $arr_transaction = $obj_transaction->toArray();
        }
            
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/subscription_transactions';
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);    
        
        return view($this->module_view_folder.'/subscription_transaction',$this->arr_view_data);
    }

    public function consultation_transactions()
    {
        $arr_transaction = [];
        $obj_transaction = $this->ConsultationTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->orderBy('id','Desc')
                                                ->get();    

        if(isset($obj_transaction) && $obj_transaction!=null)
        {
            $arr_transaction = $obj_transaction->toArray();
        }
            
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        $this->arr_view_data['module_url_path'] = $this->module_url_path.'/consultation_transactions';
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['page_title']      = str_singular($this->module_title);    
        
        return view($this->module_view_folder.'/consultation_transaction',$this->arr_view_data);
    }

    public function subscription_transactions_export(Request $request)
    {
        $arr_transaction = [];
        $data            = array();
        $obj_transaction = $this->SubscriptionTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->with('discount_details')    
                                                ->orderBy('id','Desc')
                                                ->get();
        if($obj_transaction)
        {
           $arr_transaction = $obj_transaction->toArray();
        }
        
        if(isset($arr_transaction) && sizeof($arr_transaction)>0) 
        {
            foreach($arr_transaction as $key => $transaction_data) 
            {
                $data['Sr. No.']     = ($key+1);
                
                $first_name  = isset($transaction_data['user_details']['first_name'])?decrypt_value($transaction_data['user_details']['first_name']):'';
                $last_name   = isset($transaction_data['user_details']['last_name'])?decrypt_value($transaction_data['user_details']['last_name']):'-';
                
                $data['Patient Name']       = ucfirst($first_name).' '.ucfirst($last_name);
                $data['Transaction ID']     = isset($transaction_data['transaction_id']) ? $transaction_data['transaction_id']:'-';
                $data['Transaction Date']   = isset($transaction_data['created_at']) ? date('d-M-Y',strtotime($transaction_data['created_at'])):'00:00:0000';
                $data['Invoice No.']        = isset($transaction_data['invoice_no']) ? $transaction_data['invoice_no']:'-';
                $data['Amount(€)']          = isset($transaction_data['sp_amount']) ? $transaction_data['sp_amount']:0.00;
                $data['Discount Code']      = isset($transaction_data['discount_details']['code']) ? $transaction_data['discount_details']['code']:'-';
                $data['Discount Amount(€)'] = isset($transaction_data['discount_amount']) ? $transaction_data['discount_amount']:0.00;
                $data['Paid Amount(€)']     = isset($transaction_data['paid_amount']) ? $transaction_data['paid_amount']:0.00;
                $data['Start Date']         = isset($transaction_data['start_date']) ? date('d-M-Y',strtotime($transaction_data['start_date'])):'00-00-0000';
                $data['End Date']           = isset($transaction_data['end_date']) ? date('d-M-Y',strtotime($transaction_data['end_date'])):'00-00-0000';
                $data['Status']             = isset($transaction_data['status']) ? ucfirst($transaction_data['status']):'-';
                array_push($this->arr_view_data,$data);    
            }

            $data = $this->arr_view_data;
            return Excel::create('Subscription Reports', function($excel) use ($data) {
                // Set the title
                $excel->setTitle('Subscription Reports');
                // Chain the setters
                $excel->setCreator(config('app.project.name'))
                      ->setCompany(config('app.project.name'));
                // Call them separately
                $excel->setDescription('Subscription Reports');
                $excel->sheet('Subscription Reports', function($sheet) use ($data)
                {
                    //$sheet->row(2, [ucwords('report').' - '.date('d M Y'),'','','']);
                    //$sheet->row(1, $data);
                    $j = 'A'; $k = '1';
                    for($i=0; $i<=11;$i++)
                    {
                        $sheet->cell($j.$k, function($cells) {
                            $cells->setBackground('#495b79');
                            $cells->setFontWeight('bold');
                            $cells->setAlignment('center');
                            $cells->setFontColor('#ffffff');
                        });
                        $j++;
                    }
                    $sheet->fromArray($data);
                    $sheet->setColumnFormat([
                    ]);
                });
            })->download('xlsx');
        }
        else
        {
           Flash::error('Record not available');
        }       
        return redirect()->back();       
    }

    public function consultation_transactions_export(Request $request)
    {
        $arr_transaction  = [];
        $data             = array();
        $obj_transaction  = $this->ConsultationTransactionModel
                                                ->with(['user_details'=>function($query)
                                                {
                                                    $query->select('id','first_name','last_name');
                                                }])
                                                ->whereHas('user_details',function(){})
                                                ->with('discount_details')    
                                                ->orderBy('id','Desc')
                                                ->get();
        if($obj_transaction)
        {
           $arr_transaction = $obj_transaction->toArray();
        }

        if(isset($arr_transaction) && sizeof($arr_transaction)>0) 
        {
            foreach($arr_transaction as $key => $transaction_data) 
            {
                $data['Sr. No.']     = ($key+1);
                
                $first_name  = isset($transaction_data['user_details']['first_name'])?decrypt_value($transaction_data['user_details']['first_name']):'';
                $last_name   = isset($transaction_data['user_details']['last_name'])?decrypt_value($transaction_data['user_details']['last_name']):'-';
                
                $data['Patient Name']       = ucfirst($first_name).' '.ucfirst($last_name);
                $data['Transaction ID']     = isset($transaction_data['transaction_id']) ? $transaction_data['transaction_id']:'-';
                $data['Consultation ID']    = isset($transaction_data['consultation_id']) ? $transaction_data['consultation_id']:'-';
                $data['Transaction Date']   = isset($transaction_data['created_at']) ? date('d-M-Y',strtotime($transaction_data['created_at'])):'00:00:0000';
                $data['Invoice No.']        = isset($transaction_data['invoice_no']) ? $transaction_data['invoice_no']:'-';
                $data['Amount(€)']          = isset($transaction_data['amount']) ? $transaction_data['amount']:0.00;
                $data['Discount Code']      = isset($transaction_data['discount_details']['code']) ? $transaction_data['discount_details']['code']:'-';
                $data['Discount Amount(€)'] = isset($transaction_data['discount_amount']) ? $transaction_data['discount_amount']:0.00;
                $data['Paid Amount(€)']     = isset($transaction_data['paid_amount']) ? $transaction_data['paid_amount']:0.00;
                $data['Status']             = isset($transaction_data['status']) ? ucfirst($transaction_data['status']):'-';
                array_push($this->arr_view_data,$data);      
            }

            $data = $this->arr_view_data;            
            return Excel::create('Consultation Reports', function($excel) use ($data) {
                // Set the title
                $excel->setTitle('Consultation Reports');
                // Chain the setters
                $excel->setCreator(config('app.project.name'))
                      ->setCompany(config('app.project.name'));
                // Call them separately
                $excel->setDescription('Consultation Reports');
                $excel->sheet('Consultation Reports', function($sheet) use ($data)
                {
                    //$sheet->row(2, [ucwords('report').' - '.date('d M Y'),'','','']);
                    //$sheet->row(1, $data);
                    $j = 'A'; $k = '1';
                    for($i=0; $i<=10;$i++)
                    {
                        $sheet->cell($j.$k, function($cells) {
                            $cells->setBackground('#495b79');
                            $cells->setFontWeight('bold');
                            $cells->setAlignment('center');
                            $cells->setFontColor('#ffffff');
                        });
                        $j++;
                    }
                    $sheet->fromArray($data);
                    $sheet->setColumnFormat([
                    ]);
                });
            })->download('xlsx');
        }
        else
        {
           Flash::error('Record not available');
        }       
        return redirect()->back();        
    }

}
