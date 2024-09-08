<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\HealthGeneralModel;
use App\Models\MedicationsModel;
use App\Models\LifestyleModel;
use App\Models\MedicalGeneralModel;

use Sentinel;
use Session;
use Validator;

class MyHealthController extends Controller
{
    public function __construct()
    {
        $this->HealthGeneralModel        = new HealthGeneralModel();
        $this->MedicationsModel          = new MedicationsModel();
        $this->LifestyleModel            = new LifestyleModel();
        $this->MedicalGeneralModel       = new MedicalGeneralModel();

    	$this->arr_view_data             = [];
        $this->module_title              = "My Health";
        $this->parent_url_path           = url('/').'/patient';
        $this->module_url_path           = url('/').'/patient/my_health';
        $this->module_view_folder        = "front.patient.my_health";

        $this->breadcrum_level_1         = 'Dashboard';
        $this->breadcrum_level_2         = $this->module_title;

        $this->breadcrum_level_1_url     = $this->parent_url_path.'/dashboard';
        $this->breadcrum_level_2_url     = $this->module_url_path;

        $this->patient_medication_base_path   = base_path().config('app.img_path.patient_medication');
        $this->patient_medication_public_path = url('/').config('app.img_path.patient_medication');

        $user                            = Sentinel::check();
        $this->user_id                   = '';

        if($user)
        {
           $this->user_id = $user->id;
        }
    }

    public function medical_history()
    {
        $arr_general = $arr_selected_general = $selected_general_ids = $arr_lifestyle = $arr_medication = [];

        $obj_general = $this->MedicalGeneralModel->select('id','name')->where('status','=','1')->get();
        if($obj_general)
        {
            $arr_general = $obj_general->toArray();
        }

        $obj_selected_general = $this->HealthGeneralModel->select('id','medical_general_id')
                                                         ->with(['general_details'=>function($qry){
                                                                $qry->select('id','name');
                                                          }])
                                                         ->where('user_id','=',$this->user_id)
                                                         ->get();
        if($obj_selected_general)
        {
            $arr_selected_general = $obj_selected_general->toArray();
        }

        foreach ($arr_selected_general as $value) 
        {
           $selected_general_ids[]  = $value['medical_general_id'];
        }

        $obj_lifestyle = $this->LifestyleModel->where('user_id','=',$this->user_id)
                                              ->first();
        if($obj_lifestyle)
        {
            $arr_lifestyle = $obj_lifestyle->toArray();
        }

        $obj_medication = $this->MedicationsModel->select('id','name')
                                                 ->where('user_id','=',$this->user_id)
                                                 ->orderBy('id','desc')
                                                 ->get();
        if($obj_medication)
        {
            $arr_medication = $obj_medication->toArray();
        }
        
        $this->arr_view_data['arr_general']               = $arr_general;
        $this->arr_view_data['arr_selected_general']      = $arr_selected_general;
        $this->arr_view_data['selected_general_ids']      = $selected_general_ids;
        $this->arr_view_data['arr_lifestyle']             = $arr_lifestyle;
        $this->arr_view_data['arr_medication']            = $arr_medication;
        $this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'Medical History';
        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/medical_history';
        $this->arr_view_data['page_title']                = 'Medical History';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
    
    	return view($this->module_view_folder.'.medical_history', $this->arr_view_data);
    }

    public function add_medication()
    {
    	$this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'Medical History';
        $this->arr_view_data['breadcrum_level_4']         = 'Add Medication';

        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/medical_history';
        $this->arr_view_data['breadcrum_level_4_url']     = $this->breadcrum_level_2_url.'/add_medication';
        $this->arr_view_data['page_title']                = 'Add Medication';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
    
    	return view($this->module_view_folder.'.add_medication', $this->arr_view_data);
    }

    public function store_medication(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['name']           = 'required';
        $arr_rules['date']           = 'required';
        $arr_rules['frequency']      = 'required';
        $arr_rules['medication_use'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        if($request->hasFile('file_medication'))
        {
            $medication = $request->file('file_medication');

            if(isset($medication) && sizeof($medication)>0)
            {
                $extention = strtolower($medication->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of medication. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($medication->getClientSize() > 5000000)
                {
                    Session::flash('error','medication file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                    
                    $medication_name   = $request->file('file_medication');
                    $medication_ext    = strtolower($request->file('file_medication')->getClientOriginalExtension());
                    $medication_name   = uniqid().'.'.$medication_ext;
                    $medication_result = $request->file('file_medication')->move($this->patient_medication_base_path, $medication_name);
                }

                $arr_data['medication_file']       = isset($medication_name) && !empty($medication_name) ? $medication_name : '';
            }
            else
            {
                Session::flash('error','Invalid file of medication. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        $arr_data['user_id'] = $this->user_id;
        $arr_data['name'] = trim($request->input('name'));
        $arr_data['date'] = trim(date('Y-m-d',strtotime($request->input('date'))));
        $arr_data['frequency'] = trim($request->input('frequency'));
        $arr_data['medication_use'] = trim($request->input('medication_use'));

        $status = $this->MedicationsModel->create($arr_data);
        if($status)
        {
            Session::flash('success','Medication saved succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured,while adding medication.');
            return response()->json($return_arr);
        }
    }

    public function edit_medication($enc_id)
    {
        if($enc_id!='')
        {
            $arr_medication_details = [];
            $id = base64_decode($enc_id);
            $obj_medication_details = $this->MedicationsModel->where('id','=',$id)
                                                             ->first();

            if($obj_medication_details)
            {
                $arr_medication_details = $obj_medication_details->toArray();
            }

            $this->arr_view_data['arr_medication_details']         = $arr_medication_details;
            $this->arr_view_data['enc_id']                         = $enc_id;
            $this->arr_view_data['breadcrum_level_1']              = $this->breadcrum_level_1;
            $this->arr_view_data['breadcrum_level_2']              = $this->breadcrum_level_2;
            $this->arr_view_data['breadcrum_level_3']              = 'Medical History';
            $this->arr_view_data['breadcrum_level_4']              = 'Edit Medication';
            $this->arr_view_data['breadcrum_level_1_url']          = $this->breadcrum_level_1_url;
            $this->arr_view_data['breadcrum_level_3_url']          = $this->breadcrum_level_2_url.'/medical_history';
            $this->arr_view_data['breadcrum_level_4_url']          = $this->breadcrum_level_2_url.'/edit_medication';
            $this->arr_view_data['page_title']                     = 'Edit Medication';
            $this->arr_view_data['module_url_path']                = $this->module_url_path;
            $this->arr_view_data['medication_base_path']   = $this->patient_medication_base_path;
            $this->arr_view_data['medication_public_path'] = $this->patient_medication_public_path;
        
            return view($this->module_view_folder.'.edit_medication', $this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went wrong,Please try again.');
            return redirect()->back();
        }
    }

    public function upadte_medication(Request $request,$enc_id=false)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['name']           = 'required';
        $arr_rules['date']           = 'required';
        $arr_rules['frequency']      = 'required';
        $arr_rules['medication_use'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all required field';

            return response()->json($return_arr);
        }

        $id = base64_decode($enc_id);

        if($request->hasFile('file_medication'))
        {
            $medication = $request->file('file_medication');

            if(isset($medication) && sizeof($medication)>0)
            {
                $extention = strtolower($medication->getClientOriginalExtension());
                $valid_ext = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('error','Invalid file of medication. Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp, txt, pdf, csv, doc, docx, xlsx');
                    return response()->json($return_arr);
                }
                else if($medication->getClientSize() > 5000000)
                {
                    Session::flash('error','medication file is more than limit size. Please upload image/document with small size. Max size allowed is 5mb');
                    return response()->json($return_arr);
                }
                else
                {
                    
                    $medication_name   = $request->file('file_medication');
                    $medication_ext    = strtolower($request->file('file_medication')->getClientOriginalExtension());
                    $medication_name   = uniqid().'.'.$medication_ext;
                    $medication_result = $request->file('file_medication')->move($this->patient_medication_base_path, $medication_name);
                    if($medication_result)
                    {
                         @unlink($this->patient_medication_base_path.'/'.$request->input('old_medication_file'));
                    }
                }

                $arr_data['medication_file']       = isset($medication_name) && !empty($medication_name) ? $medication_name : '';
            }
            else
            {
                Session::flash('error','Invalid file of medication. Please upload valid image/document.');
                return response()->json($return_arr);
            }
        }

        $arr_data['name'] = trim($request->input('name'));
        $arr_data['date'] = trim(date('Y-m-d',strtotime($request->input('date'))));
        $arr_data['frequency'] = trim($request->input('frequency'));
        $arr_data['medication_use'] = trim($request->input('medication_use'));

        $status = $this->MedicationsModel->where('id','=',$id)->update($arr_data);
        if($status)
        {
            Session::flash('success','Medication updated succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Problem occured,while update medication.');
            return response()->json($return_arr);
        }

    }

    public function view_medication($enc_id=false)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $obj_medication_details = $this->MedicationsModel->where('id','=',$id)
                                                     ->first();
            if($obj_medication_details)
            {
                $arr_medication_details = $obj_medication_details->toArray();
            }

            $this->arr_view_data['arr_medication_details']         = $arr_medication_details;
            $this->arr_view_data['enc_id']                         = $enc_id;
            $this->arr_view_data['breadcrum_level_1']              = $this->breadcrum_level_1;
            $this->arr_view_data['breadcrum_level_2']              = $this->breadcrum_level_2;
            $this->arr_view_data['breadcrum_level_3']              = 'Medical History';
            $this->arr_view_data['breadcrum_level_4']              = 'View Medication';
            $this->arr_view_data['breadcrum_level_1_url']          = $this->breadcrum_level_1_url;
            $this->arr_view_data['breadcrum_level_3_url']          = $this->breadcrum_level_2_url.'/medical_history';
            $this->arr_view_data['breadcrum_level_4_url']          = $this->breadcrum_level_2_url.'/edit_medication';
            $this->arr_view_data['page_title']                     = 'View Medication';
            $this->arr_view_data['module_url_path']                = $this->module_url_path;
            $this->arr_view_data['medication_base_path']   = $this->patient_medication_base_path;
            $this->arr_view_data['medication_public_path'] = $this->patient_medication_public_path;
        
            return view($this->module_view_folder.'.view_medication', $this->arr_view_data);
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
    }

    public function delete_medication($enc_id=false)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $obj_medication = $this->MedicationsModel->where('id','=',$id)
                                             ->where('user_id','=',$this->user_id)
                                             ->first();
                                             
            $medication_file = isset($obj_medication->medication_file)?$obj_medication->medication_file:'';

            $status = $obj_medication->delete();

            if($status)
            {
                if(isset($medication_file) && $medication_file!=null)
                {
                    $file         = $this->patient_medication_base_path.'/'.$medication_file;
                    if(file_exists($file))
                    {
                        unlink($file);
                    }
                }

                Session::flash('success','Medication remove succssfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error','Problem occured,while removing medication.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function lifestyle()
    {
        $arr_lifestyle = [];
        $obj_lifestyle = $this->LifestyleModel->where('user_id','=',$this->user_id)->first();
        if($obj_lifestyle)
        {
            $arr_lifestyle = $obj_lifestyle->toArray();
        }
        
        $this->arr_view_data['arr_lifestyle']             = $arr_lifestyle;
    	$this->arr_view_data['breadcrum_level_1']         = $this->breadcrum_level_1;
        $this->arr_view_data['breadcrum_level_2']         = $this->breadcrum_level_2;
        $this->arr_view_data['breadcrum_level_3']         = 'Medical History';
        $this->arr_view_data['breadcrum_level_4']         = 'Lifestyle';

        $this->arr_view_data['breadcrum_level_1_url']     = $this->breadcrum_level_1_url;
        $this->arr_view_data['breadcrum_level_3_url']     = $this->breadcrum_level_2_url.'/medical_history';
        $this->arr_view_data['breadcrum_level_4_url']     = $this->breadcrum_level_2_url.'/lifestyle';
        $this->arr_view_data['page_title']                = 'Lifestyle';
        $this->arr_view_data['module_url_path']           = $this->module_url_path;
    
    	return view($this->module_view_folder.'.lifestyle', $this->arr_view_data);
    }

    public function update_lifestyle(Request $request)
    {
        $arr_rules = $return_arr = [];

        $arr_rules['smoking']        = 'required';
        $arr_rules['exercise']       = 'required';
        $arr_rules['alcohol']        = 'required';
        $arr_rules['stress_level']   = 'required';
        $arr_rules['marital_status'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';
            return response()->json($return_arr);
        }

        $user_id = $this->user_id;

        $arr_data['user_id']        = $user_id;
        $arr_data['smoking']        = trim($request->input('smoking'));
        $arr_data['exercise']       = trim($request->input('exercise'));
        $arr_data['alcohol']        = trim($request->input('alcohol'));
        $arr_data['stress_level']   = trim($request->input('stress_level'));
        $arr_data['marital_status'] = trim($request->input('marital_status'));

        $status = $this->LifestyleModel->updateOrCreate(['user_id'=>$user_id],$arr_data);
        if($status)
        {
            Session::flash('success','Lifestyle details saved succssfully.');
            return response()->json($return_arr);
        }
        else
        {
            Session::flash('error','Something went wrong while update lifestyle details, Please try again.');
            return response()->json($return_arr);
        }
    }

    public function store_general(Request $request)
    {
        $arr_rules = $return_arr = $medical_general = [];

        $arr_rules['medical_general']        = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            $return_arr['status']  = 'error';
            $return_arr['message'] = 'Please fill all the required field.';
            return response()->json($return_arr);
        }

        $user_id = $this->user_id;
        $medical_general =$request->input('medical_general');
        if(isset($medical_general) && sizeof($medical_general)>0)
        {
            $flag = '0';
            foreach ($medical_general as $key => $value) 
            {
                $flag = '0';
                $arr_data['user_id']            = $user_id;
                $arr_data['medical_general_id'] = $value;

                $status = $this->HealthGeneralModel->create($arr_data);
                if($status)
                {
                    $flag = '1';
                }    
            }

            if($flag == '1')
            {
                Session::flash('success','Medical general added succssfully.');
                return response()->json($return_arr);
            }
            else
            {
                Session::flash('error','Problem occured while adding medical general, Please try again.');
                return response()->json($return_arr);
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return response()->json($return_arr);
        }
    }

    public function delete_general($enc_id=false)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $status = $this->HealthGeneralModel->where('id','=',$id)->delete();
            if($status)
            {
                Session::flash('success','Medical general remove succssfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error','Problem occured,while removing medical general.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Something went wrong, Please try again.');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
