<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MedicalCertificateModel;
use App\Models\PrescriptionModel;

use Sentinel;

class DocumentController extends Controller
{
    public function __construct()
    {
		$this->MedicalCertificateModel       = new MedicalCertificateModel();
		$this->PrescriptionModel  		     = new PrescriptionModel();
		$this->arr_view_data                 = [];
		$this->module_title                  = "My Documents";
		$this->parent_url_path               = url('/').'/patient';
		$this->module_url_path               = url('/').'/patient/documents';
		$this->module_view_folder            = "front.patient.my_documents";
		$this->breadcrum_level_1             = 'Dashboard';
		$this->breadcrum_level_2             = $this->module_title;
		$this->breadcrum_level_1_url         = $this->parent_url_path.'/dashboard';
		$this->breadcrum_level_2_url         = $this->module_url_path;

		$this->prescription_file_base_path   = base_path().config('app.img_path.prescription_file');
		$this->prescription_file_public_path = url('/').config('app.img_path.prescription_file');

        $this->medical_certificate_file_base_path   = base_path().config('app.img_path.medical_certificate');
        $this->medical_certificate_file_public_path = url('/').config('app.img_path.medical_certificate');
        
		$user            = Sentinel::check();
		$this->user_id   = '';
        if($user)
        {
           $this->user_id = $user->id;
        }
    }

    public function prescription(Request $request)
    {
        $arr_prescription = [];
        $arr_pagination   = null;
        
        $obj_prescription = $this->PrescriptionModel->select('id','user_id','name','created_at')
                                                    ->where('user_id',$this->user_id)
                                                    ->orderBy('id','Desc')
                                                    ->paginate(10);
        
        if( isset( $obj_prescription ) && $obj_prescription!=null ) 
        {
            $arr_pagination     = clone $obj_prescription;
            $arr_prescription = $obj_prescription->toArray();
        }
        	
        $this->arr_view_data['arr_pagination']                = isset( $arr_pagination ) ? $arr_pagination : null;
        $this->arr_view_data['arr_prescription']              = $arr_prescription;
        
        $this->arr_view_data['breadcrum_level_1']             = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']             = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']             = 'Prescription';
        
        $this->arr_view_data['breadcrum_level_1_url']         = $this->breadcrum_level_1_url;

        $this->arr_view_data['page_title']                    = 'Prescription';
        $this->arr_view_data['prescription_file_base_path']   = $this->prescription_file_base_path;
        $this->arr_view_data['prescription_file_public_path'] = $this->prescription_file_public_path;
        $this->arr_view_data['module_url_path']               = $this->module_url_path.'/prescription';
    	
    	return view($this->module_view_folder.'.prescriptions', $this->arr_view_data);
    }

    public function view_prescription( $enc_id = false )
    {
        $arr_prescription = [];
        
        $obj_prescription = $this->PrescriptionModel->with(['doctor_details' => function($query){
                                                        $query->select('id','prefix','first_name','last_name')->with('doctor_prefix');
                                                    }])
                                                    ->where('id', base64_decode($enc_id))
                                                    ->where('user_id',$this->user_id)
                                                    ->orderBy('id','Desc')
                                                    ->first();
        
        if( isset( $obj_prescription ) && $obj_prescription!=null ) 
        {
            $arr_prescription = $obj_prescription->toArray();
        }

        $this->arr_view_data['arr_prescription']              = $arr_prescription;
        
        $this->arr_view_data['breadcrum_level_1']             = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']             = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']             = 'Prescription';
        $this->arr_view_data['breadcrum_level_4']             = 'View';

        $this->arr_view_data['breadcrum_level_1_url']         = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']         = $this->module_url_path.'/prescription';
        
        $this->arr_view_data['page_title']                    = 'View Prescription';
        $this->arr_view_data['module_url_path']               = $this->module_url_path;
        
        $this->arr_view_data['prescription_file_base_path']   = $this->prescription_file_base_path;
        $this->arr_view_data['prescription_file_public_path'] = $this->prescription_file_public_path;
    	
    	return view($this->module_view_folder.'.view_prescription', $this->arr_view_data);
    }

    public function medical_certificate(Request $request)
    {
        $arr_medical    = [];
        $arr_pagination = null;
        
        $obj_medical = $this->MedicalCertificateModel->where('user_id',$this->user_id)->orderBy('id','Desc')->paginate(10);
        if( isset( $obj_medical ) && $obj_medical!=null ) 
        {
            $arr_pagination = clone $obj_medical;
            $arr_medical    = $obj_medical->toArray();
        }

        $this->arr_view_data['arr_pagination']                = isset( $arr_pagination ) ? $arr_pagination : null;
        $this->arr_view_data['arr_medical']                   = $arr_medical;
        
        $this->arr_view_data['breadcrum_level_1']             = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']             = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']             = 'Medical Certificate';
        
        $this->arr_view_data['breadcrum_level_1_url']         = $this->breadcrum_level_1_url;

        $this->arr_view_data['page_title']                    = 'Medical Certificate';
        $this->arr_view_data['module_url_path']               = $this->module_url_path.'/medical_certificate';

        $this->arr_view_data['medical_certificate_file_base_path']   = $this->medical_certificate_file_base_path;
        $this->arr_view_data['medical_certificate_file_public_path'] = $this->medical_certificate_file_public_path;
        
        return view($this->module_view_folder.'.medical_certificate', $this->arr_view_data);
    }
}
